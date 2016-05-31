<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
            parent::__construct();
            $this->load->library('session');
        } 


	public function index()
	{
		$this->load->helper('url');
		$data = $this->session->all_userdata();
		$this->template->load('base_templates/base', 'index', $data);
	}

	public function elo()
	{
		echo 'ebac';
	}
}
