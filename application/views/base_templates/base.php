<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
      <link href="<?php echo base_url('bootstrap/css/bootstrap.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

    <title>Jumbotron Template for Bootstrap</title>

  </head>

  <body>

  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url() ?>">GameWEB</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php echo ($this->uri->rsegment('2') == 'index') ? 'class="active"' : ''; ?>><a href="<?php echo base_url('games/add') ?>">LINK1<span class="sr-only">(current)</span></a></li>
        <li><a href="<?php echo base_url('games/add') ?>">LINK1<span class="sr-only">(current)</span></a></li>
        <li><a href="<?php echo base_url('games/add') ?>">LINK1<span class="sr-only">(current)</span></a></li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
       <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <form class="navbar-form navbar-right">
      <?php 
       if ($this->session->userdata('id') !== NULL) {
          echo '
           <div class="form-group">
           
           <div class="dropdown">
          <a href="#" class="dropdown-toggle btn btn-danger" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$this->session->userdata('first_name').' <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="' . base_url('account/detail') . '">Profil<span class="sr-only">(current)</span></a></li>
            <li><a href="' . base_url('games/add') . '">Dodawanie gier<span class="sr-only">(current)</span></a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href=" '.base_url().'account/logout">Logout</a></li>
          </ul>
        </div>
            
           </div>';
       } else {
          echo '
          <a class="btn btn-success" href=" '.base_url().'account/login">Sign In</a>
          <a class="btn btn-warning" href=" '.base_url().'account/register">Sign Up</a>
          ';
         }
        ?>
      </form>
        
           
          
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<?php 

  $dane = $this->session->all_userdata();
  echo '<pre>';
  print_r($dane);
  echo '</pre>';
  echo base_url();


?>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <div id="contents"><?= $contents ?></div>
      </div>
    </div>

    <div class="container">
    

      <hr>

      <footer>
        <p>&copy; 2015 Company, Inc.</p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?php echo base_url('bootstrap/js/bootstrap.min.js'); ?>"></script>
  </body>
</html>
