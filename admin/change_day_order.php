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
<html xmlns="http://www.w3.org/1999/xhtml"><html>
<head>
<title>
SASTRA University - SRC
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="ajax_post.js"></script>
<script type="text/javascript" src="../calendar_eu.js"></script>

<style type="text/css">		
	.turn-me-into-datepicker {
		float: left;
		margin: 10px;
	}
.style1 {font-size: 12px}
.style3 {
	font-size: 12px;
	color: #FFFFFF;
	font-weight: bold;
}
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
	  <h2 class='heading'>Change Day Order for a Date</h2>
	  <form id = "change_day_order">	 
<p>&nbsp;</p>
<table width="647" border="0" align="center">
  <tr>
    <td width="96"><div align="center">Date</div></td>
    <td width="232">
      
        <div align="left">
          <input name="date_tb" type="text" id="date_tb" size="15"/>
              <script language="JavaScript">
	new tcal ({
		// form name
		'formname': 'change_day_order',
		// input name
		'controlname': 'date_tb'
	});
	    </script>
        </div></td>
    <td width="60"><div align="center">Order</div></td>
    <td width="165"><label>
      <div align="center">
        <select name="select" id="select" onFocus="calendarHide()">
          <option value="Monday">Monday</option>
          <option value="Tuesday">Tuesday</option>
          <option value="Wednesday">Wednesday</option>
          <option value="Thursday">Thursday</option>
          <option value="Friday">Friday</option>
          <option value="Saturday">Saturday</option>
          <option value="Sunday" selected="selected">Sunday</option>
          <option value="Holiday">Holiday</option>
        </select>
        </div>
    </label></td>
    <td width="72">
      <div align="center">
        <input id="set" type="button" value="SET" onClick="change_order()">
      </div></td>
  </tr>
  <tr>
    <td colspan="2"><div id="container"><div class="turn-me-into-datepicker" style="font-size:9px"></div></div></td>
    </tr>
</table>

    </form>
    <div style="overflow:auto; height:200px; width:750px">
    <table width="648" border="1" align="center" cellpadding="0" cellspacing="0" ><tbody id='changedlist'>
  <tr>
    <td colspan="3" bgcolor="#C66F2F"><div align="center" class="style3">Order Changed Days</div></td>
    </tr>
    <tr>
    <td width="203" bgcolor="#C66F2F"><div align="center" class="style3">Date</div></td>
    <td width="243" bgcolor="#C66F2F"><div align="center" class="style3">Original Day</div></td>
    <td width="188" bgcolor="#C66F2F"><div align="center" class="style3">Modified Day</div></td>
    </tr>
<?php
require_once('../db_config.php');
$query = "SELECT cal_date,upper(dayname(cal_date)),upper(cal_day) FROM `calendar` where strcmp(upper(cal_day),dayname(upper(cal_date)))!=0";
$result = mysql_query($query);
$count =0;
while($row = mysql_fetch_row($result))
{ 
	++$count;
	?>
	<tr <?php if ($count%2==1) echo "class=\"even\""; else echo "class=\"odd\"";?>>
    <td><div align="center" class="style1"><?php echo $row[0]; ?></div></td>
    <td><div align="center" class="style1"><?php echo $row[1]; ?></div></td>
    <td><div align="center" class="style1"><?php echo $row[2]; ?></div></td>
    </tr>
<?php }
if(count==0)
{?>
<tr><td colspan="3"><div align="center">None found.</div></td></tr>
<?php }
?>
</tbody>
</table>
</div>
	</center>
	<p>
	  <!--- Original Code --->
	  </p>
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
