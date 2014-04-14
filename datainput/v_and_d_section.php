<?php
// Author : Sanjeev Gopinath V
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
<html>
<head>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../jquery-1.2.6.min.js"></script>
<script type='text/javascript'>
function deletecourse(coursecode,sectionid,element)
{
	if(!confirm("Click on OK to Proceed Deleting this Course for this Section.")) return false;
	$.post("ajax_delete_section_course.php", {secid: sectionid,coursecode: coursecode }, function(data){
		if(data == "Failure")
			alert("Unable to delete. Please contact the admin.");
		else
		$(document.getElementById(element)).fadeOut();
	});
}
function deletestudentcourse(relationid)
{
	if(!confirm("Click on OK to Proceed Deleting this Student for the Particular Course.")) return;
	$.post("ajax_delete_relation.php", {relationid: relationid}, function(data){
		if(data == "Failure")
			alert("Unable to delete. Please contact the admin.");
		else
		{
			//alert(data);
			$("#stud_" + relationid).fadeOut();
		}
	});
}
function deletesection(sectionid)
{
	if(!confirm("Click on OK to proceed deleting this Section.")) return;
	$.post("ajax_delete_section.php", {secid: sectionid}, function(data){
		if(data == "Failure")
			alert("Unable to delete. Please contact the admin.");
		else
		{
			$(document.getElementById("course_table")).fadeOut();
			$(document.getElementById("student_table")).fadeOut();
			document.getElementById("mainframe").innerHTML = "<div class='confirmmsg'>Deleted the section Successfully.</div>";
		}
	});
}
</script>
</head>
<body>
<?php
require_once('../db_config.php');
$sectionid = $_GET['secid'];
$sectionDetailsQuery = "SELECT pm.program,pm.department,pm.year,pm.semester,sm.section,"
				. " (select count(*) from relation where section_id='$sectionid' group by coursecode,staffid order by count(*) desc limit 1)"
				. " FROM `sectionmaster` sm inner join program_master pm on sm.program_id=pm.program_id "
				. " where sm.section_id='$sectionid'";
$sectionDetailsResult = mysql_query($sectionDetailsQuery) or die("Error!");

$courseListQuery = "SELECT cm.coursename,sm.staffname,count(*),rel.coursecode FROM relation rel "
				 . "inner join coursemaster cm on rel.coursecode = cm.coursecode "
				 . "inner join staffmaster sm on rel.staffid = sm.staffid "
				 . "where rel.section_id='$sectionid' group by rel.coursecode,rel.staffid order by cm.coursename";
$courseListResult = mysql_query($courseListQuery) or die("Error!");

$studentListQuery = "SELECT r.regnumber,student.studentname,cm.coursename,sm.staffname,r.relationid,cm.coursecode FROM `relation` r"
				  . " inner join studentmaster student on r.regnumber = student.regnumber"
				  . " inner join coursemaster cm on r.coursecode = cm.coursecode"
				  . " inner join staffmaster sm on r.staffid = sm.staffid"
				  . " where r.section_id='$sectionid' order by r.regnumber,cm.coursecode";
$studentListResult = mysql_query($studentListQuery) or die("Error!");

?>
<div style="opacity:0.7;position:fixed;width:100%;padding:5px;font-weight:bold;font-size:20px;background:#ffffff;color:#000000;border-bottom: 2px solid #0a568c;" align="center"><a href ="javascript:location.reload()">Made Changes? Refresh Once!</a> | <a href ="dataentry_index.php">Home</a> | <a href ="dataentry_relation.php">Populate Another Section</a></div>
<br/>
<br/>
<div align='center' id="mainframe">
<br/>
<?php $row = mysql_fetch_array($sectionDetailsResult); ?>
<table width = '300px' border='1' cellpadding='0' cellspacing='0' id="course_table" style="font-size:12px;">
<tr><th colspan="2">Section Details</th></tr>
<tr><th>Attribute</th><th>Value</th></tr>
<tr class="odd"><td><b>Programme</b></td><td><?php echo $row[0]; ?></td></tr>
<tr class="even"><td><b>Department</b></td><td><?php echo $row[1]; ?></td></tr>
<tr class="odd"><td><b>Year</b></td><td><?php echo $row[2]; ?></td></tr>
<tr class="even"><td><b>Semester</b></td><td><?php echo $row[3]; ?></td></tr>
<tr class="odd"><td><b>Section</b></td><td><?php echo $row[4]; ?></td></tr>
<tr class="even"><td><b>Max. Strength</b></td><td><?php echo $row[5]; ?></td></tr>
<tr><th colspan='2'><input type='button' value='Delete Section?' onclick='deletesection(<?php echo $sectionid; ?>)' /></th></tr>
</table>
<br/><br/>
<table width = '700px' border='1' cellpadding='0' cellspacing='0' id="course_table" style="font-size:12px;">
<tr><th colspan="6">Course Details</th></tr>
<tr><th>S.No</th><th align='left'>Course Code</th><th align='left'>Course Name</th><th  align='left'>Staff Name</th><th align='left'>Number of Students</th><th align='left'>Delete?</th></tr>
<?php
$count=0;
while($row = mysql_fetch_array($courseListResult))
{
	$count++;
	if($count%2==0)
	{	
		$class = 'even';
	}
	else
	{
		$class = 'odd';
	}
	echo "<tr class='$class' id=\"course_" . "$count\"><td>$count</td><td align='center'>$row[0]</td><td align='center'>$row[3]</td><td align='center'>$row[1]</td><td align='center'>$row[2]</td><td align='center'><input type='button' value='Delete?' onclick='deletecourse(\"$row[3]\",$sectionid,\"course_" . "$count\")' /></td></tr>";
}
?>
</table>
<br/>
<br/>
<table width = '750px' border='1' cellpadding='0' cellspacing='0' id="student_table" style="font-size:12px;">
<tr><th colspan="7">Student Details</th></tr>
<tr><th>S.No</th><th align='left'>Reg. Number</th><th  align='left'>Student Name</th><th align='left'>Course Code</th><th align='left'>Course Name</th><th align='left'>Staff Name</th><th align='left'>Delete?</th></tr>
<?php
$count=0;
$prev_reg_number = "";
while($row = mysql_fetch_array($studentListResult))
{
	if(strcmp($prev_reg_number,$row[0])!=0)
		$count++;
	if($count%2==0)
	{	
		$class = 'even';
	}
	else
	{
		$class = 'odd';
	}
	echo "<tr class='$class' id=\"stud_$row[4]\"><td>$count</td><td align='center'>$row[0]</td><td align='center'>$row[1]</td><td align='center'>$row[5]</td><td align='center'>$row[2]</td><td align='center'>$row[3]</td><td align='center'><input type='button' value='Delete?' onclick='deletestudentcourse($row[4])' /></td></tr>";
	$prev_reg_number = $row[0];
}
?>
</table>
<br/>
<br/>
<br/>
</div>
</body>
</html>