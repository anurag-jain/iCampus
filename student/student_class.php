<?php
class student_class 
{
	private $regNum;
	private $studentName;
	private $department;
	private $dateOfBirth;
	private $password;
	private $yearOfJoining;
	private $contact;
	private $emailid;
	private $myqoute;
	
	//encrypt them to mda5 later -- decide upon this 
	// add constructor -- to store password -- to create session object
	function student_class($rnum,$pass)
	{
		$this->regNum = $rnum;
			$this->password = $pass;
	}
	/*
	function student_class($rnum,$sname,$sdept)
	{
		$this->regNum = $rnum;
		$this->studentName = $sname;
		$this->department = $sdept;
	}
	*/
	
	private function addToDB()
	{
		require_once('../db_config.php');
		$addquery = "INSERT INTO studentmaster(regnumber,studentname,dateofbirth,yearofjoining,department) "
					."values('$this->regNum','$this->studentName','$this->dateOfBirth','$this->yearOfJoining','$this->department')";
		$result = mysql_query($addquery);
		$success = mysql_affected_rows($result);
		if($success == -1)
			return false;
		return true;
	}
	
	private function updateToDB()
	{
		require_once('../db_config.php');
		$updatequery = "UPDATE studentmaster"
						." SET studentname='$this->studentName',department='$this->department'"
						." WHERE regnumber='$this->regNum'";
		$result = mysql_query($updatequery);
		$success = mysql_affected_rows($result);
		if($success == -1)
			return false;
		return true;
	}
	
	private function deleteFromDB()
	{
		require_once('../db_config.php');
		$deletequery = "DELETE FROM studentmaster WHERE regnumber = '$this->regNum'";
		$result = mysql_query($deletequery);
		$success = mysql_affected_rows($result);
		if($success == -1)
			return false;
		return true;
	}
	
	private function selectFromDB()
	{
		require_once('../db_config.php');
		$selectquery = "SELECT regnumber,studentname,department,dateofbirth,year,contact,emailid,address,myquote FROM studentmaster "
						."WHERE regnumber = '$this->regNum'";
	
		$result = mysql_query($selectquery);
		$success = mysql_num_rows($result);
		if($success == 0)
			return null;
		return $result;
	}
	
	public function setValues()
	{
		$result=$this->selectFromDB();
		$numOfRows = mysql_num_rows($result);
		if($numOfRows==1) {
		$values = mysql_fetch_row($result);
		$this->studentName = $values[1];
		$this->department = $values[2];
		$this->dateOfBirth = $values[3];
		$this->yearOfJoining = $values[4];
		$this->contact = $values[5];
		$this->emailid = $values[6];
		$this->address = $values[7];
		$this->myquote = $values[8];
		
		}
	}
	
	public function getUserId()
	{
		return $this->regNum;
	}
	
	public function getUsername()
	{
		return $this->studentName;
	}
	
	public function getDepartment()
	{
		return $this->department;
	}
	
	public function getContact()
	{
		return $this->contact;
	}
	public function getEmailid()
	{
		return $this->emailid;
	}
	public function getAddress()
	{
		return $this->address;
	}
	public function getMyquote()
	{
		return $this->myquote;
	}
	
	public function changePassword($oldPassword,$newPassword)
	{
		$result=0;
		$readPassword=md5($oldPassword);
		$writePassword=md5($newPassword);
		if($this->password == $readPassword)
		{
			require_once('../db_config.php');
			$this->password=$writePassword;
			$passQuery="UPDATE studentmaster SET password = '$writePassword' WHERE regnumber = '$this->regNum'";
			$result=mysql_query($passQuery);
		}
		return $result;
	}
	
	
	public function getCourseDetails()
	{
		require_once('../db_config.php');
		$courseQuery = "SELECT relation.coursecode,relation.relationid,coursemaster.coursename FROM relation,coursemaster "
						."WHERE relation.regnumber = '$this->regNum' and relation.coursecode=coursemaster.coursecode";
		//echo $courseQuery;
		$result = mysql_query($courseQuery);
		$success = mysql_num_rows($result);
		if($success == 0)
			return null;
		return $result;
	}
	
