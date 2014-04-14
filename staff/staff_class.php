<?php
class staff_class 
{
	private $staffId;
	private $staffName;
	private $department;
	private $password;
	//encrypt them to mda5 later -- decide upon this 
	
	function staff_class($sid,$sname,$sdept,$pass)
	{
		$this->staffId = $sid;
		$this->staffName = $sname;
		$this->department = $sdept;
		$this->password=$pass;
	}
	
	private function addToDB()
	{
		require_once('../db_config.php');
		$addquery = "INSERT INTO staffmaster(staffid,staffname,department,password) "
					."values('$this->staffId','$this->staffName','$this->department','$this->password') ";
		$result = mysql_query($addquery);
		$success = mysql_affected_rows($result);
		if($success == -1)
			return false;
		return true;
	}
	
	private function updateToDB()
	{
		require_once('../db_config.php');
		$updatequery = "UPDATE staffmaster"
						." SET staffname='$this->staffName',department='$this->department'"
						." WHERE staffid='$this->staffId'";
		$result = mysql_query($updatequery);
		$success = mysql_affected_rows($result);
		if($success == -1)
			return false;
		return true;
	}
	
	private function deleteFromDB()
	{
		require_once('../db_config.php');
		$deletequery = "DELETE FROM staffmaster WHERE staffid = '$this->staffId'";
		$result = mysql_query($deletequery);
		$success = mysql_affected_rows($result);
		if($success == -1)
			return false;
		return true;
	}
	
	public function getStaffdetail()
	{
		require_once('../db_config.php');
		$selectquery = "SELECT staffid,staffname,department,password,staff_desig, "
						."staff_email,staff_address,staff_phone,staff_quote FROM staffmaster "
						."WHERE staffid = '$this->staffId'";
		$result = mysql_query($selectquery);
		$success = mysql_num_rows($result);
		if($success == 0)
			return null;
		return $result;
	}
	
	public function getStudentList($period)
	{
		require_once('../db_config.php');
		$fetchListQuery = " SELECT distinct a.regnumber, a.relationid, a.section_id, c.studentname FROM relation a,periodlist b," 
						 ." studentmaster c WHERE a.staffId = '$this->staffId' AND a.relationid = b.relationid" 
						 ." AND b.period = '$period'"
						 ." and a.regnumber=c.regnumber ORDER BY a.regnumber" ;
		//echo $fetchListQuery;				
		$studentList = mysql_query($fetchListQuery);
		$success = mysql_num_rows($studentList);
		if($success == 0)
			return null;
		return $studentList;
	}
	public function displayStudentList($period)
	{
		$studentList = $this->getStudentList($period);
		$rno=1;
		$list = array(array());
		
		while($studentRow= mysql_fetch_array($studentList)) {
			
			$list[$rno][0]=$studentRow[0];
			$list[$rno][1]=$studentRow[1];
			$list[$rno][2]=$studentRow[2];
			$list[$rno][3]=$studentRow[3];
			
			$rno++;
	}
		
			$list[$rno][0]=1;
			$list[$rno][3]=1;
			return $list;
	}

	public function dateCalculation($lockdays)
	{
		require_once('../db_config.php');
		$date=array(array());
		$now=date('Y-m-d');
		//echo "now".$now;
		$limit=$lockdays+1;
		$dateQuery="SELECT cal_day,cal_date FROM `calendar` where cal_date <= '$now' order by cal_date DESC limit $limit";
		$dateResult=mysql_query($dateQuery) or die("problem");
	
		$i=0;
		while($row=mysql_fetch_array($dateResult))
		{
			$part=explode('-',$row[1]);
			$row[1]=$part[2]."-".$part[1]."-".$part[0];
			$date[$i][0]=$row[0];
			$date[$i][1]=$row[1];
			$i++;
		}
		
	return $date;
		
	}
		
