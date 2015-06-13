<?php

$user = $_SESSION['compid'];
if ($_POST['remark'] != '') {
$remark=str_replace(",",".",$_POST['remark']);
    $sql = "insert into remarks(remark,comp_id,user_type,time) values('" . $remark . "','" . ucwords($user) . "' ,'" . $_SESSION['user_type'] . "','".date('Y-m-d H:i:s')."')";
    $retval = mysqli_query($con, $sql);
}
/********************************************   EMAIL TO THE STUDENT LOGIC
$ret=mysqli_query($con,"select details,status,roomno from complaints where comp_id=".$_SESSION['compid']);
$res=mysqli_fetch_array($ret);
$message="<html>
<head>
<title>Status Update on your Hostel-J Complaint Id - $user</title>
</head>
<body>
<br>
<p><b>Details :</b>".str_replace(array("\\r\\n","\\r","\\n"), "<br>",$res['details'])."</p>
";
if ($retval)
{
	$message.="<p><b>New Comment by ".$_SESSION['user_type'].":</b> ".$_POST['remark']."</p>";
    $flag = 1;
}
else
    $flag = 0;


if ($_POST['status'] != '') {
    $sql2 = "update complaints set status = '" . $_POST['status'] . "' where comp_id = " . $_SESSION['compid'];
    $retval2 = mysqli_query($con, $sql2);
}
if ($retval2)
{
	$message.="<p><b>Status changed from :</b> ".$res['status']." to ".$_POST['status']."</p>";
    $flag+=1;
}
else {
    $flag += 0;
}

if ($_POST['cdate']!="") {
    $cdate = date("Y-m-d H:i:s", strtotime($_POST['cdate']));
    $sql2 = "update complaints set exp_date = '" . $cdate . "' where comp_id = " . $_SESSION['compid'];
    $retval2 = mysqli_query($con, $sql2);
}
if ($retval2)
{
	$message.="<p><b>Expected date of completion : </b>".format_date($_POST['cdate'])."</p>";
    $flag+=1;
}
else {
    $flag += 0;
}
$ret1=mysqli_query($con,"select email from registration where roomno='".$res['roomno']."'");
$res1=mysqli_fetch_array($ret1);
$to=$res1['email'];
$message.="</body>
</html>";
$subject="Status Update on your Hostel-J Complaint Id - $user";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers.="From:Hostel-J<developer@onlinehostelj.in>";
mail($to,$subject,$message,$headers);


*////////////////////////////////////////////////////////////////////////////////////////////////
/* $row['exp_date']
  $_POST['cdate']
 */
//echo $flag;
//echo mysqli_error($con);
?>