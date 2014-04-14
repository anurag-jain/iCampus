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
$sem_id = $_POST['param1'];
$date = $_POST['param2'];
$query = "UPDATE program_master SET start_date = 'null' where program_id = $sem_id";
$result = mysql_query($query) or die("Oops! There was some problem. We're fixing it shortly.");
$query = "UPDATE src_master SET attrib_value = (select min(start_date) from program_master where start_date!='0000-00-00') where attribute = 'semester_start'";
$result = mysql_query($query) or die("Oops! There was some problem. We're fixing it shortly.");
echo "Hurray! The semester status reset was successful."
?>