<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
        
        public $status; 
        public $roles;
    
        function __construct(){
            parent::__construct();
            $this->load->model('User_model', 'user_model', TRUE);
            $this->load->library('form_validation');    
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->status = $this->config->item('status'); 
            $this->roles = $this->config->item('roles');
            $this->load->helper('url');
            $this->load->library('session');
        }   

        public function register()
                {
                     
                    $this->form_validation->set_rules('firstname', 'First Name', 'required');
                    $this->form_validation->set_rules('lastname', 'Last Name', 'required');    
                    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');    
                               
                    if ($this->form_validation->run() == FALSE) {   
                        $this->template->load('base_templates/base', 'register');
                    }else{                
                        if($this->user_model->isDuplicate($this->input->post('email'))){
                            $this->session->set_flashdata('flash_message', 'User email already exists');
                            redirect(site_url().'account/login');
                        }else{
                            
                            $clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
                            $id = $this->user_model->insertUser($clean); 
                            $token = $this->user_model->insertToken($id);                                        
                            
                            $qstring = base64_encode($token);                    
                            $url = site_url() . 'account/complete/token/' . $qstring;
                            $link = '<a href="' . $url . '">' . $url . '</a>'; 
                                       
                            $message = '';                     
                            $message .= '<strong>You have signed up with our website</strong><br>';
                            $message .= '<strong>Please click:</strong> ' . $link;                          
         
                            echo $message; //send this in email
                            exit;
                             
                            
                        };              
                    }
                }

        public function complete()
        {                                   
            $token = base64_decode($this->uri->segment(4));       
            $cleanToken = $this->security->xss_clean($token);
            
            $user_info = $this->user_model->isTokenValid($cleanToken); //either false or array();           
            
            if(!$user_info){
                $this->session->set_flashdata('flash_message', 'Token is invalid or expired');
                redirect(site_url().'account/login');
            }            
            $data = array(
                'firstName'=> $user_info->first_name, 
                'email'=>$user_info->email, 
                'user_id'=>$user_info->id, 
                'token'=>base64_encode($token)
            );
           
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');              
            
            if ($this->form_validation->run() == FALSE) {   
                 $this->template->load('base_templates/base', 'complete', $data);
            }else{
                
                $this->load->library('password');                 
                $post = $this->input->post(NULL, TRUE);
                
                $cleanPost = $this->security->xss_clean($post);
                
                $hashed = $this->password->create_hash($cleanPost['password']);                
                $cleanPost['password'] = $hashed;
                unset($cleanPost['passconf']);
                $userInfo = $this->user_model->updateUserInfo($cleanPost);
                
                if(!$userInfo){
                    $this->session->set_flashdata('flash_message', 'There was a problem updating your record');
                    redirect(site_url().'account/login');
                }
                
                unset($userInfo->password);
                
                foreach($userInfo as $key=>$val){
                    $this->session->set_userdata($key, $val);
                }
                redirect(site_url().'');
                
            }
        }


        // LOGIN FORM-------------------------------------

        public function login()
        {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');    
            $this->form_validation->set_rules('password', 'Password', 'required'); 
            
            if($this->form_validation->run() == FALSE) {
                 $this->template->load('base_templates/base','login');

            }else{
                
                $post = $this->input->post();  
                $clean = $this->security->xss_clean($post);
                
                $userInfo = $this->user_model->checkLogin($clean);
                
                if(!$userInfo){
                    $this->session->set_flashdata('flash_message', 'The login was unsucessful');
                    redirect(site_url().'account/login');
                }                
                foreach($userInfo as $key=>$val){
                    $this->session->set_userdata($key, $val);
                }
                redirect(site_url().'');
            }
            
        }

        public function forgot()
        {
            
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
            
            if($this->form_validation->run() == FALSE) {
                $this->template->load('base_templates/base','forgot');
            }else{
                $email = $this->input->post('email');  
                $clean = $this->security->xss_clean($email);
                $userInfo = $this->user_model->getUserInfoByEmail($clean);
                
                if(!$userInfo){
                    $this->session->set_flashdata('flash_message', 'We cant find your email address');
                    redirect(site_url().'account/login');
                }   
                
                if($userInfo->status != $this->status[1]){ //if status is not approved
                    $this->session->set_flashdata('flash_message', 'Your account is not in approved status');
                    redirect(site_url().'account/login');
                }
                
                //build token 
                
                $token = $this->user_model->insertToken($userInfo->id);                    
                $qstring = base64_encode($token);                    
                $url = site_url() . 'account/reset_password/token/' . $qstring;
                $link = '<a href="' . $url . '">' . $url . '</a>'; 
                
                $message = '';                     
                $message .= '<strong>A password reset has been requested for this email account</strong><br>';
                $message .= '<strong>Please click:</strong> ' . $link;             
                echo $message; //send this through mail
                exit;
                
            }
            
        }


}

?>