<?php
// Author : Sanjeev Gopinath V
// Deletes a course for a section...

session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['type']=='dataentry')
{
$user=$_SESSION['username'];
}
else {
?>
<script>
alert("Session Expired!!!");
window.location="../index.php";
</script>
<?php
}
require_once('../db_config.php');
$relationid = $_POST['relationid'];
$delete_relation_query = "delete from relation where relationid = '$relationid'";
$delete_relation_result = mysql_query($delete_relation_query) or die(mysql_error());
echo "Success";
?>
