<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['type']=='staff')
{
$user=$_SESSION['username'];
$username=$_SESSION['staffname'];
}
else { ?>
<script>
alert("Session Expired!!!");
window.location="../index.php";
</script>
<?php }
$staffid=$user;
$staffname=$username;
include_once("../db_config.php");
include('relation_class.php');
include ('security_class.php');
$security=new security_class($staffid);

$details=$_GET['value'];
$details=urldecode($details);
$details=explode(",",$details);
	$midsem_name=$details[3];
	$section_id=$details[2];
	$coursecode=$details[1];
	//$section=$details[5];
	$edit=$details[4];
	$sno='1';
	$a='0000-00-00 00:00:00';
	$customize="value %1% not posted";
	
	//echo $section;
	//echo $section_id;
	//echo $coursecode;
$relation_obj1 = new relation_class();
$students=$relation_obj1->listofstudents_staff($staffid,$section_id,$coursecode);
$cia_update=$relation_obj1->check_cia_update($staffid,$section_id,$coursecode,$midsem_name);
$course="SELECT a.department,a.year,b.section FROM program_master a,sectionmaster b where b.program_id=a.program_id and b.section_id='$section_id'";
$course_result=mysql_query($course);
$course_details=mysql_fetch_array($course_result);

if($cia_update!=null)
$cia_update_row1=mysql_fetch_row($cia_update);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
SASTRA University - SRC
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script>
function validate()
{
var maxmarks=document.getElementById('mm').value;
var convmarks=document.getElementById('cm').value;
if(isNaN(maxmarks) || isNaN(convmarks) || maxmarks=='' || convmarks=='' || maxmarks==0 || convmarks==0 )
{
alert("enter valid values");
return false;
}

if(maxmarks>50 || convmarks>50 || maxmarks<0 || convmarks<0)
{
alert("please ensure that values are non negative and less than 50");
return false;
}
if(convmarks>maxmarks)
{
alert("Converted marks should be less than maximum marks");
return false;
}
confirm("The marks will be converted from "+maxmarks+" to "+convmarks );
return true;
}
</script>
</head>
<body>
<div id="wrapper_outer"><div id="wrapper">
<div id="header"><center><img src="../images/header.png" alt="sastra university"/></center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Welcome <?php echo $staffname; ?></strong></div>
<div id="menu">
		<img src="../images/Sastra1.png" width="170" alt="sastra university" />
		<div class="clear"></div>
		<img src="../images/menu-top.png" alt="menu-top"/>
			<div id="nav">
			<ul>
				<li><a href="staff_index.php">Home</a></li>
                <li><a href="staff_profile.php">Profile</a></li>
                <li><a href="staff_attendance.php">Post Attendance</a></li>
                <li><a href="modify_attendance.php">Modify Attendance</a></li>
                <li><a href="staff_attendance.php#pending">Pending Attendance</a></li>
                <li><a href="report.php">Get Lag Report</a></li>
                <li><a href="staff_timetable.php" target="_blank">Timetable</a></li>
                <li><a href="attendance_register.php">Attendance Register</a></li>
                <li><a href="midsem_display.php">Post CIA</a></li>
                <li><a href="../logout.php">Sign Out</a></li>
			</ul>
			</div>
		<img src="../images/menu-bottom.png" alt="menu-bottom"/>
	</div>
<div id="content">
<div id="main">
<img src="../images/cont-top.png" alt="cont-top"/>
<!--Write code here!-->
<div class="main">
<h2 class='heading'>CIA Entry-<?php echo $midsem_name ?> marks for <?php echo $coursecode;?></h2>
<h3 class="heading">Section:<?php echo $course_details[0]."-".$course_details[1]."-".$course_details[2]; ?></h3>
<div id="msgdiv"></div>
	<form id="form3" method="POST" action="staff_studentlist.php" onsubmit="return validate();">
	<input type="hidden" name="coursecode" value="<?php echo $coursecode ?>" /> 
	<input type="hidden" name="section_id" value="<?php echo $section_id ?>" />
	<input type="hidden" name="midsem_name" value="<?php echo $midsem_name ?>" />
	<input type="hidden" name="edit" value="<?php echo $edit ?>" />
	<input type="hidden" name="customize" value="<?php echo $customize ?>" />
	<p><b>&nbsp;IF THE MAXIMUM MARKS AND CONVERTED MARKS HAVE TO BE CHANGED PLEASE EDIT THE VALUES IN TEXTBOXES ACCORDINGLY ELSE CLICK [SAVE AND CONTINUE]!! </b></p>
	<p></p>
	<p>Enter the maximum marks the test is conducted for&nbsp;&nbsp;<input type="text" name="max_marks" id="mm" value="50"/> <i>Default 50</i></p>
	<p>Enter the converted marks for this test &nbsp;&nbsp;<input type="text" name="conv_marks" id="cm" value="20"/> <i>Default 20</i></p>
	&nbsp;&nbsp;<input type="submit" name="submit" id="submit" value="Save and continue" />
	</form>
	<!--It Ends!-->
	</div>
	<img src="../images/cont-bottom.png" alt="cont-bottom"/>
	
</div>
<div style="clear:both">&nbsp;</div>
</div>
</div>	

<div id="footer">
Copyright 2009-10 SASTRA University - SRC Campus&nbsp; | &nbsp;Powered By GLOSS Community&nbsp;&nbsp;&nbsp;&nbsp;
</div>
</div>
</body>
</html>
