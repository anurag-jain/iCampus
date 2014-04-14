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
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome <?php echo $staffname; ?> ,</div>
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
                <li><a href="attendance_register.php">Attendance Register</a></li>
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
    <?php $date=$_POST['testinput']; ?>
	  <h2 class='heading'>Attendance posted for <?php echo $date;?></h2></br></br></br>
	  	  	  <?php
      		
			$result=$staff->getPostedAttendance($date);
			if($result)
			{
			$success=mysql_num_rows($result);
				if($success!=0)
				{?>
                <div align="center">
           <table width="725" border="1" cellspacing="1" cellpadding="1">
	      <tr>
	        <th >Date</th>
	        <th>Period</th>
	        <th>Section</th>
	        <th>Course code</th>
	        <th>Modify</th>
	        </tr>
					
				<?php
					while($row=mysql_fetch_array($result))
					{
			?>
      


	      <tr>
	        <td><?php echo $date.$row[0];?></td>
	        <td><?php echo $row[1]; ?></td>
	        <td><?php echo $row[2]; ?></td>
	        <td><?php echo $row[3]; ?></td>
	        <td style="display:block"><a href="modify_attendance_done.php?date=<?php echo urlencode($security->encrypt($date))."&pid=".urlencode($security->encrypt($row[1])); ?>">Modify</a></td>
	        </tr>
            <?php }?>
            
	      </table>
          	
		
	    </div>
		<?php		
				}
				else
				{
				echo "<div class=\"msg\">No attendance had been Posted on this date.</div>";
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
&copy; 2010 SASTRA University - SRC Campus&nbsp; | &nbsp;Engineered By GLOSS Community | <a href="../bug_filing.php?ref=staff" target="_blank">Report Bugs</a> | <a href="../feedback.php" target="_blank">Feedback</a> | <a href="../credits.php" target="_blank">Credits</a>
</div>
</div>
</div>
</body>
</html>
