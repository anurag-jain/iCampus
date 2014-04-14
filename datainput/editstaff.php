<?php
/*
Author : KP
Date : 28/02/2010
*/
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['type']=='dataentry')
{
$user=$_SESSION['username'];
}
else { ?>
<script>
alert("Session Expired!!!");
window.location="../index.php";
</script>
<?php
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
SASTRA University - SRC
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="datetimepicker.js"></script>
<script language="javascript">
function validateData() {
	
	var success=true;
	var staffid = document.getElementById('staffid');
	var staffname = document.getElementById('staffname');
	var staffdept = document.getElementById('staffdept');
	var dob = document.getElementById('staffdob');
	var desig = document.getElementById('staffdesig');
	var joindate = document.getElementById('staffjoin');
	var email = document.getElementById('staffemail');
	
	var RegExPattern = /^((((0?[1-9]|[12]\d|3[01])[\.\-\/](0?[13578]|1[02])[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|((0?[1-9]|[12]\d|30)[\.\-\/](0?[13456789]|1[012])[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|((0?[1-9]|1\d|2[0-8])[\.\-\/]0?2[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|(29[\.\-\/]0?2[\.\-\/]((1[6-9]|[2-9]\d)?(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00)|00)))|(((0[1-9]|[12]\d|3[01])(0[13578]|1[02])((1[6-9]|[2-9]\d)?\d{2}))|((0[1-9]|[12]\d|30)(0[13456789]|1[012])((1[6-9]|[2-9]\d)?\d{2}))|((0[1-9]|1\d|2[0-8])02((1[6-9]|[2-9]\d)?\d{2}))|(2902((1[6-9]|[2-9]\d)?(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00)|00))))$/;
	var RegMailPattern = /^.+@.+\..{2,3}$/;
	if(staffid.value=='') {
		document.getElementById('forsid').style.display='inline';
		success=false;
		}
	else
		document.getElementById('forsid').style.display='none';
	
	if(staffname.value=='') {
		document.getElementById('forsname').style.display='inline';
		success=false;
		}
	else
		document.getElementById('forsname').style.display='none';
	
	if(staffdept.value=='') {
		document.getElementById('forsdept').style.display='inline';
		success=false;
		}
	else
		document.getElementById('forsdept').style.display='none';
		
	if(desig.value=='') {
		document.getElementById('forsdesig').style.display='inline';
		success=false;
		}
	else
		document.getElementById('forsdesig').style.display='none';
	
	
	if(dob.value=='' || !dob.value.match(RegExPattern)) {
		document.getElementById('fordob').style.display='inline';
		success=false;
		}
	else
		document.getElementById('fordob').style.display='none';
		
	if(joindate.value=='' || !joindate.value.match(RegExPattern)) {
		document.getElementById('forjoin').style.display='inline';
		success=false;
		}
	else
		document.getElementById('forjoin').style.display='none';
	
	if(email.value=='' || !email.value.match(RegMailPattern)) {
		document.getElementById('forsemail').style.display='inline';
		success=false;
		}
	else
		document.getElementById('forsemail').style.display='none';
	
	return success;
}
function validatestaffid()
{
	var editid = document.getElementById('editid');
	var success=true;
	if(editid.value=='') {
		document.getElementById('foredit').style.display='inline';
		success=false;
		}
	else
		document.getElementById('foredit').style.display='none';
	return success;
}
</script>
</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="../images/header.png" alt="sastra university"/>
</center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome Data Entry User,</div>
<div id="menu"> <img src="../images/Sastra1.jpg" width="170" alt="sastra university" />
    <div class="clear"></div>
  <img src="../images/menu-top.png" alt="menu-top"/>
    <div id="nav">
      <ul>
        <li><a href="dataentry_index.php">Data Entry Home</a></li>
        <li><a href="addstaff.php">Add Staff</a></li>
        <li><a href="editstaff.php">Edit Staff</a></li>
        <li><a href="delstaff.php">Delete Staff</a></li>
        <li><a href="addcourse.php">Add Course</a></li>
        <li><a href="editcourse.php">Edit Course</a></li>
        <li><a href="delcourse.php">Delete Course</a></li>
        <li><a href="dataentry_section.php">Add Section</a></li>
        <li><a href="dataentry_relation.php">Populate Section</a></li>
		<li><a href="../logout.php">Sign Out</a></li>	
      </ul>
    </div>
  <img src="../images/menu-bottom.png" alt="menu-bottom"/> </div>
<div id="content">
	<div id="main">
	<img src="../images/cont-top.png" alt="cont-top"/>
	<!--Write code here!-->
	<div id="editstaff" class="main">
		<h2 class="heading">Edit Staff</h2>
		<form action="editstaff.php" method="GET" name="addstaff" onsubmit="return validatestaffid()">
		<p>
			<b>Enter Staff Id : </b><input type="text" id="editid" name="editid" />&nbsp;<span id="foredit" class="mandatory"> *</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" id="edit" name="edit" value="Edit" />
		</p>
		</form>
		&nbsp;
		<?php
		if(isset($_POST['submit']))
		{
			if(isset($_POST['staffid']))
				$staffid=$_POST['staffid'];
			if(isset($_POST['staffname']))
				$staffname=$_POST['staffname'];
			if(isset($_POST['staffdept']))
				$dept=$_POST['staffdept'];
			if(isset($_POST['staffdesig']))
				$desig=$_POST['staffdesig'];	
				
			require_once('../db_config.php');
			$querym="UPDATE staffmaster "
			."SET staffname='$staffname',department='$dept',staff_desig='$desig'"
			." WHERE staffid='$staffid'";
			echo $staffid;
			$resultm=mysql_query($querym);
			if($resultm==1)
				echo '<div class="confirmmsg">Staff Updated Successfully</div>';
			else
					echo '<div class="msg">Error While Adding Data</div>';	
			unset($_POST['submit']);
		}
		?>
		
		<?php if(isset($_GET['editid'])) { 
			$sid=$_GET['editid'];
			unset($_GET['editid']);
			require_once('../db_config.php');
			
			$query = "SELECT staffid,staffname,department,staff_desig FROM staffmaster"
						." WHERE staffid='$sid' ";
			
			$result = mysql_query($query) or die(mysql_error());
			if(mysql_num_rows($result)==0) {
				echo '<div class="msg">Staff ID NOT Valid</div>';		
			}
			else {
				$row=mysql_fetch_array($result);
			
		?>
		<form action="editstaff.php" method="post" name="editstaff" onsubmit="return validateData()">
		<input type="hidden" name="staffid" value="<?php echo $row[0]; ?>" /> 
		<table width="325">
		<tr><td><div align="right">Staff Id  &nbsp; : </div></td><td><input type="text" id="staffid" name="staffid" disabled=true value="<?php echo $row[0]; ?>"/><span id="forsid" class="mandatory"> *</span></td></tr>
		<tr><td><div align="right">Staff Name : </div></td><td><input type="text" id="staffname" name="staffname" value="<?php echo $row[1]; ?>" /><span id="forsname" class="mandatory"> *</span></td></tr>
		<tr><td><div align="right">Department : </div></td><td><input type="text" id="staffdept" name="staffdept" value="<?php echo $row[2]; ?>" /><span id="forsdept" class="mandatory"> *</span></td></tr>
		<tr><td><div align="right">Designation : </div></td><td><input type="text" id="staffdesig" name="staffdesig" value="<?php echo $row[3]; ?>" /><span id="forsdesig" class="mandatory"> *</span></td></tr>
		<td><input type="submit" id="submit" name="submit" value="Make Changes"/></td>
		</tr></table>
		</form>
		<?php
		 } }
		?>
	</div>
	<!--It Ends!-->
	<img src="../images/cont-bottom.png" alt="cont-bottom"/>
	</div>
</div>
<div style="clear:both">&nbsp;</div>
</div>	

<div id="footer">
Copyright 2010 SASTRA University - SRC Campus&nbsp; | &nbsp;Engineered By GLOSS Community | <a href="bug_filing.php?ref=top">Report Bugs</a> | <a href="feedback.php">Feedback</a> | <a href="credits.php">Credits</a>
</div>
</div>
</body>
</html>
