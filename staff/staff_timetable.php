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
<link href="../style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="student-timetable">
<div style="height:26px;background:#eed6a2;padding-top:10px;border-bottom:solid 1px #4a4949;font-weight:bolder;font-size:16px;"><center>
  SASTRA University Staff TIMETABLE
</center></div>
<div id="tt-student">
<?php
$timetable = $staff->displayTimetable();

if($timetable) {
	$days=array(0,'mon','tue','wed','thu','fri','sat');
		echo '<table cellpadding=0 cellspacing=0>';
		for($i=0;$i<7;$i++)
		{
			echo "<tr>";
			$val=$timetable[$days[$i]][0];
			echo "<th class='tt-day'>$val</th>";
			for($j=1;$j<=15;$j++) {
				$val=$timetable[$days[$i]][$j];
				if($i==0)
					echo "<td class='tt-head'>$val<td>";
				else
					echo "<td class='tt-cell'>$val<td>";
			}
			echo "</tr>";
		}
		echo '</table>';
}
else
	echo "<div class=\"msg\">".'Timetable has not been entered';
?>
</div>
<div class="clear" style="background:#fff"></div>

<div style="height:26px;background:#eed6a2;padding-top:10px;border-bottom:solid 1px #4a4949;font-weight:bolder;font-size:16px;"><center>COURSE DETAILS</center></div>
<div style="border:solid 1px #4a4949;" >
<?php
$data=array(array());
$data=$staff->getTimetableDetails();
if($data[0][0]!='@' && $data[0][1]!='@') {
	echo "<table cellpadding=0 cellspacing=1 width='100%'>";
	echo "<th>Course Code</th>";
	echo "<th>Name Of The Course</th>";
	$i=0;
	while($data[$i][0]!='@' && $data[$i][1]!='@') {
		if(($i)%2==0)
			$class='even';
		else
			$class='odd';
		$val="<td>".$data[$i][0]."</td>"
			."<td>".$data[$i][1]."</td>";
		
		echo "<tr class='$class'>$val</tr>";	
		$i++;
	}
	echo '</table>';
}
else 
	echo "<div class=\"msg\">".'Course details not found';
	
	
?>
</div>
<div class="clear" style="background:#fff"></div>
</div>
</body>
</html>