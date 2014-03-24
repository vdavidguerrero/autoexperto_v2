<?php

class user_model extends CI_Model {

    public function __construct()
    {
    	parent::__construct();
	$this->load->database(); 
    }   

    
    /**
     * Insert an user to the DataBase from an user Object.
     * 
     * @param userObject the user we want to insert
     * @return int added row 
     * @author Vincent Guerrero <v.davidguerrero@gmail.com>
     * @todo - Check 
     * @see 
     */
    public function insertUser($userObject)
    {
        $dominicanRepublicCityObject = $this->getDominicanRepublicCity($userObject->Dominican_Republic_City);
        $userObject->Dominican_Republic_Cities_ID = $dominicanRepublicCityObject->ID;
        unset($userObject->Dominican_Republic_City);
        $this->db->insert("users",$userObject);
    }
    
    /**
     * Get an user object by its RNC or Cedula.
     * 
     * @param int rnc o cedula
     * @return userObject
     * @author Vincent Guerrero <v.davidguerrero@gmail.com>
     * @todo - Check 
     * @see 
     */
    public function getUser($RNC)
    {
        //returns the 
        $this->db->select("users.*,dominican_republic_cities.Dominican_Republic_City ",false);
        $this->db->from("users");
        $this->db->join('dominican_republic_cities'   , 'users.Dominican_Republic_Cities_ID = dominican_republic_cities.ID','inner');
        $this->db->where('users.ID',$RNC );
        $query = $this->db->get();
        $userObject = $query->row();
        
       
        return $userObject;
        
    }
    
    /**
     * check if the password and username are valids
     * 
     * @param int rnc or cedulo from the user
     * @param string encrypted string with the password
     * @return $adObject
     * @author Vincent Guerrero <v.davidguerrero@gmail.com>
     * @todo - Check 
     * @see 
     */
    public function checkUserLogin($RNC,$password)
    {
         $this->db->select("users.*,dominican_republic_cities.Dominican_Republic_City ",false);
        $this->db->from("users");
        $this->db->join('dominican_republic_cities'   , 'users.Dominican_Republic_Cities_ID = dominican_republic_cities.ID','inner');
        $this->db->where('users.ID',$RNC);
        $this->db->where('users.Password',$password );
        $query = $this->db->get();
        $userObject = $query->row();
        
        if ($query->num_rows() > 0)
        {
             return $userObject;
        }
        else 
        {
            return false;
        }
    }
    
    /**
     * get all the Dominican Repblic Cities from the database
     * 
     * @param rows the table returned from the DB
     * @return $adObject
     * @author Vincent Guerrero <v.davidguerrero@gmail.com>
     * @todo - Check 
     * @see 
     */
    public function getDominicanRepublicCities() 
    {  
      $query = $this->db->get("dominican_republic_cities");
      return $query->result();
    }
    
     /**
     * Return the Dominican Republic City row by its name.
     * 
     * @param string City name
     * @return $CityObject row from the db 
     * @author Vincent Guerrero <v.davidguerrero@gmail.com>
     * @todo - Check 
     * @see 
     */
     public function getDominicanRepublicCity($dominicanRepublicCity) 
    {  
      $this->db->select("*");
      $this->db->from("dominican_republic_cities");
      $this->db->where("Dominican_Republic_City", $dominicanRepublicCity);
      $query = $this->db->get();
      return $query->row();
    }
}