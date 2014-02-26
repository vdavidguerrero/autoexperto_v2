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
             
       
             
             /*
              * 
              *  Hacer una funcion checkCar(); en el módelo.
              *  
              * 
              */
   
        }
        
        function createUniqueModel()
        {//Parameter: $data; an array with all the data! 
            /*
                ALL CAR DATA REQUIRE; BRAND,MODEL,TRIM,YEAR AT LEAST.
             * 
             * There isn't any data validation in this code!!!!
            */
            //Data Capture 
            $modelName              = $this->input->post("valor2");
            $brandName              = $this->input->post("valor7");
            $year                   = $this->input->post("valor1");
            $trim                   = $this->input->post("valor3");
            $bodyStyle              = $this->input->post("valor4");
            $engineType             = $this->input->post("valor5");
            $transmission           = $this->input->post("valor6");
            //Data Capture
            
            $modelObject  = $this->car_model->getModelByModelName($modelName);
            
            if(!$modelObject)
            {
                
                $brandObject   = $this->car_model->getBrandbyBrandName($brandName);
                if(!$brandObject)
                {
                    $newCarBrandData = array('Brand' => $brandName);
                    $this->car_model->instertCarBrand($newCarBrandData);    
                    $brandObject = $this->car_model->getBrandbyBrandName($newCarBrandData);
                }
               
                    $newCarModelData = array( 'Model' => $modelName,'Brand_ID' => $brandObject->ID);
                    $this->car_model->instertCarModel($newCarModelData);
                    $modelObject = $this->car_model->getModelByModelName($modelName);
            }
 
           $modelID        = $modelObject->ID; 
            /*Here Goes all the model data...*/
            
            $uniqueModelData    = array(
                                            'Year'          => $year,
                                            'Car_Model_ID'  => $modelID,
                                            'Trim'          => $trim,
                                            'Body_Style'    => $bodyStyle,
                                            'Engine_Type'   => $engineType,
                                            'Transmission'  => $transmission
                                        );
                // Data de revisión;
                
                $this->car_model->insertUniqueModel($uniqueModelData);
                $dataPass["pepito"] = $uniqueModelData;
             
                $this->load->view('include/header'); 
                $this->load->view('car/test_view',$dataPass);  
                $this->load->view('include/footer'); 
             
        }
        
        function createUniqueCar()
        {//paramater: $VIN, ManufacturarCountryID, $uniqueModel
           
            //Data Capture
            $VIN                       = $this->input->post("valor1");
            $manufacturerCountry       = $this->input->post("valor2");
            $uniqueModelID             = $this->input->post("valor3");
            $now = date("Y-m-d H:i:s");
            //Data Capture
            
            $manufacturerCountryObject = $this->car_model->getManufacturerCountryByName($manufacturerCountry); 
            if(!$manufacturerCountryObject)
            {
                $newManufacturerCountryData = array('Country' => $manufacturerCountry);
                $this->car_model->insertManufacturerCountry($newManufacturerCountryData); 
                $manufacturerCountryObject = $this->car_model->getManufacturerCountryByName($manufacturerCountry); 
            }
            $manufacturerCountryID = $manufacturerCountryObject->ID;
            
            $newUniqueCarData = array(
                                            'VIN'                        => $VIN,
                                            'Manufacturer_Country_ID'   => $manufacturerCountryID,
                                            'Date'                      => $now,
                                            'Unique_Model'              => $uniqueModelID
                                        );
            $this->car_model->insertUniqueCar($newUniqueCarData);
        
            $dataPass["pepito"] = $newUniqueCarData;
             
            $this->load->view('include/header'); 
            $this->load->view('car/test_view',$dataPass);  
            $this->load->view('include/footer'); 
          }
        
        
}