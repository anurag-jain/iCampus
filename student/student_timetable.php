<?php
/*
Author : KP
*/

session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['type']=='student')
{
$user=$_SESSION['username'];
$username=$_SESSION['studentname'];
$pass=$_SESSION['password'];
}
else { ?>
<script>
alert("Session Expired!!!");
window.location="../index.php";
</script>
<?php 
}
$regnumber=$user;
$studentname=$username;
include_once("../db_config.php");
include('student_class.php');
$student=new student_class($user,$pass);
$student->setValues();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
SASTRA University - SRC Campus
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="student-timetable">
<div style="height:26px;background:#eed6a2;padding-top:10px;border-bottom:solid 1px #4a4949;font-weight:bolder;font-size:16px;"><center>SASTRA University TIMETABLE</center></div>
<div id="tt-student">
<?php
$timetableData = $student->getTimetable();
if($timetableData) {
	$timetable=array(array());
	$timetable[0][0] = "";
		$timetable['mon'][0] = "Monday";
		$timetable['tue'][0] = "Tuesday";
		$timetable['wed'][0] = "Wednesday";
		$timetable['thu'][0] = "Thursday";
		$timetable['fri'][0] = "Friday";
		$timetable['sat'][0] = "Saturday";
		//$timetable['sun'][0] = "Sunday";
		
		$timetable[0][1] = "I";
		$timetable[0][2] = "II";
		$timetable[0][3] = "III";
		$timetable[0][4] = "IV";
		$timetable[0][5] = "V";
		$timetable[0][6] = "VI";
		$timetable[0][7] = "VII";
		$timetable[0][8] = "VIII";
		$timetable[0][9] = "IX";
		$timetable[0][10] = "X";
		$timetable[0][11] = "XI";
		$timetable[0][12] = "XII";
		
		
		
		while($rowTimetable = mysql_fetch_array($timetableData)) {
			//echo $rowTimetable[1]."<br>". $rowTimetable[2];
			
			$position = explode("-",$rowTimetable[2]);
			//echo $position[0];
			//echo $position[1];
			
			$timetable[$position[0]][$position[1]] = $timetable[$position[0]][$position[1]]." ".$rowTimetable[0]." - ".$rowTimetable[1];
		}
		$days=array(0,'mon','tue','wed','thu','fri','sat');
		echo '<table cellpadding=0 cellspacing=0>';
		for($i=0;$i<7;$i++)
		{
			echo "<tr>";
			$val=$timetable[$days[$i]][0];
			echo "<th class='tt-day'>$val</th>";
			for($j=1;$j<=12;$j++) {
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
	echo '<p></p><div class="msg">Timetable Not Found</div><p></p>';
?>
</div>
<div class="clear" style="background:#fff"></div>

<div style="height:26px;background:#eed6a2;padding-top:10px;border-bottom:solid 1px #4a4949;font-weight:bolder;font-size:16px;"><center>COURSE DETAILS</center></div>
<div style="border:solid 1px #4a4949;" >
<?php
$data=$student->getTimetableDetails();
if($data) {
	echo "<table cellpadding=0 cellspacing=1 width='100%'>";
	echo "<th>Course Code</th>";
	echo "<th>Name Of The Course</th>";
	echo "<th>Faculty</th>";
	echo "<th>Section</th>";
	$i=1;
	while($row=mysql_fetch_array($data)) {
		if(($i++)%2==0)
			$class='even';
		else
			$class='odd';
		$val="<td>$row[0]</td>"
			."<td>$row[1]</td>"
			."<td>$row[2]</td>"
			."<td>$row[3]</td>";
		echo "<tr class='$class'>$val</tr>";	
	}
	echo '</table>';
}
else
	echo '<p></p><div class="msg">Timetable Details Not Found</div><p></p>';
?>
</div>
<div class="clear" style="background:#fff"></div>
</div>
</body>
</html>