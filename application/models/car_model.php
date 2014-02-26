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
     
     * Unique_Car; Represents an Unique Car by its VIN 
     
     ************************************************************************/
    
    public function checkUniqueCar($VIN)
    {
        $query = $this->db->get_where('unique_cars', array('ID'=> $VIN));
         return $query->num_rows();
    }
    
    public function getUniqueCar()
    {
        $query = $this->db->get_where('unique_cars', array('ID'=> $VIN));
         return $query->result();
    }
    
     public function instertUniqueCar($VIN)
    {
        $this->db->insert('unique_cars',$VIN);     
    }
 
    
    
    /************************************************************************
     
     * Unique_Model; Represents an Unique Model by its Year,Model and Trim 
     
     ************************************************************************/
    
    
     public function getUniqueModel($trim, $modelID,  $year)
    {
        
       // hacer un join de carBrands, carModels, uniqueModel
       //  Traeme la tabla CarModels, donde uniqueModel.Brand_ID = $brandID, Model.ID
       //uniqueModel.Model_ID = $brandID
        $this->db->select('*');
        $this->db->from('car_models');
        $this->db->where('Year'    ,$trim);
        $this->db->where('Model_ID',$modelID);
        $this->db->where('Trim'    ,$year);
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
        $this->db->select('Model,ID');
        $this->db->from('car_models');
        $this->db->where('Brand_ID',$brand);
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
    
    public function instertCarPart($part)
    {
        $this->db->insert('car_parts',$part); 
    }
    
    /***********************************************************************
     *     
     * Car_manufacturer_Country; Represents 1 of many country where cars has been built. 
     * 
     ***********************************************************************/
    
    
    public function insertManufacturerCountry($country)
    {
        $this->db->insert('manufacturer_countries',$country); 
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