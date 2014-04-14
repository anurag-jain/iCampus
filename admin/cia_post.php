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
$att = $_POST['param1'] ;
$flag = 1;
$query_delete = "delete from src_master where attribute = 'cia_post_days'";
$result = mysql_query($query_delete);
$query_insert = "INSERT INTO src_master(attribute,attrib_value) values('cia_post_days','$att')";
$result = mysql_query($query_insert);
if($success_insert == -1)
{
	$flag = 0;
}
if($flag == 0)
{
	echo "There was some problem in updating the value in the database. Contact Developers.";
}
else // Successful
{
	echo "The Update Was successful.";
}
?>