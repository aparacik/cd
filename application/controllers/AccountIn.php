<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AccountIn extends MY_controller {

	function __construct(){
            parent::__construct();
            $this->load->library('session');
        } 


	public function logout()
            {
                 $this->session->sess_destroy();
                   redirect(site_url().'account/login'); 
            }
}
