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

            //$this->load->helper('url');
            // Hacer el login
            // Hacer la validación de campos.
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
                  {
                             echo "<option value='".$model->ID."' >".$model->Model."</option>";
                  }    
                  
        }
 
        public function showAdSearchResults()
        {
          $searchData = array (
                          'users.DR_City_ID'    => $this->input->post('city'), 
                          'car_models.Brand_ID' =>  $this->input->post('brands'),
                          'car_models.ID' => $this->input->post('model'),
                          'users.DR_City_ID' =>  $this->input->post('type'),
                          'users.DR_City_ID' =>  $this->input->post('lowPrice'), 
                          'users.DR_City_ID' =>  $this->input->post('highPrice'), 
                          'users.DR_City_ID' =>  $this->input->post('lowYear'),
                           'users.DR_City_ID' => $this->input->post('highYear') 
              
          )  ;
            
   
          //$this->load->view('include/header'); 
          //$this->load->view('user/succesful_user_view',$dataPass);  
          // $this->load->view('include/footer'); 
        }
       
        public function createAd()
        {
             $json = file_get_contents('php://input');
             $obj = json_decode($json,true);
             $VIN = $obj["VIN"];
             
            if($VIN)           
                return "Ya existe un anuncio activo de este carro";
            
            else 
            {
             
                foreach ($obj['troubleCodes'] as $k =>$val)
                     $carTroubleCodes[$k] =  $val['Trouble'];
                 
             
                 foreach ($obj['carParts'] as $val)
                 {
                     $carPartsReview["carPartID"]     =  $val['ID'];
                     $carPartsReview["carPartReview"] =  $val['Review'];
                 }
                 
                
               
             
                $idUser = $obj["ID_user"];
                $carPaperStatus = $obj["papers"];
                $adPrice = $obj["adPrice"];
                $userID = $obj["userID"];
                $carReview = $this->generateCarReview($carPartsReview);
                $flag = 0;
                $adPublishDate = date("Y-m-d H:i:s");
                $adExpirationDate = date("Y-m-d H:i:s");
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
                                        'Unique_Car_ID'     => $uniqueCarID  
                                     );
                $this->ad_model->insertCarAd($newCarAdData);

                $carAdObject = $this->car_model->getPendingAdByVIN($VIN);
                $carAdID = $carAdObject->ID;

                // Part relate to the review

                 foreach ($carPartsReview as $carPartReview)
                {
                    $carPartReviewData = array(
                                                'Car_Ad_ID'     => $carAdID,
                                                'Car_Part_ID'   => $carPartReview["carPartID"],
                                                'Seller_Review' => $carPartReview["carPartReview"],
                                                'Seller_Date'   => $adPublishDate
                                             );
                    $this->ad_model->insertCarPartReview($carPartReviewData);
                }

                foreach ($carTroubleCodes as $carTroubleCode)
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
            
            
            return review/(44);
        }
        
        
       
        
            
    
} 