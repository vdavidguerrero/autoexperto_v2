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
        if($VIN = "JN8AZ08T93W106333")
        {
            $uniqueCarObject                          = new stdClass();
            $uniqueCarObject->Manufacturer_Country   = 'Americano';
            $uniqueCarObject->VIN                    = $VIN;
            $uniqueCarObject->Date                   = date("Y-m-d H:i:s");
            $uniqueCarObject->Unique_Model           = (object) array(
                'AC'                    => 'Si',
                'Year'                  => '2005',
                'Trim'                  => '234 vc',
                'Brand'                 => 'Nissan',
                'Model'                 => 'Murano',
                'Radio'                 => 'CD',
                'Wheels'                => 'Magnesio',
                'Seating'               => 'Leather',
                'Gallons'               => '21',
                'ABS_Brake'             => 'Si',
                'CD_Player'             => 'Si',
                'Subwoofer'             => 'Si',
                'Body_Style'            => 'Jeep',
                'Engine_Type'           => '3.5,  6Cilindros',
                'Transmission'          => 'Automatico, 5 cambios',
                'Power_Windows'         => 'Si',
                'Leather_Seats'         => 'Si',
                'Driver_Airbag'         => 'Si',
                'Cruise_Control'        => 'Si',
                'Convertible_Top'       => 'No',
                'Front_Side_Airbag'     => 'Si',
                'Fuel_Economy_City'     => '17.2 kmh/g',
                'Fuel_Economy_Highway'  => '8.5 kmh/g',
                'Color'                 => 'Blanco'
            );

        }

        else if($VIN = "3VWTL71K19M296957")
        {
            $uniqueCarObject                          = new stdClass();
            $uniqueCarObject->Manufacturer_Country   = 'Americano';
            $uniqueCarObject->VIN                    = $VIN;
            $uniqueCarObject->Date                   = date("Y-m-d H:i:s");
            $uniqueCarObject->Unique_Model           = (object) array(
                'AC'                    => 'Si',
                'Year'                  => '2009',
                'Trim'                  => '1.6i 16V',
                'Brand'                 => 'Volkswagen',
                'Model'                 => 'Jetta',
                'Radio'                 => 'CD',
                'Wheels'                => 'Magnesio',
                'Seating'               => 'Leather',
                'Gallons'               => '21',
                'ABS_Brake'             => 'Si',
                'CD_Player'             => 'Si',
                'Subwoofer'             => 'Si',
                'Body_Style'            => 'Sedan',
                'Engine_Type'           => '1.6i 16v,  4Cilindros',
                'Transmission'          => 'Mecanico, 5 cambios',
                'Power_Windows'         => 'Si',
                'Leather_Seats'         => 'Si',
                'Driver_Airbag'         => 'Si',
                'Cruise_Control'        => 'Si',
                'Convertible_Top'       => 'No',
                'Front_Side_Airbag'     => 'Si',
                'Fuel_Economy_City'     => '5.6 l/ km',
                'Fuel_Economy_Highway'  => '6.6 l/ km',
                'Color'                 => 'Azul'
            );

        }

        else if($VIN = "1GTDS146X48207440")
        {
            $uniqueCarObject                          = new stdClass();
            $uniqueCarObject->Manufacturer_Country   = 'Americano';
            $uniqueCarObject->VIN                    = $VIN;
            $uniqueCarObject->Date                   = date("Y-m-d H:i:s");
            $uniqueCarObject->Unique_Model           = (object) array(
                'AC'                    => 'Si',
                'Year'                  => '2002',
                'Trim'                  => 'EX',
                'Brand'                 => 'Honda',
                'Model'                 => 'Civic',
                'Radio'                 => 'CD',
                'Wheels'                => 'Magnesio',
                'Seating'               => 'Leather',
                'Gallons'               => '21',
                'ABS_Brake'             => 'Si',
                'CD_Player'             => 'Si',
                'Subwoofer'             => 'Si',
                'Body_Style'            => 'Sedan',
                'Engine_Type'           => '1.8i Vtec,  I4',
                'Transmission'          => 'Automatico, 5 cambios',
                'Power_Windows'         => 'Si',
                'Leather_Seats'         => 'Si',
                'Driver_Airbag'         => 'Si',
                'Cruise_Control'        => 'Si',
                'Convertible_Top'       => 'No',
                'Front_Side_Airbag'     => 'Si',
                'Fuel_Economy_City'     => '5.6 l/ km',
                'Fuel_Economy_Highway'  => '6.6 l/ km',
                'Color'                 => 'Negro'
            );

        }

        else if($VIN = "2FTRF17L43C864717")
        {
            $uniqueCarObject                          = new stdClass();
            $uniqueCarObject->Manufacturer_Country   = 'Americano';
            $uniqueCarObject->VIN                    = $VIN;
            $uniqueCarObject->Date                   = date("Y-m-d H:i:s");
            $uniqueCarObject->Unique_Model           = (object) array(
                'AC'                    => 'Si',
                'Year'                  => '2004',
                'Trim'                  => 'LE',
                'Brand'                 => 'Nissan',
                'Model'                 => 'Sentra',
                'Radio'                 => 'CD',
                'Wheels'                => 'Magnesio',
                'Seating'               => 'Leather',
                'Gallons'               => '21',
                'ABS_Brake'             => 'Si',
                'CD_Player'             => 'Si',
                'Subwoofer'             => 'Si',
                'Body_Style'            => 'Sedan',
                'Engine_Type'           => '2.0 ,  4Cilindros',
                'Transmission'          => 'Automatico, 6 cambios',
                'Power_Windows'         => 'Si',
                'Leather_Seats'         => 'Si',
                'Driver_Airbag'         => 'Si',
                'Cruise_Control'        => 'Si',
                'Convertible_Top'       => 'No',
                'Front_Side_Airbag'     => 'Si',
                'Fuel_Economy_City'     => '5.6 l/ km',
                'Fuel_Economy_Highway'  => '6.6 l/ km',
                'Color'                 => 'Azul'
            );

        }

        else
        {
            $uniqueCarObject                          = new stdClass();
            $uniqueCarObject->Manufacturer_Country   = 'Americano';
            $uniqueCarObject->VIN                    = $VIN;
            $uniqueCarObject->Date                   = date("Y-m-d H:i:s");
            $uniqueCarObject->Unique_Model           = (object) array(
                'AC'                    => 'Si',
                'Year'                  => '2009',
                'Trim'                  => 'LE',
                'Brand'                 => 'Nissan',
                'Model'                 => 'Pathfinder',
                'Radio'                 => 'CD',
                'Wheels'                => 'Magnesio',
                'Seating'               => 'Leather',
                'Gallons'               => '21',
                'ABS_Brake'             => 'Si',
                'CD_Player'             => 'Si',
                'Subwoofer'             => 'Si',
                'Body_Style'            => 'Sedan',
                'Engine_Type'           => '2.0 ,  4Cilindros',
                'Transmission'          => 'Automatico, 6 cambios',
                'Power_Windows'         => 'Si',
                'Leather_Seats'         => 'Si',
                'Driver_Airbag'         => 'Si',
                'Cruise_Control'        => 'Si',
                'Convertible_Top'       => 'No',
                'Front_Side_Airbag'     => 'Si',
                'Fuel_Economy_City'     => '5.6 l/ km',
                'Fuel_Economy_Highway'  => '6.6 l/ km',
                'Color'                 => 'Negra'
            );

        }
        return $uniqueCarObject;

    }



}






