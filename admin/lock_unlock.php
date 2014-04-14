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
$lock = $_POST['lock'];
if(strcmp($lock,"lock")==0)
{
	$query = "UPDATE attendance_lock set status = 1";
}
else
{
	$query = "UPDATE attendance_lock set status = 0";
}
$result_query = mysql_query($query) or die("Oops! There was some problem. We're fixing it shortly.");
echo "Hurray! The lock was reset for all staff.";
?>