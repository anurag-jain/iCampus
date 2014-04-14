<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['type']=='staff')
{
$user=$_SESSION['username'];
$username=$_SESSION['staffname'];
}
else { ?>
<script>
alert("Session Expired!!!");
window.location="../index.php";
</script>
<?php }
$staffid=$user;
$staffname=$username;
include_once("../db_config.php");
include('relation_class.php');

$relation_obj = new relation_class();
?>
<!--Author: Anurag Jain-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SASTRA University - SRC</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../admin/ajax_post.js"></script>
<style type="text/css">
<!--
.style1 {
	color: #000000
}
-->
</style>
</head>
<body>
<div id="wrapper_outer">
  <div id="wrapper">
    <div id="header">
      <center>
        <img src="../images/header.png" alt="sastra university"/>
      </center>
    </div>
    <div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome <?php echo $staffname; ?></div>
    <?php 
	require_once('../db_config.php');
	$checkQuery="SELECT flag FROM staffmaster WHERE staffid='$staffid'";
	$result=mysql_query($checkQuery);
	$row=mysql_fetch_row($result);
	if($row[0]!=0)
	{
	$flag='ok';
	}
	?>
    <div id="menu"> <img src="../images/Sastra1.png" width="170" alt="sastra university" />
      <div class="clear"></div>
      <img src="../images/menu-top.png" alt="menu-top"/>
      <div id="nav">
        <ul>
          <?php if($flag=='ok'){?>
          <li><a href="staff_index.php">Home</a></li>
          <li><a href="staff_profile.php">Profile</a></li>
          <li><a href="staff_attendance.php">Post Attendance</a></li>
          <li><a href="modify_attendance.php">Modify Attendance</a></li>
          <li><a href="staff_attendance.php#pending">Pending Attendance</a></li>
          <li><a href="report.php">Get Lag Report</a></li>
          <li><a href="staff_timetable.php" target="_blank">Timetable</a></li>
          <li><a href="attendance_register.php">Attendance Register</a></li>
          <li><a href="midsem_display.php">Post CIA</a></li>
          <li><a href="../logout.php">Sign Out</a></li>
          <?php } else {?>
          <li><a href="timetable_entry.php">Fix Your Timetable</a></li>
          <li><a href="../logout.php">Sign Out</a></li>
          <?php }?>
        </ul>
      </div>
      <img src="../images/menu-bottom.png" alt="menu-bottom"/> </div>
    <div id="content">
      <div id="main"> <img src="../images/cont-top.png" alt="cont-top"/>
        <div id="studenthome" class="main">
          <h2 class='heading'>Dashboard - Staff Manager</h2>
          <!--- Original Code --->
          <center>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <?php if($flag=='ok'){?>
            <table width="742">
              <tr>
                <td width="130"><div align="center"><img src="../images/Diagram_48.png" width="48" height="48" /></div></td>
                <td width="130"><div align="center"><img src="../images/attendance_change.png" width="48" height="48" /></div></td>
                <td width="130"><div align="center"><img src="../images/Clock_48.png" alt="Set / Reset Locks" width="48" height="48" /></div></td>
                <td width="130"><div align="center"><img src="../images/attendance_pending.png" alt="Change Day Order" width="48" height="48" /></div></td>
                <td width="130"><div align="center"><img src="../images/Clipboard_48.png" width="48" height="48" /></div></td>
              </tr>
              <tr>
                <td><div align="center" class="style1"><a href="staff_attendance.php">Post Attendance</a></div></td>
                <td><div align="center" class="style1"><a href="modify_attendance.php">Change Attendance</a></div></td>
                <td><div align="center" class="style1"><a href="staff_timetable.php" target="_blank">View Timetable</a></div></td>
                <td><div align="center" class="style1"><a href="staff_attendance.php#pending">Pending Attendance</a></div></td>
                <td><div align="center" class="style1"><a href="midsem_display.php">Post CIA</a></div></td>
              </tr>
            </table>
            <p>
              <?php } 
   else { 
   
   		require_once('../db_config.php');
	  	$fetchtimetableQuery="SELECT distinct a.coursecode,concat(b.section,b.batch),a.section_id, c.coursename,d.program,d.department,d.year "
	  					  ."FROM relation a, sectionmaster b,coursemaster c,program_master d WHERE "
					      ."staffid='$staffid' and a.section_id=b.section_id and a.coursecode=c.coursecode and b.program_id=d.program_id";
//	echo $fetchtimetableQuery;
	
	  $result=mysql_query($fetchtimetableQuery) ;
	  $norow=mysql_num_rows($result);
	   $i=0;
   ?>
            </p>
            <p><strong>NOTE : We have provided you with courses and section details. Please check them once before proceeding to enter the Timetable.</strong><br>
              <strong>In case of any discrepancy please contact the Administrator (Mr. Senthil, IT Admin - 9952352362).</strong></br>
            </p>
            </p>
            <p>&nbsp;</p>
            <table id="course_table" width="641" border="1" align="center" cellspacing="0" cellpadding="0">
              <tr>
                <th>Courses code</th>
                <th>Course name
                  </td>
                <th>Branch and year</th>
                <th>Section</th>
                <th align="center" style="display:none">Section id</th>
              </tr>
              <?php  while($row=mysql_fetch_array($result))
				{	  
		  ?>
              <tr>
                <td align="center"><?php echo $row[0]; ?></td>
                <td align="center"><?php echo $row[3]; ?></td>
                <td align="center"><?php echo $row[4].":".$row[5].":".$row[6]; ?></td>
                <td align="center"><?php echo $row[1];?></td>
                <td style="display:none" align="center"><?php echo $row[2];?></td>
              </tr>
              <?php } ?>
            </table>
            <p>&nbsp;</p>
            <p>Click <a href="timetable_entry.php">here</a> to enter/edit your Timetable after you have checked above details. </p>
            <?php	}
   ?>
          </center>
          <!--- Original Code --->
        </div>
        <!--It Ends!-->
        <img src="../images/cont-bottom.png" alt="cont-bottom"/> </div>
    </div>
    <div style="clear:both">&nbsp;</div>
  </div>
  <div id="footer"> &copy; 2010 SASTRA University - SRC Campus&nbsp; | &nbsp;Engineered By GLOSS Community | <a href="../bug_filing.php?ref=staff" target="_blank">Report Bugs</a> | <a href="../feedback.php" target="_blank">Feedback</a> | <a href="../credits.php" target="_blank">Credits</a> </div>
</div>
</div>
</body>
</html>
