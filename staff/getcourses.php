<?php
$staffid='C003';
require_once('../db_config.php');
$regno=$_POST['regno'];
$query="SELECT relationid,relation.coursecode,coursemaster.coursename"
		." FROM relation,coursemaster WHERE "
		." regnumber='$regno' and staffid='$staffid' and relation.coursecode=coursemaster.coursecode";
$result=mysql_query($query);
if($result) {
		echo '<p>Select Course :';
		echo "<select id='relationid' name='relationid'>";
		echo "<option value='invalid'><i>Choose a Course</i></option>";
		while($row=mysql_fetch_array($result)) {
			echo "<option value='$row[0]'>$row[1] - $row[2]</option>";
		echo "</select></p>";
		}
	}
else
	echo "<i>No courses found</i>";
?>