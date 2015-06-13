<!DOCTYPE html>
<html>
    <head>
        <title><?php echo 'Hostel-J ';
if (isset($title)) echo "| $title"; ?></title>               
        <script src="<?php echo base_url(); ?>/public/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>/public/js/jquery.dropotron.min.js"></script>
        <script src="<?php echo base_url(); ?>/public/js/skel.min.js"></script>
        <script src="<?php echo base_url(); ?>/public/js/skel-layers.min.js"></script>
        <script src="<?php echo base_url(); ?>/public/js/init.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>/public/css/skel.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>/public/css/style.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>/public/css/style-wide.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>/public/css/strength.css" />
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
            <h1 style="font-size:30px"><a href="">HOSTEL-J</a><a href="http://www.thapar.edu" target="_blank" style="font-weight:100"> Thapar University</a></h1>
            <nav id="nav">
                <ul>
                    <li><?php
                        if (!isset($_SESSION['id']))
                            header('location:home');
                        ?>
                        <a href="" class="icon fa-angle-down"><?php echo $_SESSION['name']; ?></a>
                        <ul><?php if ($_SESSION['user_type'] == 'student') { ?>
                                <li><a href="<?php echo base_url(); ?>index.php/student/home/">New Complaints</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/student/status/">View Status</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/student/profile/">Account Settings</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/complaint/logout/">Logout</a></li>
                                <?php
                            } else if ($_SESSION['user_type'] == 'caretaker') {
                                ?>
                                <li><a href="<?php echo base_url(); ?>index.php/admin/home/">Complaints</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/admin/profile/">Account Settings</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/complaint/logout/">Logout</a></li>
<?php } else if ($_SESSION['user_type'] == 'warden') { ?>
                                <li><a href="<?php echo base_url(); ?>index.php/admin/home/">Complaints</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/admin/add_category/">Add Complaint Type</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/admin/del_category/">Delete Complaint Type</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/admin/clean_database/">Clear Database</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/admin/profile/">Account Settings</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/complaint/logout/">Logout</a></li>
<?php } ?>

                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