	public function fetchTimetable()
	{
		require_once('../db_config.php');
	
					
		$fetchQuery= "SELECT b.period,a.relationid,a.coursecode,d.year,d.program, c.section"
					." FROM periodlist b, relation a,sectionmaster c, program_master  d "
					." WHERE a.relationid=b.relationid and a.staffid='$this->staffId'"
					." and a.section_id=c.section_id and c.program_id=d.program_id GROUP BY b.period,a.coursecode,d.program,a.section_id";
					
		$fetchResult=mysql_query($fetchQuery) or die("problem1");
		//echo $fetchQuery;
		return $fetchResult;
	
	
	
	}
		
	public function displayTimetable()
	{
		$resultTimetable = staff_class::fetchTimetable();
		if(mysql_num_rows($resultTimetable)!=0)
	
		{
		$timetable = array(array());
		$timetable[0][0] = "";
		$timetable['mon'][0] = "Mon";
		$timetable['tue'][0] = "Tue";
		$timetable['wed'][0] = "wed";
		$timetable['thu'][0] = "Thu";
		$timetable['fri'][0] = "Fri";
		$timetable['sat'][0] = "Sat";
		$timetable['sun'][0] = "Sun";
		
		$timetable[0][1] = "0";
		$timetable[0][2] = "1";
		$timetable[0][3] = "2";
		$timetable[0][4] = "3";
		$timetable[0][5] = "4";
		$timetable[0][6] = "5";
		$timetable[0][7] = "6";
		$timetable[0][8] = "7";
		$timetable[0][9] = "8";
		$timetable[0][10] = "9";
		$timetable[0][11] = "10";
		$timetable[0][12] = "11";
		$timetable[0][13] = "12";
		$timetable[0][14] = "13";
		$timetable[0][15] = "14";
		
		
		while($rowTimetable = mysql_fetch_array($resultTimetable)) {
			$position = explode("-",$rowTimetable[0]);
                        if($timetable[$position[0]][$position[1]+1]!="")
			$timetable[$position[0]][$position[1]+1] =$timetable[$position[0]][$position[1]+1]."+". $rowTimetable[2]." - ".$rowTimetable[3]."yr ".$rowTimetable[4]." - ".$rowTimetable[5];
			else
                        $timetable[$position[0]][$position[1]+1] = $rowTimetable[2]." - ".$rowTimetable[3]."yr ".$rowTimetable[4]." - ".$rowTimetable[5];
                        }
		}
		else $timetable=NULL;
		return $timetable;
	}
	
	public function getTimetableDetails()
	{
		require_once('../db_config.php');
		$detail=array(array());
		$timetableQuery="SELECT a.coursecode,b.coursename FROM relation a, coursemaster b " 
						."WHERE staffid='$this->staffId' and a.coursecode=b.coursecode group by coursecode";
		
		$timetableResult=mysql_query($timetableQuery);
		$i=0;
		while($row=mysql_fetch_array($timetableResult))
		{
			$detail[$i][0]=$row[0];
			$detail[$i][1]=$row[1];
			$i++;
		}
		
		$detail[$i][0]='@';
		$detail[$i][1]='@';
		return $detail;
	}
	
	public function returnStartdate()
	{
	require_once('../db_config.php');
	$returnQuery="SELECT attrib_value FROM src_master where attribute='semester_start'";
	$returnResult=mysql_query($returnQuery);
	$row=mysql_fetch_row($returnResult);
	
	return $row[0];
		}
	
	public function returnLockdays()
	{
	require_once('../db_config.php');
	$returnQuery="SELECT attrib_value FROM src_master where attribute='att_post_days'";
	$returnResult=mysql_query($returnQuery);
	$row=mysql_fetch_row($returnResult);
	
	return $row[0];
	}	
	
