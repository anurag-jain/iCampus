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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
SASTRA University - SRC
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../admin/ajax_post.js"></script>
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
	<div id="studenthome" class="main">
	  <h2 class='heading'>Dashboard - Student</h2>
	  <!--- Original Code --->
	<center>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <table width="684">
  <tr>
    <td width="130"><div align="center"><img src="../images/Diagram_48.png" alt="reset password" width="48" height="48" /></div></td>
    <td width="130"><div align="center"><img src="../images/Block_48.png" alt="Change Day Order" width="48" height="48" /></div></td>
    <td width="130"><div align="center"><img src="../images/Clock_48.png" alt="services" width="48" height="48" /></div></td>
    <td width="130"><div align="center"><img src="../images/Clipboard_48.png" alt="Set / Reset Locks" width="48" height="48" /></div></td>
    <td width="130"><div align="center"><img src="../images/user-48.png" alt="Set / Reset Locks" width="48" height="48" /></div></td>
    </tr>
  <tr>
    <td><div align="center" class="style1"><a href="student_attendance.php">Attendance</a></div></td>
    <td><div align="center" class="style1"><a href="student_absentinfo.php">Absent Details</a></div></td>
    <td><div align="center" class="style1"><a href="student_timetable.php" target="_blank">Timetable</a></div></td>
    <td><div align="center" class="style1"><a href="student_internals.php">CIA Marks</a></div></td>
    <td><div align="center" class="style1"><a href="student_profile.php">View Profile</a></div></td>
    </tr>
</table>

	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	</center>
	<!--- Original Code --->
	</div>
	<!--It Ends!-->
	<img src="../images/cont-bottom.png" alt="cont-bottom"/>
	</div>
</div>
<div style="clear:both">&nbsp;</div>
</div>	

<div id="footer">
&copy; 2010 SASTRA University - SRC Campus&nbsp; | &nbsp;Engineered By GLOSS Community | <a href="../bug_filing.php?ref=student" target="_blank">Report Bugs</a> | <a href="../feedback.php" target="_blank">Feedback</a> | <a href="../credits.php" target="_blank">Credits</a>
</div>
</div>
</body>
</html>
