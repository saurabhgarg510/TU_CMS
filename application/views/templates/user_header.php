<!DOCTYPE html>
<html>
        <head>
                <title><?php echo 'Hostel-J '; if(isset($title)) echo "| $title"; ?></title>               
				<script src="../../../public/js/jquery.min.js"></script>
                <script src="../../../public/js/jquery.dropotron.min.js"></script>
                <script src="../../../public/js/skel.min.js"></script>
                <script src="../../../public/js/skel-layers.min.js"></script>
                <script src="../../../public/js/init.js"></script>
                <script src="../../../public/js/jquery.popupoverlay.js"></script>
                <script src="../../../public/js/jquery-2.1.1.js"></script>
                <link rel="stylesheet" href="../../../public/css/skel.css" />
                <link rel="stylesheet" href="../../../public/css/style.css" />
                <link rel="stylesheet" href="../../../public/css/style-wide.css" />
                <link rel="stylesheet" href="../../../public/css/strength.css" />
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
                    <li><a href="http://localhost/ci/index.php/student/home/">New Complaints</a></li>
                    <li><a href="http://localhost/ci/index.php/student/status/">View Status</a></li>
                    <li><a href="http://localhost/ci/index.php/student/profile/">Account Settings</a></li>
                    <li><a href="http://localhost/ci/index.php/complaint/logout/">Logout</a></li>
                    <?php
                    } else if ($_SESSION['user_type'] == 'caretaker') {
                        ?>
                        <li><a href="http://localhost/ci/index.php/admin/home/">Complaints</a></li>
                        <li><a href="http://localhost/ci/index.php/admin/profile/">Account Settings</a></li>
                        <li><a href="http://localhost/ci/index.php/complaint/logout/">Logout</a></li>
					<?php } else if ($_SESSION['user_type'] == 'warden') { ?>
                        <li><a href="http://localhost/ci/index.php/admin/home/">Complaints</a></li>
                        <li><a href="http://localhost/ci/index.php/admin/add_category/">Add Complaint Type</a></li>
                        <li><a href="http://localhost/ci/index.php/admin/del_category/">Delete Complaint Type</a></li>
                        <li><a href="http://localhost/ci/index.php/admin/clean_database/">Clear Database</a></li>
                        <li><a href="http://localhost/ci/index.php/admin/profile/">Account Settings</a></li>
                        <li><a href="http://localhost/ci/index.php/complaint/logout/">Logout</a></li>
					<?php } ?>

                </ul>
            </li>
        </ul>
    </nav>
</header>
