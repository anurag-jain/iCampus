<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['type']=='staff')
{
echo "Please Wait..";
include ('staff_class.php');
$user=$_SESSION['username'];
$staffid=$user;
$department=$_SESSION['department'];
$pass=$_SESSION['password'];
$staff = new staff_class($staffid,$staffname,$department,$pass);
$old=$_POST['oldpass'];
$new=$_POST['newpass'];
$success=$staff->changePassword($old,$new);
echo "<meta http-equiv='refresh' content='0;url=staff_profile.php?success=$success'>";
}
else {
	echo 'Session Expired!';
	exit;
}
?>
<!--Author: Anurag Jain-->