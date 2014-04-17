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
            $uniqueCarObject->Manufacturer_Country   = 'Prueba1';
            $uniqueCarObject->VIN                    = $VIN;
            $uniqueCarObject->Date                   = date("Y-m-d H:i:s");
            $uniqueCarObject->Unique_Model           = (object) array(  
                                                                        'AC'                    => 'Prueba1',
                                                                        'Year'                  => '2000',
                                                                        'Trim'                  => 'Prueba1',
                                                                        'Brand'                 => 'Prueba1',
                                                                        'Model'                 => 'Prueba1',
                                                                        'Radio'                 => 'Prueba1',
                                                                        'Wheels'                => 'Prueba1',
                                                                        'Seating'               => 'Prueba1',
                                                                        'Gallons'               => '20',
                                                                        'ABS_Brake'             => 'Prueba1',
                                                                        'CD_Player'             => 'Prueba1',
                                                                        'Subwoofer'             => 'Prueba1',
                                                                        'Body_Style'            => 'Prueba1',
                                                                        'Engine_Type'           => 'Prueba1',
                                                                        'Transmission'          => 'Prueba1',
                                                                        'Power_Windows'         => 'Prueba1',
                                                                        'Leather_Seats'         => 'Prueba1',
                                                                        'Driver_Airbag'         => 'Prueba1',
                                                                        'Cruise_Control'        => 'Prueba1',
                                                                        'Convertible_Top'       => 'Prueba1',
                                                                        'Front_Side_Airbag'     => 'Prueba1',
                                                                        'Fuel_Economy_City'     => 'Prueba1',
                                                                        'Fuel_Economy_Highway'  => 'Prueba1'
                                                        
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



