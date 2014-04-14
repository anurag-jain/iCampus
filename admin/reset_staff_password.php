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
$staff_id = $_POST['param1'];
$query = "UPDATE staffmaster SET password = MD5('sastra') where staffid = '$staff_id' or staffname = '$staff_id'";
$result = mysql_query($query) or die("Oops! There was some problem. We're fixing it shortly.");
echo "Hurray! The staff password was reset successfully."
?>