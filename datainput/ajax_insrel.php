<?php
/*
Author : KP
Date : 28/02/2010
*/
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['type']=='dataentry')
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
		$regno= $_POST['regno'];
		$coursecode = $_POST['coursecode'];
		$staffid = $_POST['staffid'];
		$sec = $_POST['sec'];
		
$insquery = "INSERT INTO relation(regnumber,coursecode,staffid,section_id) VALUES('$regno','$coursecode','$staffid','$sec')";
//echo $insquery;
		$result = mysql_query($insquery);
		if($result==1)
			echo "<div class='confirmmsg'>Adding $regno for the course $coursecode lectured by $staffid</div>&nbsp;";
		else {
			echo "<div class='msg'>*** Error : Adding $regno for the course $coursecode lectured by $staffid ***</div>&nbsp;";
		}
?>