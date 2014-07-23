<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class User_model extends CI_Model {
    
    
    public function __construct()
    {
    	parent::__construct();
	    $this->load->database(); 
        
    }


    public function getUserInfractions($cedula)
    {


	    $this->db->select('Usuarios.Nombre, Usuarios.Apellido, Usuarios.Cedula,
	                                    Vehiculo.Tipo, Vehiculo.Marca, Vehiculo.Modelo, 
	                                    Vehiculo.No_Placa, Infraccion.Fecha, Infraccion.Hora, 
	                                    Infraccion.Lugar_Hecho, Razon_Infraccion.Tipo_Infraccion,Razon_Infraccion.Precio, 
	                                    Amet.NombreAmet, Amet.ApellidoAmet');
	    $this->db->from('Infraccion');
	    $this->db->join('Usuarios '          ,'Infraccion.ID_Usuario = Usuarios.ID'); 
	    $this->db->join('Razon_Infraccion '  ,'Infraccion.ID_Razon = Razon_Infraccion.ID'); 
		$this->db->join('Vehiculo '          ,'Infraccion.ID_Vehiculo = Vehiculo.ID'); 
		$this->db->join('Amet '				 ,'Infraccion.ID_Amet = Amet.ID'); 
		$this->db->where('Usuarios.Cedula',$cedula);
		$query = $this->db->get();
	    return $query->result();

    }

    public function checkCedula($cedula)
    {
        $this->db->select('Cedula');
        $this->db->from("Usuarios");
        $this->db->where('Cedula',$cedula);
        $query = $this->db->get();
        $userObject = $query->row();
        return $userObject;

    }
 }

