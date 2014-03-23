<?php if (!defined('BASEPATH')) die();



class car_controller extends Main_Controller {
    
      
    
        // Unique Car Object Propeties
        
      
        var $VIN;
        var $Date;
        var $Manufacturer_Country; 
        
        //object
        var $Unique_Model;
       

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
             header('Content-type: application/json');
             $this->VIN  =  $jsonObject['VIN'];
              
             if(strlen($this->VIN) === 17)
             {  
                $thisCarData = $this->car_model->getCar($this->VIN);
                if(!$thisCarData)
                { 
                   
                    $thisCarData = $this->queryCarData($this->VIN); 
                    $this->instanceCar($thisCarData);
                    $this->car_model->insertCar($this);
                    $this->instanceCar($this->car_model->getCar($this->VIN));    
                }
                else  
                {
                    $this->instanceCar($thisCarData);
                } 
                echo json_encode($this->getThisObjectOnly());
                return;
            }
            echo json_encode("VIN INVALIDO");
        }
        
        
       /**
        * Query the data for an unknow car. $this->vin
        * 
        * @param int 17length car VIN( Vehiculo identifer Number)
        * @return a car Objetc.
        * @author Vincent Guerrero <v.davidguerrero@gmail.com>
        * @todo - implemente vinquery handler 
        */
        function queryCarData($VIN)
        {
            $uniqueCarObject                          = new stdClass();
            $uniqueCarObject->Manufacturer_Country   = 'Japon';  
            $uniqueCarObject->VIN                    = $VIN;
            $uniqueCarObject->Date                   = date("Y-m-d H:i:s");
            $uniqueCarObject->Unique_Model           = (object) array(  
                                                                        'AC'                    => 'YES',
                                                                        'Year'                  => '2009', 
                                                                        'Trim'                  => 'Full',
                                                                        'Brand'                 => 'Nissan',
                                                                        'Model'                 => 'Infinity',
                                                                        'Radio'                 => 'YES',
                                                                        'Wheels'                => 'ALLOY',
                                                                        'Seating'               => 'Lether', 
                                                                        'Gallons'               => '14',
                                                                        'ABS_Brake'             => 'Yes',
                                                                        'CD_Player'             => 'DVD',
                                                                        'Subwoofer'             => 'YES 18',
                                                                        'Body_Style'            => 'Sedan',
                                                                        'Engine_Type'           => '3.8 SOHC',
                                                                        'Transmission'          => 'Secuencial', 
                                                                        'Power_Windows'         => 'YES',
                                                                        'Leather_Seats'         => 'NO',
                                                                        'Driver_Airbag'         => 'Yes',
                                                                        'Cruise_Control'        => 'YES',
                                                                        'Convertible_Top'       => 'NO',
                                                                        'Front_Side_Airbag'     => 'NO',
                                                                        'Fuel_Economy_City'     => '25',
                                                                        'Fuel_Economy_Highway'  => '27'
                                                        
                                                                         );
           return $uniqueCarObject;
            
        }
        
        /**
        * Create an instace for this object.
        * 
        * @param carObject car object from car_model->getCar($VIN) or from car_controller->queryCarData
        * @return a car Object.
        * @author Vincent Guerrero <v.davidguerrero@gmail.com>
        * @todo - implemente vinquery handler 
        */
        function instanceCar($uniqueCarObject)
        {
            
            $this->Manufacturer_Country    = $uniqueCarObject->Manufacturer_Country;
            $this->VIN                     = $uniqueCarObject->VIN;
            $this->Date                    = $uniqueCarObject->Date;
            //Object
            $this->Unique_Model            = $uniqueCarObject->Unique_Model; 
              
        }
      
        /**
        * Eliminites the partent properties.
        * 
        * @return this child .
        * @author Vincent Guerrero <v.davidguerrero@gmail.com>
        * @todo - implemente vinquery handler 
        */
        function getThisObjectOnly()
        {
           $child = (object) array();
             $i=0; 
             foreach($this as $property => $propertyValue)
             {
                 if($i==4)
                 {
                     break;
                 }
                 $i++;
                 $child->$property = $propertyValue;
             }
             return $child; 
        }   
}



