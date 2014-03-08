<?php

class Ad_model extends CI_Model {

    //
    
    public function __construct()
    {
    	parent::__construct();
	$this->load->database(); 
    }
    
    
    /************************************************************************
     
    * Trouble_Codes; Represents de trouble codes that a car can have
     
    ************************************************************************/
    
    public function relateAdAndTroubleCode($relationshipData)
    {
     
         $this->db->insert('trouble_code_N_ad',$relationshipData);     
    }
    
    public function getTroubleCode($troubleCode)
    {
        $this->db->select('*');
        $this->db->from('trouble_codes');
        $this->db->where('Trouble_Code'    ,$troubleCode);
        $query = $this->db->get();
        return $query->result();  
    }
    
    /************************************************************************
     
    * Ads; Represents car ads.
     
    ************************************************************************/
       
    public function getPendingAdByVIN($carVIN)
    {
        $this->db->select('*');
        $this->db->from('car_ads');
        $this->db->join('unique_cars', 'car_ads.Unique_Car_ID = unique_cars.ID','inner');
        $this->db->where('unique_cars.VIN'    ,$carVIN);
        $this->db->where('car_ads.Flag', 0);
        $query = $this->db->get();
        return $query->row();   
    }
    
    public function insertCarPartReview($carPartReviewData)
    {
         $this->db->insert('car_part_review',$carPartReviewData); 
    }
    
     public function getActiveAdByVIN($carVIN)
    {
        $this->db->select('*');
        $this->db->from('car_ads');
        $this->db->join('unique_cars', 'car_ads.Unique_Car_ID = unique_cars.ID','inner');
        $this->db->where('unique_cars.VIN'    ,$carVIN);
        $this->db->where('car_ads.Flag', 1);
        $query = $this->db->get();
        return $query->row();   
    }
    public function getAdsBySearch()
    {
        
    }
}