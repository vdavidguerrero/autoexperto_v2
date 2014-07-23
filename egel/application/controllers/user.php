<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {


	public function __construct()
        {
            parent::__construct();
            $this->load->model("user_model");
            $this->load->library('form_validation');
            $this->load->helper('form');
            $this->load->library('session');
            $this->load->helper('url');  
        } 

	public function index()
	{
        $this->loadView('user/search');
	}

	public function showUserInfractions()
	{
		$cedula = $this->input->post("cedula");
	    $sess_array = array( 'cedula' => $cedula);
        $this->session->set_userdata('sessionInfo', $sess_array);

		$infractions = $this->user_model->getUserInfractions($cedula);
		$dataPass["infractions"] = $infractions;
		$this->loadView('userInfractions',$datapass);

	}

	public function loadView($view, $dataPass = "pepe")
	{
		$this->load->view('include/header');
		$this->load->view($view,$dataPass);
		$this->load->view('include/footer');
	}

}