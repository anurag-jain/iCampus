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
$success=0;
if(isset($_POST['submit'])) {
	require_once('../db_config.php');
	if(isset($_POST['year']))
		$progid=$_POST['year'];
	if(isset($_POST['sec']))
		$sec=$_POST['sec'];
	if($progid!='' && $sec!='') {
		$selectQuery = "SELECT count(*) FROM sectionmaster WHERE program_id='$progid' AND section = '$sec'";
		$checkIfExists = mysql_query($selectQuery);
		if($checkIfExists) {
			$row = mysql_fetch_array($checkIfExists);
			if($row[0] == 0) {
				$insertQuery = "INSERT INTO sectionmaster(program_id,section) VALUES('$progid','$sec')";
				$result = mysql_query($insertQuery);
				if($result) {
				$success=1;
				}
			}
		}
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
function fillDept(obj) {
	if(obj.value!='invalid') {
	$.post("ajax_filldept.php", {prog: ""+obj.value+""}, function(data){
		$('#deptfill').html(data);
	});
	}
}
function fillSec(obj) {
	if(obj.value!='invalid') {
		var prog=document.getElementById('dept').value;
		$.post("ajax_fillyr.php", {prog: ""+obj.value+"",dept: ""+prog+""}, function(data){
		$('#yrfill').html(data);
	});
	}
}
function validatedr() {
	var success = true;
	var prog = document.getElementById('prog');
	var dept = document.getElementById('dept');
	var year = document.getElementById('year');
	var sec = document.getElementById('sec');
	
	if(prog.value=='invalid') {
		document.getElementById('forprog').style.display='inline';
		success=false;
	}
	else
		document.getElementById('forprog').style.display='none';
	
	if(year.value=='invalid') {
		document.getElementById('foryear').style.display='inline';
		success=false;
	}
	else
		document.getElementById('foryear').style.display='none';
		
	if(sec.value=='') {
		document.getElementById('forsec').style.display='inline';
		success=false;
	}
	else
		document.getElementById('forsec').style.display='none';
	
	return success;
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
		<h2 class='heading'>Add a New Section</h2>
			<?php
			if(isset($_POST['submit'])) {
			if($success == 0) {
				echo '<div class="msg">Section Addition Failed<br/>Section Might Already Exists. Go through the <a href="sectionlist.php">section list</a> and try again.</div>';		
			}
			else 
				echo '<div class="confirmmsg">Section Added Successfully</div>';
			unset($_POST['submit']);
			}
			?>
			&nbsp;&nbsp;Important Note : <br>&nbsp;&nbsp;1. Make sure there exists no section previously with the same program and name from the section list. It is mandatory.
			<br>&nbsp;&nbsp;2. Make the section name in capitals.
			<br>&nbsp;&nbsp;3. Lab sections have to be named in the following format. A section - A1, A2 and in case of B section - B1, B2.
			<form action="dataentry_section.php" method="post" onsubmit="return validatedr()">
			<div id="data-left-cs">
			<input type="hidden" id='dept' name='dept' value="<?php echo $dept; ?>" /> 
			<p>
			Select Programme :
			</p>
			<div style="margin-left:20px;"> 
			<select onchange='fillSec(this)'  id='prog'>
				<option value='invalid'>Choose a Programme</option>
				<?php
					require_once('../db_config.php');
					$progids=$_SESSION['department'];
					//$progs = explode('-',$progids);
					$progQuery="SELECT distinct program,department FROM program_master";
					$i=1;
					/*while($progs[$i]!="") {
						$progQuery=$progQuery." or program_id='$progs[$i]'";
						$i++;
					}*/
					$progResult=mysql_query($progQuery);
					if($progResult) {
						while($row=mysql_fetch_array($progResult)) {
							echo "<option value='$row[0]-$row[1]'>$row[0] $row[1]</option>";
						}
					}	
				?>
			</select>&nbsp;<span id="forprog" class="mandatory"> *</span>
			<?php //echo $progQuery; ?>
			</div>
			<p>
			Select Year :
			</p>
			<div id="yrfill" style="margin-left:20px;">
				<select id='year'>
					<option value='invalid'>Choose a Department Above</option>
				</select>&nbsp;<span id="foryear" class="mandatory"> *</span>
			</div>
			<p>
			Enter Section Name : <input type='text' id='sec' name='sec' />&nbsp;<span id="forsec" class="mandatory"> *</span>
			</p>
			<p>
				<input type="submit" id="submit" name="submit" value="Add Section" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" />
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