	public function getAbsentInfo($relationId,$courseCode)
	{
		require_once('../db_config.php');
		$infoQuery = "SELECT attendance.date,attendance.period,remark.remark FROM attendance,remark,relation "
					."WHERE attendance.relationid = '$relationId' AND remark.coursecode = '$courseCode' AND remark.section_id=relation.section_id "
					. "and attendance.relationid=relation.relationid and attendance.present = 0 and attendance.date = remark.date and attendance.period = remark.period order by attendance.date";
		//echo $infoQuery;
		$result = mysql_query($infoQuery);
		$success = mysql_num_rows($result);
		if($success == 0)
			return null;
		return $result;
	}
	
	public function getTotalClasses()
	{
		$attendanceQuery = "select relation.coursecode,relation.section_id,coursemaster.coursename,sum(present),count(present),coursemaster.coursename "
						."from relation,attendance,coursemaster "
						."where relation.regnumber='$this->regNum' and attendance.relationid=relation.relationid "
						."and coursemaster.coursecode = relation.coursecode "
						."group by attendance.relationid order by attendance.relationid";
		$result = mysql_query($attendanceQuery);
		//echo $attendanceQuery;
		$success = mysql_num_rows($result);
		if($success == 0)
			return null;
		return $result;
	}
	
	public function getAttendanceDetails()
	{
		$attendanceQuery = "select coursemaster.coursecode,coursemaster.coursename,coursemaster.credits,count(present),relation.section_id "
						."from relation,attendance,coursemaster "
						."where relation.regnumber='$this->regNum' and attendance.relationid=relation.relationid "
						."and coursemaster.coursecode = relation.coursecode and present = 1 "
						."group by attendance.relationid order by attendance.relationid"; 
				
		$result = mysql_query($attendanceQuery);
		$success = mysql_num_rows($result);
		if($success == 0)
			return null;
		return $result;
	}
	
	public function getCIADetails()
	{
		$ciaQuery="SELECT relation.coursecode,coursemaster.coursename,midsem1,midsem2,midsem3,internals from relation,coursemaster,midsem_marks "
				."where relation.regnumber='$this->regNum' and relation.relationid = midsem_marks.relationid and relation.coursecode=coursemaster.coursecode";
				
		$result = mysql_query($ciaQuery);
		$success = mysql_num_rows($result);
		if($success == 0)
			return null;
		return $result;
	}
	public function getTimetable()
	{	
		$ttQuery = "SELECT coursecode,sectionmaster.section,period "
					."FROM relation,periodlist,sectionmaster "
					."WHERE regnumber='{$this->regNum}' AND "
					."relation.relationid = periodlist.relationid AND "
					."relation.section_id = sectionmaster.section_id";
		$result = mysql_query($ttQuery);
		$success = mysql_num_rows($result);
		if($success == 0)
			return null;
		return $result;			
	}
	
	public function getTimetableDetails()
	{
		$ttDetailQuery="SELECT relation.coursecode,coursemaster.coursename,staffmaster.staffname,sectionmaster.section "
						."FROM relation,coursemaster,staffmaster,sectionmaster "
						."WHERE relation.regnumber='{$this->regNum}' AND "
						."relation.staffid=staffmaster.staffid AND "
						."relation.coursecode = coursemaster.coursecode AND " 
						."relation.section_id = sectionmaster.section_id";
		$result = mysql_query($ttDetailQuery);
		$success = mysql_num_rows($result);
		if($success == 0)
			return null;
		return $result;				
						
	}
	
	public function getUpdates($regnumber)
	{
		$updateQuery="SELECT staffid,coursecode,sectionid FROM relation WHERE regnumber='$regnumber'";
		$result = mysql_query($updateQuery);
		$success = mysql_num_rows($result);
		if($success <= 0)
			return null;
		return $result;		
	}
	public function getUpdatedetails($staffid,$coursecode,$sectionid)
	{
		$updateQuery2="SELECT midsem1,midsem2,midsem3,internals FROM midsem_post "
						." WHERE staffid='$staffid' and coursecode='$coursecode' and sectionid='$sectionid'"
						."order by internals desc,midsem3 desc,midsem2 desc, midsem1 desc";
						$result1 = mysql_query($updateQuery2);
		$success = mysql_num_rows($result1);
		if($result!=null){
		if($success <= 0)
			return null;}
		return $result1;		
	}
	
		

}
?>