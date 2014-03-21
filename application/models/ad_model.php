<?php
    
class Ad_model extends CI_Model {
    
    
    public function __construct()
    {
    	parent::__construct();
	$this->load->database(); 
        $this->load->model("car_model");
        $this->load->model("user_model");
        
    }
        
        
   /**
      * Create de relationship between the trouble code and the Ad
      * 
      * @param Array relation array(adID=> x, TroubleCodeID => y)
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo - Check 
      */
          
    public function relateAdAndTroubleCode($troubleCodes, $adObject)
    {
        
         foreach ($troubleCodes as $k => $troubleCode)
                {
                   $troubleCodeObject =  $this->ad_model->getTroubleCode($troubleCode);
                   $insertArray  = array(
                                            'Car_Ad_ID'         => $adObject->adID,
                                            'Trouble_Code_ID'   => $troubleCodeObject->ID
                                        );
                    $this->db->insert('trouble_code_N_ad',$insertArray);
                }
    }
        
    /**
      * Get the Trouble Code Row by its name
      * 
      * @param  String Trouble Code Name
      * @return Object trouble code Row
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo - Check 
      */
          
    public function getTroubleCode($troubleCode)
    {
        $this->db->select('*');
        $this->db->from('trouble_codes');
        $this->db->where('Trouble_Code'    ,$troubleCode);
        $query = $this->db->get();
        return $query->row();  
    }
    /**
      * get all the trouble codes from an Ad
      * 
      * @param int Ad ID
      * @return Object_Array, Object->Trouble_Code
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo - Check 
      */
          
    public function getTroubleCodeByAd($ID)
    {
        $this->db->select('*');
        $this->db->from('trouble_codes');
        $this->db->join("trouble_code_N_ad", "trouble_code_N_ad.Trouble_Code_ID = trouble_codes.ID");
        $this->db->where('trouble_code_N_ad.Car_Ad_ID' ,$ID);
        $query = $this->db->get();
        return $query->result();  
    }
        
        
      /**
      * Get an activeAd by its ID. there's only 1 ad by car.
      * 
      * @param 
      * @return 
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo - Check 
      * @see getAdsBySearch
      */
    public function getActiveAdByVIN($VIN)
    {
        
        $this->db->select('car_ads.*',false);
        $this->db->from('car_ads');
        $this->db->join('unique_cars','unique_cars.ID = car_ads.Unique_Car_ID');
        $this->db->where('unique_cars.VIN',$VIN);
        $this->db->where('Flag',0);
        $query = $this->db->get();
            
        // Ad Propeties
        $adObject = $query->row();  
            
        // Ad Arrays
        $adObject->Car_Part_Reviews = $this->getCarPartsReviewByAd($adObject->ID);
        $adObject->Trouble_Codes    = $this->getTroubleCodeByAd($adObject->ID);
            
        // Ad Objects
        $adObject->Car              = $this->car_model->getCar($adObject->Unique_Car_ID);
        $adObject->Seller           = $this->user_model->getUserByRnc($adObject->Seller_ID);
        //$adObject->Mechanic        = $this->user_model->getUserByRnc($adObject->Seller_ID);
            
        return $adObject;
    }
      /**
      * 
      * 
      * @param 
      * @return 
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo - Check performance when adObject get the last insert
      */
    
    
     public function insertAd($adObject)
     {  
                $Trouble_Codes           = $adObject->Trouble_Codes;
                $Car_Part_Review         = $adObject->Car_Part_Review;
                
                $adObject->Seller_ID     = $adObject->Seller->ID;
                $adObject->Unique_Car_ID = $adObject->Car->ID;
                
                
                unset($adObject->Car);
                unset($adObject->Seller);
                unset($adObject->Trouble_Codes);
                unset($adObject->Car_Part_Review);
                
                 
                $this->db->insert('car_ads',$adObject);   
                
//                $adObject = $this->getActiveAdByVIN($adObject->Unique_Car_ID);   
//                $this->insertCarPartReview($Car_Part_Review,$adObject);
//                $this->relateAdAndTroubleCode($Trouble_Codes, $adObject);         
     }
        
