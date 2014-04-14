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
$password=$_SESSION['password'];
//include ('staff_class.php');
include_once("../db_config.php");
include ('security_class.php');
include('relation_class.php');
$staff = new staff_class($staffid,$staffname,$department,$password);
$security=new security_class($staffid);
$relationobj=new relation_class();
$courses=$relationobj->getcourse_staff($staffid);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
SASTRA University - SRC
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.status {}
-->
</style>
</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="../images/header.png" alt="sastra university"/></center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome <?php echo $staffname; ?>,</div>
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
	  <h2 class='heading'>Attendance Lag Report</h2>
	  <table width="675" align="center" cellpadding="0" cellspacing="1">
	    <tr>
	      <th width="151">Course Code</th>
	      <th width="209">Course Name</th>
	      <th width="76">Section</th>
	      <th width="232"></th>
	      <?php
		  

  while($row=mysql_fetch_array($courses)) 
  {	
 
			if(($sno++)%2==0)
				$class='even';
			else
				$class='odd';
	?>
	      </tr>
	    <tr class="<?php echo $class; ?>" id="<?php echo $sno; ?>" onClick="popup(<?php echo $sno; ?>);">
	      <td ><?php echo $row[0] ?></td>
	      <td><?php echo ucwords($row[5]); ?></td>
	      <td><?php echo ucwords($row[2]."-".$row[1]."-".$row[3]); ?></td>
	      <td><div id="status_<?php echo $sno; ?>" class="status" align="center"><a href="report_done.php?secid=<?php echo $row[4]."&course=".$row[0];?>">Get lag report</a></div></td>
	      </tr>
	    <?php  }
	$sno++;
	?>
	    </table>
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
