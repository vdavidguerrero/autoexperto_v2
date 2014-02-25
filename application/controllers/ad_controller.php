<?php if (!defined('BASEPATH')) die();


class Ad_controller extends Main_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->model("ad_model");
            $this->load->model("car_model");
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
            $dataPass["cities"] = $this->ad_model->getAdcities();  
            $dataPass["years"]  = $this->car_model->getCarYears();
            
            $this->load->view('include/header'); 
            $this->load->view('ad/search_ad_view',$dataPass);  
            $this->load->view('include/footer');  
        
            //  $this->load->view('user/succesful_user_view',$dataPass);  
          
            
        }
                
        function showModelsFromABrand($brandID)
        {
              
            $models = $this->car_model->getModelsByBrand($brandID); 
            echo "<option selected disabled>Seleccione Una Marca</option>";
            foreach ($models as $model)
                  {
                             echo "<option value='".$model->ID."' >".$model->Model."</option>";
                  }    
            //$this->load->view('include/header'); 
            //$this->load->view('user/succesful_user_view',$dataPass);  
           // $this->load->view('include/footer'); 
        }
       
        public function createAd($VIN, $troubleCodes, $datos,$idUser, $carId)
        {
            /*
                
             * 
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
        }
        
        
        
        
       
        
            
    
} 