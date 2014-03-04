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
    
    public function insertTroubleCode($troubleCode)
    {
     
         $this->db->insert('unique_cars',$troubleCode);     
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
       
    public function getAdsByVIN()
    {
        
    }
    
    public function insertCarAd()
    {
        
    }
}