<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['type']=='administrator')
{
$user=$_SESSION['username'];
}
else { ?>
<script>
alert("Session Expired!!!");
window.location="../index.php";
</script>
<?php }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
SASTRA University - SRC
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="ajax_post.js"></script>
<style type="text/css">
<!--
.style1 {color: #000000}
-->
</style>
</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="../images/header.png" alt="sastra university"/></center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome Administrator,</div>
<div id="menu"> <img src="../images/Sastra1.png" width="170" alt="sastra university" />
    <div class="clear"></div>
  <img src="../images/menu-top.png" alt="menu-top"/>
    <div id="nav">
      <ul>
        <li><a href="admin_index.php">Home</a></li>
        <li><a href="password_reset.php">Reset Password</a></li>
        <li><a href="lock_reset.php">Set / Reset Locks</a></li>
        <li><a href="admin_service_index.php">Services &amp; Facts</a></li>
        <li><a href="change_day_order.php">Change Day Order</a></li>
        <li><a href="admin_modify_index.php">Modify Records</a></li>
        <li><a href="../logout.php">Sign Out</a></li>
      </ul>
    </div>
  <img src="../images/menu-bottom.png" alt="menu-bottom"/> </div>
<div id="content">
	<div id="main">
	<img src="../images/cont-top.png" alt="cont-top"/>
	<div id="studenthome" class="main">
	  <h2 class='heading'>Service Dashboard</h2>
	<!--- Original Code --->
	<center>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <table width="705">
      <tr>
        <td width="130"><div align="center"><a href="attendance_lock.php"><img src="../images/Lock (2).png"/></a></div></td>
        <td width="130"><div align="center"><a href="cia_lock.php"><img src="../images/Lock (2).png"/></a></div></td>
        <td width="130"><div align="center"><a href="semester_status.php"><img src="../images/Gnome-Appointment-New-64.png" width="59" height="59"/></a></div></td>
        <td width="130"><div align="center"><a href="midsem_start.php"><img src="../images/Gnome-Edit-Paste-64.png"/></a></div></td>
        <td width="130"><div align="center"><a href="percentage_page.php"><img src="../images/at_per.jpg"/></a></div></td>
        <td width="130"><div align="center"><a href="lagreport.php"><img src="../images/Numbers.png" width="72" height="65" /></a></div></td>
      </tr>
      <tr>
        <td><div align="center" class="style1"><a href="attendance_lock.php">Attendance Lock</a></div></td>
        <td><div align="center" class="style1"><a href="cia_lock.php">CIA Lock</a></div></td>
        <td><div align="center" class="style1"><a href="semester_status.php">Semester Status</a></div></td>
        <td><div align="center" class="style1"><a href="midsem_start.php">Midsem Status</a></div></td>
        <td><div align="center" class="style1"><a href="percentage_page.php">Attendance %</a></div></td>
        <td><div align="center" class="style1"><a href="lagreport.php">Get Lag Report</a></div></td>
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
&copy; 2010 SASTRA University - SRC Campus&nbsp; | &nbsp;Engineered By GLOSS Community | <a href="../bug_filing.php?ref=admin" target="_blank">Report Bugs</a> | <a href="../feedback.php" target="_blank">Feedback</a> | <a href="../credits.php" target="_blank">Credits</a>
</div>
</div>
</div>
</body>
</html>
