<?php if (!defined('BASEPATH')) die();


class Ad_controller extends Main_Controller {
    
    
        //Ad Properties
         var $adID;
         var $Flag; 
         var $Price;  
         var $Mileage;
         var $Car_Review; 
         var $Paper_Status;
         var $Publish_Date; 
         var $Expiration_Date; 
        
         // Arrays
         var $Car_Part_Reviews;
         var $Trouble_Codes;
         
         // Ad Objects
         var $Car;
         var $Seller;
      // var $Mechanic;
        
         
       
         
        public function __construct()
        {  
            parent::__construct();
            $this->load->model("ad_model");
            $this->load->model("car_model");
            $this->load->model("user_model");
            $this->load->library('form_validation');
            $this->load->helper('form');
            $this->load->library('session');
            $this->load->helper('url'); 
        }  
            
        function index ()
	{
          $this->showAdForm();
        }
            
        
         /**
        * load the Show_ad_view. 
        * 
        * @author Vincent Guerrero <v.davidguerrero@gmail.com>
        * @todo - Check 
        */
        public function showAdForm($key="var",$val="1")
        {
           $dataPass["brands"] = $this->car_model->getCarBrands();
           $dataPass["cities"] = $this->user_model->getUserCities();  
           $dataPass["years"]  = $this->car_model->getCarYears();
           $dataPass[$key] = $val;
           $this->load->view('include/header'); 
           $this->load->view('ad/search_ad_view',$dataPass);  
           $this->load->view('include/footer');  
        }
        
         /**
         * Echos a list of all the models from a brand
         * 
         * @param string Brand]
         * @author Vincent Guerrero <v.davidguerrero@gmail.com>
         * @todo - Check 
         */
        public function showAdModels($brand)
        {
            $models = $this->car_model->getModelsByBrand($brand); 
            foreach ($models as $model)
                echo "<li><a>".$model->Model."</a></li>";      
        }
            
        public function showSearchResults()
        {  
         $inputArray = $this->input->post();
         $adObjects = $this->ad_model->getAdsBySearch($inputArray,0);    
         $this->showAdForm("ads", $adObjects);
        }
           
        /**
        * Shows an actvie Ad by its ID.
        * 
        * @param int Adid
        * @author Vincent Guerrero <v.davidguerrero@gmail.com>
        * @todo - Check 
        */
        public function showAd($adId)
        {  
          $dataPass["ad"] = $this->ad_model->getActiveAd($adId);
          $this->load->view('include/header'); 
          $this->load->view('ad/show_ad_view',$dataPass);  
          $this->load->view('include/footer'); 
          
        }
            
        /**
        * Creates an Ad from a JSON.
        * 
        * @author Vincent Guerrero <v.davidguerrero@gmail.com>
        * @todo - Check 
        */
        public function createAd()
        {
             $json = file_get_contents('php://input');
             $obj = json_decode($json,true);
             $VIN = $obj["VIN"];
             $carPartsReview = array();
             $carPartsID = array(); 
             $carTroubleCodes = array();
                 
            if($this->ad_model->getPendingAdByVIN($VIN)) // se debe cambiar a activo.          
               echo "Ya existe un anuncio para este Vehículo.";
                   
            else 
            {
                 foreach ($obj['troubleCodes'] as $val)
                     array_push($carTroubleCodes, $val['Trouble']);
                         
                         
                 foreach ($obj['carParts'] as $val)
                 {
                     array_push($carPartsReview, $val['Review']);
                     array_push($carPartsID, $val['ID']);
                 }
                     
                $carMileage = $obj["mileage"];
                $carPaperStatus = $obj["papers"];
                $adPrice = $obj["adPrice"];
                $userID = $obj["userID"];
                $carReview = $this->generateCarReview($carPartsReview);
                $flag = 0;
                $adPublishDate = date("Y-m-d H:i:s");
                $adExpirationDate = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s")."+45 days"));
                $uniqueCarObject = $this->car_model->getUniqueCar($VIN);
                $uniqueCarID = $uniqueCarObject->ID;
                    
                 $newCarAdData = array(
                                        'Seller_ID'         => $userID,
                                        'Expiration_Date'   => $adExpirationDate,
                                        'Publish_Date'      => $adPublishDate,
                                        'Price'             => $adPrice,
                                        'Flag'              => $flag,         
                                        'Paper_status'      => $carPaperStatus,
                                        'Car_Review'        => $carReview,
                                        'Mileage'           => $carMileage,
                                        'Unique_Car_ID'     => $uniqueCarID  
                                     );
                $this->ad_model->insertCarAd($newCarAdData);
                    
                $carAdObject = $this->ad_model->getPendingAdByVIN($VIN);
                $carAdID = $carAdObject->ID;
                    
                    
                    
                 foreach ($carPartsReview as $k => $carPartReview)
                {
                    $carPartReviewData = array(
                                                'Car_Ad_ID'     => $carAdID,
                                                'Car_Part_ID'   => $carPartsID[$k],
                                                'Seller_Review' => $carPartReview,
                                                'Seller_Date'   => $adPublishDate
                                             );
                    $this->ad_model->insertCarPartReview($carPartReviewData);
                }
                    
                foreach ($carTroubleCodes as $k => $carTroubleCode)
                {
                   $troubleCodeObject =  $this->ad_model->getTroubleCode($carTroubleCode);
                   $troubleCodeID = $troubleCodeObject->ID; 
                   $troubleCodeNAdData  = array(
                                                    'Car_Ad_ID'         => $carAdID,
                                                    'Trouble_Code_ID'   => $troubleCodeID
                                               );
                  $this->ad_model->relateAdAndTroubleCode($troubleCodeNAdData);
                      
                }
                    
              }
                  
        }
            
          
        public function generateCarReview()
        {
            return 3;
        }
                    
        public function instanceAd($adObject)
        {      
        
        //Ad Properties
         $this->adID             = $adObject->adID;
         $this->Flag             = $adObject->Flag;
         $this->Price            = $adObject->Price; 
         $this->Mileage          = $adObject->Mileage;
         $this->Car_Review       = $adObject->Car_Review; 
         $this->Paper_Status     = $adObject->Paper_Status;
         $this->Publish_Date     = $adObject->Publish_Date; 
         $this->Expiration_Date  = $adObject->Expiration_Date; 
        
         // Ad Arrays
         $this->Car_Part_Reviews = $adObject->Car_Part_Reviews;
         $this->Trouble_Codes    = $adObject->Trouble_Codes;
         
         // Ad Objects
         $this->Car              = $adObject->Car;
         $this->Seller           = $adObject->Seller;
        // $this->mechanic = $adObject->Mechanic;
        
        }
        function getThisObjectOnly()
        {
           $child = (object) array();
             $i=0; 
             foreach($this as $property => $propertyValue)
             {
                 if($i>11)
                 {
                     break;
                 }
                 $i++;
                 $child->$property = $propertyValue;
             }
             return $child; 
        }
} 