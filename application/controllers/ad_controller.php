<?php if (!defined('BASEPATH')) die();


class Ad_controller extends Main_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->model("ad_model");
            $this->load->library('form_validation');
            $this->load->helper('form');
            $this->load->library('session');

            //$this->load->helper('url');
            // Hacer el login
            // Hacer la validación de campos.
        }  
    
        function index ()
	{
            //$dataPass = array();
            $dataPass["brands"] = $this->ad_model->getAdBrands();
            $dataPass["cities"] = $this->ad_model->getAdcities();  
            for ($i = 1990; $i<2015; $i++)
                        $years[$i] = $i;    
            $dataPass["years"]  = $years;
            $this->load->view('include/header'); 
            $this->load->view('ad/search_ad_view',$dataPass);  
            $this->load->view('include/footer');   
	}
        
        function getModelsByBrand($ID)
        {
              
            $models = $this->ad_model->getModelsByBrand($ID); 
             foreach ($models as $model)
                  {
                             echo "<option value='".$brand->ID."' >".$brand->Brand."</option>";
                  }    
            //$this->load->view('include/header'); 
            //$this->load->view('user/succesful_user_view',$dataPass);  
           // $this->load->view('include/footer'); 
        }
       
        
            
    
} 