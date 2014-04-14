<?php
/*
Author : KP
*/

session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['type']=='student')
{
$user=$_SESSION['username'];
$username=$_SESSION['studentname'];
$pass=$_SESSION['password'];
}
else { ?>
<script>
alert("Session Expired!!!");
window.location="../index.php";
</script>
<?php 
}
$regnumber=$user;
$studentname=$username;
include_once("../db_config.php");
include('student_class.php');
$student=new student_class($user,$pass);
$student->setValues();
echo "Please Wait..";
$old=$_POST['oldpass'];
$new=$_POST['newpass'];
$success=$student->changePassword($old,$new);
echo "<meta http-equiv='refresh' content='0;url=student_profile.php?success=$success'>";
?>