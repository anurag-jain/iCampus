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
		
	if(email.value=='' || !email.value.match(RegMailPattern)) {
		document.getElementById('forsemail').style.display='inline';
		success=false;
		}
	else
		document.getElementById('forsemail').style.display='none';
	
	return success;
}
</script>
</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="../images/header.png" alt="sastra university"/></center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome Day Entry User,</div>
<div id="menu">
		<img src="../images/Sastra1.png" width="170" alt="sastra university" />
		<div class="clear"></div>
		<img src="../images/menu-top.png" alt="menu-top"/>
			<div id="nav">
		<ul>
        <li><a href="dataentry_index.php">Data Entry Home</a></li>
        <li><a href="addstaff.php">Add Staff</a></li>
		<li><a href="editstaff.php">Edit Staff</a></li>
        <li><a href="delstaff.php">Delete Staff</a></li>
		<li><a href="addstudent.php">Add Student</a></li>
		<li><a href="editstudent.php">Edit Student</a></li>
        <li><a href="delstudent.php">Delete Student</a></li>
		<li><a href="addcourse.php">Add Course</a></li>
        <li><a href="editcourse.php">Edit Course</a></li>
        <li><a href="delcourse.php">Delete Course</a></li>
		<li><a href="adddept.php">Add Department</a></li>
		<li><a href="deletedept.php">Delete Department</a></li>
		<li><a href="dataentry_section.php">Add Section</a></li>
        <li><a href="dataentry_relation.php">Populate Section</a></li>
		<li><a href="timetable_entry.php">Add Timetable</a></li>
		<li><a href="stafflist.php">Staff List</a></li>
		<li><a href="courselist.php">Course List</a></li>
		<li><a href="sectionlist.php">Section List</a></li>
		<li><a href="deptlist.php">Department List</a></li>
		<li><a href="../logout.php">Sign Out</a></li>
      </ul>
			</div>
		<img src="../images/menu-bottom.png" alt="menu-bottom"/>
	</div>
<div id="content">
	<div id="main">
	<img src="../images/cont-top.png" alt="cont-top"/>
	<!--Write code here!-->
	<div id="addstaff" class="main">
		<h2 class="heading">Add Staff</h2>
		<form action="addstaff.php" method="post" name="addstaff" onsubmit="return validateData()">
		<?php
		if(isset($_POST['submit']))
		{
			if(isset($_POST['staffid']))
				$staffid=$_POST['staffid'];
			if(isset($_POST['staffname']))
				$staffname=$_POST['staffname'];
			if(isset($_POST['staffdept']))
				$dept=$_POST['staffdept'];
			if(isset($_POST['staffemail']))
				$email=$_POST['staffemail'];
			if(isset($_POST['desig']))
				$desig=$_POST['desig'];
		
			require_once('../db_config.php');
			$querym="INSERT INTO staffmaster(staffid,staffname,department,staff_email,password,staff_desig) VALUES('$staffid','$staffname','$dept','$email','".md5('sastra')."','$desig')";
			$resultm=mysql_query($querym);
			if($resultm==1)
				echo '<div class="confirmmsg">Data Added Successfully</div>';
			else
					echo '<div class="msg">Error While Adding Data</div>';	
			unset($_POST['submit']);
		}
		?>
		<table width="415" height="209" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td><div align="right">Staff Id :</div></td>
            <td><input type="text" id="staffid" name="staffid" /><span id="forsid" class="mandatory"> *</span></td>
          </tr>
          <tr>
            <td><div align="right">Staff Name :</div></td>
            <td><input type="text" id="staffname" name="staffname" /><span id="forsname" class="mandatory"> *</span></td>
          </tr>
          <tr>
            <td><div align="right">Department :</div></td>
            <td><input type="text" id="staffdept" name="staffdept" /><span id="forsdept" class="mandatory"> *</span></td>
          </tr>
          <tr>
            <td><div align="right">Designation :</div></td>
            <td>
			<select id="desig" name="desig">
				<option value="Assistant Professor -I">Assistant Professor -I</option>
				<option value="Assistant Professor -II">Assistant Professor -II</option>
				<option value="Assistant Professor -III">Assistant Professor -III</option>
				<option value="Senior Assistant Professor">Senior Assistant Professor</option>
				<option value="">Professor</option>
			</select>
			</td>
          </tr>
           <tr>
            <td><div align="right">Email Id :</div></td>
            <td><input type="text" id="staffemail" name="staffemail" /><span id="forsemail" class="mandatory"> *</span></td>
          </tr>
          <tr>
            <td><input type="submit" id="submit" name="submit" value="Add"/></td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" /></td>
		  </tr>
        </table>
		<p>&nbsp;</p>
		</form>
		&nbsp;</div>
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
