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
	{   
            
	}
        
         public function carQuery()
        {//Paramatrer: $VIN
             // Checks if there's any Unique car associate with the $VIN, if there's no it creates 1
             // and the return the new value.

             $VIN = $this->input->post("VIN");
             $car  = $this->car_model->getCar($VIN);
             if(!$car)
             {
                    $newCarDataObject = $this->queryCarData($VIN); 
                    $trim  =                   $newCarDataObject->Trim;
                    $model =                   $newCarDataObject->Model;
                    $year  =                   $newCarDataObject->Year;
                    $manufacturerCountry =     $newCarDataObject->Country;

                    $newCarUniqueModelID =     $this->car_model->getUniqueModel($trim,$model,$year);
                    if(!$newCarUniqueModelID)
                    {
                         $this->createUniqueModel($newCarDataObject); 
                         $newCarUniqueModelID = $this->car_model->getUniqueModel($trim,$model,$year);
                    }
                    $this->createUniqueCar($VIN,$manufacturerCountry,$newCarUniqueModelID->ID);   
             }
             return $car; 
            
             
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
        }
        
        function createUniqueModel($newUniqueModelDataObject)
        {  
            /*
                BRAND,MODEL,TRIM,YEAR are the basic parameters
            */
            
            //Data Capture 
            $modelName              = $newUniqueModelDataObject->Model;
            $brandName              = $newUniqueModelDataObject->Brand;
            $year                   = $newUniqueModelDataObject->Year;
            $trim                   = $newUniqueModelDataObject->Trim;
            $bodyStyle              = $$newUniqueModelDataObject->varlor5;
            $engineType             = $$newUniqueModelDataObject->varlor6;
            $transmission           = $$newUniqueModelDataObject->varlor7;
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
        }
        
        function createUniqueCar($VIN,$manufacturerCountry, $uniqueCarModelID)
        {//paramater: $VIN, $ManufacturarCountry, $uniqueCarModel
           
            $now = date("Y-m-d H:i:s");
            
            $manufacturerCountryObject = $this->car_model->getManufacturerCountryByName($manufacturerCountry); 
            if(!$manufacturerCountryObject)
            {
                $newManufacturerCountryData = array('Country' => $manufacturerCountry);
                $this->car_model->insertManufacturerCountry($newManufacturerCountryData); 
                $manufacturerCountryObject = $this->car_model->getManufacturerCountryByName($manufacturerCountry); 
            }
            $manufacturerCountryID = $manufacturerCountryObject->ID;
            
            $newUniqueCarData = array(
                                            'VIN'                       => $VIN,
                                            'Manufacturer_Country_ID'   => $manufacturerCountryID,
                                            'Date'                      => $now,
                                            'Unique_Model'              => $uniqueCarModelID
                                      );
            $this->car_model->insertUniqueCar($newUniqueCarData); 
          }
        
        function queryCarData($VIN)
        {
            // Sacar esta info de VIN Query
            $pepe = (object) array(
                                    'Country'       => 'Japan', 
                                    'Trim'          => 'klk',
                                    'Year'          => '2012', 
                                    'Model'         => 'NSX2',
                                    'Brand'         => 'Honda',
                                    'Body_Style'    => 'Sedan',
                                    'Engine_Type'   => 'SI DOHC',
                                    'Transmission'  => 'Manual'
                                 );
           
            return $pepe; 
        }
         
        
}