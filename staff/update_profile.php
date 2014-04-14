<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['type']=='staff')
{
$user=$_SESSION['username'];
}
else { ?>
<script>
alert("Session Expired!!!");
window.location="../index.php";
</script>
<?php }
$staffid=$user;

?>
<!--Author: Anurag Jain-->
<?php
require_once('../db_config.php');
$email=$_POST['param1'];
$phone=$_POST['param2'];
$address=$_POST['param3'];
$quote=$_POST['param4'];
$updateQuery="UPDATE staffmaster SET staff_email='$email', staff_phone=$phone, staff_address='$address', staff_quote='$quote' where staffid='$staffid'";
$result=mysql_query($updateQuery);
if(!result)
{
	echo "An error occured while saving your profile details ";
	}
else
{
echo "Your profile has been updated";
}

?>