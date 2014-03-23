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
      * Get an its VIN. there's only 1 ad by car.
      * 
      * @param int Car VIn 
      * @param int Flag 0= pending, 1= active, 2= no active
      * @return adObject the ad of the car
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo - Check 
      * @see getAdsBySearch
      */
    public function getAdByVIN($VIN,$flag)
    {
        
        $this->db->select('car_ads.*',false);
        $this->db->from('car_ads');
        $this->db->join('unique_cars','unique_cars.VIN = car_ads.Unique_Car_ID');
        $this->db->where('unique_cars.VIN',$VIN);
        $this->db->where('Flag',$flag);
        $query = $this->db->get();
    
        
        $adObject = $query->row();  
        if($adObject)
        {
            $adObject->Pictures         = $this->getPicturesByAd($adObject->ID);
            $adObject->Trouble_Codes    = $this->getTroubleCodeByAd($adObject->ID);
            $adObject->Car_Part_Reviews = $this->getCarPartsReviewByAd($adObject->ID);
            

            // Ad Objects
            $adObject->Unique_Car       = $this->car_model->getCar($adObject->Unique_Car_ID);
            $adObject->Seller           = $this->user_model->getUser($adObject->Seller_ID);
            unset($adObject->Unique_Car_ID);
            unset($adObject->Seller_ID);  
        }  
        return $adObject;
    }

      
    
     /**
      * Get all the ads from a Seller.
      * 
      * @param int car's VIN.
      * @param int flag, 0= pending, 1= active, 2= no active, 3 = all;
      * @return 
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo - Check 
      * @see getAdsByMechanic
      */
    public function getAdsBySeller($ID,$flag)
    {
        $searchArray = array(
                                'users.ID' =>$ID,
                                'car_ads.Flag'            =>$flag,           
        );
        if($flag == 3)
        {
            unset($searchArray["Flag"]);
        }
        $this->db->select('car_ads.*',false);
        $this->db->from('car_ads');
        $this->db->join('users','car_ads.Seller_ID = users.ID');
        
        $this->db->where($searchArray);
        $query = $this->db->get();
        
        $adObjects = $query->result();
        
        if($adObjects)
        {
            $adObjects = $this->buildAdObject($adObjects);
        }  
        return $adObjects;
    }
    
     /**
      * Get all the ads from a user.
      * 
      * @param int car's VIN.
      * @param int flag, 0= pending, 1= active, 2= no active, 3 = all;
      * @return 
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo - Check 
      * @see getAdsBySeller
      */
    public function getAdsByMechanic($ID,$flag)
    {
        $searchArray = array(
                                'users.ID' =>$ID,
                                'car_ads.Flag'            =>$flag,           
        );
        if($flag == 3)
        {
            unset($searchArray["Flag"]);
        }
        $this->db->select('car_ads.*',false);
        $this->db->from('car_ads');
        $this->db->join('users','car_ads.Mechanic_ID = users.ID');
        $this->db->where($searchArray);
        $query = $this->db->get();
        
        $adObjects = $query->result();
        
        if($adObjects)
        {
            $adObjects = $this->buildAdObject($adObjects);
        }  
        return $adObjects;
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
                                 'dominican_republic_cities.Dominican_Republic_City'   => $searchParamaters['city'], 
                                 'car_brands.Brand'                 => $searchParamaters['brands'],
                                 'car_models.Model'                 => $searchParamaters['model'],
                                 'unique_models.Body_Style'         => $searchParamaters['type'],
                                 'unique_models.Year <='            => $searchParamaters['highYear'],
                                 'unique_models.Year >='            => $searchParamaters['lowYear'],
                                 'car_ads.Price  <='                => $searchParamaters['highPrice'],
                                 'car_ads.Price  >='                => $searchParamaters['lowPrice'],
                                 'car_ads.Flag   = '                => $flag
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
        $this->db->join('unique_cars'                 , 'car_ads.Unique_Car_ID = unique_cars.VIN'         ,'inner');
        $this->db->join('unique_models'               , 'unique_cars.Unique_Model_ID = unique_models.ID'    ,'inner');
        $this->db->join('car_models'                  , 'unique_models.Car_Model_ID = car_models.ID'     ,'inner');
        $this->db->join('car_brands'                  , 'unique_models.Car_Brand_ID = car_brands.ID'      ,'inner');
        $this->db->join('users'                       , 'car_ads.Seller_ID = users.ID'                   ,'inner');
        $this->db->join('dominican_republic_cities'   , 'users.Dominican_Republic_Cities_ID = dominican_republic_cities.ID','inner');
        $this->db->where($searchArray);
        $query = $this->db->get();    
        $adObjects = $query->result();
        
        if($adObjects)
        {
            $adObjects = $this->buildAdObject($adObjects);
        }
        
        return $adObjects;
    }
    
     /**
      * Insert an entire ad to the database. As usual iit recive an entire
      * Ad ad object an get all its ID and insert to the data base
      * 
      * @param adObject the new object we want to insert
      * @return int added row
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo - Check performance when adObject get the last insert
      */
     public function insertAd($adObject)
     {  
                // get the array
                $troubleCodes           = $adObject->Trouble_Codes;
                $carPartReview          = $adObject->Car_Part_Reviews;
                $pictures               = $adObject->Pictures;
                
                // get the objects
                $adObject->Seller_ID     = $adObject->Seller->ID;
                $adObject->Unique_Car_ID = $adObject->Unique_Car->VIN;
                
                // unset the un useless values;
                unset($adObject->ID);
                unset($adObject->Mechanic);
                
                unset($adObject->Car);
                unset($adObject->Seller);
                unset($adObject->Pictures);
                unset($adObject->Trouble_Codes);
                unset($adObject->Car_Part_Review);
                
                
                //insert an relate values;
                 $this->db->insert('car_ads',$adObject);   
                $adObject->ID = $this->db->insert_id();
                $this->insertCarPartReview($carPartReview,$adObject);
                $this->relateAdAndTroubleCode($troubleCodes, $adObject);
                $this->insertPictures($pictures, $adObject);
                return $this->db->insert_id();        
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
                                            'Car_Ad_ID'         => $adObject->ID,
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
      * insert the new photos paths to the data base
      * 
      * @param array Pictures array with all the paths
      * @param adObject an ad object  
      * @return AdObject all the Ads Objects available
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo - Check 
      */
     public function insertPictures($pictures, $adObject)
     {
           foreach ($pictures as $k => $picture)
           {
                    $carPartReviewData = array(
                                                'Car_Ad_ID'      => $adObject->ID,
                                                'Picture_Path'   => $picture
                                              );
                     $this->db->insert('pictures',$carPartReviewData); 
           }   
           return $this->db->insert_id();
     }
     
     /**
      * Get all the picture of an ad
      * 
      * @param int ad ID 
      * @return AdObject all the Ads Objects available
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo - Check 
      */
     public function getPicturesByAd($ID)
     {
        $this->db->select('Picture_Path');
        $this->db->from('pictures');
        $this->db->where('Car_Ad_ID' ,$ID);
        $query = $this->db->get();
        return $query->result();  
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
                                                'Review'        => $carPartReview,
                                                'Date'          => $adObject->Publish_Date
                                              );
                     $this->db->insert('car_part_review',$carPartReviewData); 
           }  
           return $this->db->insert_id();
    }
    
    /** Get all the parts from an AD
      * 
      * 
      * @param int Ad ID
      * @return array Partas array
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo - Check 
      */
    public function getCarPartsReviewByAd($ID)
    {
        $this->db->select('*');
        $this->db->from('car_part_review');
        $this->db->join('car_parts', 'car_part_review.Car_Part_ID = car_parts.ID','inner');
        $this->db->where('car_part_review.Car_Ad_ID'    ,$ID); 
        $query = $this->db->get();
        $result =  $query->result();   
        return $result;
    } 
    
     
     /**
      * Build the Ad object from the Ad Table.
      * 
      * @param rows the table returned from the DB
      * @return $adObject
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo - Check 
      * @see 
      */
    public function buildAdObject($adObjects)
    {
         foreach($adObjects as $k => $adObject)
            {
                // Ad Arrays
                $adObjects[$k]->Pictures         = $this->getPicturesByAd($adObject->ID);
                $adObjects[$k]->Trouble_Codes    = $this->getTroubleCodeByAd($adObject->ID);
                $adObjects[$k]->Car_Part_Reviews = $this->getCarPartsReviewByAd($adObject->ID);


                // Ad Objects
                $adObjects[$k]->Unique_Car       = $this->car_model->getCar($adObject->Unique_Car_ID);
                $adObjects[$k]->Seller           = $this->user_model->getUser($adObject->Seller_ID);
                unset($adObject->Unique_Car_ID);
                unset($adObject->Seller_ID);
             }

        return $adObjects;
    }

    
    
}