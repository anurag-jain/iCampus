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
<title>
SASTRA University - SRC
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="../images/header.png" alt="sastra university"/></center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome <?php echo $staffname?>,</div>
<div id="menu">
		<img src="../images/Sastra1.png" width="170" alt="sastra university" />
		<div class="clear"></div>
		<img src="../images/menu-top.png" alt="menu-top"/>
			<div id="nav">
			<ul>
				<li><a href="staff_index.php">Home</a></li>
              	<li><a href="staff_profile.php">Profile</a></li>
				<li><a href="staff_attendance.php">Post Attendance</a></li>
                <li><a href="modify_attendance.php">Modify Attendance</a></li>
				<li><a href="staff_attendance.php#pending">Pending Attendance</a></li>
				<li><a href="report.php">Get Lag Report</a></li>
				<li><a href="staff_timetable.php" target="_blank">Timetable</a></li>
                <li><a href="midsem_display.php">Post CIA</a></li>
                <li><a href="../logout.php">Sign Out</a></li>
			</ul>
			</div>
		<img src="../images/menu-bottom.png" alt="menu-bottom"/>
	</div>
<div id="content">
	<div id="main">
	<img src="../images/cont-top.png" alt="cont-top"/>
	<!--Write code here!-->
	<div id="studenthome" class="main">
	  <h2 class='heading'>Attendance updated</h2>
	  </br></br></br>
    <?php
	require_once('../db_config.php'); 
	
	$rno=1;
	
	$timestamp=time();
	$curDate = date('Y-m-d', $timestamp);
	
	$enpid=$_GET['pid'];
	$part=explode('-',$enpid);
	$pid=$security->decrypt(urldecode($part[0]));
	$pid=$pid."-".$part[1];
	
	$endate=$_GET['date'];
	$date=$security->decrypt(urldecode($endate));
	
	
	$section=$_GET['section'];
	
	$remark=$_POST['textarea'];

if($staff->getFlag($date,$pid)=="true")
{
	$datePart=explode('-',$date);
	$date=$datePart[2]."-".$datePart[1]."-".$datePart[0];
	//echo " attendance not posted";
	while(isset($_POST[$rno]) && $_POST[$rno]!="" ) 
	{
	$r=$_POST[$rno];
	$part=explode('-',$r);
	$staff->updateAttendence($date,$part[0],$part[1],$pid,$part[2]);
	$rno++;
	}


$staff->commitRemark($remark,$date,$pid,$section);
}
else if($staff->getFlag($date,$pid)=="false")
{
	echo "<div class=\"msg\">Attendance has already been posted for this day</div>";
	}
else if($staff->getFlag($date,$pid)=="ignored")
{
echo "<div class=\"msg\">"."The Attendance for this day has been ignored by you"."</div>";
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
&copy; 2010 SASTRA University - SRC Campus&nbsp; | &nbsp;Engineered By GLOSS Community | <a href="../bug_filing.php?ref=staff" target="_blank">Report Bugs</a> | <a href="../feedback.php" target="_blank">Feedback</a> | <a href="../credits.php" target="_blank">Credits</a>
</div>
</div>
</div>
</body>
</html>
