<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_controller extends CI_Controller {

public $restricted = array(
                'Account'=> array('logout')
            );

function __construct()
{
    parent::__construct();
    $CI = & get_instance();
    $CI->load->library('session');
    $CI->load->helper('url');

    foreach($this->restricted as $innerRow => $classname){
	    	if($this->is_in_uri($innerRow)){
		    	foreach($classname as $innerRow => $function){
		    		if($this->is_in_uri($function)){
		    			if ( $this->session->userdata('id') === NULL)
		    				redirect('account/login');
		    		}
		    	}
	    	}
  	}

}

private function is_in_uri($segment)
{
	$segment = strtolower($segment);
	$segments_amount = $this->uri->total_segments();
	for( $i= 0 ; $i <= $segments_amount ; $i++ ){
		if($segment == strtolower($this->uri->segment($i)))
			return true;
	}
	return false;
}



}
?>