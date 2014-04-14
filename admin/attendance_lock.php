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
        <li><a href="attendance_lock.php">Attendance Lock</a></li>
        <li><a href="cia_lock.php">CIA Lock</a><a href="semester_status.php">Semester Status</a></li>
        <li><a href="midsem_start.php">Midsem Status</a></li>
        <li><a href="percentage_page.php">Attendance %</a></li>
        <li><a href="lagreport.php">Lag Report</a></li>
        <li><a href="../logout.php">Sign Out</a></li>
      </ul>
    </div>
  <img src="../images/menu-bottom.png" alt="menu-bottom"/> </div>
<div id="content">
	<div id="main">
	<img src="../images/cont-top.png" alt="cont-top"/>
	<div id="studenthome" class="main">
	  <h2 class='heading'>Set Attenadance Lock</h2>
	<!--- Original Code --->
	<center>
    <?php
		require_once('../db_config.php');
		$query_percentage = "SELECT attrib_value from src_master where attribute='att_post_days'";
		$result_percentage = mysql_query($query_percentage);
		$row = mysql_fetch_row($result_percentage);
	?>
	<p>Staff will not be able to post attendance after 
    <input id="attendance_tb" name="attendance_tb" type="text" size="5" maxlength="3" value="<?php echo $row[0] ?>"> 
    days.</p>
    <input type="button" onClick="attendance_lock_ajax()" name="submit_att" id="submit_att" value="Change">
    &nbsp;
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
