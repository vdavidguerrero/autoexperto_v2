<?php

class user_model extends CI_Model {

    public function __construct()
    {
    	parent::__construct();
	$this->load->database(); 
    }   

    public function insertUser($userData)
    {
        //Insert one user in the DataBase
        $this->db->insert('users',$userData); 
    }
    
    public function deleteUser($RNC)
    {
        // delete a user from the daba base bu its RNC or Cedula.
        $this->db->delete('users', array('ID' => $RNC)); 
    }
    
    public function editUser($data)
    {
        
    }
    
    public function getUserByRnc($RNC)
    {
        //returns the 
        $this->db->select("users.*,dominican_republic_cities.City ",false);
        $this->db->from("users");
        $this->db->join('dominican_republic_cities'   , 'users.DR_City_ID = dominican_republic_cities.ID','inner');
        $this->db->where('users.ID',$RNC );
        $query = $this->db->get();
        $userObject = $query->row();
        
        if ($query->num_rows() > 0)
        {
           
             return $userObject;
        }
        else return false;
        
    }
    
    public function checkUserLogin($rnc_cedula,$password)
    {
        
         $query = $this->db->get_where('users', array('ID'=> $rnc_cedula,'password' => $password));
         return $query->row();
    }
    
    public function getUserCities() 
    {  
      $query = $this->db->get("dominican_republic_cities");
      return $query->result();
    }
}