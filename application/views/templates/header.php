<?php
if (isset($_SESSION['id'])) {
    if ($_SESSION['user_type'] == 'student')
        header('location:student/');
    else if ($_SESSION['user_type'] == 'caretaker')
        header('location:caretaker/');
    if ($_SESSION['user_type'] == 'warden')
        header('location:warden/');
}
?>

<!DOCTYPE html>
<html>
        <head>
                <title><?php echo 'Hostel-J '; if(isset($title)) echo "| $title"; ?></title>               
				<script src="../../../public/js/jquery.min.js"></script>
                <script src="../../../public/js/jquery.dropotron.min.js"></script>
                <script src="../../../public/js/skel.min.js"></script>
                <script src="../../../public/js/skel-layers.min.js"></script>
                <script src="../../../public/js/init.js"></script>
                <link rel="stylesheet" href="../../../public/css/skel.css" />
                <link rel="stylesheet" href="../../../public/css/style.css" />
                <link rel="stylesheet" href="../../../public/css/style-wide.css" />
        </head>
<body>
<header id="header" class="<?php if(isset($title)){ if($title=='Home') echo "alt"; else echo "skel-layers-fixed";}?>">
            <h1 style="font-size:30px "><a href="">HOSTEL-J</a><a href="http://www.thapar.edu" target="_blank" style="font-weight:100"> Thapar University</a></h1>
            <nav id="nav">      <h1 style="font-size:30px "><a href="">HOSTEL-J</a><a href="login.php">Sign In</a><a href="http://www.thapar.edu" target="_blank" style="font-weight:100"> Thapar University</a></h1>

            </nav>
</header>