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
$courseDetails = $student->getCourseDetails();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title>
SASTRA University - SRC
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../jquery-1.2.6.min.js"></script>
<script language="javascript">
function getAbsentDetails(relationid,coursecode)
{
	
	$.post("getabsentdetails.php", {relationid: ""+relationid+"",coursecode: ""+coursecode+""}, function(data){
		$('#'+relationid).toggle();
		$('#'+relationid).html(data);
	});
}
</script>
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
	<div id="absentdetails" class='main'>
		<h2 class='heading'>Absent Information</h2>
		<?php 
		if(!$courseDetails)
			echo '<div class="msg">No Course Found</div>';
		else {
		while($row = mysql_fetch_array($courseDetails)) {
			echo "<div id='$row[0]' class='coursetitle'>";
			echo "<a href='javascript:getAbsentDetails(\"$row[1]\",\"$row[0]\")' >";
			echo "<span style='width:200px'> $row[0] </span>- $row[2]";
			echo "</a></div>";
			echo "<div id='$row[1]' class='absentdetails'>&nbsp;</div>";
		}
		}
		?>
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
