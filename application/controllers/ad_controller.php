<?php if (!defined('BASEPATH')) die();


class Ad_controller extends Main_Controller {
    
    
        //Ad Properties
         var $ID;
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
         var $Pictures;
         
         // Ad Objects
         var $Unique_Car;
         var $Seller;
         var $Mechanic;
        

        public function __construct()
        {  
            parent::__construct();
            $this->load->model("ad_model");
            $this->load->model("user_model");
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
        * @todo - Ready 
        */
        public function showAdForm($key="var",$val="1")
        {
           $dataPass["brands"] = $this->car_model->getBrands();
           $dataPass["cities"] = $this->user_model->getDominicanRepublicCities();  
           $dataPass["years"]  = $this->car_model->getYears();
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
         * @todo - Ready 
         */
        public function showAdModels($brand)
        {
            $models = $this->car_model->getModelsByBrand($brand); 
            foreach ($models as $model)
                echo "<li><a>".$model->Model."</a></li>";      
        }

        /**
         * Show all the ads from a custom search
         *
         * @param string Brand]
         * @author Vincent Guerrero <v.davidguerrero@gmail.com>
         * @todo - Ready
         */
        public function showSearchResults()
        {
         $inputArray = $this->input->post();
         $adObjects = $this->ad_model->getAdsBySearch($inputArray,1);    
         $this->showAdForm("ads", $adObjects);
        }
           
        /**
        * Shows an actvie Ad by its ID.
        * 
        * @param int Adid
        * @author Vincent Guerrero <v.davidguerrero@gmail.com>
        * @todo - Check 
        */
        public function showAd($VIN,$flag)
        {
          $this->instanceAd($this->ad_model->getAdByVIN($VIN,$flag));
          $dataPass["ad"] = $this->getThisObjectOnly();
          $this->load->view('include/header'); 
          $this->load->view('ad/show_ad_view',$dataPass);  
          $this->load->view('include/footer'); 
          
        }
        
       /**
        * echos a JSON with all the ads from a mechanich ID.
        * 
        * @param int mechanich ID
        * @author Vincent Guerrero <v.davidguerrero@gmail.com>
        * @todo - Check 
        */
        public function getMechanicAds()
        {  
          $json = file_get_contents('php://input');
          $mechanicID = json_decode($json);
          
          $adsObject = $this->ad_model->getAdsByMechanic($mechanicID->ID,0);
          header('Content-type: application/json');
          echo json_encode($adsObject);
          
        }
        /**
         * echos a JSON with all the ads from a mechanich ID.
         *
         * @param int mechanich ID
         * @author Vincent Guerrero <v.davidguerrero@gmail.com>
         * @todo - Check
         */
        public function getActiveAdByVin()
        {
            $json = file_get_contents('php://input');
            $VIN = json_decode($json);

            $adsObject = $this->ad_model->getAdByVIN($VIN->VIN, 0);
            header('Content-type: application/json');
            echo json_encode($adsObject);

        }

        /**
         * turns an Ad from pending to active
         *
         * @author Vincent Guerrero <v.davidguerrero@gmail.com>
         * @todo - Check
         */
        public function insertMechanicReview(){
            $json = file_get_contents("php://input");
            $updateObject = json_decode($json);
            if($updateObject)
            {
                if($this->ad_model->getAdByID($updateObject->adID,0))
                {
                    $this->ad_model->insertCarPartReview($updateObject->Reviews,$updateObject->adID);
                    $this->ad_model->setFlag(1,$updateObject->adID);
                    header('Content-type: application/json');
                    $response = (object) array("Response" => 1);
                    echo json_encode($response);
                }
                else
                {
                    header('Content-type: application/json');
                    $response = (object) array("Response" => -1);
                    echo json_encode($response);
                }

            }
            else
            {
                header('Content-type: application/json');
                $response = (object) array("Response" => -2);
                echo json_encode($response);
            }

        }


        /**
        * Creates an Ad from a JSON.
        * 
        * @author Vincent Guerrero <v.davidguerrero@gmail.com>
        * @todo - Check 
        */
        public function createPendingAd()
        {
            $json = file_get_contents('php://input');
            $adObject = json_decode($json);

            if($adObject)
            {

                    if($this->ad_model->getAdByVIN($adObject->VIN,0) || $this->ad_model->getAdByVIN($adObject->VIN,1))
                    {
                        header('Content-type: application/json');
                        $response = (object) array("Response" => -1);
                        echo json_encode($response);
                    }
                    else
                    {
                        $adObject->Seller           = $this->user_model->getUser($adObject->Seller_ID);
                        $adObject->Mechanic         = $this->user_model->getUser(12345678923);
                        $adObject->Unique_Car       = $this->car_model->getCar($adObject->VIN);
                        $adObject->ID               = NULL;
                        $adObject->Publish_Date     = date("Y-m-d H:i:s");
                        $adObject->Expiration_Date  = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s")."+45 days"));
                        $adObject->Car_Review       = 0;
                        $adObject->Car_Part_Reviews = NULL;
                        $this->instanceAd($adObject);
                        $this->ad_model->insertAd($this);

                        header('Content-type: application/json');
                        $response = (object) array("Response" => 1);
                        echo json_encode($response);
                    }
            }
            else
            {
                 header('Content-type: application/json');
                        $response = (object) array("Response" => -2);
                        echo json_encode($response);
            }
	    
        }

        
        /**
        * Generates a Car Review from all its values.
        * 
        * @author Vincent Guerrero <v.davidguerrero@gmail.com>
        * @todo - Check 
        */
        public function generateCarReview()
        {
           $overallReview = 0;
           foreach($this->Car_Part_Reviews as $review)
           {
               $overallReview =+ $review;
           }
           return $overallReview/(sizeof($this->Car_Part_Reviews)-1);
        }
       
        /**
        * Create a instance of the Ad
        * 
        * @param $adObject an object with all the require to create an AD
        * @return 
        * @author Vincent Guerrero <v.davidguerrero@gmail.com>
        * @todo - Check 
        * @see getAdsBySearch
        */           
        public function instanceAd($adObject)
        {      
        
        //Ad Properties
        
         $this->ID               = $adObject->ID; 
         $this->Flag             = $adObject->Flag;  
         $this->Price            = $adObject->Price; 
         $this->Mileage          = $adObject->Mileage;
         $this->Car_Review       = $adObject->Car_Review; 
         $this->Paper_Status     = $adObject->Paper_Status;
         $this->Publish_Date     = $adObject->Publish_Date; 
         $this->Expiration_Date  = $adObject->Expiration_Date; 
        
         // Ad Arrays
         $this->Car_Part_Reviews  = $adObject->Car_Part_Reviews;
         $this->Trouble_Codes     = $adObject->Trouble_Codes;
         $this->Pictures          = $adObject->Pictures;
         
         // Ad Abjects
         $this->Unique_Car       = $adObject->Unique_Car;
         $this->Seller           = $adObject->Seller;  
         $this->Mechanic         = $adObject->Mechanic;
        
        }
        
          /**
        * Get the child from its father
        * 
        * @author Vincent Guerrero <v.davidguerrero@gmail.com>
        * @todo - Check 
        * @see getAdsBySearch
        */           
        function getThisObjectOnly()
        {
           $child = (object) array();
             $i=0; 
             foreach($this as $property => $propertyValue)
             {
                 if($i==14)
                 {
                     break;
                 }
                 $i++;
                 $child->$property = $propertyValue;
             }
             return $child; 
        }
} 
