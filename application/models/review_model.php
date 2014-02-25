<?php

class Ad_model extends CI_Model {

    //
    
    public function __construct()
    {
    	parent::__construct();
	$this->load->database(); 
    }
    
    public function insertReview()
    {
         $this->db->insert('car_reviews',$part); 
    }
    
    public function insertTroubleCode()
    {
         $this->db->insert('trouble_codes',$part); 
    }
   
    //Modelo Carro
    //Create Brand
    //Delete Brand
    
}

