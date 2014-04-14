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
		<h2 class="heading">Add Student</h2>
		<form action="addstudent.php" method="post" name="addstaff" onsubmit="return validateData()">
		<?php
		if(isset($_POST['submit']))
		{
			if(isset($_POST['staffid']))
				$staffid=$_POST['staffid'];
			if(isset($_POST['staffname']))
				$staffname=$_POST['staffname'];
			if(isset($_POST['staffdept']))
				$dept=$_POST['staffdept'];
			if(isset($_POST['year']))
				$year=$_POST['year'];
			
			require_once('../db_config.php');
			$querym="INSERT INTO studentmaster(regnumber,studentname,department,year,password) VALUES('$staffid','$staffname','$dept','$year','".md5('tryandhackmypassword')."')";
			$resultm=mysql_query($querym);
			
			if($resultm==1)
				echo '<div class="confirmmsg">Student Added Successfully</div>';
			else
					echo '<div class="msg">Error While Adding Student!!!</div>';	
			unset($_POST['submit']);
		}
		?>
		<table width="415" height="209" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td><div align="right">Student Registration No. :</div></td>
            <td><input type="text" id="staffid" name="staffid" /><span id="forsid" class="mandatory"> *</span></td>
          </tr>
          <tr>
            <td><div align="right">Student Name :</div></td>
            <td><input type="text" id="staffname" name="staffname" /><span id="forsname" class="mandatory"> *</span></td>
          </tr>
		  <tr>
		  <td><div align="right">Department :</div></td>
          <td><select id="staffdept" name="staffdept" value="<?php echo $row[2]; ?>">
						<?php
							require_once('../db_config.php');
							$deptquery = "SELECT distinct department FROM studentmaster";
							$dept_res = mysql_query($deptquery);
							if($dept_res) {
								while($dept_row = mysql_fetch_row($dept_res)) {
									echo "<option value='$dept_row[0]'>$dept_row[0]</option>";
								}
							}
						?>
				</select>
				<span id="forsdept" class="mandatory"> *</span>
			</td>
			</tr>
          <tr>
            <td><div align="right">Year :</div></td>
            <td><input type="text" id="year" name="year" /><span id="forsyear" class="mandatory"> *</span></td>
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
Copyright 2009-10 SASTRA University - SRC Campus&nbsp; | &nbsp;Powered By GLOSS Community&nbsp;&nbsp;&nbsp;&nbsp;
</div>
</div>
</body>
</html>
