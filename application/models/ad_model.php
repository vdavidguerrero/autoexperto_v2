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
        return $query->row();  
    }
    
    /************************************************************************
     
    * Ads; Represents car ads.
     
    ************************************************************************/
       
    public function getPendingAdByVIN($carVIN)
    {
        $this->db->select('car_ads.ID');
        $this->db->from('car_ads');
        $this->db->join('unique_cars', 'car_ads.Unique_Car_ID = unique_cars.ID','inner');
        $this->db->where('unique_cars.VIN'    ,$carVIN);
        $this->db->where('car_ads.Flag', 0);
        $query = $this->db->get();
        return $query->row();   
    }
    
    public function insertCarAd($newCarAdData)
    {
          $this->db->insert('car_ads',$newCarAdData);
    }
    
    public function insertCarPartReview($carPartReviewData)
    {
         $this->db->insert('car_part_review',$carPartReviewData); 
    }
    
    public function getCarPartsReviewByAd($adID)
    {
        $this->db->select('car_part_review.Seller_Review, car_parts.Part ');
        $this->db->from('car_part_review');
        $this->db->join('car_parts', 'car_part_review.Car_Part_ID = car_parts.ID','inner');
        $this->db->where('car_part_review.Car_Ad_ID'    ,$adID); 
        $query = $this->db->get();
        return $query->result();   
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
    
    public function getAd($adID)
    {
       $this->db->select('*');
       $this->db->from('car_ads');
       $this->db->where('ID', $adID);
       $query = $this->db->get();
       return $query->row();
    }
    
    public function getAdBySeller($selleID)
    {
        
    }
   
    public function getAdsBySearch($searchData)
    {
        $this->db->select('*, car_ads.ID as adID, users.ID as userID',false);
        $this->db->from('car_ads');
        $this->db->join('unique_cars'                 , 'car_ads.Unique_Car_ID = unique_cars.ID'         ,'inner');
        $this->db->join('unique_models'               , 'unique_cars.Unique_Model = unique_models.ID'    ,'inner');
        $this->db->join('car_models'                  , 'unique_models.Car_Model_ID = car_models.ID'     ,'inner');
        $this->db->join('car_brands'                  , 'car_models.Brand_ID = car_brands.ID'            ,'inner');
        $this->db->join('users'                       , 'car_ads.Seller_ID = users.ID'                   ,'inner');
        $this->db->join('dominican_republic_cities'   , 'users.DR_City_ID = dominican_republic_cities.ID','inner');
        $this->db->where($searchData);
        $query = $this->db->get();    
        return $query->result();

    }
}