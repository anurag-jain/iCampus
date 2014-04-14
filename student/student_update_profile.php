<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['type']=='student')
{
$user=$_SESSION['username'];
}
else { ?>
<script>
alert("Session Expired!!!");
window.location="../index.php";
</script>
<?php }
$regnumber=$user;

?>

<?php
require_once('../db_config.php');
$email=$_POST['param1'];
$phone=$_POST['param2'];
$address=$_POST['param3'];
$quote=$_POST['param4'];
$updateQuery="UPDATE studentmaster SET emailid='$email', contact='$phone', address='$address', myquote='$quote' where regnumber='$regnumber'";
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