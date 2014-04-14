<?php
/*
Author : KP
Date : 28/02/2010
*/
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['type']=='dataentry')
{
$dept=$_SESSION['department'];
$user=$_SESSION['username'];
}
else { ?>
<script>
alert("Session Expired!!!");
window.location="../index.php";
</script>
<?php
}
if(isset($_POST['submit'])) {
	require_once('../db_config.php');
	if(isset($_POST['prog']))
		$prog=$_POST['prog'];
	if($prog=='others') {
		if(isset($_POST['newprog']))
		$prog=$_POST['newprog'];
	}
	if(isset($_POST['dept']))
		$dept=$_POST['dept'];
	if(isset($_POST['year']))
		$year=$_POST['year'];
	
	$semQuery = "SELECT attrib_value FROM src_master WHERE attribute = 'semester_type'";
	$semResult = mysql_query($semQuery);
	$semRow = mysql_fetch_row($semResult);
	$deleteQuery = "DELETE FROM program_master WHERE program ='$prog' AND department='$dept'";
	$result=mysql_query($deleteQuery);
	if($prog!='' && $dept!='' && $year!='') {
		$i=1;
		do {
			$sem = 2*$i-$semRow[0];
			$addQuery = "INSERT INTO program_master(program,department,year,semester) VALUES('$prog','$dept','$i','$sem')";
			$result=mysql_query($addQuery);
			$i++;
		}while($i<=$year and $result);
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title>
SASTRA University - SRC
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../jquery-1.2.6.min.js"></script>
<script language="javascript">
function validatedr() {
	var success = true;
	var prog = document.getElementById('prog');
	var newprog = document.getElementById('newprog');
	var dept = document.getElementById('dept');
	var year = document.getElementById('year');
	
	if(prog.value=='invalid') {
		document.getElementById('forprog').style.display='inline';
		success=false;
	}
	else {
			if(newprog.value=='' && prog.value=='others') {
			document.getElementById('fornewprog').style.display='inline';
			success=false;
			}
			else
				document.getElementById('fornewprog').style.display='none';
			document.getElementById('forprog').style.display='none';
		}
	if(dept.value=='') {
		document.getElementById('fordept').style.display='inline';
		success=false;
	}
	else
		document.getElementById('fordept').style.display='none';
	
	if(year.value=='') {
		document.getElementById('foryear').style.display='inline';
		success=false;
	}
	else
		document.getElementById('foryear').style.display='none';
	
	return success;
}
function newProg(obj) {
	var newprog = document.getElementById('progwrapper');
	if(obj.value=='others') {
		newprog.style.display="block";
	}
	else {
		newprog.style.display="none";
	}
}
</script>
</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="../images/header.png" alt="sastra university"/></center></div>
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
		<div id="data-relation" class="main">
		<h2 class='heading'>Add Department</h2>
			<?php
			if(isset($_POST['submit'])) {
			if(!$result) {
				echo '<div class="msg">Department Addition Failed</div>';		
			}
			else 
				echo '<div class="confirmmsg">Departments Added Successfully</div>';
			unset($_POST['submit']);
			}
			?>
			<form action="adddept.php" method="post" onsubmit="return validatedr()">
			<div id="data-left-cs">
			<div> 
			<p>
			Select Programme : 
			<select onchange='newProg(this)' id='prog' name='prog'>
				<option value='invalid'>Choose a Programme</option>
				<?php
					require_once('../db_config.php');
					$progQuery="SELECT distinct program FROM program_master";
					$progResult=mysql_query($progQuery);
					if($progResult) {
						while($row=mysql_fetch_array($progResult)) {
							echo "<option value='$row[0]'>$row[0]</option>";
						}
					}
					echo "<option value='others'>Add New Programme</option>";
				?>
			</select>&nbsp;<span id="forprog" class="mandatory"> *</span>	
			</p>
			<p id="progwrapper" style="display:none">
			Enter Programme Name : <input type='text' id='newprog' name='newprog'/>&nbsp;<span id="fornewprog" class="mandatory"> *</span>
			</p>
			</div>
			
			<p>
			Enter Department Name : <input type="text" id='dept' name='dept'/>&nbsp;<span id="fordept" class="mandatory"> *</span> 
			</p>
			<p>
			Select Year : <input type="text" id='year' name='year'/>&nbsp;<span id="foryear" class="mandatory"> *</span>
			</p>
			<p>
				<input type="submit" id="submit" name="submit" value="Add Department" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" />
			</p>
			</div>
			</form>&nbsp;
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
