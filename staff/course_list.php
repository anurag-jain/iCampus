<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['type']=='staff')
{
$user=$_SESSION['username'];
}
else { ?>
<script>
alert("Session Expired!!!");
window.location="../index.php";
</script>
<?php }
$staffid=$user;
$staffname=$_SESSION['staffname'];
$department=$_SESSION['department'];
include ('staff_class.php');
include ('security_class.php');
$staff = new staff_class($staffid,$staffname,$department,$pass);
$security=new security_class($staffid);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Courses covered</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
$(document).ready(function(){
$('.status').hide();
$('#listview').hide();
});
function popup(divid)
{
//$('.status').slideUp("slow","");
var string = "#status_" + divid;
$(string).slideToggle("slow","");
//$('.status').hide("slow","");
}

function listview()
{
$('#listview').slideToggle("slow","");
//$('#listview').slideUp("slow","")
}
</script>
</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="../images/header.png" alt="sastra university"/></center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome <?php echo $staffname; ?>,</div>
<div id="menu">
		<img src="../images/Sastra1.jpg" width="170" alt="sastra university" />
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
	<div id="studenthome" class="main">
	  <h2 class='heading'>Courses covered.</h2>
	  <div id="listview" style="border:2px #000000">
   			<p>&nbsp;</p>
   			<table width="673" height="60" align=center cellpadding=0 cellspacing=1>
   			  <?php
				
				$result=$staff->fetchCourses();
				while($course=mysql_fetch_array($result))
  				{
				$i=1;	
			?>
   			  
   			  <th colspan="4" onClick="listview()"><?php echo $course[0]." - ".$course[1];?></th>
              <div id="listview">
   			    <?php $remark=$staff->fetchRemark($course[0]);
				while($row=mysql_fetch_array($remark))			
				{
					
			?>
            
		      <tr <?php if($i%2!=0) {?>class='even'<?php } else {?>class='odd'<?php }?>>
   			      <td width="130" height="22" ><?php echo $i;?></td>
   			      <td width="177"><?php echo $row[1];?></td>
   			      <td width="125"><?php echo $row[0];?></td>
   			      
		      </tr>
   			  <?php $i++;} }?>
              </div>
		    </table>
            <hr />
    </div>
    </div>
	<!--It Ends!-->
	<img src="../images/cont-bottom.png" alt="cont-bottom"/>
	</div>
</div>
<div style="clear:both">&nbsp;</div>
</div>	

<div id="footer">
&copy; 2010 SASTRA University - SRC Campus&nbsp; | &nbsp;Engineered By GLOSS Community | <a href="../bug_filing.php?ref=staff" target="_blank">Report Bugs</a> | <a href="../feedback.php" target="_blank">Feedback</a> | <a href="../credits.php" target="_blank">Credits</a>
</div>
</div>
</div>
</body>