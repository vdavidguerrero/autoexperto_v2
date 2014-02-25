<?php

class car_model extends CI_Model {
    
    public function __construct()
    {
    	parent::__construct();
	$this->load->database(); 
    }
   
    public function getCarBrands() 
    {  
      $query = $this->db->get("car_brands");
      return $query->result();
    }
    
    public function getModelsByBrand($brand)
    {
        $this->db->select('Model,ID');
        $this->db->from('car_models');
        $this->db->where('Brand_ID',$brand);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getCarYears()
    {
        for ($i = 1990; $i<2015; $i++)
                        $years[$i] = $i; 
        return $years;
    }
    
    public function instertCarModel($model)
    {
        $this->db->insert('car_models',$model); 
    }
    
    public function instertCarBrand($brand)
    {
        $this->db->insert('car_brands',$brand); 
    }
    
    public function instertCarPart($part)
    {
        $this->db->insert('car_parts',$part); 
    }
    
    public function insertManufacturerCountry($country)
    {
        $this->db->insert('manufacturer_countries',$country); 
    }
    
    public function instertCarUniqueModel($carData)
    {
      $this->db->insert('manufacturer_countries',$carData); 
    }
     
    public function instertUniqueCar($VIN)
    {
        $this->db->insert('manufacturer_countries',$VIN); 
           
    }
    
    public function checkUniqueCar($VIN)
    {
        $query = $this->db->get_where('unique_cars', array('ID'=> $VIN));
         return $query->num_rows();
    }
    
    public function getUniqueCarByVIN()
    {
        $query = $this->db->get_where('unique_cars', array('ID'=> $VIN));
         return $query->result();
    }
    
    public function getUniqueModel($trim, $modelID, $brandID, $year)
    {
        
       // hacer un join de carBrands, carModels, uniqueModel
       //  Traeme la tabla CarModels, donde uniqueModel.Brand_ID = $brandID, Model.ID
       //uniqueModel.Model_ID = $brandID
       //
    }
    
    
}