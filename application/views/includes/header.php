<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Lourdes College Student Attendance</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">

     <!-- Open Iconic Bootstrap -->
     <link rel="stylesheet" href="<?php echo base_url();?>assets/css/open-iconic-bootstrap.css">

     <!-- Custom Styles -->
     <link rel="stylesheet" href="<?php echo base_url();?>assets/css/global.css">

  </head>
  <body>
    

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#"> <img src="<?php echo base_url();?>/assets/img/logo-web.svg" width="30" height="30" class="d-inline-block align-top" alt=""> LCSA App Admin</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto">

            <?php if($this->session->userdata('logged_in')): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url();?>"><span class="oi oi-home"></span> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url();?>students"><span class="oi oi-people"></span> Students</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="<?php echo base_url();?>attendance/?program=all&date=<?php echo Date('Y-m-d'); ?>"><span class="oi oi-list"></span> Attendance list</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url();?>checkers"><span class="oi oi-circle-check"></span> Checkers</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="oi oi-person"></span> <?php echo $this->session->userdata('checker_username'); ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item"  href="<?php echo base_url();?>logout"><span class="oi oi-account-logout"></span> Logout</a>
                    </div>
                </li>

            <?php endif; ?>
          
           

        </ul>
    
    </div>
    </nav>

    
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo base_url();?>/assets/js/jquery-3.2.1.slim.min.js" ></script>
    <script src="<?php echo base_url();?>/assets/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>/assets/js/bootstrap.min.js"></script>


  </body>
</html>