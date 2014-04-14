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
include ('staff_class.php');
include ('security_class.php');
$staff = new staff_class($staffid,$staffname,$department,$password);
$security=new security_class($staffid);
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
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome <?php echo $staffname; ?></div>
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
	  <h2 class='heading'>Student lag report</h2>
	  </br></br></br>
       <?php
		$course=$_GET['course'];
		$section=$_GET['secid'];
		$report=$staff->generateReport($section,$course);
		?>
      <div align="center">
        <p>List of Student having attendance below <?php echo $report[0][4]."%";?></p>
        <p>Course code :<?php echo $course;?> </p>
      </div>
      <p>&nbsp; </p>
	  <table width="579" height="48" border="1" align="center" cellpadding="0" cellspacing="0">
    
	  <tr>
      	<th width="85" height="25">Sno</th>
      	<th width="152">Register number</th>
	    <th width="212">Student name</th>
	    <th width="120">Attendance %</th>
	    </tr>
       
        <?php
		$i=0; 
		while($report[$i][0]!=99999 && $report[$i][1]!=99999)
		{
	?>
	  <tr>
      	<td height="20"><div align="center"><?php echo $i+1;  ?></div></td>
      	<td><div align="center"><?php echo $report[$i][1];  ?></div></td>
	    <td><div align="center"><?php echo $report[$i][2];  ?></div></td>
	    <td><div align="center"><?php echo round($report[$i][3],2);  ?></div></td>
	    </tr>
        <?php $i++; }?>
	  </table>
	  <p>&nbsp;</p>
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
