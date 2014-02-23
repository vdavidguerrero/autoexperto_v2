<?php

class Ad_model extends CI_Model {

    //
    
    public function __construct()
    {
    	parent::__construct();
	$this->load->database(); 
    }   
    public function getAdBrands() 
    {
        
      $query = $this->db->get("car_brands");
      return $query->result();
    }
    public function getAdCities() 
    {  
      $query = $this->db->get("dominican_republic_cities");
      return $query->result();
    }
    public function getModelsByBrand($brand)
    {
        $this->db->select('Model');
        $this->db->from('car_models');
        $this->db->where('Brand_ID',$brand);
        $query = $this->db->get();
        return $query->results();
    }
}