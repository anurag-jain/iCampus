<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['type']=='administrator')
{
$user=$_SESSION['username'];
}
else { ?>
<script>
alert("Session Expired!!!");
window.location="../index.php";
</script>
<?php }
require_once('../db_config.php');
$staffid = $_POST['staff_id'];
$lock = $_POST['lock_status'];
$lock_type = $_POST['lock_type'];
if(strcmp($lock_type,"true") == 0)
{
	if(strcmp($lock,"true") == 0) // lock
	{
		$query = "UPDATE attendance_lock set status = 1 where staff_id='$staffid'";
	}
	else if(strcmp($lock,"false") == 0) // unlock
	{
		$query = "UPDATE attendance_lock set status = 0 where staff_id='$staffid'";
	}
	//echo $query;
	$result_query = mysql_query($query) or die(mysql_error());
}
else if(strcmp($lock_type,"false")==0)
{
	if(strcmp($lock,"true") == 0) // lock
	{
		$query = "UPDATE staffmaster set flag = 1 where staffid='$staffid'";
	}
	else if(strcmp($lock,"false") == 0) // unlock
	{
		$query = "UPDATE staffmaster set flag = 0 where staffid='$staffid'";
	}
	//echo $query;
	$result_query = mysql_query($query) or die(mysql_error() . "Oops! There was some problem. We're fixing it shortly.");
}
echo "Hurray! The lock was reset for the staff.";
?>