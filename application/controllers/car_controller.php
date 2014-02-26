<?php if (!defined('BASEPATH')) die();


class car_controller extends Main_Controller {

    
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
	{   $dataPass["pepito"] = array();
            $this->load->view('include/header'); 
            $this->load->view('car/test_view',$dataPass);  
            $this->load->view('include/footer');   
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
        
        function createUniqueModel()
        {
            /*
                ALL CAR DATA REQUIRE; BRAND,MODEL,TRIM,YEAR AT LEAST.
             * 
             * There isn't any data validation in this code!!!!
            */
            
            $modelName = $this->input->post("valor2");
            $brandName = $this->input->post("valor7");
            
            
            $modelObject  = $this->car_model->getModelByModelName($modelName);
            
            if(!$modelObject)
            {
                
                $brandObject   = $this->car_model->getBrandbyBrandName($brandName);
                if(!$brandObject)
                {
                    $newBrandData = array( 'Brand' => $brandName);
                    $this->car_model->instertCarBrand($newBrandData);    
                    $brandObject = $this->car_model->getBrandbyBrandName($brandName);
                }
                // ACABAR DE VALIDAR EL MODELO
                    //$newCarModelData = array( );
            }
            
            
            if($modelObject)
            {
                $year           = $this->input->post("valor1");
                $modelID        = $modelObject->ID; 
                $trim           = $this->input->post("valor3");
                $bodyStyle      = $this->input->post("valor4");
                $engineType     = $this->input->post("valor5");
                $transmission   = $this->input->post("valor6");


                $uniqueModelData    = array(
                                                'Year'          => $year,
                                                'Car_Model_ID'      => $modelID,
                                                'Trim'          => $trim,
                                                'Body_Style'    => $bodyStyle,
                                                'Engine_Type'   => $engineType,
                                                'Transmission'  => $transmission
                                             );

                // Data de revisión;
                $dataPass["pepito"] = $uniqueModelData;
                $this->car_model->insertUniqueModel($uniqueModelData);
             }
             else
             {
                $dataPass["pepito"] = array('ahja' => "Eh.. Que te digo.");
             }
                $this->load->view('include/header'); 
                $this->load->view('car/test_view',$dataPass);  
                $this->load->view('include/footer'); 
               
        }
        
        
}