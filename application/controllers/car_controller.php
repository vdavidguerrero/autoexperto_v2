<?php if (!defined('BASEPATH')) die();



class car_controller extends Main_Controller {
    
      
    
    
        var $AC;     
        var $VIN;         
        var $Year;  
        var $Trim;  
        var $Model;
        var $Brand; 
        var $Radio; 
        var $Wheels; 
        var $Gallons;
        var $Seating;  
        var $CD_Player;           
        var $Subwoofer;   
        var $ABS_Brake;   
        var $Body_Style; 
        var $Engine_Type; 
        var $Leather_Seats;         
        var $Power_Windows; 
        var $Driver_Airbag;
        var $Cruise_Control;      
        var $Convertible_Top;  
        var $Front_Side_AirBag;  
        var $Fuel_Economy_City; 
        var $Manufacturer_Country; 
        var $Fuel_Economy_Highway;  
           

        public function __construct()
        {
            parent::__construct();
            $this->load->model("car_model");
            $this->load->model("ad_model");
        }
        
         /**
        * Return a JSON with the 
        * 
        * @param integer $carVIN - VIN of the the car/
        * @return a car Objetc from the database - Array with all the found rows
        * @author Vincent Guerrero <v.davidguerrero@gmail.com>
        * @todo - Check 
        * @see getCarByValues
        */
             
        public function carQuery()
        { 
             $json = file_get_contents('php://input');
             $jsonObject = json_decode($json,true);
             $this->VIN  =  $jsonObject['VIN'];
             
             if(strlen($this->VIN) === 17)
             {
                $thisCarData = $this->car_model->getCarByVIN($this->VIN);
                if(!$thisCarData)
                { 
                       $thisCarData = $this->queryCarData($this->VIN); 
                       $this->instanceCar($thisCarData);
                       $this->car_model->insertCar($this);
                }
                else
                {
                    $this->instanceCar($thisCarData); 
                }   
                header('Content-type: application/json');
                echo json_encode($this->getThisObjectOnly());
             }
             else 
             {
                header('Content-type: application/json');
                echo json_encode("Vin Invalido");
                return;
             }
        }
        
        function queryCarData()
        {
           // Need to be done.
           $carData = (object) array(   
                                        'VIN'                   => $this->VIN,   
                                        'AC'                    => 'YES',
                                        'Year'                  => '2007', 
                                        'Trim'                  => 'EX',
                                        'Brand'                 => 'Honda',
                                        'Model'                 => 'Accord',
                                        'Radio'                 => 'YES',
                                        'Wheels'                => 'ALLOY',
                                        'Seating'               => 'Lether', 
                                        'Gallons'               => '12',
                                        'ABS_Brake'             => 'Yes',
                                        'CD_Player'             => 'DVD',
                                        'Subwoofer'             => 'YES 18',
                                        'Body_Style'            => 'Sedan',
                                        'Engine_Type'           => '1.7 DOHC',
                                        'Transmission'          => 'Secuencial', 
                                        'Power_Windows'         => 'YES',
                                        'Leather_Seats'         => 'NO',
                                        'Driver_Airbag'         => 'Yes',
                                        'Cruise_Control'        => 'YES',
                                        'Convertible_Top'       => 'NO',
                                        'Front_Side_Airbag'     => 'NO',
                                        'Fuel_Economy_City'     => '25',
                                        'Contry'  => 'USA',
                                        'Fuel_Economy_Highway'  => '27',
                                           
                                    );
           return $carData;
            
        }
        
        function instanceCar($thisCarObject)
        {
            $this->AC                       = $thisCarObject->AC;
            $this->VIN                      = $thisCarObject->VIN;
            $this->Year                     = $thisCarObject->Year;    
            $this->Trim                     = $thisCarObject->Trim ;        
            $this->Brand                    = $thisCarObject->Brand;
            $this->Radio                    = $thisCarObject->Radio; 
            $this->Model                    = $thisCarObject->Model;        
            $this->Wheels                   = $thisCarObject->Wheels; 
            $this->Seating                  = $thisCarObject->Seating;  
            $this->Gallons                  = $thisCarObject->Gallons;  
            $this->ABS_Brake                = $thisCarObject->ABS_Brake;  
            $this->CD_Player                = $thisCarObject->CD_Player;           
            $this->Subwoofer                = $thisCarObject->Subwoofer;
            $this->Body_Style               = $thisCarObject->Body_Style;         
            $this->Engine_Type              = $thisCarObject->Engine_Type;        
            $this->Transmission             = $thisCarObject->Transmission;  
            $this->Leather_Seats            = $thisCarObject->Leather_Seats;         
            $this->Power_Windows            = $thisCarObject->Power_Windows;   
            $this->Driver_Airbag            = $thisCarObject->Driver_Airbag;   
            $this->Cruise_Control           = $thisCarObject->Cruise_Control;      
            $this->Convertible_Top          = $thisCarObject->Convertible_Top;   
            $this->Front_Side_AirBag        = $thisCarObject->Front_Side_Airbag;     
            $this->Fuel_Economy_City        = $thisCarObject->Fuel_Economy_City; 
            $this->Manufacturer_Country     = $thisCarObject->Country;
            $this->Fuel_Economy_Highway     = $thisCarObject->Fuel_Economy_Highway;   
        }
      
        function getThisObjectOnly()
        {
           $child = (object) array();
             $i=0; 
             foreach($this as $property => $propertyValue)
             {
                 if($i==24)
                 {
                     break;
                 }
                 $i++;
                 $child->$property = $propertyValue;
             }
             return $child; 
        }   
}



