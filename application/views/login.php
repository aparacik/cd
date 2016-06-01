<?php
  if($this->session->flashdata('flash_message') !== NULL){  
  $wrong_pass =  '<div class="alert alert-danger">'.$this->session->flashdata('flash_message').'</div>';
  }else
  $wrong_pass = '';
?>

<div class="col-lg-4 col-lg-offset-4">
    <h2>Please login</h2>
    <?php $fattr = array('class' => 'form-signin');
         echo form_open(site_url().'account/login/', $fattr); ?> 

    <div class="form-group">
      <?php echo form_input(array(
          'name'=>'email', 
          'id'=> 'email', 
          'placeholder'=>'Email', 
          'class'=>'form-control', 
          'value'=> set_value('email'))); ?>
      <?php echo form_error('email') ?>
    </div>

    <div class="form-group">
      <?php echo form_password(array(
          'name'=>'password', 
          'id'=> 'password', 
          'placeholder'=>'Password', 
          'class'=>'form-control', 
          'value'=> set_value('password'))); ?>
      <?php echo form_error('password') ;
          echo $wrong_pass;
      ?>
    </div>
    
    <?php echo form_submit(array('value'=>'Let me in!', 'class'=>'btn btn-lg btn-primary btn-block')); ?>
    <?php echo form_close(); ?>
    <p>Don't have an account? Click to <a href="<?php echo site_url();?>account/register">Register</a></p>
    <p>Click <a href="<?php echo site_url();?>account/forgot">here</a> if you forgot your password.</p>
</div>