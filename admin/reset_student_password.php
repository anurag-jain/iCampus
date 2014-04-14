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
$reg_stud = $_POST['param1'];
$query = "UPDATE studentmaster SET password = MD5('sastra') where regnumber = '$reg_stud' or studentname = '$reg_stud'";
$result = mysql_query($query) or die("Oops! There was some problem. We're fixing it shortly.");
echo "Hurray! The student password was reset successfully.";
?>