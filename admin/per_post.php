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
// This page will decide how many days a staff can take for posting the cia marks
// Last Edited by Sanjeev Gopinath V - 19/02/2010
require_once('../db_config.php');
$var = $_POST['param1'] ;
$query_delete = "delete from src_master where attribute = 'percentage'";
$result = mysql_query($query_delete) or die("Oops! There was some problem. We're fixing it shortly.");
$query_insert = "INSERT INTO src_master(attribute,attrib_value) values('percentage','$var')";
$result = mysql_query($query_insert) or die("Oops! There was some problem. We're fixing it shortly.");
echo "Hurray! The attendance percentage was changed.";
?>