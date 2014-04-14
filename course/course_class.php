<?php
class course_class
{
	private $courseCode;
	private $courseName;
	private $credits;
	private $department;
	
	private function addToDB()
	{
		require_once('../db_config.php');
		$addquery = "INSERT INTO coursemaster(coursecode,coursename,credits,department) "
					."values('$this->courseCode','$this->courseName','$this->credits','$this->department') ";
		$result = mysql_query($addquery);
		$success = mysql_affected_rows($result);
		if($success == -1)
			return false;
		return true;
	}
	
	private function updateToDB()
	{
		require_once('../db_config.php');
		$updatequery = "UPDATE coursemaster"
						." SET coursename='$this->courseName',credits='$this->credits',department='$this->department'"
						." WHERE coursecode='$this->courseCode'";
		$result = mysql_query($updatequery);
		$success = mysql_affected_rows($result);
		if($success == -1)
			return false;
		return true;
	}
	
	private function deleteFromDB()
	{
		require_once('../db_config.php');
		$deletequery = "DELETE FROM coursemaster WHERE coursecode = '$this->courseCode'";
		$result = mysql_query($deletequery);
		$success = mysql_affected_rows($result);
		if($success == -1)
			return false;
		return true;
	}
	
	private function selectFromDB()
	{
		require_once('../db_config.php');
		$selectquery = "SELECT coursecode,coursename,credits,department FROM coursemaster "
						."WHERE coursecode = '$this->courseCode'";
		$result = mysql_query($selectquery);
		$success = mysql_num_rows($result);
		if($success == 0)
			return null;
		return $result;
	}
	
}
?>