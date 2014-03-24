<?php if (!defined('BASEPATH')) die();
    
    
class user_controller extends Main_Controller {
    
         var $ID; 
         var $Name;  
         var $Flag; 
         var $Date; 
         var $Phone; 
         var $Email;
         var $Address;
         var $Password; 
         var $Dominican_Republic_City;
             
        public function __construct()
        {
            parent::__construct();
            $this->load->model("user_model");
            $this->load->model("ad_model");
            $this->load->model("car_model");
            $this->load->library('form_validation');
            $this->load->helper('form');
            $this->load->library('session');
            $this->load->helper('url');  
        }  
        function index ()
	{
          $this->showUserForm();
	}
            
       /**
        * Shoe the create user from
        * 
        * @param string an optional var name to pass to the view
        * @param var an optional var wich will be calle by the first name param
        * @author Vincent Guerrero <v.davidguerrero@gmail.com>
        * @todo - Check 
        * @see 
        */ 
        public function showUserForm($key="message",$val=" ")
        {
            $dataPass["cities"] = $this->user_model->getDominicanRepublicCities();
            $dataPass["$key"] = $val;
            $this->load->view('include/header'); 
            $this->load->view('user/create_user_view',$dataPass);  
            $this->load->view('include/footer'); 
        }
            
         /**
        * Create a user from a form. Valitades the form too.
        * 
        * 
        * @author Vincent Guerrero <v.davidguerrero@gmail.com>
        * @todo - Check 
        * @see 
        */ 
        public function createUser()
	{ 
            $this->form_validation->set_rules('Name'                        , 'Name.'    , 'required');
            $this->form_validation->set_rules('Password'                    , 'Password.', 'min_length[6]|required');
            $this->form_validation->set_rules('ID'                          , 'ID.'      , 'required|exact_length[11]|integer');
            $this->form_validation->set_rules('Address'                     , 'Address.' , 'required');
            $this->form_validation->set_rules('Phone'                       , 'Phone.'   , 'required');
            $this->form_validation->set_rules('Dominican_Republic_City'   , 'City.'    , 'required');
            $this->form_validation->set_rules('Flag'                        , 'Flag.'    , 'required');
            $this->form_validation->set_rules('Email'                       , 'Email.'   , 'required|valid_email');
            $this->form_validation->set_message('exact_length'              , 'Introduzca una Cedula o RNC Valido.EX 00119045615');
            $this->form_validation->set_message('min_length'                , 'La contraseña debe tener al menos 6 Caracteres.');
            $this->form_validation->set_message('required'                  , ' ');
            $this->form_validation->set_message('valid_email'               , 'Digite un correo Valido.');
                
            if($this->form_validation->run() === FALSE) 
            {
                $this->showUserForm("message","Existe Un Problema En El Formulario");
            }
                
            else if($this->user_model->getUser($this->input->post('cedula_rnc')))
            {
                $this->showUserForm("message","El RNC o Cedula Ya Existe");
            }
                
            else  
            {
               $userObject = new stdClass();
               foreach($this->input->post() as $k => $formFields)
               {
                   $userObject->$k = $formFields;
               }
               $userObject->Date     = $now = date("Y-m-d H:i:s");
               $userObject->Password = MD5($this->input->post('Password'));
               $this->instanceUser($userObject);
               $this->user_model->insertUser($this->getThisObjectOnly());
                    
               $sess_array = array( 'id'    => $this->ID, 'flag' => $this->Flag);
               $this->session->set_userdata('logged_in', $sess_array);  
               redirect("/ad_controller");
            }
                
	}
            
