<?php if (!defined('BASEPATH')) die();


class car_controller extends Main_Controller {
   
        public function __construct()
        {
            parent::__construct();
            $this->load->model("car_model");
            $this->load->model("ad_model");
            $this->load->library('form_validation');
            $this->load->helper('form');
            $this->load->library('session');
            $this->load->helper('url');

        }  
       
        public function index()
        {  
              $troubleCodeObject =  $this->ad_model->getTroubleCode("P0002");
              echo $troubleCodeObject->ID;
        }
        public function carQuery()
        {
             
             $json = file_get_contents('php://input');
             $obj = json_decode($json,true);
             $VIN  =  $obj['VIN'];
  
             if(strlen($VIN) == 17)
             {
                $car  = $this->car_model->getCar($VIN);
                if(!$car)
                {
                       $UniqueCarDataArray = $this->queryCarData($VIN); 
                       $trim  =                   $UniqueCarDataArray["Trim"];
                       $model =                   $UniqueCarDataArray["Car_Model_ID"];
                       $year  =                   $UniqueCarDataArray["Year"];
                       $manufacturerCountry =     $UniqueCarDataArray["Manufacturer_Country"];

                       $newCarUniqueModelObject =     $this->car_model->getUniqueModel($trim,$model,$year);
                       if(!$newCarUniqueModelObject)
                       {
                            $this->createUniqueModel($UniqueCarDataArray); 
                            $newCarUniqueModelObject = $this->car_model->getUniqueModel($trim,$model,$year);
                       }
                       $this->createUniqueCar($VIN,$manufacturerCountry,$newCarUniqueModelObject->ID);   
                       $car  = $this->car_model->getCar($VIN);
                }
               
             }
             else
              $car = "VIN INVALIDO";
               header('Content-type: application/json');
               echo json_encode($car);
        }
        
        public function createUniqueModel($newUniqueModelDataArray)
        {  
          
            $modelName              = $newUniqueModelDataArray["Car_Model_ID"];
            $brandName              = $newUniqueModelDataArray["Brand"];
            
            // Even tough these are car's values, they aren't define on  UniqueCar table, 
            // We need to unset.
            unset($newUniqueModelDataArray['Brand']);    
            unset($newUniqueModelDataArray['Manufacturer_Country']);
            
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
 
           $newUniqueModelDataArray["Car_Model_ID"]  = $modelObject->ID; 
           $this->car_model->insertUniqueModel($newUniqueModelDataArray);   
        }
        
        public function createUniqueCar($VIN, $manufacturerCountry, $uniqueCarModelID)
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
           $carData = array(
                                    'Manufacturer_Country'  => 'Venezuela', // Datos Del Carro único
                                    'Brand'                 => 'Mitsubishi',// Datos Del Carro único We must Unset them
                                    'Year'                  => '1997', 
                                    'Car_Model_ID'          => 'Lancer',
                                    'Trim'                  => 'LE Full',
                                    'Body_Style'            => 'Coupe',
                                    'Engine_Type'           => '2.0 SOHC',
                                    'Transmission'          => 'Secuencial',
                                    'Gallons'               => '12',
                                    'Fuel_Economy_City'     => '25', 
                                    'Fuel_Economy_Highway'  => '27',
                                    'Seating'               => 'Lether', 
                                    'ABS_Brake'             => 'Yes',
                                    'Driver_Airbag'         => 'Yes',
                                    'Front_Side_AirBag'     => 'NO',
                                    'AC'                    => 'YES',
                                    'Cruise_Control'        => 'YES',
                                    'Convertible_Top'       => 'NO',
                                    'Radio'                 => 'YES',
                                    'CD_Player'             => 'DVD',
                                    'Subwoofer'             => 'YES 18',
                                    'Leather_Seats'         => 'NO',
                                    'Power_Windows'         => 'YES',
                                    'Wheels'                => 'ALLOY'
                           );
           
            return $carData; 
            
                  
        }
    
}