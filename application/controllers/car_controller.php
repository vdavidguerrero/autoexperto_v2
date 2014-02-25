<?php if (!defined('BASEPATH')) die();


class user_controller extends Main_Controller {

    
    //Falta buscar la forma de llamar a ad_controller->index() desde aquí.;
        public function __construct()
        {
            parent::__construct();
            $this->load->model("car_model");
            $this->load->library('form_validation');
            $this->load->helper('form');
            $this->load->library('session');
            $this->load->helper('url');
            //Arreglar esto con el redirect...
            
        }  
        function index ()
	{
         $this->getModelFormData(1);
            // if $flag == 0, we're creating an Taller. if it's 1 then is a dealer
           // $dataPass["var"] = " ";
           // $dataPass["flagValue"] = $flag;
           // $this->load->view('include/header'); 
           // $this->load->view('user/login_user_view',$dataPass);  
           // $this->load->view('include/footer');   
	}
        
         public function getModelFormData($VIN)
        {
             
             $vin = $this->input->post("VIN");
            /*
             * Retorna los datos necesarios para llenar el formulario del carro. 
             * 
             * Primer Parte: Gestion del carro.
             * 
             * 1)Revisa si ya exisiste un carro único con el VIN. Si exsite se retorna el formulario
             * 
             * 
             * 2) Si el no existe el carro entonces Realiza un request a vinquery.com y trae los datos del VIN. 
             * 
             * 
             * 3) Con el TRIM, Modelo, Año y marca,y revisa si Existe un módelo único con esas descripciones.
             *  Si existe trae el ID. 
             * 
             * Si no existe , pues se procede a crear un Modelo_único con los datos de vinQuery. Y retorna el ID
             *  
             * 
             * Luego que se tiene el ID del modelo_Unico, se crea el carro único y se retorna el formulario.
             * 
             * Segunda Parte: Envío de la data. 
             * 
             * Se en envía los datos de la información del modelo que está en la tabla Unique_Model.          
             */
             
             if($this->car_model->checkUniqueCar($vin))
             {
                 $uniqueCar = $this->car_model->getCar($vin);
                 
                 // Con esta funcion se obtienen todos los componentes del carro. 
             }
             
             /*
              * 
              *  Hacer una funcion checkCar(); en el módelo.
              *  
              * 
              */
             
             
             
             
             
             
             
        }
}