       /**
        * shows the user information view from the logged user.
        * 
        * @author Vincent Guerrero <v.davidguerrero@gmail.com>
        * @todo - Check 
        * @see 
        */ 
        public function showUser()
        {
            $sessionInfo = $this->session->userdata('logged_in');
            $id     = $sessionInfo['id'];
            $flag   = $sessionInfo['flag'];
            if($id)
            {
                $dataPass["user"]       =  $this->user_model->getUser($id);
                if(!$flag)
                {
                    $dataPass["pendingAds"] =  $this->ad_model->getAdsBySeller($id,0);
                    $dataPass["activeAds"]  =  $this->ad_model->getAdsBySeller($id,1);
                    $dataPass["oldAds"]     =  $this->ad_model->getAdsBySeller($id,2);  
                    $view = "user/seller_information_view";   
                } 
                else
                {
                    $dataPass["pendingAds"] =  $this->ad_model->getAdsByMechanic($id,0);
                    $view = "user/mechanic_information_view";
                   
                }
                $this->load->view('include/header');
                $this->load->view($view,$dataPass);  
                $this->load->view('include/footer');
            }
             else 
             {
                $dataPass["message"] = "Debe Iniciar Sesion Primero";
                $this->load->view('include/header');
                $this->load->view('user/login_user_view',$dataPass);  
                $this->load->view('include/footer');    
             }
        }     
       
            
        /**
        * check the user name and password then initialize the session. Via Post
        * 
        * @author Vincent Guerrero <v.davidguerrero@gmail.com>
        * @todo - Check 
        * @see 
        */ 
        public function userLogin()
        {    
            $this->form_validation->set_rules('cedula_rnc'      , 'ID'            , 'required|exact_length[11]|integer');
            $this->form_validation->set_rules('password'        , 'Password'      , 'required');
            $this->form_validation->set_message('exact_length'  , 'Introduzca un RNC o Cedula Valida. EX 00119045615');
            $this->form_validation->set_message('required'      , 'Todos Los Campos Son requeridos');
                
                
            if($this->form_validation->run() === FALSE)
            {
                $dataPass["message"] = " ";
                $this->load->view('include/header'); 
                $this->load->view('user/login_user_view',$dataPass);
                $this->load->view('include/footer');  
            }
            else 
            {
                
                $cedula_rnc = $this->input->post("cedula_rnc");
                $password = MD5($this->input->post("password"));
                $userObject =  $this->user_model->checkUserLogin($cedula_rnc,$password);
                if($userObject)
                { 
                  $this->instanceUser($userObject);
                  $sess_array = array( 'id'       => $this->ID, 'flag' => $this->Flag);
                  $this->session->set_userdata('logged_in', $sess_array);
                  redirect("/ad_controller");
                }
                else
                {
                    $dataPass["message"] = "Introduzca Valores Correctos";
                    $this->load->view('include/header'); 
                    $this->load->view('user/login_user_view',$dataPass);  
                    $this->load->view('include/footer'); 
                }
             }
        }
            
        /**
        * kill the user session
        * 
        * @author Vincent Guerrero <v.davidguerrero@gmail.com>
        * @todo - Check 
        * @see 
        */ 
        public function userLogOff()
        { 
            $this->session->sess_destroy();  
            redirect("/ad_controller");
        }
            
       /**
        * Check the user and pass via JSON
        * 
        * @return string OK for good, NO for bad.
        * @author Vincent Guerrero <v.davidguerrero@gmail.com>
        * @todo - Check 
        * @see 
        */ 
        public function remoteUserLogin()
        {    
            $json = file_get_contents('php://input');
            $obj = json_decode($json,true);
            $userID    =  $obj['userID'];
            $password  =  MD5($obj['password']);
                
            $check =  $this->user_model->checkUserLogin($userID,$password);
  
            if($check)
                $response = array("Response" => "OK");
            else
                $response = array("Response" => "NO");
                    
             header('Content-type: application/json');
             echo json_encode($response);        
                 
        }
            
       /**
        * Initialize this object by a object from the DB
        * 
        * @return string OK for good, NO for bad.
        * @author Vincent Guerrero <v.davidguerrero@gmail.com>
        * @todo - Check 
        * @see 
        */
        public function instanceUser($userObject)
        {    
            
         $this->ID                       = $userObject->ID; 
         $this->Name                     = $userObject->Name;  
         $this->Flag                     = $userObject->Flag; 
         $this->Date                     = $userObject->Date; 
         $this->Phone                    = $userObject->Phone; 
         $this->Email                    = $userObject->Email;
         $this->Address                  = $userObject->Address;
         $this->Password                 = $userObject->Password; 
         $this->Dominican_Republic_City  = $userObject->Dominican_Republic_City; 
        }
            
        /**
        * Get this object wothout the parent
        * 
        * @return userObject without its parent
        * @author Vincent Guerrero <v.davidguerrero@gmail.com>
        * @todo - Check 
        * @see 
        */
        function getThisObjectOnly()
        {
           $child = (object) array();
            $i=0; 
            foreach($this as $property => $propertyValue)
            {
                 if($i==9)
                 {
                     break;
                 }
                 $i++;
                 $child->$property = $propertyValue;
            }
             return $child; 
        }
} 