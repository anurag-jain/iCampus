<?php
/*
Author : KP
Date : 03/03/2010
*/
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
include_once("db_config.php");
include('relation_class.php'); 
if(isset($_POST['submit']))
{
	if(isset($_POST['question1']))
	$q1=$_POST['question1'];
	if(isset($_POST['question2']))
	$q2=$_POST['question2'];
	if(isset($_POST['question3']))
	$q3=$_POST['question3'];
	
	$sQuery= "SELECT * FROM staffmaster WHERE answer1='$q1' AND answer2='$q2' AND answer3='$q3'";
	$sResult=mysql_query($sQuery);
	$cnt=mysql_num_rows($sResult);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
SASTRA University - SRC
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function validateSQ()
{
	var success=true;
	if(document.getElementById('question1').value=='') {
		success=false;
		document.getElementById('forq1').style.display='inline';
	}
	else
		document.getElementById('forq1').style.display='none';

	if(document.getElementById('question2').value=='') {
		success=false;
		document.getElementById('forq2').style.display='inline';
	}
	else
		document.getElementById('forq2').style.display='none';

	if(document.getElementById('question3').value=='') {
		success=false;
		document.getElementById('forq3').style.display='inline';
	}
	else
		document.getElementById('forq3').style.display='none';

	return success;	
}
</script>
</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="../images/header.png" alt="sastra university"/></center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo "Welcome ".$staffname; ?></strong></div>
<div id="menu">
		<img src="../images/Sastra1.jpg" width="170" alt="sastra university" />
		<div class="clear"></div>
		<img src="../images/menu-top.png" alt="menu-top"/>
			<div id="nav">
			<ul>
				<li><a href="staff_index.php">Home</a></li>
              	<li><a href="javascript:;">View Profile</a></li>
				<li><a href="staff_attendance.php">Post Attendance</a></li>
				<li><a href="modify_attendance.php">Modify Attendance</a></li>
				<li><a href="staff_attendance.php">View Timetable</a></li>
				<li><a href="staff_attendance.php">Pending Attendance</a></li>
                <li><a href="midem_display.php">Post CIA Marks</a></li>
				<li><a href="update_cia.php">Change CIA Marks</a></li>
                <li><a href="../logout.php">Change CIA Marks</a></li>
			</ul>
			</div>
		<img src="../images/menu-bottom.png" alt="menu-bottom"/>
	</div>
<div id="content">
	<div id="main">
	<img src="../images/cont-top.png" alt="cont-top"/>
	<!--Write code here!-->
	<div id="update-cia" class="main">
	<h2 class='heading'>Modify CIA - Please Answer the questions</h2>
	<form name="form1" method="post" action="update_cia.php" style="margin-left:30px;" onsubmit='return validateSQ()'>
	<?php
	if(isset($_POST['submit'])) {
	if($cnt==1)
		echo "<meta http-equiv='refresh' content='0;url=modifycia.php'>";
	else
		echo "<div class='msg'>Authentication Failed. Please Re-enter The Correct Answers </div>";
	unset($_POST['submit']);
	}
	$query="select question1,question2,question3 from src.staffmaster where staffid='$staffid' ";
    $result=mysql_query($query);
	$row=mysql_fetch_array($result);
	?>
	<p><h2><?php echo $row[0]; ?></h2></p>
	<p><input name="question1" type="text" id="question1" size="100" maxlength="150"><span id='forq1' class='mandatory'> *</span></p>
  	<p><h2><?php echo $row[1]; ?></h2>
	<p><input name="question2" type="text" id="question2" size="100" maxlength="150"><span id='forq2' class='mandatory'> *</span></p>
  	<p><h2><?php echo $row[2]; ?></h2>
	<p><input name="question3" type="text" id="question3" size="100" maxlength="150"><span id='forq3' class='mandatory'> *</span></p>
	<p>
    <label>
    <input type="submit" name="submit" id="submit" value="Submit">
    </label>
	</p>
	</form>

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