	public function getFlag($date, $period)
	{
		require_once('../db_config.php');
		//echo "hello".$date;
		$parts=explode("-",$date);
		$date=$parts[2]."-".$parts[1]."-".$parts[0];
		//echo "date received".$date."--Period".$period."<br>";
		$flag="";
		$flagQuery="SELECT remark,ignore_flag FROM remark where staff_id='$this->staffId' AND date='$date' AND period='$period'";
		$resultFlag=mysql_query($flagQuery);
		$n=mysql_num_rows($resultFlag);
		
		$row=mysql_fetch_row($resultFlag);
		//echo $n,"-",$row[1];
		//echo $flagQuery;
		if ($n==1)
		{
			if($row[1]==1)
			{
				//echo "ohh";
				$flag="false";
				return $flag;
			}
			if($row[1]==0)
			{
			//echo "yeah";
			$flag="ignored";
			return $flag;
			}
		
		
		}
			

		if($n==0)
		{
		//echo "--true-";
		//echo "oops";
		$flag="true";
		//echo "Flag is",$flag;
		return $flag;
		}

			
		}
		
public function updateAttendence($date,$relationid,$present,$period,$regno)
{
	require_once('../db_config.php');
	//echo $date."<br>".$relationid."<br>".$present."<br>".$period."<br>".$remark."<br>".$section."<br>".$curDate;
	if($present=='P')
	$present=1;
	else if ($present=='A')
	$present=0;
	
	//echo $present;
	$queryAttendence="INSERT INTO attendance(date,relationid,present,period) VALUES (STR_TO_DATE('$date','%Y-%m-%d'),$relationid,$present,'$period')";
	$resultAttendence=mysql_query($queryAttendence);
	
}

public function commitRemark($remark,$date,$period,$section)
{
//echo "inside remark".$period."<br>".$remark."<br>".$section."<br>".$date;
require_once('../db_config.php');
$queryCourse="SELECT coursecode FROM relation a, periodlist b where staffid='{$this->staffId}'"
			 ."AND section_id=$section AND b.period='$period' AND a.relationid=b.relationid";
$resultCourse=mysql_query($queryCourse);
$course=mysql_fetch_row($resultCourse);
//echo $course[0];

if($remark=="Ignored")
$ignoreflag=0;
else
$ignoreflag=1;

$remarkQuery="INSERT INTO remark(remark,date,staff_id,coursecode,period,section_id,ignore_flag) VALUES "
			." ('$remark', STR_TO_DATE('$date','%Y-%m-%d') , '{$this->staffId}' , '$course[0]' ,'$period',$section,$ignoreflag) ";
$remarkResult=mysql_query($remarkQuery);
if(!$remarkResult)
{
	echo "<div class=\"msg\">"."An error occured while posting the attendance"."</div>";
	}
else if($ignoreflag==1)
echo "<div class=\"confirmmsg\">"."Attendance was posted successfully"."</div>";
else
echo "<div class=\"confirmmsg\">"."Attendance was Ignored"."</div>";
}


public function updateList($date,$pid)
{
	require_once('../db_config.php');
	//echo "inside updatelist";
	if($this->getFlag($date,$pid)!="true")//conferming if an entry exists for that day.
	{
		//echo "true".$date." ".$pid;
		$parts=explode("-",$date);
		$date=$parts[2]."-".$parts[1]."-".$parts[0];
		//echo $date."<br>".$pid."<br>";
		$updateQuery="SELECT a.relationid, a.present, c.regnumber, d.studentname FROM attendance a, relation c,"
				  ."studentmaster d  WHERE period='$pid' and c.staffid='{$this->staffId}' AND date='$date'"
				  ."AND c.relationid=a.relationid AND c.regnumber=d.regnumber order by c.regnumber";
		$resultQuery=mysql_query($updateQuery);
		$updateList=array(array());
		$x=1;
		while($row=mysql_fetch_array($resultQuery))
		{
			//echo "hi".$row[2];
			$updateList[$x][0]=$row[0];
			$updateList[$x][1]=$row[1];
			$updateList[$x][2]=$row[2];
			$updateList[$x][3]=$row[3];
			$x++;
		}
			$updateList[$x][0]='$';
			$updateList[$x][1]='$';
			$updateList[$x][2]='$';
			$updateList[$x][3]='$';
			//echo $updateList[1][2]."<br>". $updateList[1][3];
		
		
		return $updateList;	
		}
	
	else
	{
		echo "<div class=\"msg\">The attendence for this day has not been posted</div>";
		}
}
public function changeAttendence($date,$pid,$relationid,$present,$regnumber)
{
	require_once('../db_config.php');
	if($present=='P')
	$present=1;
	else if ($present=='A')
	$present=0;
$changeQuery="UPDATE attendance SET present=$present where date=STR_TO_DATE('$date','%d-%m-%Y') AND period='$pid' AND relationid=$relationid";
$changeResult=mysql_query($changeQuery) or die(mysql_error());
return $changeResult;
	
}

public function getPeriods($pendingDate,$startdate)
{
	require_once('../db_config.php');
	$i=0;
	//echo $pendingDate." <br>".$startdate;
	$pending=array(array());
	$periodQuery="SELECT distinct a.cal_date,a.cal_day,b.period,c.staffid,c.section_id,c.coursecode "
				."FROM calendar a,periodlist b,relation c where c.staffid = '{$this->staffId}' and "
				."cal_date between STR_TO_DATE('$startdate','%Y-%m-%d') and STR_TO_DATE('$pendingDate','%d-%m-%Y') and "
				."b.relationid = c.relationid and strcmp(substr(a.cal_day,1,3),substr(b.period,1,3))=0 " 
				."order by a.cal_date,b.period ASC";
	$periodResult=mysql_query($periodQuery) or die("problem2");
	while($row=mysql_fetch_array($periodResult))
	{	
		if($pending['date'][$i-1]==$row[0] && $pending['day'][$i-1]==$row[1] && $pending['period'][$i-1]==$row[2])
		{
		$pending['course'][$i-1]=$pending['course'][$i-1]."+".$row[5];
		continue;
		}
		else{
			$pending['date'][$i]=$row[0];
			$pending['day'][$i]=$row[1];
			$pending['period'][$i]=$row[2];
			$pending['course'][$i]=$row[5];
			$i++;
		
                }
       }
		$pending['date'][$i]="";
		$pending['day'][$i]="";
		$pending['period'][$i]="";
		$pending['course'][$i]="";
		
		
		//echo "hi".$pending['date'][0];
	return $pending;	
	}
public function getStafflock()
{
	require_once('../db_config.php');
	$slockQuery="SELECT status from attendance_lock where staff_id='{$this->staffId}'";
	$slockResult=mysql_query($slockQuery);
	$row=mysql_fetch_row($slockResult);
	return $row[0];
	}
	
public function getSection($sectionId)
{
	require_once('../db_config.php');
	$sectionQuery="SELECT b.year,b.department,a.section FROM sectionmaster a, program_master b "
				 ." where section_id='$sectionId' and a.program_id=b.program_id"; //changed			 
	$sectionResult=mysql_query($sectionQuery);
	$row=mysql_fetch_row($sectionResult);
	$section=$row[0]."yr:".$row[1].":".$row[2];
	return $section;
	
	}
public function validateCourseStart($course,$date)
{
	require_once('../db_config.php');
	$part=explode('-','$course');
	$course=$part[0];
	$courseQuery="SELECT a.start_date,a.department from program_master a,coursemaster b where " 
				."b.coursecode='$coursecode' and concat(concat(a.program,' -'),a.department)=b.department group by department";
	$courseResult=mysql_query($courseQuery);
	$row=mysql_fetch_row($courseResult);
	if(strtotime($row[0])<=strtotime($date))
	{
		
		return true;
	}
	

}

public function generateReport($sectionid,$coursecode)
{
	require_once('../db_config.php');
	
	$total="SELECT count(a.present),a.relationid,b.regnumber,c.studentname FROM attendance a, relation b, studentmaster c "
				  ." WHERE a.relationid=b.relationid and b.regnumber=c.regnumber and "
				  ." b.staffid='{$this->staffId}' AND b.coursecode='$coursecode' AND b.section_id=$sectionid "
				  ." group by a.relationid order by regnumber ASC";
	//echo "<br>".$total;
	$totalResult=mysql_query($total);
	//echo $total;
	
	$presentQuery="SELECT count(a.present),a.relationid,b.regnumber,c.studentname FROM attendance a, relation b, studentmaster c "
				  ." WHERE a.present='1' AND a.relationid=b.relationid and b.regnumber=c.regnumber and "
				  ." b.staffid='{$this->staffId}' AND b.coursecode='$coursecode' AND b.section_id=$sectionid "
				  ." group by a.relationid order by regnumber ASC";
	//echo "<br>".$presentQuery;
	$presentResult=mysql_query($presentQuery);
	//echo $presentQuery;
	
	$workingQuery="SELECT count(*) FROM remark WHERE coursecode='$coursecode' and staff_id='{$this->staffId}' and section_id=$sectionid;";
    //echo "<br>".$workingQuery;
	$workingResult=mysql_query($workingQuery);
	$workingdays=mysql_fetch_row($workingResult);
	//echo $workingdays[0];
	
	$percentQuery="SELECT attrib_value from src_master WHERE attribute='percentage'";
	//echo "<br>".$percentQuery;
	$percentResult=mysql_query($percentQuery);
	$percentage=mysql_fetch_row($percentResult);
	//echo "hello".$percentage[0];
	$reportarray=array(array());
	$i=0;
	while($row1=mysql_fetch_array($totalResult))
	{
			$row=mysql_fetch_array($presentResult);
			if((($row[0]*100/$workingdays[0]))<=$percentage[0])
		{
			//echo $i."--".$row[2]."--".$row[3]."<br>";
			$reportarray[$i][0]=$i;
			$reportarray[$i][1]=$row[2];
			$reportarray[$i][2]=$row[3];
			$reportarray[$i][3]=($row[0]*100/$workingdays[0]);
			//echo $reportarray[$i][3];
			$reportarray[$i][4]=$percentage[0];
			$i++;
			}
	}
	$reportarray[$i][0]=99999;
	$reportarray[$i][1]=99999;
	
	
	
	
	return $reportarray;
}

public function changePassword($oldPassword,$newPassword)
	{
		
		//echo $this->staffId."<br>";
		//echo "here".$this->password."<br>";
		 
		
		$result=0;
		$readPassword=md5($oldPassword);
		$writePassword=md5($newPassword);
		
		//echo "old md5".$readPassword."<br>";
		//echo "new md5".$writePassword."<br>";
		if($this->password == $readPassword)
		{//echo "Here i am";
			require_once('../db_config.php');
			$this->password=$writePassword;
			$passQuery="UPDATE staffmaster SET password = '$writePassword' WHERE staffid = '{$this->staffId}'";
			//echo $passQuery;
			$result=mysql_query($passQuery);
			//unset($_SESSION['password'];
			$_SESSION['password']=md5($newPassword);
			//$this->password=$newPassword;
		}
		return $result;
	}
	public function getPostedAttendance($date)
	{
		
		require_once('../db_config.php');
	$fetchQuery="SELECT a.date,a.period,a.coursecode,c.section FROM remark a,  sectionmaster c WHERE "
				."a.date=str_to_date('$date','%d-%m-%Y') and a.section_id=c.section_id and a.staff_id='{$this->staffId}'";
	$fetchResult=mysql_query($fetchQuery) or die("An error occured while executing query");	
	
	return $fetchResult;
	}
	
	public function attendanceRegister()
	{
		require_once('../db_config.php');
	$Query="SELECT a.date,a.coursecode,a.section_id,a.period,b.section,c.program,c.department,c.year,c.semester FROM remark a, "
		  ." sectionmaster b,program_master c where a.section_id=b.section_id and b.program_id=c.program_id and staff_id='{$this->staffId}' AND a.ignore_flag=1"
		  ." order by a.date desc";
	$Result=mysql_query($Query);
	return $Result;
	}
	
}
?>
<!--Author: Anurag Jain-->
