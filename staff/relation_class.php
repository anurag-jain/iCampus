<?php
include('staff_class.php');
include('student_class.php');
include('course_class.php');

class relation_class
{
	
	/*get list of courses for a particular staff 
	input->staffid
	*/
	function getcourse_staff($staffid)
	{
		$query3 = "SELECT distinct relation.coursecode,program_master.year,program_master.department,sectionmaster.section,sectionmaster.section_id,"
		           	."coursemaster.coursename from relation,coursemaster,sectionmaster,program_master " 
						."where staffid='$staffid' "
						."and relation.coursecode=coursemaster.coursecode "
						."and relation.section_id=sectionmaster.section_id "
						."and sectionmaster.program_id=program_master.program_id";
						
		$result3 = mysql_query($query3);
		//echo $query3;
		//$success = mysql_num_rows($result3);
		//if($success <= 0)
			//return null;
		return $result3;
	}
	
	
	/*get list of students for a particular staff and section 
	input->staffid
	*/
	function listofstudents_staff($staffid,$section_id,$coursecode)
	{	
		$query4 = "select distinct a.studentname,a.regnumber,b.staffid,b.section_id,b.coursecode from studentmaster a,relation b ".
					"where b.staffid='$staffid' and b.regnumber=a.regnumber and b.coursecode='$coursecode' order by a.regnumber";
		$result4 = mysql_query($query4);
		//echo $query4;
		$success = mysql_num_rows($result4);
	
		if($success == 0)
			return null;
		return $result4;
	}
	

	/*get list of students for a particular section
	input->year,branch,section
	*/

	function getstudentlist_section($dept,$year,$section)
	{
		require_once('../db_config.php');
		$query5 = "SELECT regnumber,studentname FROM src.studentmaster WHERE regnumber in "
					."(SELECT regnumber FROM src.relation WHERE section_id in "
						."( SELECT section_id FROM src.sectionmaster WHERE $section_class_object->department='$dept' and $section_class_object->year='$year' and )" 			                        	. "$section_class_object->section='$section'))";

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
					."(SELECT staffid FROM src.relation WHERE section_id in "
						."( SELECT section_id FROM src.sectionmaster WHERE $section_class_object->department='$dept' and 		                                             $section_class_object->year='$year')" 	 	                         	
						. " and $section_class_object->section='$section'))";

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
		
		$query6 = "SELECT coursecode,coursename FROM src.coursemaster WHERE coursecode in "
					."(SELECT coursecode FROM src.relation WHERE section_id in "
						."( SELECT section_id FROM src.sectionmaster WHERE $section_class_object->department='$dept' and $section_class_object->year='$year'))";

		$result6 = mysql_query($query6);
		$success = mysql_num_rows($result6);
		if($success == -1)
			return false;
		return true;
	}

	
	/* Insert midsem marks and update posted information */
	
	function insert_midsem_marks($relationid,$marks,$midsem_name,$staffid,$coursecode,$section_id)
	{
		$query8="SELECT midsem1,midsem2,midsem3,internals FROM midsem_post WHERE ". 
							"staffid='$staffid' and coursecode='$coursecode' and section_id='$section_id'";
			$result8=mysql_query($query8);
			$row8=mysql_fetch_array($result8);
		switch($midsem_name)
		{
		case 1:
					if($marks=='a' || $marks=='A' || $marks=='ab' || $marks=='Ab')
					{
						$marks='121';
					}
						$query9="INSERT INTO midsem_marks(relationid,midsem1) values('$relationid','$marks')";
						$result9=mysql_query($query9);
					
		break;
		case 2:
					if($marks=="a" || $marks=="A" || $marks=="ab" || $marks=="Ab")
					{
						$marks='121';
					}
					$query9="UPDATE midsem_marks SET midsem2='$marks' WHERE relationid='$relationid'";
					$result9=mysql_query($query9);
		break;
		case 3:
					if($marks=="a" || $marks=="A" || $marks=="ab" || $marks=="Ab")
					{
						$marks='121';
					}
					
					$query9="UPDATE midsem_marks SET midsem3='$marks' WHERE relationid='$relationid'";
					$result9=mysql_query($query9);
		break;
		case 4:
					if($marks=="a" || $marks=="A" || $marks=="ab" || $marks=="Ab")
					{
						$marks='121';
					}
					$query9="UPDATE midsem_marks SET internals='$marks' WHERE relationid='$relationid'";
					$result9=mysql_query($query9);
		break;
		}
	}
	
