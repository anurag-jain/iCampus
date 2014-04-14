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
<title>Modify Attendance</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script language="javascript">


/*function checkDate()
{
document.getElementById('here').innerHTML="";
var sdate=document.getElementById('date').value;	
var dd=sdate.substr(0,2);

var mm=sdate.substr(3,2);

var yyyy=sdate.substr(6,4);


var date=new Date(mm+"/"+dd+"/"+yyyy);


var today=new Date();


var timestamp=today-date;

if(timestamp>604800000)
{
document.getElementById('here').innerHTML="<div class=\"msg\">You are not allowed to change attendance for this date.</div>";	
return false;
}
else 
{
return true;
}
}*/
</script>
<script type="text/javascript" src="../CALENDER/calendar_eu.js"></script>


</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="../images/header.png" alt="sastra university"/></center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome <?php echo $staffname;?>,</div>
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
	<div id="studenthome" class="main" >
	  <h2 class='heading'>Modify Attendance      </h2>
	  <div id="here"></div>
      <p>&nbsp;</p>
      <div align="center">
    <form name="testform" method="post"  action="postedattendance.php" >
      <table width="413" border="0" cellspacing="0">
        <tr>
          <th colspan="4">Please enter the date to modify attendance</th>
          </tr>
        <tr>
          <td width="199"><div align="center">Date:</div></td>
          <td width="207" colspan="3"><input id="date" type="text" name="testinput" readonly="readonly"/>
            <script language="JavaScript">
			new tcal ({
				// form name
				'formname': 'testform',
				// input name
				'controlname': 'testinput'
			});

			</script>
            </td>
          </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
          </tr>
        <tr>
          <td colspan="4"><div align="center">
            
            <input type="submit" name="button" id="button" value="Get List" />
            
            </div></td>
          </tr>
      </table>
	</form>
 </div>
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
