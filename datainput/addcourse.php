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
<title>
SASTRA University - SRC
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="datetimepicker.js"></script>
<script language="javascript">
function validateData() {
	
	var success=true;
	var coursecode = document.getElementById('courseid');
	var coursename = document.getElementById('coursename');
	var cdept = document.getElementById('cdept');
	var credits = document.getElementById('credits');
	var sem = document.getElementById('semester');
	;
	if(coursecode.value=='') {
		document.getElementById('forcid').style.display='inline';
		success=false;
		}
	else
		document.getElementById('forcid').style.display='none';
	;
	if(coursename.value=='') {
		document.getElementById('forcname').style.display='inline';
		success=false;
		}
	else
		document.getElementById('forcname').style.display='none';
	;
	if(cdept.value=='') {
		document.getElementById('forcdept').style.display='inline';
		success=false;
		}
	else
		document.getElementById('forcdept').style.display='none';
	;	
	if(credits.value=='') {
		document.getElementById('forccred').style.display='inline';
		success=false;
		}
	else
		document.getElementById('forccred').style.display='none';
	;
	if(sem.value=='') {
		document.getElementById('forcsem').style.display='inline';
		success=false;
		}
	else
		document.getElementById('forcsem').style.display='none';
	;
	return success;
}
</script>
</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center>
  <img src="../images/header.png" alt="sastra university"/>
</center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome Data Entry User,</div>
<div id="menu"> <img src="../images/Sastra1.png" width="170" alt="sastra university" />
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
  <img src="../images/menu-bottom.png" alt="menu-bottom"/> </div>
<div id="content">
	<div id="main">
	<img src="../images/cont-top.png" alt="cont-top"/>
	<!--Write code here!-->
	<div id="addstaff" class="main">
		<h2 class="heading">Add Course</h2>
		<form action="addcourse.php" method="post" name="addstaff" onSubmit="return validateData()">
		<p>
		  <?php
		if(isset($_POST['submit']))
		{
			if(isset($_POST['courseid']))
				$coursecode=$_POST['courseid'];
			if(isset($_POST['coursename']))
				$coursename=$_POST['coursename'];
			if(isset($_POST['cdept']))
				$cdept=$_POST['cdept'];
			if(isset($_POST['credits']))
				$credits=$_POST['credits'];
			if(isset($_POST['semester']))
				$sem=$_POST['semester'];	
				
			require_once('../db_config.php');
			$querym="INSERT INTO coursemaster(coursecode,coursename,department,credits,semester) VALUES('$coursecode','$coursename','$cdept','$credits','$sem')";
			$resultm=mysql_query($querym);
			if($resultm==1)
				echo '<div class="confirmmsg">Data Added Successfully</div>';
			else
					echo '<div class="msg">Error While Adding Data</div>';	
			unset($_POST['submit']);
		}
		?></p>
		<table width="312" border="0" align="center" cellpadding="1" cellspacing="1">
          <tr>
            <td><div align="right">Course Code  &nbsp; :</div></td>
            <td><input type="text" id="courseid" name="courseid" /><span id="forcid" class="mandatory">*</span></td>
          </tr>
          <tr>
            <td><div align="right">Course Name :</div></td>
            <td><input type="text" id="coursename" name="coursename" /><span id="forcname" class="mandatory">*</span></td>
          </tr>
          <tr>
            <td><div align="right">Department :</div></td>
            <td><input type="text" id="cdept" name="cdept" /><span id="forcdept" class="mandatory">*</span></td>
          </tr>
          <tr>
            <td><div align="right">Credits :</div></td>
            <td><input type="text" id="credits" name="credits" /><span id="forccred" class="mandatory">*</span></td>
          </tr>
          <tr>
            <td><div align="right">Semester :</div></td>
            <td><input type="text" id="semester" name="semester" /><span id="forcsem" class="mandatory">*</span>	</td>
          </tr>
          <tr>
            <td><input type="submit" id="submit" name="submit" value="Add"/></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" /></td>
		  </tr>
        </table>
		</form>
		&nbsp;
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
