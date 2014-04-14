<?php
include('../staff/staff_class.php');
include('../student/student_class.php');
include('../course/course_class.php');

/*function __autoload($staff_class, $student_class, $course_class) {
    require_once $staff_class . '.php';
	require_once $student_class . '.php';
	require_once $course_class . '.php';
}*/


class relation_class
{
	//private $relationId;
	
	$staff_class_ob = new staff_class($sid);
	$student_class_ob = new student_class();
	$course_class_ob = new course_class();
	$section_class_ob = new section_class();
	
	
	function insertToDb($relationId)
	{
		require_once('../db_config.php');
		$query1 = "INSERT INTO relation(relationid,regnumber,coursecode,staffid,sectionid) "
					."values('$this->relationId','$regnumber','$courseCode','$staffId','$sectionId') ";
		$result1 = mysql_query($query1);
		$success = mysql_affected_rows($result1);
		if($success == -1)
			return false;
		return true;
	}
	
	/*get list of courses for a particular student 
	input->regnumber
	*/
	function getcourse_student($regnum)
	{	
		require_once('../db_config.php');
		$query2 = "SELECT coursename FROM src.coursemaster WHERE coursecode in" 
					. "(select coursecode from src.relation where $student_class_object->regNum = '$regnum') ";
		$result2 = mysql_query($query2);
		$success = mysql_num_rows($result2);
		if($success == -1)
			return false;
		return true;
	}
	
	/*get list of courses for a particular staff 
	input->staffid
	*/
	function getcourse_staff($staffid)
	{
		require_once('../db_config.php');
		$query3 = "SELECT distinct relation.coursecode,sectionid,coursemaster.coursename from relation,coursemaster". 
					"where staffid='$staffid' and relation.coursecode=coursemaster.coursecode; ";
		$result3 = mysql_query($query3);
		$success = mysql_num_rows($result3);
		if($success == 0)
			return false;
		return true;
		/*$rno=1;
		while($courselist= mysql_fetch_array($result3)) {
			echo "<tr><td>$rno</td>";
			echo "<td><input type=";
			echo "\"submit\"" ;
			echo "name='$courselist[0]'  value='$courselist[0]' /></td></tr>";
			$rno++;
		}*/
	
	}
	
	/*get list of students for a particular staff 
	input->staffid
	*/
	function listofstudents_staff($staffid)
	{
		require_once('../db_config.php');
		$query4 = "select studentname,regnumber from src.studentmaster where regnumber in"
					."( select regnumber from src.relation where $staff_class_object->staffid = '$staffid') ";
		$result4 = mysql_query($query4);
		$success = mysql_num_rows($result4);
		if($success == -1)
			return false;
		return true;
	}
	
	/*get list of students for a particular section
	input->year,branch,section
	*/

	function getstudentlist_section($dept,$year,$section)
	{
		require_once('../db_config.php');
		$query5 = "SELECT regnumber,studentname FROM src.studentmaster WHERE regnumber in "
					."(SELECT regnumber FROM src.relation WHERE sectionid in "
						."( SELECT sectionid FROM src.sectionmaster WHERE $section_class_object->department='$dept' and $section_class_object->year='$year' and )" 			                        	. "$section_class_object->section='$section'))";

		$result5 = mysql_query($query5);
		$success = mysql_num_rows($result5);
		if($success == -1)
			return false;
		return true;
	}
	
	/*get list of staff for a particular section 
	input->year,branch,section
	*/
	function getstafflist_section($dept,$year,$section)
	{
		require_once('../db_config.php');
		$query6 = "SELECT staffid,staffname FROM src.staffmaster WHERE staffid in "
					."(SELECT staffid FROM src.relation WHERE sectionid in "
						."( SELECT sectionid FROM src.sectionmaster WHERE $section_class_object->department='$dept' and $section_class_object->year='$year')" 	 	                         	. " and $section_class_object->section='$section'))";

		$result6 = mysql_query($query6);
		$success = mysql_num_rows($result6);
		if($success == -1)
			return false;
		return true;
	}
	
	/*get list of courses for a particular branch 
	input->year and branch
	*/
	function getcourseslist_yearwise($dept,$year)
	{
		require_once('../db_config.php');
		$query6 = "SELECT coursecode,coursename FROM src.coursemaster WHERE coursecode in "
					."(SELECT coursecode FROM src.relation WHERE sectionid in "
						."( SELECT sectionid FROM src.sectionmaster WHERE $section_class_object->department='$dept' and $section_class_object->year='$year'))";

		$result6 = mysql_query($query6);
		$success = mysql_num_rows($result6);
		if($success == -1)
			return false;
		return true;
	}
?>		