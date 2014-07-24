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
           $dataPass["lastAds"] = $this->ad_model->getLastTenAds(1);
           $dataPass["lastAds"] = $this->ad_model->getLastTenAds(1);
           $dataPass["reviewAds"] = $this->ad_model->getThree(1);
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
            $response = new stdClass();
            $response->Response = $this->ad_model->getAdByVIN($VIN->VIN, 0);
            if(!$response->Response)
                $response->Response = -1;

            header('Content-type: application/json');
            echo json_encode($response->ID);

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
                    $this->ad_model->setFlag(1,$updateObject->adID,2);
                    $this->instanceAd($this->ad_model->getAdByID($updateObject->adID,1));
                    $this->ad_model->setFlag(1,$updateObject->adID,$this->generateCarReview());
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
                        $adObject->Mechanic         = $this->user_model->getUser(40221021963);
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

            $this->Car_Review = 0;
            foreach($this->Car_Part_Reviews as $carrito)
                {
                    $this->Car_Review += $carrito->Review * $carrito->Weight;
                }
            return $this->Car_Review = round(($this->Car_Review/580) * 5);
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

       /**
     * Change the state to sold
     *
     * @author Vincent Guerrero <v.davidguerrero@gmail.com>
     * @todo - Check
     * @see getAdsBySearch
     */
    function sellCar($adID)
    {
        $fecha = $this->ad_model->getAdByID($adID,1)->Publish_Date;
        $hoy = date("Y-m-d H:i:s");
        $fechaS =  strtotime($fecha);
        $hoyS = strtotime($hoy);
        $ahjaS = $hoyS - $fechaS  ;

        $days =  round((($ahjaS/60)/60)/24);
        $this->ad_model->setFlag2(2,$adID,$days);
        redirect("/user_controller/showUser/");
    }

    /**
     * Change the state to sold
     *
     * @author Vincent Guerrero <v.davidguerrero@gmail.com>
     * @todo - Check
     * @see getAdsBySearch
     */
    function photoUpload($adID, $vin)
    {
        $counter = 0;
        $this->load->helper(array('form', 'url'));

        $config['upload_path'] = './assets/img';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['overwrite']      = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload())
        {
            $name[0] = "prueba3.jpg";
        }
        else
        {
            $temp =  $this->upload->data();
            $name[0] = $temp['file_name'];
        }

        if (!$this->upload->do_upload("userfile2"))
        {
            $name[1] = "prueba3.jpg";
        }
        else
        {
            $temp =   $this->upload->data();
            $name[1] = $temp['file_name'];
        }

        if (!$this->upload->do_upload("nombre"))
        {
            $name[2] = "prueba3.jpg";
        }
        else
        {
            $temp =   $this->upload->data();
            $name[2] =  $temp['file_name'];
        }

        $pictures = $this->ad_model->getPicturesByAd($adID);

        foreach($pictures as $pepe)
        {
            $this->ad_model->setPicture($name[$counter],$pepe->ID);
            echo $counter;
            $counter++;
        }

        $this->ad_model->setPrice($adID,$this->input->post("price"));


        redirect("/ad_controller/showAd/".$vin."/1");


    }

    /**
     * Change the state to sold
     *
     * @author Vincent Guerrero <v.davidguerrero@gmail.com>
     * @todo - Check
     * @see getAdsBySearch
     */
    function showEditForm($adID, $vin)
    {
        $dataPass["id"] = $adID;
        $dataPass["vin"] = $vin;


        $this->instanceAd($this->ad_model->getAdByVIN($vin,1));
        $dataPass["ad"] = $this->getThisObjectOnly();

        if($this->ad_model->getSum("Car_Review",$this->Unique_Car->Unique_Model->Year, $this->Unique_Car->Unique_Model->Trim, $this->Unique_Car->Unique_Model->Model,3) < 5)
        {
            $dataPass["statitics"] = 0;
        }
        else
        {
            $dataPass["statitics"] = 1;
            $dataPass["first"] = $this->ad_model->Estimate(1,$this->Car_Review,$this->Unique_Car->Unique_Model->Year, $this->Unique_Car->Unique_Model->Trim, $this->Unique_Car->Unique_Model->Model);
            $dataPass["second"] = $this->ad_model->Estimate(15,$this->Car_Review,$this->Unique_Car->Unique_Model->Year, $this->Unique_Car->Unique_Model->Trim, $this->Unique_Car->Unique_Model->Model);
            $dataPass["third"] = $this->ad_model->Estimate(30,$this->Car_Review,$this->Unique_Car->Unique_Model->Year, $this->Unique_Car->Unique_Model->Trim, $this->Unique_Car->Unique_Model->Model);
            $dataPass["fourth"] = $this->ad_model->Estimate(45,$this->Car_Review,$this->Unique_Car->Unique_Model->Year, $this->Unique_Car->Unique_Model->Trim, $this->Unique_Car->Unique_Model->Model);

        }
        $this->load->view('include/header');
        $this->load->view('ad/edit_ad',$dataPass);
        $this->load->view('include/footer');

    }

    /**
     * Change the state to sold
     *
     * @author Vincent Guerrero <v.davidguerrero@gmail.com>
     * @todo - Check
     * @see getAdsBySearch
     */
    function createAdTemp($vin,$mileage,$troubleCode,$userID = "00119045615")
    {
        $json = file_get_contents('php://input');
       // $tempAd = json_decode($json);
        $tempAd = (object) array("VIN" => $vin,
                                   "Mileage" => $mileage,
                                   "User_ID" => $userID,
                                   "Trouble_Code" => $troubleCode);

        if($this->ad_model->insertTempAd($tempAd))
        {
            echo "1";
        }
        else
        {
            echo "-1";
        }
    }

    /**
     * Change the state to sold
     *
     * @author Vincent Guerrero <v.davidguerrero@gmail.com>
     * @todo - Check
     * @see getAdsBySearch
     */
    function getLastTempAd($userID = "00119045615")
    {
        $json = file_get_contents('php://input');

        $adObject = $this->ad_model->getLastTempAd($userID);

        header('Content-type: application/json');
        $response = (object) array("VIN" => $adObject->VIN,
                                    "Mileage" => $adObject->Mileage);
        echo json_encode($response);
    }





} 
