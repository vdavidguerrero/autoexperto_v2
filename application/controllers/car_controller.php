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



        if($VIN == "12222222222222222")
        {
            $uniqueCarObject                          = new stdClass();
            $uniqueCarObject->Manufacturer_Country   = 'Prueba1';
            $uniqueCarObject->VIN                    = $VIN;
            $uniqueCarObject->Date                   = date("Y-m-d H:i:s");
            $uniqueCarObject->Unique_Model           = (object) array(
                'AC'                    => 'Si',
                'Year'                  => '2012',
                'Trim'                  => 'EX',
                'Brand'                 => 'Honda',
                'Model'                 => 'Accord',
                'Radio'                 => 'DVD',
                'Wheels'                => 'Aluminio',
                'Seating'               => 'Piel',
                'Gallons'               => '19',
                'ABS_Brake'             => 'Si',
                'CD_Player'             => 'No',
                'Subwoofer'             => 'Si',
                'Body_Style'            => 'Sedan',
                'Engine_Type'           => '3.2 Vtec, V6',
                'Transmission'          => 'Automatica, 5 cambios',
                'Power_Windows'         => 'Si',
                'Leather_Seats'         => 'Si',
                'Driver_Airbag'         => 'Si',
                'Cruise_Control'        => 'Si',
                'Convertible_Top'       => 'No',
                'Front_Side_Airbag'     => 'Si',
                'Fuel_Economy_City'     => '18 kmh/g',
                'Fuel_Economy_Highway'  => '22 kmh/g'
            );
        }
        else if($VIN == "13333333333333333")
        {
            $uniqueCarObject                          = new stdClass();
            $uniqueCarObject->Manufacturer_Country   = 'Prueba1';
            $uniqueCarObject->VIN                    = $VIN;
            $uniqueCarObject->Date                   = date("Y-m-d H:i:s");
            $uniqueCarObject->Unique_Model           = (object) array(
                'AC'                    => 'Si',
                'Year'                  => '1999',
                'Trim'                  => 'Sencillo',
                'Brand'                 => 'Skoda',
                'Model'                 => 'Felicia',
                'Radio'                 => 'MP3',
                'Wheels'                => 'Magnesio',
                'Seating'               => 'Gamusa',
                'Gallons'               => '13',
                'ABS_Brake'             => 'Si',
                'CD_Player'             => 'No',
                'Subwoofer'             => 'Si',
                'Body_Style'            => 'Extension',
                'Engine_Type'           => '1.3 ',
                'Transmission'          => 'Mecanico, 4 cambios',
                'Power_Windows'         => 'Si',
                'Leather_Seats'         => 'No',
                'Driver_Airbag'         => 'Si',
                'Cruise_Control'        => 'Si',
                'Convertible_Top'       => 'No',
                'Front_Side_Airbag'     => 'Si',
                'Fuel_Economy_City'     => '32 kmh/g',
                'Fuel_Economy_Highway'  => '35 kmh/g'
            );
        }

        else if($VIN == "15555555555555555")
        {
            $uniqueCarObject                          = new stdClass();
            $uniqueCarObject->Manufacturer_Country   = 'Prueba1';
            $uniqueCarObject->VIN                    = $VIN;
            $uniqueCarObject->Date                   = date("Y-m-d H:i:s");
            $uniqueCarObject->Unique_Model           = (object) array(
                'AC'                    => 'Si',
                'Year'                  => '2009',
                'Trim'                  => 'Land Cruiser',
                'Brand'                 => 'Totota',
                'Model'                 => 'Prado',
                'Radio'                 => 'MP3',
                'Wheels'                => 'Magnesio',
                'Seating'               => 'Gamusa',
                'Gallons'               => '13',
                'ABS_Brake'             => 'Si',
                'CD_Player'             => 'No',
                'Subwoofer'             => 'Si',
                'Body_Style'            => 'Sedan',
                'Engine_Type'           => '3.6 Vtec, disel',
                'Transmission'          => 'Automatica, 5 cambios',
                'Power_Windows'         => 'Si',
                'Leather_Seats'         => 'No',
                'Driver_Airbag'         => 'Si',
                'Cruise_Control'        => 'Si',
                'Convertible_Top'       => 'No',
                'Front_Side_Airbag'     => 'Si',
                'Fuel_Economy_City'     => '23 kmh/g',
                'Fuel_Economy_Highway'  => '27 kmh/g'
            );
        }

        else if($VIN == "16666666666666666")
        {
            $uniqueCarObject                          = new stdClass();
            $uniqueCarObject->Manufacturer_Country   = 'Prueba1';
            $uniqueCarObject->VIN                    = $VIN;
            $uniqueCarObject->Date                   = date("Y-m-d H:i:s");
            $uniqueCarObject->Unique_Model           = (object) array(
                'AC'                    => 'Si',
                'Year'                  => '1996',
                'Trim'                  => 'EX',
                'Brand'                 => 'Toyota',
                'Model'                 => 'Corolla',
                'Radio'                 => 'MP3',
                'Wheels'                => 'Magnesio',
                'Seating'               => 'Gamusa',
                'Gallons'               => '13',
                'ABS_Brake'             => 'Si',
                'CD_Player'             => 'No',
                'Subwoofer'             => 'Si',
                'Body_Style'            => 'Sedan',
                'Engine_Type'           => '1.8 Vtec',
                'Transmission'          => 'Automatica, 4 cambios',
                'Power_Windows'         => 'Si',
                'Leather_Seats'         => 'No',
                'Driver_Airbag'         => 'Si',
                'Cruise_Control'        => 'Si',
                'Convertible_Top'       => 'No',
                'Front_Side_Airbag'     => 'Si',
                'Fuel_Economy_City'     => '33 kmh/g',
                'Fuel_Economy_Highway'  => '37 kmh/g'
            );
        }

        else if($VIN == "17777777777777777")
        {
            $uniqueCarObject                          = new stdClass();
            $uniqueCarObject->Manufacturer_Country   = 'Prueba1';
            $uniqueCarObject->VIN                    = $VIN;
            $uniqueCarObject->Date                   = date("Y-m-d H:i:s");
            $uniqueCarObject->Unique_Model           = (object) array(
                'AC'                    => 'Si',
                'Year'                  => '2004',
                'Trim'                  => 'EX',
                'Brand'                 => 'Hyudai',
                'Model'                 => 'Tucson',
                'Radio'                 => 'MP3',
                'Wheels'                => 'Magnesio',
                'Seating'               => 'Lether',
                'Gallons'               => '13',
                'ABS_Brake'             => 'Si',
                'CD_Player'             => 'No',
                'Subwoofer'             => 'Si',
                'Body_Style'            => 'Jeep',
                'Engine_Type'           => '2.3 Vtec',
                'Transmission'          => 'Automatica, 4 cambios',
                'Power_Windows'         => 'Si',
                'Leather_Seats'         => 'No',
                'Driver_Airbag'         => 'Si',
                'Cruise_Control'        => 'Si',
                'Convertible_Top'       => 'No',
                'Front_Side_Airbag'     => 'Si',
                'Fuel_Economy_City'     => '28 kmh/g',
                'Fuel_Economy_Highway'  => '32 kmh/g'
            );
        }
        else if($VIN == "18888888888888888")
        {
            $uniqueCarObject                          = new stdClass();
            $uniqueCarObject->Manufacturer_Country   = 'Prueba1';
            $uniqueCarObject->VIN                    = $VIN;
            $uniqueCarObject->Date                   = date("Y-m-d H:i:s");
            $uniqueCarObject->Unique_Model           = (object) array(
                'AC'                    => 'Si',
                'Year'                  => '2002',
                'Trim'                  => 'EX',
                'Brand'                 => 'BMW',
                'Model'                 => 'M3',
                'Radio'                 => 'MP3',
                'Wheels'                => 'Magnesio',
                'Seating'               => 'Lether',
                'Gallons'               => '13',
                'ABS_Brake'             => 'Si',
                'CD_Player'             => 'No',
                'Subwoofer'             => 'Si',
                'Body_Style'            => 'Sedan',
                'Engine_Type'           => '3.2 ',
                'Transmission'          => 'Tictronic, 6 cambios',
                'Power_Windows'         => 'Si',
                'Leather_Seats'         => 'No',
                'Driver_Airbag'         => 'Si',
                'Cruise_Control'        => 'Si',
                'Convertible_Top'       => 'No',
                'Front_Side_Airbag'     => 'Si',
                'Fuel_Economy_City'     => '23 kmh/g',
                'Fuel_Economy_Highway'  => '27 kmh/g'
            );
        }
        else if($VIN == "19999999999999999")
        {
            $uniqueCarObject                          = new stdClass();
            $uniqueCarObject->Manufacturer_Country   = 'Prueba1';
            $uniqueCarObject->VIN                    = $VIN;
            $uniqueCarObject->Date                   = date("Y-m-d H:i:s");
            $uniqueCarObject->Unique_Model           = (object) array(
                'AC'                    => 'Si',
                'Year'                  => '2002',
                'Trim'                  => 'Full',
                'Brand'                 => 'Audi',
                'Model'                 => 'A4',
                'Radio'                 => 'MP3',
                'Wheels'                => 'Magnesio',
                'Seating'               => 'Gamusa',
                'Gallons'               => '13',
                'ABS_Brake'             => 'Si',
                'CD_Player'             => 'No',
                'Subwoofer'             => 'Si',
                'Body_Style'            => 'Sedan',
                'Engine_Type'           => '2.7 V6',
                'Transmission'          => 'Automatica, 5 cambios',
                'Power_Windows'         => 'Si',
                'Leather_Seats'         => 'No',
                'Driver_Airbag'         => 'Si',
                'Cruise_Control'        => 'Si',
                'Convertible_Top'       => 'No',
                'Front_Side_Airbag'     => 'Si',
                'Fuel_Economy_City'     => '23 kmh/g',
                'Fuel_Economy_Highway'  => '27 kmh/g'
            );
        }
        else if ($VIN == "29999999999999999")
        {
            $uniqueCarObject                          = new stdClass();
            $uniqueCarObject->Manufacturer_Country   = 'Prueba1';
            $uniqueCarObject->VIN                    = $VIN;
            $uniqueCarObject->Date                   = date("Y-m-d H:i:s");
            $uniqueCarObject->Unique_Model           = (object) array(
                'AC'                    => 'Si',
                'Year'                  => '2008',
                'Trim'                  => 'Full',
                'Brand'                 => 'Prueba',
                'Model'                 => 'A4',
                'Radio'                 => 'MP3',
                'Wheels'                => 'Magnesio',
                'Seating'               => 'Gamusa',
                'Gallons'               => '13',
                'ABS_Brake'             => 'Si',
                'CD_Player'             => 'No',
                'Subwoofer'             => 'Si',
                'Body_Style'            => 'Sedan',
                'Engine_Type'           => '2.7 V6',
                'Transmission'          => 'Automatica, 5 cambios',
                'Power_Windows'         => 'Si',
                'Leather_Seats'         => 'No',
                'Driver_Airbag'         => 'Si',
                'Cruise_Control'        => 'Si',
                'Convertible_Top'       => 'No',
                'Front_Side_Airbag'     => 'Si',
                'Fuel_Economy_City'     => '23 kmh/g',
                'Fuel_Economy_Highway'  => '27 kmh/g'
            );
        }
        else
        {
            $uniqueCarObject                          = new stdClass();
            $uniqueCarObject->Manufacturer_Country   = 'Prueba1';
            $uniqueCarObject->VIN                    = $VIN;
            $uniqueCarObject->Date                   = date("Y-m-d H:i:s");
            $uniqueCarObject->Unique_Model           = (object) array(
                'AC'                    => 'Si',
                'Year'                  => '1997',
                'Trim'                  => 'LE',
                'Brand'                 => 'Nissan',
                'Model'                 => 'Sentra',
                'Radio'                 => 'CD',
                'Wheels'                => 'Magnesio',
                'Seating'               => 'Pana',
                'Gallons'               => '11',
                'ABS_Brake'             => 'Si',
                'CD_Player'             => 'No',
                'Subwoofer'             => 'Si',
                'Body_Style'            => 'Sedan',
                'Engine_Type'           => '2.0, I4',
                'Transmission'          => 'Secuencial, 5 cambios',
                'Power_Windows'         => 'Si',
                'Leather_Seats'         => 'No',
                'Driver_Airbag'         => 'Si',
                'Cruise_Control'        => 'Si',
                'Convertible_Top'       => 'No',
                'Front_Side_Airbag'     => 'Si',
                'Fuel_Economy_City'     => '20 kmh/g',
                'Fuel_Economy_Highway'  => '25 kmh/g'
            );
        }

        return $uniqueCarObject;

    }



}






