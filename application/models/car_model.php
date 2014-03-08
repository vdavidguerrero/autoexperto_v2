<?php

class car_model extends CI_Model {
    
    public function __construct()
    {
    	parent::__construct();
	$this->load->database(); 
    }
    
    /*
     * 
     * Unique_Cars
     * Unique_Models
     * Car_Brand
     * Car_Model
     * Car_Part
     * Car_Manufacturer
     * Car_Years
     * 
     */
    
     /************************************************************************
     
     * Car; Represents an Entire Car by its VIN 
     
     ************************************************************************/
      
     public function getCar($carVIN)
     {
        $this->db->select('*');
        $this->db->from('unique_models');
        $this->db->join('unique_cars', 'unique_models.ID = unique_cars.Unique_Model','inner');
        $this->db->where('unique_cars.VIN'    ,$carVIN);
        $query = $this->db->get();
        return $query->row_array();   
     }
     
      public function getCarByValues($carBrand, $carModel, $userCity, $carType )
     {
        $this->db->select('*');
        $this->db->from('unique_models');
        $this->db->join('unique_cars', 'unique_models.ID = unique_cars.Unique_Model','inner');
        $this->db->where('unique_cars.VIN'    ,$carVIN);
        $query = $this->db->get();
        return $query->row();   
     }
     
     
    /************************************************************************
     
     * Unique_Car; Represents an Unique Car by its VIN 
     
     ************************************************************************/
      
    public function getUniqueCar()
    {
        $query = $this->db->get_where('unique_cars', array('VIN'=> $VIN));
        return $query->result();
    }
    
     public function insertUniqueCar($VIN)
    {
        $this->db->insert('unique_cars',$VIN);     
    }

    /************************************************************************
     
     * Unique_Model; Represents an Unique Model by its Year,Model and Trim 
     
     ************************************************************************/
    
    
     public function getUniqueModel($trim, $model,  $year)
    {
        $this->db->select('*');
        $this->db->from('car_models');
        $this->db->join('unique_models', 'unique_models.Car_Model_ID = car_models.ID','inner');  
        $this->db->where('unique_models.Year'    ,$year);
        $this->db->where('unique_models.Trim'    ,$trim);
        $this->db->where('car_models.Model'      ,$model);

        $query = $this->db->get();
        return $query->row();   
    }
    
    public function insertUniqueModel($uniqueModelData)
    {
        $this->db->insert('unique_models',$uniqueModelData); 
    }
     
    /************************************************************************
     
     * Car_Brand; Represents 1 of all the registred car brands.
     
     ************************************************************************/    
    
    public function getCarBrands() 
    {  
      $query = $this->db->get("car_brands");
      return $query->result();
    }
    
     public function getBrandbyBrandName($brandName)
    {
        $this->db->select('*');
        $this->db->from('car_brands');
        $this->db->where('Brand',$brandName);
        $query = $this->db->get();
        return $query->row();
    }
    
     public function instertCarBrand($brand)
    {
        $this->db->insert('car_brands',$brand); 
    }
     
    /************************************************************************
     
     * Car_Model; Represents 1 of all the registred car models. Every Model must hava a brand
     
     ************************************************************************/
    
    
     public function getModelsByBrandID($brandID)
    {
        $this->db->select('*');
        $this->db->from('car_models');
        $this->db->where('Brand_ID',$brandID);
        $query = $this->db->get();
        return $query->result();
    }
   
    public function getModelByModelName($modelName)
    {
        $this->db->select('*');
        $this->db->from('car_models');
        $this->db->where('Model',$modelName);
        $query = $this->db->get();
        return $query->row();   
    }
    
      public function instertCarModel($carModelData)
    {
        $this->db->insert('car_models',$carModelData); 
    }
    
    /************************************************************************
     
     * Car_Part; Represents 1 of many parts that a car has. 
     
     ************************************************************************/
    
    public function instertCarPart($carPartData)
    {
        $this->db->insert('car_parts',$carPartData); 
    }
    
    /***********************************************************************
     *     
     * Car_manufacturer_Country; Represents 1 of many country where cars has been built. 
     * 
     ***********************************************************************/
    
    
    public function insertManufacturerCountry($ManufacturerCountryData)
    {
        $this->db->insert('manufacturer_countries',$ManufacturerCountryData); 
    }
    public function getManufacturerCountryByName($ManufacturerCountryData)
    {
        $this->db->select('*');
        $this->db->from('manufacturer_countries');
        $this->db->where('Country',$ManufacturerCountryData);
        $query = $this->db->get();
        return $query->row();
    }
   
    /************************************************************************
     
     * Car_Years; Has all the aavailable 
     
     ************************************************************************/
    
    public function getCarYears()
    {
        for ($i = 1990; $i<2015; $i++)
                        $years[$i] = $i; 
        return $years;
    }
    
    
   
   
}