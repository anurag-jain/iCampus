<?php
/*
Author : KP
Date : 01/03/2010
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
SASTRA University - SRC
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script language="javascript">
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
<div id="header"><center><img src="images/header.png" alt="sastra university"/></center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome Data Entry User,</div>
<div id="menu">
		<img src="../images/Sastra1.jpg" width="170" alt="sastra university" />
		<div class="clear"></div>
		<img src="../images/menu-top.png" alt="menu-top"/>
			<div id="nav">
			<ul>
        <li><a href="dataentry_index.php">Data Entry Home</a></li>
        <li><a href="addstaff.php">Add Staff</a></li>
        <li><a href="delstaff.php">Delete Staff</a></li>
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
		<li><a href="deptlist.php">Department List</a></li>
		<li><a href="../logout.php">Log Out</a></li>
      </ul>
			</div>
		<img src="../images/menu-bottom.png" alt="menu-bottom"/>
	</div>
<div id="content">
	<div id="main">
	<img src="../images/cont-top.png" alt="cont-top"/>
	<!--Write code here!-->
		<div id="delstaff" class="main">
		<h2 class="heading">Delete Student</h2>
		<?php  
		if(isset($_POST['editid'])) { 
			$sid=$_POST['editid'];
			unset($_POST['editid']);
			require_once('../db_config.php');
			
			$query = "DELETE FROM studentmaster"
						." WHERE regnumber='$sid' ";
			
			$result=mysql_query($query);

			
			if(!$result) {
				echo '<div class="msg">Student Registration is not Valid (or) Student Enrolled in Some Section Already.</div>';		
			}
			else 
				echo '<div class="confirmmsg">Student Deleted Successfully</div>';
		} 
		?>
		<form action="delstudent.php" method="post" name="addstaff" onsubmit="return validatestaffid()">
		<p>
			<b>Enter Registration No. : </b><input type="text" id="editid" name="editid" />&nbsp;<span id="foredit" class="mandatory"> *</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" id="edit" name="edit" value="Delete" />
		</p>
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
Copyright 2009-10 SASTRA University - SRC Campus&nbsp; | &nbsp;Powered By GLOSS Community&nbsp;&nbsp;&nbsp;&nbsp;
</div>
</div>
</body>
</html>
