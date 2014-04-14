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
<div id="menu">
		<img src="../images/Sastra1.png" width="170" alt="sastra university" />
		<div class="clear"></div>
		<img src="../images/menu-top.png" alt="menu-top"/>
			<div id="nav">
			<ul>
				<li><a href="admin_index.php">Home</a></li>
				<li><a href="admin_news.php">Publish News</a></li>
                <li><a href="../logout.php">Sign Out</a></li>
			  </ul>
	  </div>
		<img src="../images/menu-bottom.png" alt="menu-bottom"/>
	</div>
<div id="content">
	<div id="main">
	<img src="../images/cont-top.png" alt="cont-top"/>
	<div id="studenthome" class="main">
	  <h2 class='heading'>Dashboard</h2>
	<!--- Original Code --->
	<center>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <table width="684">
  <tr>
    <td width="130"><div align="center"><a href="password_reset.php"><img src="../images/Gnome-Preferences-Desktop-Personal-64.png" alt="reset password" width="69" height="69"/></a></div></td>
    <td width="130"><div align="center"><a href="admin_service_index.php"><img src="../images/Gnome-Applications-Other-64.png" alt="services"  width="69" height="69"/></a></div></td>
    <td width="130"><div align="center"><a href="lock_reset.php"><img src="../images/Lock (2).png" alt="Set / Reset Locks"/></a></div></td>
    <td width="130"><div align="center"><a href="change_day_order.php"><img src="../images/Calender.png" alt="Change Day Order"/></a></div></td>
    <td width="130"><div align="center"><a href="admin_modify_index.php"><img src="../images/Gnome-Applications-Office-64.png" width="64" height="64" /></a></div></td>
  </tr>
  <tr>
    <td><div align="center" class="style1"><a href="password_reset.php">Reset Password</a></div></td>
    <td><div align="center" class="style1"><a href="admin_service_index.php">Services &amp; Facts</a></div></td>
    <td><div align="center" class="style1"><a href="lock_reset.php">Set / Reset Locks</a></div></td>
    <td><div align="center" class="style1"><a href="change_day_order.php">Day Order</a></div></td>
    <td><div align="center"><a href="admin_modify_index.php">Modify Records</a></div></td>
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
</body>
</html>
