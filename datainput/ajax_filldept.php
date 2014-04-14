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
$prog = $_POST['prog'];
require_once('../db_config.php');
echo "<select onchange='fillSec(this)' id='dept' name='dept'><option value='invalid'>Choose a Department</option>";
$deptfillQuery = "SELECT distinct department FROM program_master "
				."WHERE program ='$prog'";
$dfResult=mysql_query($deptfillQuery);
if($dfResult) {
	while($row=mysql_fetch_array($dfResult)) {
		echo "<option value='$row[0]'>$row[0]</option>";
	}
}
echo "</select>&nbsp;<span id='fordept' class='mandatory'> *</span>";
?>