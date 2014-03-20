<?php
    
class car_model extends CI_Model {
    
    public function __construct()
    {
    	parent::__construct();
	$this->load->database(); 
    }
     /**
      * Get a car by its VIN
      * 
      * @param integer $carVIN - VIN of the the car/
      * @return a car Objetc from the database - Array with all the found rows
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo - Check 
      * @see getCarByValues
      */
          
     public function getCar($carVIN)
     {
        $this->db->select('*, Country as Manufacturer_Country');
        $this->db->from('unique_models');
        $this->db->join('unique_cars', 'unique_models.ID = unique_cars.Unique_Model','inner');
        $this->db->join('car_models', 'unique_models.Car_Model_ID = car_models.ID' );
        $this->db->join('car_brands','car_models.Brand_ID = car_brands.ID' );
        $this->db->join('manufacturer_countries', 'unique_cars.Manufacturer_Country_ID = manufacturer_countries.ID');
        $this->db->where('unique_cars.VIN'    ,$carVIN);
        $query = $this->db->get();
        return $query->row();   
     }
         
     /**
      * insert an entire car to the data base.
      * 
      * @param CarObject from car_controller class.
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo - Check.
      */
          
     public function insertCar($carObject)
     {
         $VIN = $carObject->VIN; 
         $manufacturerCountry = $carObject->Manufacturer_Country;
             
          if(!$this->getUniqueModel($carObject->Trim, $carObject->Model,$carObject->Year))
            {
                 if(!$this->getModel($carObject->Model))
                 {
                     if(!$this->getBrand($carObject->Brand))
                     {
                         $this->instertCarBrand($carObject->Brand); 
                     }
                    $this->instertCarModel($carObject->Model, $carObject->Brand);
                 }  
                unset($carObject->Brand);
                unset($carObject->Manufacturer_Country);
                unset($carObject->Model);        
                unset($carObject->VIN);  
                $this->insertUniqueModel($carObject);             
            }
            if(!$this->getManufacturerCountry($carObject->Manufacturer_Country))
            {
                $this->car_model->insertManufacturerCountry($carObject->Manufacturer_Country); 
            }
            $this->insertUniqueCar($VIN,$manufacturerCountry,$carObject->Trim, $carObject->Year, $carObject->Model); 
     }
         
    /**
      * Get a unique car object.
      * 
      * @param integer - unique car VIN.
      * @return rowObject -  with al the car information 
      * @author Vincent Guerrero <v.davidguerrero@gmail.com>
      * @todo - change de select * for select (car_controller->objects).
      */
         
    public function getUniqueCar($carVIN)
    {
        $this->db->select('*');
        $this->db->from('unique_cars');
        $this->db->where('VIN',$carVIN);
        $query = $this->db->get();
        return $query->row();   
    }
        
     public function insertUniqueCar($VIN, $Manufacturer_Country, $trim, $year, $model)
    {
        $manufacturerCountryRow = $this->getManufacturerCountry($Manufacturer_Country);
        $uniqueModelRow = $this->getUniqueModel($trim, $model,$year);
        $insertObject = (object) array(
                                'VIN'                       => $VIN,
                                'Manufacturer_Country_ID'   => $manufacturerCountryRow->ID,
                                'Date'                      => date("Y-m-d H:i:s"),
                                'Unique_Model'              => $uniqueModelRow->ID
                            );
        $this->db->insert('unique_cars',$insertObject);
    }
        
    /************************************************************************
        
     * Unique_Model; Represents an Unique Model by its Year,Model and Trim 
         
     ************************************************************************/
         
         
     public function getUniqueModel($trim, $model,  $year)
    {
        $this->db->select('*');
        $this->db->from('car_models');
        $this->db->join('unique_models', 'unique_models.Car_Model_ID = car_models.ID','inner');  
        $this->db->where('unique_models.Year'    ,$year);
        $this->db->where('unique_models.Trim'    ,$trim);
        $this->db->where('car_models.Model'      ,$model);
            
        $query = $this->db->get();
        return $query->row();   
    }
        
    public function insertUniqueModel($uniqueModelObject)
    { 
        $modelObject =  $this->getModelByModelName($uniqueModelObject->Model);
        $uniqueModelObject->Car_Model_ID = $modelObject->ID;
        $this->db->insert('unique_models',$uniqueModelObject); 
    }
        
        
        
        
    /************************************************************************
        
     * Car_Brand; Represents 1 of all the registred car brands.
         
     ************************************************************************/    
         
    public function getCarBrands() 
    {  
      $query = $this->db->get("car_brands");
      return $query->result();
    }
        
     public function getBrand($brandName)
    {
        $searchObject =  array("Brand" =>$brandName);
        $this->db->select('*');
        $this->db->from('car_brands');
        $this->db->where($searchObject);
        $query = $this->db->get();
        return $query->row();
    }
        
     public function instertCarBrand($brand)
    {
        $this->db->insert('car_brands',$brand); 
    }
        
    /************************************************************************
        
     * Car_Model; Represents 1 of all the registred car models. Every Model must hava a brand
         
     ************************************************************************/
         
         
     public function getModelsByBrand($brand)
    {
        $this->db->select('*');
        $this->db->from('car_models');
        $this->db->join('car_brands', "car_models.Brand_ID = car_brands.ID");
        $this->db->where('car_brands.Brand',$brand);
        $query = $this->db->get();
        return $query->result();
    }
        
    public function getModel($modelName)
    {
        $this->db->select('*');
        $this->db->from('car_models');
        $this->db->where('Model',$modelName);
        $query = $this->db->get();
        return $query->row();   
    }
        
      public function instertCarModel($Model, $brand)
    {
        $BrandRow =  $this->getBrand($brand);  
        $instertObject = (object) array(
                                "Model"    => $Model, 
                                "Brand_ID" => $BrandRow->ID
                         );
                             
        $this->db->insert('car_models',$instertObject); 
    }
        
    /************************************************************************
        
     * Car_Part; Represents 1 of many parts that a car has. 
         
     ************************************************************************/
         
    public function instertCarPart($carPartData)
    {
        $this->db->insert('car_parts',$carPartData); 
    }
        
    /***********************************************************************
     *     
     * Car_manufacturer_Country; Represents 1 of many country where cars has been built. 
     * 
     ***********************************************************************/
         
         
    public function insertManufacturerCountry($manufacturerCountry)
    {
        $instertObject = (object) array("Country" => $manufacturerCountry);
            
        $this->db->insert('manufacturer_countries',$instertObject);
            
    }
    public function getManufacturerCountry($manufacturerCountry)
    {
        $searchArray = array("Country" => $manufacturerCountry);
            
        $this->db->select('*');
        $this->db->from('manufacturer_countries');
        $this->db->where($searchArray);
        $query = $this->db->get();
        return $query->row();
    }
        
    /************************************************************************
        
     * Car_Years; Has all the aavailable 
         
     ************************************************************************/
         
    public function getCarYears()
    {
        for ($i = 1990; $i<= date("Y"); $i++)
        {
            $years[$i] = $i; 
        }
            return $years;
    }
        
        
        
        
}