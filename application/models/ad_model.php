<?php

class Ad_model extends CI_Model {

    //
    
    public function __construct()
    {
    	parent::__construct();
	$this->load->database(); 
    }
    
    
    public function getAdCities() 
    {  
      $query = $this->db->get("dominican_republic_cities");
      return $query->result();
    }
    
    //Modelo Carro
    //Delete Model
    //Create Model

    
    public function insertCarAd()
    {
        
    }
}