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
<?php
}
require_once('../db_config.php');
$date = $_POST['param1'];
$day = $_POST['param2'];
$query_delete = "DELETE from calendar where datediff(STR_TO_DATE('$date','%d-%m-%Y'),cal_date)=0";
$result_delete = mysql_query($query_delete) or die("Oops! There was some problem. We're working on it! Try after sometime!");
$query_insert = "INSERT into calendar(cal_date,cal_day) values(STR_TO_DATE('$date','%d-%m-%Y'),'$day')";
$result_insert = mysql_query($query_insert) or die("Oops! There was some problem. We're working on it! Try after sometime!");
echo "Hurray! The day order for the date was changed successfully."
?>
