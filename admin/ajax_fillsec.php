<?php
/*
Author : KP
Date : 28/02/2010
*/
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
$prog= $_POST['prog'];
$dept = $_POST['dept'];
require_once('../db_config.php');
echo "<select onchange='fillStu(this)' id='sec' name='sec'><option value='invalid'>Choose a Section</option>";
$secfillQuery = "SELECT section_id,year,section FROM sectionmaster,program_master "
				."WHERE program_master.program ='$prog' and program_master.department ='$dept' and sectionmaster.program_id=program_master.program_id";
$sfResult=mysql_query($secfillQuery);
if($sfResult) {
	while($row=mysql_fetch_array($sfResult)) {
		echo "<option value='$row[0]'>$row[1] - $row[2]</option>";
	}
}
echo "</select>&nbsp;<span id='forsec' class='mandatory'> *</span>";
?>