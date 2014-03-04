<?php if (!defined('BASEPATH')) die();


class Ad_controller extends Main_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->model("ad_model");
            $this->load->model("car_model");
            $this->load->model("user_model");
            $this->load->model("review_model");
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
           
            $this->load->view('ad/test_view',$dataPass);  
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
        
        
       
        
        public function showAd()
        {
              
            
            
            
            // Revisa si existe un caro      
            //$this->load->view('include/header'); 
            //$this->load->view('user/succesful_user_view',$dataPass);  
           // $this->load->view('include/footer'); 
        }
       
        public function createAd($partsArray, $troubleCodes, $precio ,$idUser, $vin)
        {
            /*
                
             * 
             * Primera Parte: Anuncio 
             * 
             * 1) Se crea un anuncio, con el ID del cliente. 
             * 
             * Primera Parte: Review
             * 
             * 1) Se crea el review con el ID del anuncio, y con el ID del Carro Unico 
             *  
             * 2) se asocian cada trouble code con el review, insertandolo en la tabla de Review_troubleCode
             * 
             * 3) se toman los ID de las piezas, junto con los review de cada pieza y se asocian a cada una de las piezas 
             * instroduciendolos en la tabla Review_Parts.
             * 
             *  */
            
            // Primero se crea el review. Con el ID del review. 
            
            
            
            $VIN = $vin; 
            $reviewDate = date("Y-m-d H:i:s");
            $uniqueCarObject = $this->car_model->getUniqueCar($VIN);
            $uniqueCarID = $uniqueCarObject->ID;
            
            $newReviewData  = array(
                                    'Unique_Car_ID' => $uniqueCarID,
                                    'Date'          => $reviewDate
                                   );
            
            // Luego creado el review, Se debe relacionar las partes con el review y relacionar
            
            
            
            $this->review_model->insertCarReview($newReviewData);
            
            $price = $precio; 
            $flag = 0;
            //Averiguar como...
            $publishDate = date("Y-m-d H:i:s");
            $expirationDate = date("Y-m-d H:i:s");
            $sellerID = $idUser;
            
            $newCarAdData = array(
                                'Seller_ID'         => $sellerID,
                                'Expiration_Date'   => $expirationDate,
                                'Publish_Date'      => $publishDate,
                                'Price'             => $price,
                                'Flag'              => $flag,             
                                 );
            $this->ad_model->insertCarAd($newCarAdData);
            
            
             
            
            
           
            // se crea un review con el carro unico, que se optiene atraves del VIN
            
            // Se asocia el review de cada pieza con el ID del del review.
            
            // // Se asocia el ID del anuncion con el trouble COde. 
            // 
            
            
          
        }
        
        function queryAdData($VIN)
        {
            // Sacar esta info de VIN Query
            $piezas =  array(
                              '1'   => '5', 
                              '2'   => '3',
                              '3'   => '1', 
                              '4'   => '5',
                              '5'   => '5',
                              '6'   => '5',
                              '7'   => '5',
                              '8'   => '5'
                             );
            $precio = 150000;
            $ID_user = 1;
            $DGII_Status = "GOOD";
            $trouble_codes = array(
                                    '1' => 'P0001',
                                    '2' => 'P0003'
                                   );
            $vin = 
            
            $return_Array = array (
                                    '1'   => $piezas, 
                                    '2'   => $precio,
                                    '3'   => $ID_user, 
                                    '4'   => $trouble_codes,
                                    '5'   => $vin 
                    );
         
            return  $return_Array; 
        }
    
        
        
        
        
       
        
            
    
} 