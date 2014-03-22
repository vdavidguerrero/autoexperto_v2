<?php
    
class car_model extends CI_Model {
    
    public function __construct()
    {
    	parent::__construct();
	$this->load->database(); 
    }
    
     /**
      * Get a car by its VIN
      * 
      * @param integer $carVIN - VIN of the the car/
      * @return a car Objetc from the database 
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo  Ready 
      * @see getCar
      */  
     public function getCar($carVIN)
     {
        $uniqueCarObject = $this->getUniqueCar($carVIN);
        return $uniqueCarObject;
     }

      /**
      * Get a car by its ID
      * 
      * @param integer Unique Car ID - VIN of the the car/
      * @return a car Objetc from the database 
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo  Ready
      * @see getCarByVIN
      */  
     public function insertCar($carObject)
     {
        return  $this->insertUniqueCar($carObject); 
     }  
     
     /**
      * Get a unique car object by Its VIN.
      * 
      * @param integer - unique car VIN.
      * @return UniqueCarObject -  with al the car information 
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo  Ready.
      * @see  getUniqueCar 
      */
     public function getUniqueCar($carVIN)
    { 
        $this->db->select('unique_cars.*, manufacturer_countries.Manufacturer_Country',false);
        $this->db->from('unique_cars');
        $this->db->join('manufacturer_countries', 'unique_cars.Manufacturer_Country_ID = manufacturer_countries.ID');
        $this->db->where('unique_cars.VIN'    ,$carVIN);
        $query           =  $this->db->get();
        $uniqueCarObject =  $query->row();
        if($uniqueCarObject)
        {
           $uniqueCarObject->Unique_Model = $this->getUniqueModel($uniqueCarObject->Unique_Model_ID);
           unset($uniqueCarObject->Manufacturer_Country_ID);
        }
        return $uniqueCarObject;
    }
    
    /**
      * Insert an UniqueCar to the data base.
      * 
      * @param int  unique car VIN.
      * @param String  Manufacturer Country.
      * @param Unique_Model  Unique Model Object 
      * @return UniqueModel Object 
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo - Ready.
      */
     public function insertUniqueCar($uniqueCarObject)
    {
         
        $manufacturerCountryObject = $this->getManufacturerCountry($uniqueCarObject->Manufacturer_Country);
        if(!$manufacturerCountryObject)
        {   
           $manufacturerCountryObject =new stdClass();
           $manufacturerCountryObject->ID =  $this->car_model->insertManufacturerCountry($uniqueCarObject->Manufacturer_Country); 
        }
        
        
        $uniqueModelObject = $this->getUniqueModelTrimModelYear($uniqueCarObject->Unique_Model->Trim, $uniqueCarObject->Unique_Model->Model,$uniqueCarObject->Unique_Model->Year);
        if(!$uniqueModelObject)
        {
              $uniqueModelObject = new stdClass();
              $uniqueModelObject->ID =  $this->insertUniqueModel($uniqueCarObject->Unique_Model);
              
        }
       
        $insertObject = (object) array(
                                'VIN'                       => $uniqueCarObject->VIN,
                                'Manufacturer_Country_ID'   => $manufacturerCountryObject->ID,
                                'Date'                      => date("Y-m-d H:i:s"),
                                'Unique_Model_ID'           => $uniqueModelObject->ID
                            );
        $this->db->insert('unique_cars',$insertObject);
        return $this->db->insert_id();
    }
 
     /**
      * Get a unique Model by its ID.
      * 
      * @param int - Unique Model Trim. 
      * @return UniqueModel -  with al the car information 
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo  Ready.
      * @see getUniqueModel
      */
    public function getUniqueModel($ID)
    {
        
        $this->db->select("unique_models.*, car_brands.Brand, car_models.Model",false);
        $this->db->from("unique_models");
        $this->db->join('car_models', 'unique_models.Car_Model_ID = car_models.ID' );
        $this->db->join('car_brands', 'unique_models.Car_Brand_ID = car_brands.ID' );
        $this->db->where("unique_models.ID", $ID);
        $query = $this->db->get();
        $uniqueModelObject = $query->row();
        unset($uniqueModelObject->Car_Model_ID);
        unset($uniqueModelObject->Car_Brand_ID);
        return $uniqueModelObject;
    }
       /**
      * Get a unique Model by its Trim, Model and Year.
      * 
      * @param String - Unique Model Trim.
      * @param String - Unique Model Model.
      * @param String - Unique Model Year.  
      * @return UniqueModel -  with al the car information 
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo  Ready.
      * @see getUniqueModel
      */
    
