<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['type']=='administrator')
{
$user=$_SESSION['username'];
}
else
{ ?>
<script>
alert("Session Expired!!!");
window.location="../index.php";
</script>
<?php 
}
require_once('../db_config.php');
$regno = $_POST['param1'];
$staffid = $_POST['param2'];
$coursecode = $_POST['param3'];
$type = $_POST['param4'];
$marks = $_POST['param5'];
if((strcmp($marks,"A")==0) or (strcmp($marks,"a")==0))
{
	$marks = 121;
}
else
{
	$marks *= 0.4;
}
$updateQuery="UPDATE midsem_marks SET $type=$marks WHERE relationid in (SELECT relationid FROM relation where staffid='$staffid' and regnumber='$regno' and coursecode='$coursecode')";
$result=mysql_query($updateQuery) or die(mysql_error());
echo "Hurray! The marks were updated successfully.";
?>