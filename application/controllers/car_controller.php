<?php if (!defined('BASEPATH')) die();



class car_controller extends Main_Controller {
   
    
        var $VIN;
        var $Manufacturer_Country;
        var $Brand;                
        var $Year;               
        var $Model;         
        var $Trim;         
        var $Body_Style;         
        var $Engine_Type;        
        var $Transmission;         
        var $Gallons;              
        var $Fuel_Economy_City;    
        var $Fuel_Economy_Highway;  
        var $Seating;              
        var $ABS_Brake;            
        var $Driver_Airbag;        
        var $Front_Side_AirBag;     
        var $AC;                   
        var $Cruise_Control;      
        var $Convertible_Top;       
        var $Radio;                
        var $CD_Player;           
        var $Subwoofer;            
        var $Leather_Seats;         
        var $Power_Windows;         
        var $Wheels;                

        
    
    
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
       
       
        public function carQuery()
        { 
             $json = file_get_contents('php://input');
             $jsonObject = json_decode($json,true);
             $this->VIN  =  $jsonObject['VIN'];
             
             if(strlen($this->VIN) === 17)
             {
                $thisCarData = $this->car_model->getCar($this->VIN);
                if(!$thisCarData)
                { 
                       $thisCarData = $this->queryCarData($this->VIN); 
                       $this->instanceCar($thisCarData);
                       
                       if(!$this->car_model->getUniqueModel($this->Trim, $this->Model,$this->Year))
                       {
                          
                            $this->createUniqueModel($this->getThisObjectOnly()); 
                       }
                       $this->createUniqueCar();   
                }
                else
                {
                    $this->instanceCar($thisCarData);
                }   
             }
             else 
             {
                  header('Content-type: application/json');
                  echo json_encode("Vin Invalido");
                  return;
             }
             header('Content-type: application/json');
            echo json_encode($this->getThisObjectOnly());
          
             }
        
        public function createUniqueModel()
        {  
            if(!$this->car_model->getModelByModelName($this->Model))
            {
                if(!$this->car_model->getBrand($this->Brand))
                {
                    $this->car_model->instertCarBrand($this->Brand); 
                }
               $this->car_model->instertCarModel($this->Model, $this->Brand);
            }
          $this->car_model->insertUniqueModel($this->getThisObjectOnly());   
        }
        
        public function createUniqueCar()
        {  
            if(!$this->car_model->getManufacturerCountry($this->Manufacturer_Country))
            {
                $this->car_model->insertManufacturerCountry($this->Manufacturer_Country); 
            }
            $this->car_model->insertUniqueCar($this->VIN,$this->Manufacturer_Country,$this->Trim, $this->Year, $this->Model); 
          }
        
        function queryCarData($VIN)
        {
            // Sacar esta info de VIN Query
           $carData = array(
                                    
                                    'Manufacturer_Country'  => 'USA', 
                                    'Brand'                 => 'Honda',
                                    'Year'                  => '2007', 
                                    'Model'                 => 'Accord',
                                    'Trim'                  => 'EX',
                                    'Body_Style'            => 'Sedan',
                                    'Engine_Type'           => '1.7 DOHC',
                                    'Transmission'          => 'Secuencial',
                                    'Gallons'               => '12',
                                    'Fuel_Economy_City'     => '25', 
                                    'Fuel_Economy_Highway'  => '27',
                                    'Seating'               => 'Lether', 
                                    'ABS_Brake'             => 'Yes',
                                    'Driver_Airbag'         => 'Yes',
                                    'Front_Side_Airbag'     => 'NO',
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
        
        function instanceCar($data)
        {
            
            $this->AC                       = $data['AC'];
            $this->Year                     = $data['Year'];    
            $this->Trim                     = $data['Trim'];         
            $this->Brand                    = $data['Brand'];
            $this->Radio                    = $data['Radio']; 
            $this->Wheels                   = $data['Wheels']; 
            $this->Seating                  = $data['Seating'];  
            $this->Gallons                  = $data['Gallons'];   
            $this->Model                    = $data['Model'];         
            $this->ABS_Brake                = $data['ABS_Brake'];  
            $this->CD_Player                = $data['CD_Player'];           
            $this->Subwoofer                = $data['Subwoofer'];
            $this->Body_Style               = $data['Body_Style'];         
            $this->Engine_Type              = $data['Engine_Type'];        
            $this->Transmission             = $data['Transmission'];  
            $this->Leather_Seats            = $data['Leather_Seats'];         
            $this->Power_Windows            = $data['Power_Windows'];   
            $this->Driver_Airbag            = $data['Driver_Airbag'];   
            $this->Cruise_Control           = $data['Cruise_Control'];      
            $this->Convertible_Top          = $data['Convertible_Top'];   
            $this->Front_Side_AirBag        = $data['Front_Side_Airbag'];     
            $this->Fuel_Economy_City        = $data['Fuel_Economy_City']; 
            $this->Manufacturer_Country     = $data['Manufacturer_Country'];
            $this->Fuel_Economy_Highway     = $data['Fuel_Economy_Highway'];  
            
        }
      
        function getThisObjectOnly()
        {
           $child = (object) array();
             $i=0; 
             foreach($this as $property => $propertyValue)
             {
                 if($i>24)
                 {
                     break;
                 }
                 $i++;
                 $child->$property = $propertyValue;
             }
             return $child; 
        }
    
}