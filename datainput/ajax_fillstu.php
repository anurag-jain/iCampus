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
$prog= $_POST['prog'];
$dept = explode('-',$prog);
$sec = $_POST['sec'];

require_once('../db_config.php');
$stuQuery="SELECT regnumber,studentname FROM studentmaster,sectionmaster,program_master "
			."WHERE studentmaster.department = '$dept[0] - $dept[1]' and sectionmaster.section_id='$sec' "
			."and sectionmaster.program_id = program_master.program_id and program_master.year = studentmaster.year;";
$stuResult=mysql_query($stuQuery);
if($stuResult) {
	echo '<table width=100%>';
	while($row=mysql_fetch_array($stuResult)) {
		echo "<tr><td>$row[0] - $row[1]</td><td><input type='checkbox' onchange='copyvalues()' value='$row[0]' /></td></tr>";
	}
	echo '</table>';
}
else {	
	echo "No Students Found !!";
	}
?>