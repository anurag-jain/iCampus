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
SASTRA University - SRC
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="../images/header.png" alt="sastra university"/></center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome <?php $name=$student->getUsername();echo $name; ?>,</div>
<div id="menu">
		<img src="../images/Sastra1.png" width="170" alt="sastra university" />
		<div class="clear"></div>
		<img src="../images/menu-top.png" alt="menu-top"/>
			<div id="nav">
			<ul>
				<li><a href="student_home.php">Home</a></li>
                <li><a href="student_attendance.php">Attendance</a></li>
				<li><a href="student_absentinfo.php">Absent Details</a></li>
				<li><a href="student_timetable.php" target="_blank">Timetable</a></li>
				<li><a href="student_internals.php">CIA Marks</a></li>
                <li><a href="student_profile.php">View Profile</a></li>
				<li><a href="../logout.php">Sign Out</a></li>

			</ul>
			</div>
		<img src="../images/menu-bottom.png" alt="menu-bottom"/>
</div>
<div id="content">
	<div id="main">
	<img src="../images/cont-top.png" alt="cont-top"/>
	<!--Write code here!-->
	<div class="main" style="height:400px;">
		<h2 class="heading">Midterm & Internals</h2>
		<?php
			$internals=$student->getCIADetails();
			if($internals) {
				echo '<table width=80% align=center cellpadding=0 cellspacing=1>';
				echo '<th>Course Code</th>';
				echo '<th>Course Name</th>';
				echo '<th>Type</th>';
				echo '<th>Marks</th>';
				$i=1;
				while($row = mysql_fetch_row($internals)) {
					if($row[2]!="" && $row[2]!=-1) {
						if($row[2]==121)
							$row[2]='Absent';
						if(($i++)%2==0)
							$class='even';
						else
							$class='odd';
						echo "<tr class='$class'><td>$row[0]</td><td>$row[1]</td><td>Midsem I</td><td>$row[2]</td></tr>";
					}
					if($row[3]!=""  && $row[3]!=-1) {
						if($row[3]==121)
							$row[3]='Absent';
						if(($i++)%2==0)
							$class='even';
						else
							$class='odd';
						
						echo "<tr class='$class'><td>$row[0]</td><td>$row[1]</td><td>Midsem II</td><td>$row[3]</td></tr>";
					}
					if($row[4]!=""  && $row[4]!=-1) {
						if($row[4]==121)
							$row[4]='Absent';
						if(($i++)%2==0)
							$class='even';
						else
							$class='odd';
						
						echo "<tr class='$class'><td>$row[0]</td><td>$row[1]</td><td>Midsem III</td><td>$row[4]</td></tr>";
					}
					if($row[5]!=""  && $row[5]!=-1) {
						if($row[5]==121)
							$row[5]='Absent';
						if(($i++)%2==0)
							$class='even';
						else
							$class='odd';
						echo "<tr class='$class'><td>$row[0]</td><td>$row[1]</td><td>Internals</td><td>$row[5]</td></tr>";
					}
				}
			}
			else
				echo '<div class="msg">No CIA Marks have been posted</div>';

		?>
		</table></div>
	<!--It Ends!-->
	<img src="../images/cont-bottom.png" alt="cont-bottom"/>
	</div>
</div>
</body>
<div style="clear:both">&nbsp;</div>
</div>	
	
<div id="footer">
&copy; 2010 SASTRA University - SRC Campus&nbsp; | &nbsp;Engineered By GLOSS Community | <a href="../bug_filing.php?ref=student" target="_blank">Report Bugs</a> | <a href="../feedback.php" target="_blank">Feedback</a> | <a href="../credits.php" target="_blank">Credits</a>
</div>
</div>
</body>
</html>
