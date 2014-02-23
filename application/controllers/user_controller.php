<?php if (!defined('BASEPATH')) die();


class user_controller extends Main_Controller {

    
    //Falta buscar la forma de llamar a ad_controller->index() desde aquí.;
        public function __construct()
        {
            parent::__construct();
            $this->load->model("user_model");
            $this->load->library('form_validation');
            $this->load->helper('form');
            $this->load->library('session');
            //$this->load->helper('url');
        }  
        function index ()
	{
           $this->showUserForm(1);
            // if $flag == 0, we're creating an Taller. if it's 1 then is a dealer
           // $dataPass["var"] = " ";
           // $dataPass["flagValue"] = $flag;
           // $this->load->view('include/header'); 
           // $this->load->view('user/login_user_view',$dataPass);  
           // $this->load->view('include/footer');   
	}

        public function showUserForm($flag)
        {
           //if $flag == 0, we're creating an Taller. if it's 1 then is a dealer
            $dataPass["var"] = " ";
            $dataPass["flagValue"] = $flag;
            $this->load->view('include/header'); 
            $this->load->view('user/create_user_view',$dataPass);  
            $this->load->view('include/footer'); 
        }
        public function createUser()
	{
            //Recives the user creation form, validate it, an create an user. 
            $this->form_validation->set_rules('name'        , 'Name.'    , 'required');
            $this->form_validation->set_rules('password'    , 'Password.', 'min_length[6]|required');
            $this->form_validation->set_rules('cedula_rnc'  , 'ID.'      , 'required|exact_length[11]|integer');
            $this->form_validation->set_rules('address'     , 'Address.' , 'required');
            $this->form_validation->set_rules('phone'       , 'Phone.'   , 'required');
            $this->form_validation->set_rules('email'       , 'Email.'   , 'required|valid_email');
            $this->form_validation->set_message('exact_length', 'Introduzca una Cedula o RNC Valido.EX 00119045615');
            $this->form_validation->set_message('min_length', 'La contraseña debe tener al menos 6 Caracteres.');
            $this->form_validation->set_message('required', ' ');
            $this->form_validation->set_message('valid_email', 'Digite un correo Valido.');
         
            $dataPass["flagValue"] = $this->input->post('flag');
            
            if($this->form_validation->run() === FALSE) 
            {
                $dataPass["var"] = "Existe Un Problema En El Formulario";
                $this->load->view('include/header'); 
                $this->load->view('user/create_user_view',$dataPass);  
                $this->load->view('include/footer'); 
            }
            
            else if($this->user_model->checkUser($this->input->post('cedula_rnc')) > 0)
            {
                $dataPass["var"] = "El RNC o Cedula Ya Existe";
                $this->load->view('include/header'); 
                $this->load->view('user/create_user_view',$dataPass);  
                $this->load->view('include/footer'); 
            }
            
            else  
            {
                $now = date("Y-m-d H:i:s");
                $password = $this->input->post('password');
                $data = array(  "name"     => $this->input->post('name'),
                                "address"  => $this->input->post('address'),
                                "ID "      => $this->input->post('cedula_rnc'),
                                "phone"    => $this->input->post('phone'),
                                "flag"     => $this->input->post('flag'),
			        "email"    => $this->input->post('email'),
			        "date"    => $now,
                                "password" => MD5($password));
                $this->user_model->insertUser($data);
                $dataPass["var"] = "Usuario insertado Correctamente";
                $this->load->view('include/header'); 
                $this->load->view('user/succesful_user_view',$dataPass);  
                $this->load->view('include/footer'); 
            }
               
	}
        
        public function deleteUser()
        {
            $cedula = $this->input->post('cedula_rnc');
            $this->user_model->deleteUser($cedula); 
        }
        
        public function showUser($ID)
        {
            $cedula = $this->input->post('cedula_rnc');
            $dataPass["var"] = $this->user_model->getUserByRnc($ID);
            $this->load->view('include/header'); 
            $this->load->view('user/user_information_view',$dataPass);  
            $this->load->view('include/footer');    
        }
        
        public function userLogin()
        {      
            $this->form_validation->set_rules('cedula_rnc'  , 'ID'      , 'required|exact_length[11]|integer');
            $this->form_validation->set_rules('password'  , 'Password'      , 'required');
            $this->form_validation->set_message('exact_length', 'Introduzca un RNC o Cedula Valida. EX 00119045615');
            $this->form_validation->set_message('required', 'Todos Los Campos Son requeridos');
             $dataPass["var"] = " ";
            
            if($this->form_validation->run() === FALSE)
            {
               
                $this->load->view('include/header'); 
                $this->load->view('user/login_user_view',$dataPass);
                $this->load->view('include/footer');  
            }
            else 
            {
                $cedula_rnc = $this->input->post("cedula_rnc");
                $password = MD5($this->input->post("password"));
                $user =  $this->user_model->checkUserLogin($cedula_rnc,$password);
                if($user)
                { 
                
                  $sess_array = array( 'id'       => $user->ID);
                  $this->session->set_userdata('logged_in', $sess_array);
                    
                    $this->load->view('include/header'); 
                    $this->load->view('ad/search_ad_view',$dataPass);  
                    $this->load->view('include/footer'); 
                }
                else
                {
                    $dataPass["var"] = "Introduzca Valores Correctos";
                    $this->load->view('include/header'); 
                    $this->load->view('user/login_user_view',$dataPass);  
                    $this->load->view('include/footer'); 
                }
                
              }
            
        }
        
        public function userLogOff()
        {
             $dataPass["var"] = " ";
            $this->session->sess_destroy();
            $this->load->view('include/header'); 
            $this->load->view('ad/search_ad_view',$dataPass);  
            $this->load->view('include/footer');
        }
    
} 