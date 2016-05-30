<?php
  if($this->session->flashdata('flash_message') !== NULL){  
  $wrong_email =  '<div class="alert alert-danger">'.$this->session->flashdata('flash_message').'</div>';
  }else
  $wrong_email = '';
?>

<div class="col-lg-4 col-lg-offset-4">
    <h2>Forgot Password</h2>
    <p>Please enter your email address and we'll send you instructions on how to reset your password</p>
    <?php $fattr = array('class' => 'form-signin');
         echo form_open(site_url().'account/forgot/', $fattr); 
          
         ?>
    <div class="form-group">
      <?php echo form_input(array(
          'name'=>'email', 
          'id'=> 'email', 
          'placeholder'=>'Email', 
          'class'=>'form-control', 
          'value'=> set_value('email'))); ?>
      <?php echo form_error('email') ;
      echo $wrong_email;
      ?>
    </div>
    <?php echo form_submit(array('value'=>'Submit', 'class'=>'btn btn-lg btn-primary btn-block')); ?>
    <?php echo form_close(); ?>    
</div>