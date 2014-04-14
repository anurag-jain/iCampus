<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['type']=='staff')
{
$user=$_SESSION['username'];
}
else { ?>
<script>
alert("Session Expired!!!");
window.location="../index.php";
</script>
<?php }
$staffid=$user;
$staffname=$_SESSION['staffname'];
$department=$_SESSION['department'];
$pass=$_SESSION['password'];
include ('staff_class.php');
include ('security_class.php');
$staff = new staff_class($staffid,$staffname,$department,$pass);
$security=new security_class($staffid);
?>
<!--Author: Anurag Jain-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Staff Timetable</title>

</head>
<body>
<div id="student-timetable">
<h2><center>
  SASTRA University Staff TIMETABLE
</center></h2>
<div id="tt-student">
<?php
$timetable = $staff->displayTimetable();
if($timetable) {
	$days=array(0,'mon','tue','wed','thu','fri','sat');
		echo "<table cellpadding=0 cellspacing=1 width='100%' border=1>";
		for($i=0;$i<7;$i++)
		{
			echo "<tr>";
			$val=$timetable[$days[$i]][0];
			echo "<td width=300px>$val</td>";
			for($j=1;$j<=12;$j++) {
				$val=$timetable[$days[$i]][$j];
				
					echo "<td width=300px>$val<td>";
			}
			echo "</tr>";
		}
		echo '</table>';
}
else
	echo 'Please Try Again Later';
?>
</div>
<div></div>

<div><center>COURSE DETAILS</center></div>
<div >
<?php
$data=array(array());
$data=$staff->getTimetableDetails();
if($data) {
	echo "<table cellpadding=0 cellspacing=1 width='100%' border=1>";
	echo "<th>Course Code</th>";
	echo "<th>Name Of The Course</th>";
	$i=0;
	while($data[$i][0]!='@' && $data[$i][1]!='@') {
			$val="<td>".$data[$i][0]."</td>"
			."<td>".$data[$i][1]."</td>";
		
		echo "<tr>$val</tr>";	
		$i++;
	}
	echo '</table>';
}
else
	echo 'Please Try Again Later';
?>
</div>
<div ></div>
</div>
</body>
</html>