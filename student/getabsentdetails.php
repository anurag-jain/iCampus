<?php
/*
Author : KP
*/
session_start();
include ('student_class.php');
if(isset($_SESSION['username']) && $_SESSION['username']!='')
{
$user=$_SESSION['username'];
$pass=$_SESSION['password'];
$student=new student_class($user,$pass);
$student->setValues();
}
else {
	echo 'Session Expired!';
	exit;
}
?>
<?php
function convertDays($in) {
	$inarr = explode('-',$in);
	if($inarr[0] == 'mon')
		$out = "Monday - ".$inarr[1];
	else if($inarr[0] == 'tue')
		$out = "Tuesday - ".$inarr[1];
	else if($inarr[0] == 'wed')
		$out = "Wednesday - ".$inarr[1];
	else if($inarr[0] == 'thu')
		$out = "Thursday - ".$inarr[1];
	else if($inarr[0] == 'fri')
		$out = "Friday - ".$inarr[1];
	else if($inarr[0] == 'sat')
		$out = "Saturday - ".$inarr[1];
	else if($inarr[0] == 'sun')
		$out = "Sunday - ".$inarr[1];	
	return $out;
}
$relationId = $_POST['relationid'];
$courseCode = $_POST['coursecode'];
$absentInfo=$student->getAbsentInfo($relationId,$courseCode);
if(!$absentInfo)
	echo 'No Classes Missed';
else {
echo "<table cellspacing='1' cellpadding='0' width='600px'>";
	echo '<th>&nbsp;Date&nbsp;</th>';
	echo '<th>&nbsp;Period&nbsp;</th>';
	echo '<th>&nbsp;Portions Covered&nbsp;</th>';
	$i=1;
while($row=mysql_fetch_array($absentInfo)) {
	if(($i++)%2==0)
		$class='even';
	else
		$class='odd';
	echo "<tr class='$class'><td>$row[0]</td><td>".convertDays($row[1])."</td><td>$row[2]</td></tr>";
}
echo '</table>';
}
?>