<?php if (!defined('BASEPATH')) die();


class Ad_controller extends Main_Controller {
    
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
            
        public function showAdForm()
        {
           $dataPass["brands"] = $this->car_model->getCarBrands();
           $dataPass["cities"] = $this->user_model->getUserCities();  
           $dataPass["years"]  = $this->car_model->getCarYears();
           $this->load->view('include/header'); 
           $this->load->view('ad/search_ad_view',$dataPass);  
           $this->load->view('include/footer');  
          
           
        }
            
        public function showAdModels($brandID)
        {
            $models = $this->car_model->getModelsByBrandID($brandID); 
            echo "<option selected disabled>Seleccione Una Marca</option>";
                
            foreach ($models as $model)
                echo "<option value='".$model->ID."' >".$model->Model."</option>";
                    
                    
        }
            
        public function showSearchResults()
        {
            
            $searchData = array (
                                 'users.DR_City_ID'         => $this->input->post('city'), 
                                 'car_models.Brand_ID'      => $this->input->post('brands'),
                                 'car_models.ID'            => $this->input->post('model'),
                                 'unique_models.Body_Style' => $this->input->post('type'),
                                 'unique_models.Year <='     => $this->input->post('highYear'),
                                 'unique_models.Year >='     => $this->input->post('lowYear'),
                                 'car_ads.Price < '         => $this->input->post('highPrice'),
                                 'car_ads.Price > '         => $this->input->post('lowPrice')  
                               );
                                   
          foreach ($searchData as $k => $data)
              if(strlen($data) == 0)
                  unset($searchData[$k]);
                      
           $dataPass["var"] = $this->ad_model->getAdsBySearch($searchData);
           $dataPass["brands"] = $this->car_model->getCarBrands();
           $dataPass["cities"] = $this->user_model->getUserCities();  
           $dataPass["years"]  = $this->car_model->getCarYears();
               
           $this->load->view('include/header'); 
           $this->load->view('ad/search_ad_view',$dataPass);  
           $this->load->view('include/footer');  
        }
            
        public function showAd($adID,$VIN, $userID)
        {
            
            
          $dataPass["ad"]  = $this->ad_model->getAd($adID);
          $dataPass["car"] = $this->car_model->getCar($VIN);
          $dataPass["user"] = $this->user_model->getUserByRnc($userID);
          $dataPass["parts"] = $this->ad_model->getCarPartsReviewByAd($adID);
          $this->load->view('include/header'); 
          $this->load->view('ad/show_ad_view',$dataPass);  
          $this->load->view('include/footer'); 
              
        }
            
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
            
        function queryAdData($VIN)
        {
            // Sacar esta info de VIN Query
            for ($i = 1; $i<45; $i++)
                        $piezas[$i] = 3; 
                            
             $trouble_codes = array(
                                    '1' => 'P0001',
                                    '2' => 'P0003'
                                   );
                                       
            $precio = 150000;
            $ID_user = 1;
            $DGII_Status = "GOOD";
            $vin = 1234;
            $papers = "OK";
                
            $return_Array = array (
                                    '1'   => $piezas, 
                                    '2'   => $precio,
                                    '3'   => $ID_user, 
                                    '4'   => $trouble_codes,
                                    '5'   => $vin, 
                                    '6'   => $papers,
                    );
                        
            return  $return_Array; 
        }
            
            
        public function generateCarReview($carPartsReview)
        {
            $review = 0; 
                
            foreach($carPartsReview as $values)
                $review += $values; 
                    
                    
            return $review/(44);
        }
                    
} 