     /**
      * Get all the add by its Specefic Search.
      * 
      * @param Array order by : city, brands, model, type, highYear, lowYear,
      *         highPrice, lowPrice. The array must have at least all this keys.
      * @param flag 0= active ads, 1= pending ads, 2= no active ad  
      * @return AdObject all the Ads Objects available
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo - Check 
      */
    public function getAdsBySearch($searchParamaters, $flag)
    {
          $searchArray = array (
                                 'dominican_republic_cities.City'   => $searchParamaters['city'], 
                                 'car_brands.Brand'                 => $searchParamaters['brands'],
                                 'car_models.Model'                 => $searchParamaters['model'],
                                 'unique_models.Body_Style'         => $searchParamaters['type'],
                                 'unique_models.Year <='            => $searchParamaters['highYear'],
                                 'unique_models.Year >='            => $searchParamaters['lowYear'],
                                 'car_ads.Price  <='                => $searchParamaters['highPrice'],
                                 'car_ads.Price  >='                => $searchParamaters['lowPrice'],
                                 'car_ads.Flag'                    => $flag
                               );                  
          foreach ($searchArray as $k => $data)
          {
            if(strlen($data) == 0)
            {
               unset($searchArray[$k]);
            } 
          }
    
        $this->db->select('car_ads.*',false);
        $this->db->from('car_ads');
        $this->db->join('unique_cars'                 , 'car_ads.Unique_Car_ID = unique_cars.ID'         ,'inner');
        $this->db->join('unique_models'               , 'unique_cars.Unique_Model = unique_models.ID'    ,'inner');
        $this->db->join('car_models'                  , 'unique_models.Car_Model_ID = car_models.ID'     ,'inner');
        $this->db->join('car_brands'                  , 'car_models.Brand_ID = car_brands.ID'            ,'inner');
        $this->db->join('users'                       , 'car_ads.Seller_ID = users.ID'                   ,'inner');
        $this->db->join('dominican_republic_cities'   , 'users.DR_City_ID = dominican_republic_cities.ID','inner');
        $this->db->where($searchArray);
        $query = $this->db->get();    
        $adObjects = $query->result();
        
        foreach($adObjects as $k => $adObject)    
        {
            // Ad Arrays
            $adObjects[$k]->Car_Part_Reviews = $this->getCarPartsReviewByAd($adObject->ID);
            $adObjects[$k]->Trouble_Codes    = $this->getTroubleCodeByAd($adObject->ID);

            // Ad Objects
            $adObjects[$k]->Car              = $this->car_model->getCar($adObject->Unique_Car_ID);
            $adObjects[$k]->Seller           = $this->user_model->getUserByRnc($adObject->Seller_ID);
           //$adObject->Mechanic        = $this->user_model->getUserByRnc($adObject->Seller_ID);
            
            unset($adObjects[$k]->ID);
            unset($adObjects[$k]->Seller_ID);
            unset($adObjects[$k]->Mechanic_ID);
            unset($adObjects[$k]->Unique_Car_ID);
        }
        return $adObjects;
    }
    
          
  
    /**
      * 
      * 
      * @param 
      * @return 
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo - Check Performance 
      */
    public function insertCarPartReview($carPartsReviewData, $adObject)
    {
          foreach ($carPartsReviewData as $k => $carPartReview)
           {
                    $carPartReviewData = array(
                                                'Car_Ad_ID'     => $adObject->ID,
                                                'Car_Part_ID'   => $k+1,
                                                'Seller_Review' => $carPartReview,
                                                'Seller_Date'   => $adObject->Date
                                              );
                     $this->db->insert('car_part_review',$carPartReviewData); 
           }       
    }
    /**
      * 
      * 
      * @param 
      * @return 
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo - Check 
      */
    public function getCarPartsReviewByAd($ID)
    {
        $this->db->select('car_part_review.Seller_Review, car_parts.Part ');
        $this->db->from('car_part_review');
        $this->db->join('car_parts', 'car_part_review.Car_Part_ID = car_parts.ID','inner');
        $this->db->where('car_part_review.Car_Ad_ID'    ,$ID); 
        $query = $this->db->get();
        return $query->result();   
    } 
    
    
}