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
		
		$coursecode = $_POST['coursecode'];
		$regno = $_POST['regno'];

$delquery="DELETE FROM relation WHERE "
					."regnumber='$regno' AND coursecode='$coursecode'";
			$dresult = mysql_query($delquery);
				if($dresult==1)
					echo "<div class='msg'>Removing $regnumber for the course $coursecode lectured by $staffid </div>&nbsp;";
				else
					echo "<div class='msg'>*** Error : Removing $regnumber from the course $coursecode lectured by $staffid ***</div>&nbsp;";
?>