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
require_once('../db_config.php');
echo "<select id='year' name='year'><option value='invalid'>Choose a Year</option>";
$secfillQuery = "SELECT program_id,year FROM program_master "
				."WHERE program = '$dept[0]' and department ='$dept[1]'";
$sfResult=mysql_query($secfillQuery);
if($sfResult) {
	while($row=mysql_fetch_array($sfResult)) {
		echo "<option value='$row[0]'>$row[1]</option>";
	}
}
echo "</select>&nbsp;<span id='foryear' class='mandatory'> *</span>";
?>