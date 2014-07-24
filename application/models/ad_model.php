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
        $this->db->where('car_ads.Flag',$flag);
        $query = $this->db->get();
    
        
        $adObject = $query->row();  
        if($adObject)
        {
            $adObject->Pictures         = $this->getPicturesByAd($adObject->ID);
            $adObject->Trouble_Codes    = $this->getTroubleCodeByAd($adObject->ID);
            if($flag != 0)
            {
                $adObject->Car_Part_Reviews = $this->getCarPartsReviewByAd($adObject->ID);
            }
             else
            {
                $adObject->Car_Part_Reviews = NULL;
            }

            // Ad Objects
            $adObject->Unique_Car       = $this->car_model->getCar($adObject->Unique_Car_ID);
            $adObject->Seller           = $this->user_model->getUser($adObject->Seller_ID);
            $adObject->Mechanic         = $this->user_model->getUser($adObject->Mechanic_ID);
            unset($adObject->Unique_Car_ID);
            unset($adObject->Seller_ID);  
        }  
        return $adObject;
    }

    /**
     * Get an its ID. there's only 1 ad by car.
     *
     * @param int Car VIn
     * @param int Flag 0= pending, 1= active, 2= no active
     * @return adObject the ad of the car
     * @author Vincent Guerrero <v.davidguerrero@gmail.com>
     * @todo - Check
     * @see getAdsBySearch
     */
    public function getAdByID ($adID,$flag)
    {

        $this->db->select('car_ads.*',false);
        $this->db->from('car_ads');
        $this->db->join('unique_cars','unique_cars.VIN = car_ads.Unique_Car_ID');
        $this->db->where('car_ads.ID',$adID);
        $this->db->where('car_ads.Flag',$flag);
        $query = $this->db->get();


        $adObject = $query->row();
        if($adObject)
        {
            $adObject->Pictures         = $this->getPicturesByAd($adObject->ID);
            $adObject->Trouble_Codes    = $this->getTroubleCodeByAd($adObject->ID);
            if($flag != 0)
            {
                $adObject->Car_Part_Reviews = $this->getCarPartsReviewByAd($adObject->ID);
            }
            else
            {
                $adObject->Car_Part_Reviews = NULL;
            }

            // Ad Objects
            $adObject->Unique_Car       = $this->car_model->getCar($adObject->Unique_Car_ID);
            $adObject->Seller           = $this->user_model->getUser($adObject->Seller_ID);
            $adObject->Mechanic         = $this->user_model->getUser($adObject->Mechanic_ID);
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
                                'users.ID'        =>$ID,
                                'car_ads.Flag'    =>$flag,           
        );
        if($flag === 3)
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
            $adObjects = $this->buildAdObject($adObjects,$flag);
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
            $adObjects = $this->buildAdObject($adObjects,$flag);
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
            $adObjects = $this->buildAdObject($adObjects,$flag);
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
                $adObject->Mechanic_ID   = $adObject->Mechanic->ID;
                
                // unset the un useless values;
                unset($adObject->ID);
                unset($adObject->Mechanic);
                
                unset($adObject->Car);
                unset($adObject->Seller);
                unset($adObject->Mechanic);
                unset($adObject->Pictures);
                unset($adObject->Trouble_Codes);
                unset($adObject->Car_Part_Reviews);
                
                
                //insert an relate values;
                $this->db->insert('car_ads',$adObject);   
                $adObject->ID = $this->db->insert_id();
              //  $this->insertCarPartReview($carPartReview,$adObject);
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
        $this->db->select('*');
        $this->db->from('pictures');
        $this->db->where('Car_Ad_ID' ,$ID);
        $query = $this->db->get();
        return $query->result();  
     }
        
    /**
    * relate and review all the parts from an ad
    *
    * @param
    * @return
    * @author Vincent Guerrero <v.davidguerrero@gmail.com>
    * @todo - Check Performance
    */
    public function insertCarPartReview($carPartsReviewData, $adID)
    {
          $now = date("Y-m-d H:i:s");
          foreach ($carPartsReviewData as $k => $carPartReview)
           {
                    $carPartReviewData = array(
                                                'Car_Ad_ID'     => $adID,
                                                'Car_Part_ID'   => $k+1,
                                                'Review'        => $carPartReview,
                                                'Date'          => $now
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
    public function buildAdObject($adObjects, $flag)
    {
         foreach($adObjects as $k => $adObject)
            {
               
                // Ad Arrays
                $adObjects[$k]->Pictures         = $this->getPicturesByAd($adObject->ID);
                $adObjects[$k]->Trouble_Codes    = $this->getTroubleCodeByAd($adObject->ID);
                if($flag != 0)
                {
                    $adObjects[$k]->Car_Part_Reviews = $this->getCarPartsReviewByAd($adObject->ID);
                }
                else
                {
                    $adObjects[$k]->Car_Part_Reviews = NULL;
                }
                // Ad Objects
                $adObjects[$k]->Unique_Car       = $this->car_model->getCar($adObject->Unique_Car_ID);
                $adObjects[$k]->Seller           = $this->user_model->getUser($adObject->Seller_ID);
                $adObjects[$k]->Mechanic           = $this->user_model->getUser($adObject->Mechanic_ID);
                unset($adObject->Unique_Car_ID);
                unset($adObject->Mechanic_ID);
                unset($adObject->Seller_ID);
             }

        return $adObjects;
    }


    /**
     * Change the ad status
     *
     * @param int flag which could be 0= pending, 1 = active, 2= sold
     * @return
     * @author Vincent Guerrero <v.davidguerrero@gmail.com>
     * @todo - Check Performance
     */
    public function setFlag($flag, $adID,$review)
    {
       $sendingQuery = "
       UPDATE car_ads
       SET
       Flag = $flag, Car_Review = $review

       WHERE ID = $adID ";

       $this->db->query($sendingQuery);
    }

    /**
     * Change the ad status
     *
     * @param int flag which could be 0= pending, 1 = active, 2= sold
     * @return
     * @author Vincent Guerrero <v.davidguerrero@gmail.com>
     * @todo - Check Performance
     */
    public function setFlag2($flag, $adID,$time)
    {
        $sendingQuery = "
       UPDATE car_ads
       SET
       Flag = $flag, Sold_Time = $time

       WHERE ID = $adID ";

        $this->db->query($sendingQuery);
    }

    /**
     * Change the ad status
     *
     * @param int flag which could be 0= pending, 1 = active, 2= sold
     * @return
     * @author Vincent Guerrero <v.davidguerrero@gmail.com>
     * @todo - Check Performance
     */
    public function setPicture($name, $id)
    {
        $sendingQuery = "
       UPDATE pictures
       SET
       Picture_Path = '$name'

       WHERE ID = $id ";

        $this->db->query($sendingQuery);
    }

    /**
     * Change the ad status
     *
     * @param int flag which could be 0= pending, 1 = active, 2= sold
     * @return
     * @author Vincent Guerrero <v.davidguerrero@gmail.com>
     * @todo - Check Performance
     */
    public function setPrice( $adID,$price)
    {
        $sendingQuery = "
       UPDATE car_ads
       SET
       Price = $price

       WHERE ID = $adID ";

        $this->db->query($sendingQuery);
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
    public function getSum($sumValue, $year,$trim,$model,$flag)
    {

        $this->db->select('car_ads.'.$sumValue,false);
        $this->db->from('car_ads');
        $this->db->join('unique_cars'                 , 'car_ads.Unique_Car_ID = unique_cars.VIN'         ,'inner');
        $this->db->join('unique_models'               , 'unique_cars.Unique_Model_ID = unique_models.ID'    ,'inner');
        $this->db->join('car_models'                  , 'unique_models.Car_Model_ID = car_models.ID'     ,'inner');
        $this->db->join('car_brands'                  , 'unique_models.Car_Brand_ID = car_brands.ID'      ,'inner');
        $this->db->where('unique_models.Year'    ,$year);
        $this->db->where('unique_models.Trim'    ,$trim);
        $this->db->where('car_models.Model'      ,$model);
        $this->db->where('car_ads.Flag'      ,2);
        $query = $this->db->get();
        $priceTotal =  $query->result();
        $precio = 0;
        $counter = 0;
        foreach($priceTotal as $price)
        {
            $precio += $price->$sumValue;
            $counter += 1;

        }

        if($flag == 0)
        {
            //retorna la sumatoria.
            return $precio;
        }
        else if($flag == 1 )
        {
            //retorna el promedio
            return $precio/$counter;
        }
        else if($flag ==2)
        {
            //retorna la  derivación estandar
            $promedio =  $precio/$counter;
            $precio =0;
            foreach($priceTotal as $price)
            {

                $precio  += (($price->$sumValue - $promedio)*($price->$sumValue - $promedio)) ;

            }
            return sqrt($precio/$counter);
        }

        else if($flag ==3)
        {
            // retorna la cantidad de resultados.
            return  $counter;
        }



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
    public function getSumBysum($sumValue,$sumValue2, $year,$trim,$model)
    {

        $this->db->select('car_ads.'.$sumValue.",car_ads.".$sumValue2,false);
        $this->db->from('car_ads');
        $this->db->join('unique_cars'                 , 'car_ads.Unique_Car_ID = unique_cars.VIN'         ,'inner');
        $this->db->join('unique_models'               , 'unique_cars.Unique_Model_ID = unique_models.ID'    ,'inner');
        $this->db->join('car_models'                  , 'unique_models.Car_Model_ID = car_models.ID'     ,'inner');
        $this->db->join('car_brands'                  , 'unique_models.Car_Brand_ID = car_brands.ID'      ,'inner');
        $this->db->where('unique_models.Year'    ,$year);
        $this->db->where('unique_models.Trim'    ,$trim);
        $this->db->where('car_models.Model'      ,$model);
        $this->db->where('car_ads.Flag'      ,2);
        $query = $this->db->get();
        $priceTotal =  $query->result();


        $precio = 0;
        foreach($priceTotal as $price)
        {
            $precio += $price->$sumValue * $price->$sumValue2;

        }
        return $precio;
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
    public function calculateS($sumValue,$sumValue2, $year,$trim,$model)
    {

       $first =  $this->getSumBysum($sumValue,$sumValue2, $year,$trim,$model);

       $second = $this->getSum($sumValue,$year,$trim,$model,0) * $this->getSum($sumValue2,$year,$trim,$model,0);

       $second = $second / $this->getSum($sumValue,$year,$trim,$model,3);

       return $first-$second;

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
    public function calculateR($sumValue,$sumValue2, $year,$trim,$model)
    {

        $first  =  $this->calculateS($sumValue,$sumValue2, $year,$trim,$model);

        $second =  $this->calculateS($sumValue,$sumValue, $year,$trim,$model);

        $third  =  $this->calculateS($sumValue2,$sumValue2, $year,$trim,$model);

        $fourth  = sqrt(($second*$third));


        return $first/$fourth;
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
    public function calculateB1( $year,$trim,$model, $rPD, $rPR, $rDR)
    {
        $S = $this->getSum("Price",$year,$trim,$model,2) / $this->getSum("Sold_Time",$year,$trim,$model,2);
        $b1 = (($rPD - ($rPR * $rDR)) / (1 - ($rDR*$rDR))) * $S;
        return $b1;

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
    public function calculateB2( $year,$trim,$model, $rPD, $rPR, $rDR)
    {
        $S = $this->getSum("Price",$year,$trim,$model,2) / $this->getSum("Car_Review",$year,$trim,$model,2);
        $b2 = (($rPR - ($rPD * $rDR)) / (1 - ($rDR*$rDR))) * $S;
        return $b2;

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
    public function calculateB0($year,$trim,$model, $b1, $b2)
    {

        $z  = $this->ad_model->getSum("Car_Review",$year,$trim,$model,1);
        $x  = $this->ad_model->getSum("Sold_Time", $year,$trim,$model,1);
        $y  = $this->ad_model->getSum("Price", $year,$trim,$model,1);
        $b0 = $y - ($b1*$x) - ($b2*$z);
        return $b0;

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
    public function estimate($dias, $Review, $year,$trim,$model)
    {

        $rPD = $this->calculateR("Price","Sold_Time" ,$year,$trim,$model);
        $rPR = $this->calculateR("Price","Car_Review",$year,$trim,$model);
        $rDR = $this->calculateR("Sold_Time","Car_Review",$year,$trim,$model);

        $b1 = $this->calculateB1($year,$trim,$model,$rPD,$rPR,$rDR);
        $b2 = $this->calculateB2($year,$trim,$model,$rPD,$rPR,$rDR);
        $b0 = $this->calculateB0($year,$trim,$model,$b1,$b2);

        $precio = $b0 + ($b1*$dias) + ($b2*$Review);

        return $precio;

    }


    public function insertTempAd($adObject)
    {
       return $this->db->insert('car_ads_Temp',$adObject);
    }


    public function getLastTempAd($userID)
    {
        $this->db->select('*');
        $this->db->from('car_ads_Temp');
        $this->db->where('User_ID' ,$userID);
        return $query = $this->db->get()->last_row();

    }

    /**
     * Get an its ID. there's only 1 ad by car.
     *
     * @param int Car VIn
     * @param int Flag 0= pending, 1= active, 2= no active
     * @return adObject the ad of the car
     * @author Vincent Guerrero <v.davidguerrero@gmail.com>
     * @todo - Check
     * @see getAdsBySearch
     */
    public function getLastTenAds($flag)
    {

        $this->db->select('car_ads.*',false);
        $this->db->from('car_ads');
        $this->db->join('unique_cars'                 , 'car_ads.Unique_Car_ID = unique_cars.VIN'         ,'inner');
        $this->db->join('unique_models'               , 'unique_cars.Unique_Model_ID = unique_models.ID'    ,'inner');
        $this->db->join('car_models'                  , 'unique_models.Car_Model_ID = car_models.ID'     ,'inner');
        $this->db->join('car_brands'                  , 'unique_models.Car_Brand_ID = car_brands.ID'      ,'inner');
        $this->db->join('users'                       , 'car_ads.Seller_ID = users.ID'                   ,'inner');
        $this->db->join('dominican_republic_cities'   , 'users.Dominican_Republic_Cities_ID = dominican_republic_cities.ID','inner');
        $this->db->where('car_ads.Flag',$flag);
        $this->db->order_by('id', 'DESC');
        $this->db->limit('10');
        $query = $this->db->get();
        $adObjects = $query->result();
        if($adObjects)
        {
            $adObjects = $this->buildAdObject($adObjects,$flag);
        }

        return $adObjects;
    }

    /**
     * Get an its ID. there's only 1 ad by car.
     *
     * @param int Car VIn
     * @param int Flag 0= pending, 1= active, 2= no active
     * @return adObject the ad of the car
     * @author Vincent Guerrero <v.davidguerrero@gmail.com>
     * @todo - Check
     * @see getAdsBySearch
     */
    public function getThree($flag)
    {

        $this->db->select('car_ads.*',false);
        $this->db->from('car_ads');
        $this->db->join('unique_cars'                 , 'car_ads.Unique_Car_ID = unique_cars.VIN'         ,'inner');
        $this->db->join('unique_models'               , 'unique_cars.Unique_Model_ID = unique_models.ID'    ,'inner');
        $this->db->join('car_models'                  , 'unique_models.Car_Model_ID = car_models.ID'     ,'inner');
        $this->db->join('car_brands'                  , 'unique_models.Car_Brand_ID = car_brands.ID'      ,'inner');
        $this->db->join('users'                       , 'car_ads.Seller_ID = users.ID'                   ,'inner');
        $this->db->join('dominican_republic_cities'   , 'users.Dominican_Republic_Cities_ID = dominican_republic_cities.ID','inner');
        $this->db->where('car_ads.Flag',$flag);
        $this->db->order_by('car_ads.Car_Review', 'DESC');
        $this->db->limit('3');
        $query = $this->db->get();
        $adObjects = $query->result();
        if($adObjects)
        {
            $adObjects = $this->buildAdObject($adObjects,$flag);
        }

        return $adObjects;
    }






}
