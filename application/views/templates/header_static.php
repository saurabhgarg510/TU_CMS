<!DOCTYPE html>
<html>
    <head>
        <title><?php echo 'Hostel-J ';
if (isset($title))
    echo "| $title";
?></title>               
        <script src="<?php echo base_url(); ?>/public/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>/public/js/jquery.dropotron.min.js"></script>
        <script src="<?php echo base_url(); ?>/public/js/skel.min.js"></script>
        <script src="<?php echo base_url(); ?>/public/js/skel-layers.min.js"></script>
        <script src="<?php echo base_url(); ?>/public/js/init.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>/public/css/skel.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>/public/css/style.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>/public/css/style-wide.css" />
        <style>
            html, body {
                max-width: 100%;
                overflow-x: hidden;
            }
            #fadeandscale {
                transform: scale(0.8);
            }
            .popup_visible #fadeandscale {
                transform: scale(1);
            }
        </style>
    </head>
    <body>
        <header id="header" class="skel-layers-fixed">
            <h1 style="font-size:30px "><a href="">HOSTEL-J</a><a href="http://www.thapar.edu" target="_blank" style="font-weight:100"> Thapar University</a></h1>
            <nav id="nav">      <h1 style="font-size:30px "><a href="">HOSTEL-J</a><a href="login.php">Sign In</a><a href="http://www.thapar.edu" target="_blank" style="font-weight:100"> Thapar University</a></h1>

            </nav>
        </header>