	/* Update midsem marks posted information */
	
	function update_midsempost_details($staffid,$coursecode,$section_id,$midsem_name,$max_marks,$conv_marks)
	{
		$query11="SELECT midsem1,midsem2,midsem3,internals FROM midsem_post WHERE ". 
							"staffid='$staffid' and coursecode='$coursecode' and section_id='$section_id'";
			$result11=mysql_query($query11);
			$row11=mysql_fetch_array($result11);
		switch($midsem_name)
		{
		case 1:
			if($row11[0]=='0' && $row11[1]=='0' && $row11[2]=='0' && $row11[3]=='0' || mysql_num_rows($result11)=='0')
				{
					$query10="INSERT INTO src.midsem_post (staffid,coursecode,section_id,midsem1,max_midsem1,conv_midsem1) ".
					 			" values('$staffid','$coursecode','$section_id',now(),'$max_marks','$conv_marks')";
					$result10=mysql_query($query10);
				}
			else
				{
					$query10="UPDATE src.midsem_post SET midsem1=now(),max_midsem1='$max_marks',conv_midsem1='$conv_marks' WHERE ".
						" staffid='$staffid' and coursecode='$coursecode' and section_id='$section_id'"; 
					$result10=mysql_query($query10);
				}			
		break;
		case 2:
				
					$query10="UPDATE src.midsem_post SET midsem2=now(),max_midsem2='$max_marks',conv_midsem2='$conv_marks' WHERE ".
						" staffid='$staffid' and coursecode='$coursecode' and section_id='$section_id'"; 
					$result10=mysql_query($query10);			
					
		break;
		case 3:
					$query10="UPDATE src.midsem_post SET midsem3=now(),max_midsem3='$max_marks',conv_midsem3='$conv_marks' WHERE ".
						" staffid='$staffid' and coursecode='$coursecode' and section_id='$section_id'"; 
					$result10=mysql_query($query10);		
		break;
		case 4:
					$query10="UPDATE src.midsem_post SET internals=now(),max_internals='$max_marks',conv_internals='$conv_marks' WHERE ".
						" staffid='$staffid' and coursecode='$coursecode' and section_id='$section_id'"; 
					$result10=mysql_query($query10);						
		break;
		}
	}
	
	
	/* check for midsem marks update*/
	function check_cia_update($staffid,$section_id,$coursecode,$midsem_name)
	{
		
		switch($midsem_name)
		{
			case 1:

					$query11="SELECT cast(midsem1 AS DATE) FROM midsem_post WHERE ". 
							" staffid='$staffid' and coursecode='$coursecode' and section_id='$section_id'";
					 break;
			case 2:
					$query11="SELECT cast(midsem2 AS DATE) FROM midsem_post WHERE ". 
							"staffid='$staffid' and coursecode='$coursecode' and section_id='$section_id'";
					break;
			case 3:
					$query11="SELECT cast(midsem3 AS DATE) FROM midsem_post WHERE ". 
							"staffid='$staffid' and coursecode='$coursecode' and section_id='$section_id'";
					break;
			case 4:
					$query11="SELECT cast(internals AS DATE) FROM midsem_post WHERE ". 
							"staffid='$staffid' and coursecode='$coursecode' and section_id='$section_id'";
					break; 
					
			case 5:
					$query11="SELECT midsem1,midsem2,midsem3,internals FROM midsem_post WHERE ". 
							"staffid='$staffid' and coursecode='$coursecode' and section_id='$section_id'";
					break;
			}
			//echo $query11;
			
			$result11=mysql_query($query11);
					$success = mysql_num_rows($result11);
					if($success <= 0 || !$result11)
						return null; 
					else
					return $result11;
		}
		
function check_allupdate_cia($staffid,$coursecode,$sectionid)
{
			$query_check="SELECT midsem1,midsem2,midsem3,internals FROM midsem_post WHERE ". 
							" staffid='$staffid' and coursecode='$coursecode' and section_id='$sectionid'"; 
			$result_check=mysql_query($query_check);
			echo $query_check;
			$success = mysql_num_rows($result_check);
					if($success <= 0 || !$result_check)
						return null; 
					else
					return $result_check;
}


/* Get Midsem marks for a staff and given coursecode */
function getmidsem_marks($staffid,$section_id,$coursecode,$midsem_name)
{
	/*if($midsem_name==5)
		$midsem_name='1,midsem2,midsem3,internals';*/
	switch($midsem_name)
	{
		case 1:
		$query13="SELECT midsem1 FROM midsem_marks WHERE relationid in ".
			"(select relationid from relation where staffid='$staffid' and section_id='$section_id' and coursecode='$coursecode')";
		break;
		case 2:
		$query13="SELECT midsem2 FROM midsem_marks WHERE relationid in ".
			"(select relationid from relation where staffid='$staffid' and section_id='$section_id' and coursecode='$coursecode')";
		break;
		case 3:
		$query13="SELECT midsem3 FROM midsem_marks WHERE relationid in ".
			"(select relationid from relation where staffid='$staffid' and section_id='$section_id' and coursecode='$coursecode')";
		break;
		case 4:
		$query13="SELECT internals FROM midsem_marks WHERE relationid in ".
			"(select relationid from relation where staffid='$staffid' and section_id='$section_id' and coursecode='$coursecode')";
		break;

		case 5:
		$query13="SELECT midsem1,midsem2,midsem3,internals FROM midsem_marks WHERE relationid in ".
			"(select relationid from relation where staffid='$staffid' and section_id='$section_id' and coursecode='$coursecode')";
		break;
	}

	/*$query13="SELECT midsem$midsem_name FROM midsem_marks WHERE relationid in ".
			"(select relationid from relation where staffid='$staffid' and section_id='$section_id' and coursecode='$coursecode')";*/
		
	$result13=mysql_query($query13);
	$success = mysql_num_rows($result13);
					if($success == '0')
						return null;
					else
					return $result13;

}

/* Update Midsem marks */
function update_midsem_marks($staffid,$section_id,$coursecode,$regnumber)
{
$query14="UPDATE src.midsem_marks SET midsem1='$marks' WHERE relationid in ".
						" ( select relationid from relation where staffid='$staffid' and coursecode='$coursecode' and 		                                 section_id='$section_id' and regnumber='$regnumber'"; 
$result14=mysql_query($query14);
}

function getLocks($staffid)
{
$lockQuery="SELECT midsem_1,midsem_2,midsem_3,internals FROM program_master,sectionmaster,relation "
				." WHERE sectionmaster.program_id=program_master.program_id and sectionmaster.section_id=relation.section_id and relation.staffid='$staffid'";
$lockResult=mysql_query($lockQuery);
$success = mysql_num_rows($lockResult);
					if($success == '0')
						return null;
					else	
					return $lockResult;
}

/* Get Staff name for Staffid*/
function getstaff_name($staffid)
{
	$query15="SELECT staffname from staffmaster WHERE staffid='$staffid'";
	$result15=mysql_query($query15);
	$success = mysql_num_rows($result15);
					if($success == '0')
						return null;
					else
					return $result15;
}
/*get section details for given section id*/
function getsection_details($sectionid)
{
	$query16="SELECT a.program,a.department,a.year,b.section from program_master a,sectionmaster b "
					." where ( select program_id from sectionmaster where section_id='$sectionid')";
	$result16=mysql_query($query16);
	$success = mysql_num_rows($result16);
					if($success == '0')
						return null;
					else
					return $result16;
}


function getedit_cia_lock()
{
$query17="SELECT attrib_value FROM src_master WHERE attribute='cia_post_days'";
$result17=mysql_query($query17);
	$success = mysql_num_rows($result17);
					if($success == '0')
						return null;
					else
					return $result17;
 
}


}	
?>		