     public function getUniqueModelTrimModelYear($trim, $model,  $year)
    {
        $this->db->select("unique_models.*, car_brands.Brand, car_models.Model",false);
        $this->db->from("unique_models");
        $this->db->join('car_models', 'unique_models.Car_Model_ID = car_models.ID' );
        $this->db->join('car_brands', 'unique_models.Car_Brand_ID = car_brands.ID' );
        $this->db->where('unique_models.Year'    ,$year);
        $this->db->where('unique_models.Trim'    ,$trim);
        $this->db->where('car_models.Model'      ,$model);
        $query = $this->db->get();
        $uniqueModelObject = $query->row();
        unset($uniqueModelObject->Car_Model_ID);
        unset($uniqueModelObject->Car_Brand_ID);
        return $uniqueModelObject;
    }
    
     /**
      * Insert an Unique Model to the data base.
      * 
      * @param uniqueModelObject  unique car VIN.
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo - Ready.
      */
    public function insertUniqueModel($uniqueModelObject)
    { 
        if(!$this->getModel($uniqueModelObject->Model))
        {
           $this->instertModel($uniqueModelObject->Model);
        }
        if(!$this->getBrand($uniqueModelObject->Brand))
        {
           $this->instertBrand($uniqueModelObject->Brand);
        }
        $modelObject =  $this->getModel($uniqueModelObject->Model);
        $brandObject =  $this->getBrand($uniqueModelObject->Brand);
        $uniqueModelObject->Car_Model_ID = $modelObject->ID;
        $uniqueModelObject->Car_Brand_ID = $brandObject->ID;
        unset($uniqueModelObject->Model);
        unset($uniqueModelObject->Brand);
        $this->db->insert('unique_models',$uniqueModelObject); 
        return $this->db->insert_id();
    }
   
     /**
      * Return the brand object by its ID
      * 
      * @param  string Brand Name
      * @return brandObject Accesible vía $object->Brand
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo - Ready.
      */
     public function getBrand($brandName)
    {
        $searchObject =  array("Brand" =>$brandName);
        $this->db->select('*');
        $this->db->from('car_brands');
        $this->db->where($searchObject);
        $query = $this->db->get();
        return $query->row();
    }
    
     /**
      * Get all the brands available
      * 
      * @return brandObject Array Accesible vía $object->Brand
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo - Ready.
      */
    public function getBrands() 
    {  
      $query = $this->db->get("car_brands");
      return $query->result();
    }
        
     /**
      * Insert a single brand into the data base;
      * 
      * @param  string Brand Name
      * @return int the added row
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo - Ready.
      */
    public function instertBrand($brand)
    {
        
        $instertObject = (object) array("Brand" => $brand);
        $this->db->insert('car_brands',$instertObject); 
        return $this->db->insert_id();
    }
       
     /**
      * Return the Model object by its ID
      * 
      * @param  string Model Name
      * @return brandObject Accesible vía $object->Model
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo - Ready.
      */    
    public function getModel($model)
    {
        $this->db->select('*');
        $this->db->from('car_models');
        $this->db->where('Model',$model);
        $query = $this->db->get();
        return $query->row();   
    }
    
     /**
      * Get all the models from a particular brand;
      * 
      * @param  string Brand Name
      * @return modelObject array with all the models
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo - Ready.
      */
    public function getModelsByBrand($brand)
    {
        $this->db->select('*');
        $this->db->from('unique_models');
        $this->db->join('car_models', 'unique_models.Car_Model_ID = car_models.ID' );
        $this->db->join('car_brands', 'unique_models.Car_Brand_ID = car_brands.ID' );
        $this->db->where('car_brands.Brand',$brand);
        $query = $this->db->get();
        return $query->result();
    }
     
        
      /**
      * Insert a model to the data base
      * 
      * @param  string Model Name
      * @return int added row
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo - Ready.
      */  
      public function instertModel($Model)
    {
        $instertObject = (object) array("Model"    => $Model, );            
        $this->db->insert('car_models',$instertObject); 
        return $this->db->insert_id();
    }
        
      /**
      * Insert a Manufacturer Country  to the data base
      * 
      * @param  string Manufacturer Country 
      * @return int added row
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo - Ready.
      */ 
    public function insertManufacturerCountry($manufacturerCountry)
    {
        $instertObject = (object) array("Manufacturer_Country" => $manufacturerCountry);    
        $this->db->insert('manufacturer_countries',$instertObject);
        return $this->db->insert_id();
    }
   
      /**
      * Return the Manufacturer Country object by its ID
      * 
      * @param  string Manufacturer Country
      * @return manufacturerCountrybject Accesible vía $object->Manufacturer Country
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo - Ready.
      */  
    public function getManufacturerCountry($manufacturerCountry)
    {
        $searchArray = array("Manufacturer_Country" => $manufacturerCountry);
            
        $this->db->select('*');
        $this->db->from('manufacturer_countries');
        $this->db->where($searchArray);
        $query = $this->db->get();
        return $query->row();
    }
        
    /**
      * Return All the years until the date
      *
      * @return int array
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo - Ready.
      */  
    public function getYears()
    {
        for ($i = 1990; $i<= date("Y"); $i++)
        {
            $years[$i] = $i; 
        }
            return $years;
    }    
}