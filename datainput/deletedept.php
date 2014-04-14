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
	if(isset($_POST['dept']))
		$dept=$_POST['dept'];
	
	if($prog!='' && $dept!='') {
			$deleteQuery = "DELETE FROM program_master WHERE program ='$prog' AND department='$dept'";
			$result=mysql_query($deleteQuery);
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
	var dept = document.getElementById('dept');
	
	if(prog.value=='invalid') {
		document.getElementById('forprog').style.display='inline';
		success=false;
	}
	else {
		document.getElementById('forprog').style.display='none';
	}
	if(dept.value=='invalid') {
		document.getElementById('fordept').style.display='inline';
		success=false;
	}
	else
		document.getElementById('fordept').style.display='none';
	
	return success;
}
function fillDept(obj) {
	if(obj.value!='invalid') {
	$.post("ajax_filldept.php", {prog: ""+obj.value+""}, function(data){
		$('#deptfill').html(data);
	});
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
		<h2 class='heading'>Delete Department</h2>
			<?php
			if(isset($_POST['submit'])) {
			if(!$result) {
				echo '<div class="msg">Department Removal Failed <br></br> Sections exists for this department</div>';		
			}
			else { 
				echo '<div class="confirmmsg">Department Deleted Successfully</div>';
			}
			unset($_POST['submit']);
			}
			?>
			<form action="deletedept.php" method="post" onsubmit="return validatedr()">
			<div id="data-left-cs">
			<div> 
			<p>
			Select Programme : 
			</p>
			<div style="margin-left:20px;">
			
			<select onchange='fillDept(this)' id='prog' name='prog'>
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
				?>
			</select>&nbsp;<span id="forprog" class="mandatory"> *</span>	
			</div>
			
			<p>
			Enter Department Name :  
			</p>
			<div id="deptfill" style="margin-left:20px;">
				<select id='dept'>
					<option value='invalid'>Choose a Programme Above</option>
				</select>&nbsp;<span id="fordept" class="mandatory"> *</span>
			</div>
			<p><br></br>
				<input type="submit" id="submit" name="submit" value="Delete Department" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" />
			</p>
			</div>
			</form>
		</div>&nbsp;</div>
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
