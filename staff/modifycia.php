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
if(isset($_POST['submit'])) {
	if(isset($_POST['relationid']))
		$relationid=$_POST['relationid'];
	if(isset($_POST['type']))
		$type=$_POST['type'];
	if(isset($_POST['marks']))
		$marks=$_POST['marks'];

	$updateQuery="UPDATE midsem_marks SET $type='$marks' WHERE relationid='$relationid'";
	$result=mysql_query($updateQuery);
	if($result==1){
		echo "success";
		}
	else
		echo "";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
SASTRA University - SRC
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../jquery-1.2.6.min.js"></script>
<script language="javascript"> 
function getCourses() 
{
	var regnum=document.getElementById('regno').value;
	if(regnum.length > 8) {
	$.post("getcourses.php", {regno: ""+regnum+""}, function(data){
					$('#courses').html(data);
		});
	}
}
</script>
</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="../images/header.png" alt="sastra university"/></center></div>
<div id="welcome"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "Welcome ".$staffname; ?></strong></div>
<div id="menu">
		<img src="../images/Sastra1.jpg" width="170" alt="sastra university" />
		<div class="clear"></div>
		<img src="../images/menu-top.png" alt="menu-top"/>
			<div id="nav">
			<ul>
				<li><a href="staff_index.php">Home</a></li>
				<li><a href="staff_attendance.php">Post Attendance</a></li>
				<li><a href="modify_attendance.php">Change Attendance</a></li>
				<li><a href="staff_attendance.php">View Timetable</a></li>
				<li><a href="staff_attendance.php">Pending Attendance</a></li>
                <li><a href="midem_display.php">Post CIA Marks</a></li>
				<li><a href="update_cia.php">Change CIA Marks</a></li>
                <li><a href="../logout.php">Logout</a></li>
                
			</ul>
			</div>
		<img src="../images/menu-bottom.png" alt="menu-bottom"/>
	</div>
<div id="content">
	<div id="main">
	<img src="../images/cont-top.png" alt="cont-top"/>
	<!--Write code here!-->
	<div id="staff-modify" class="main">
	<h2 class='heading'>Modify Attendance</h2>
    <form name="form1" id="form1" method="post" action="<?php echo $PHP_SELF; ?>">
	<p>
		Enter Register Number : <input type="text" id="regno" name="regno" onkeyup="getCourses()"/>
	</p>
	<div id="courses">
	&nbsp;
	</div>
	<p>
		Select Type : <select id="type" name="type">
			<option value="invalid"><i>Choose a type</i></option>
			<option value="midsem1">Mid Sem I</option>
			<option value="midsem2">Mid Sem II</option>
			<option value="midsem3">MId Sem III</option>
			<option value="internals">Internals</option>
		</select>
	</p>
	<p>
		Enter marks : <input type="text" id="marks" name="marks" />
	</p>
	<p>
		<input type="submit" id="submit" name="submit" value="Change" />
	</p>&nbsp;
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
