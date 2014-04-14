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
		<div id="liststaff" class="main">
		<h2 class="heading">List Of Departments</h2>
		<?php  
			include_once('../db_config.php');
			$slQuery="SELECT distinct program,department FROM program_master order by program";
			$result=mysql_query($slQuery);
			if($result) {
				$num=mysql_num_rows($result);
				if($num>0) {
					echo "<table width='650px' align='center' cellspacing='1' cellpadding='0'>";
					echo "<tr><th>S No</th>";
					echo "<th>Program</th>";
					echo "<th>Department</th>";
					echo "<th><a href='courselist.php'>View All Courses</a></th>";
					echo "<th width='16px'></th></tr><tbody style='height:250px;overflow:auto'>";
					$i=0;
				while($row=mysql_fetch_row($result)) {
					if((++$i)%2==0)
						$class='even';
					else
						$class='odd';
					$value = "<td>$i</td>"
							."<td>$row[0]</td>"
							."<td>$row[1]</td>"
							."<td><a href='courselist.php?dept=".urlencode(str_pad($row[0],7)."-$row[1]")."'>View Courses</a></td>";
					echo "<tr class='$class'>$value</tr>";
				}
					echo "</tbody></table>";
					echo "<p>Click <a href='list_report_dept.php' target='_blank'>Here</a> To Download PDF</p>";
				}
				else
					echo '<div class="msg">No Course Found</div>';
			}
			else 
				echo '<div class="msg">Error! Please Try again Later</div>';
		
		?>
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
