<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_controller {
        
        public $status; 
        public $roles;
    
        function __construct(){
            parent::__construct();
            $this->load->model('User_model', 'user_model', TRUE);
            $this->load->library('form_validation');    
            $this->form_validation->set_error_delimiters('<div class="error alert alert-danger">', '</div>');
            $this->status = $this->config->item('status'); 
            $this->roles = $this->config->item('roles');
            $this->load->helper('url');
            $this->load->library('session');
            $this->load->library('email');
        }   

        public function register()
                {
                     
                    $this->form_validation->set_rules('firstname', 'First Name', 'required');
                    $this->form_validation->set_rules('lastname', 'Last Name', 'required');    
                    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');    
                               
                    if ($this->form_validation->run() == FALSE) {   
                        $this->template->load('base_templates/base', 'account/register');
                    }else{                
                        if($this->user_model->isDuplicate($this->input->post('email'))){
                            $this->session->set_flashdata('flash_message', 'User email already exists');
                            redirect(site_url().'account/register');
                        }else{
                            
                            $clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
                            $id = $this->user_model->insertUser($clean); 
                            $token = $this->user_model->insertToken($id);                                        
                            
                            $qstring = base64_encode($token);                    
                            $url = site_url() . 'account/complete/token/' . $qstring;
                            $link = '<a href="' . $url . '">CLICK HERE BITCH</a>'; 
                                       
                            $subject = 'Account activation';                  
                            $message = '<strong>You have signed up with our website</strong><br>';
                            $message .= $link;     

                            $this->sendmail($subject, $message, $this->input->post('email'));   

                           
                             $data = array(
                             'message' => ' Link aktywacyjny został wysłany na '.$this->input->post('email')
                             );                          

                            $this->template->load('base_templates/base', 'account/mail_sent' , $data);    
                            // exit;
                             
                            
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
                 $this->template->load('base_templates/base', 'account/complete', $data);
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
                    redirect(site_url().'account/complete');
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

                 $this->template->load('base_templates/base','account/login');

            }else{
                
                $post = $this->input->post();  
                $clean = $this->security->xss_clean($post);
                
                $userInfo = $this->user_model->checkLogin($clean);
                
                if(!$userInfo){
                    $this->session->set_flashdata('flash_message', 'Wrong login or password');
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
                $this->template->load('base_templates/base','account/forgot');
            }else{
                $email = $this->input->post('email');  
                $clean = $this->security->xss_clean($email);
                $userInfo = $this->user_model->getUserInfoByEmail($clean);
                
                if(!$userInfo){
                    $this->session->set_flashdata('flash_message', 'We cant find your email address');
                    redirect(site_url().'account/forgot');
                }   
                
                if($userInfo->status != $this->status[1]){ //if status is not approved
                    $this->session->set_flashdata('flash_message', 'Your account is not in approved status');
                    redirect(site_url().'account/forgot');
                }
                
                //build token 
                
                $token = $this->user_model->insertToken($userInfo->id);                    
                $qstring = base64_encode($token);                    
                $url = site_url() . 'account/reset_password/token/' . $qstring;
                $link = '<a href="' . $url . '">' . $url . '</a>'; 
                
                $subject = 'Password reset';
                $message = '';                     
                $message .= '<strong>A password reset has been requested for this email account</strong><br>';
                $message .= '<strong>Please click:</strong> ' . $link;   
                $this->sendmail($subject, $message, $email)    ;
                $data = array(
                 'message' => ' Hasło zostało wysłane na '.$this->input->post('email')
                 );                          

                 $this->template->load('base_templates/base', 'account/mail_sent' , $data);       
                
                
                
            }
            
        }

        public function reset_password()
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
               
                $this->template->load('base_templates/base','account/reset_password', $data);
            }else{
                                
                $this->load->library('password');                 
                $post = $this->input->post(NULL, TRUE);                
                $cleanPost = $this->security->xss_clean($post);                
                $hashed = $this->password->create_hash($cleanPost['password']);                
                $cleanPost['password'] = $hashed;
                unset($cleanPost['passconf']);                
                if(!$this->user_model->updatePassword($cleanPost)){
                    $this->session->set_flashdata('flash_message', 'There was a problem updating your password');
                }else{
                    $this->session->set_flashdata('flash_message', 'Your password has been updated. You may now login');
                }
                redirect(site_url().'account/login');                
            }
        }

        

          public function sendmail($subject, $message_, $email ) { 
                $this->load->library('email');

                $config['protocol'] = "smtp";
                // does not have to be gmail
                $config['smtp_host'] = 'ssl://smtp.gmail.com'; 
                $config['smtp_port'] = '465';
                $config['smtp_user'] = 'aparacikk@gmail.com';
                $config['smtp_pass'] = 'Glejt$90';
                $config['mailtype'] = 'html';
                $config['charset'] = 'utf-8';
                $config['newline'] = "\r\n";
                $config['wordwrap'] = TRUE;

                $this->email->initialize($config);

                $this->email->from('admin@gmail.com', 'admin');
                $this->email->to($email);
                $this->email->subject($subject.':');

                // $message = "Thanks for signing up! Your account has been created, you can login with your credentials after you have activated your account by pressing the url below. Please click this link to activate your account:<a href='.$token.>Click Here</a>";

                $message = $message_ ;
                

                $this->email->message($message);

                $this->email->send();

                echo $this->email->print_debugger();
          } 

          public function logout()
            {
                 $this->session->sess_destroy();
                   redirect(site_url().'account/login'); 
            }



}

?>