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
$pass=$_SESSION['password'];
include ('staff_class.php');
include ('security_class.php');
$staff = new staff_class($staffid,$staffname,$department,$pass);
$security=new security_class($staffid);
?>
<!--Author: Anurag Jain-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Post Attendance</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="../images/header.png" alt="sastra university"/></center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome <?php echo $staffname; ?></div>
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
	<div id="studenthome" class="main">
	  <h2 class='heading'>Current attendance</h2>
	    <?php 
			$lockdays=$staff->returnLockdays();
			$date=$staff->dateCalculation($lockdays);
			$day=array();
			$startdate=$staff->returnStartdate();
			for($i=0;$i<$lockdays;$i++)
			{
				$day[$i]=strtolower($date[$lockdays-$i-1][0][0]).$date[$lockdays-$i-1][0][1].$date[$lockdays-$i-1][0][2];
			}
		   $timetable=$staff->displayTimetable();
		?>
		<div id="attendance-tt">
	  <table width="1170" cellpadding="0" cellspacing="1" class="timetable" id="timetable">
			  <!-- !!!!check css classes and use them!!!!  !-->
			  <!-- Heading !-->
				<th width="110px">&nbsp;</th>
                <th width="110px">&nbsp;0&nbsp;</th>
			    <th width="110px">&nbsp;I&nbsp;</th>
			    <th width="110px">&nbsp;II&nbsp;</th>
			    <th width="110px">&nbsp;III&nbsp;</th>
			    <th width="110px">&nbsp;IV&nbsp;</th>
			    <th width="110px">&nbsp;V&nbsp;</th>
			    <th width="110px">&nbsp;VI&nbsp;</th>
			    <th width="110px">&nbsp;VII&nbsp;</th>
			    <th width="110px">&nbsp;VIII&nbsp;</th>
			    <th width="110px">&nbsp;IX&nbsp;</th>
			    <th width="110px">&nbsp;X&nbsp;</th>
			    <th width="110px">&nbsp;XI&nbsp;</th>
			    <th width="110px">&nbsp;XII&nbsp;</th>
                <th width="110px">&nbsp;XIII&nbsp;</th>
                <th width="110px">&nbsp;XIV&nbsp;</th>
             
             
             
		        <!-- Content !-->
              <?php
			  //echo "people".$date[6][2];
			  for($i=0;$i<$lockdays;$i++)
			  	{
				if(strtotime($date[$lockdays-$i-1][1]) >= strtotime($startdate))	
				{
			  ?>
			  <tr>
             
			    <td>
			    <?php 
				echo $date[$lockdays-$i-1][0],"<br>" , $date[$lockdays-$i-1][1];?></td>
              <?php for($j=1;$j<=15;$j++)
			  {
			  ?>
			    <td class="staff-tt-td" style="font-size:80%">
				<?php 
				if($timetable[$day[$i]][$j]!=""){
				if($staff->validateCourseStart($timetable[$day[$i]][$j],$date[$lockdays-$i-1][1])==true){ 
				if($staff->getFlag($date[$lockdays-$i-1][1],$day[$i]."-".($j-1))=="true") {
				?>
                <a  href="staff_attendance_list.php?pid=
				<?php
				echo urlencode($security->encrypt($day[$i])),"-",($j-1);
				?>&date=
				<?php
				echo urlencode($security->encrypt($date[$lockdays-$i-1][1]));
				?> " title="Click here to post attendance">
		        <?php 
				echo $timetable[$day[$i]][$j];
				} 
				else if($staff->getFlag($date[$lockdays-$i-1][1],$day[$i]."-".($j-1))=="false") {
					echo "<a style=\"background:#93d48d\" href=\"modify_attendance_done.php?date=>"
					,urlencode($security->encrypt($date[$lockdays-$i-1][1]))."&pid="
					,urlencode($security->encrypt($day[$i]."-".($j-1)))
					,"\" title=\"Click here to modify attendance.\">"
					,$timetable[$day[$i]][$j],"</a>";

					 } 
				else if($staff->getFlag($date[$lockdays-$i-1][1],$day[$i]."-".($j-1))=="ignored")
				{
					echo "<div class='staff-tt-empty'>&nbsp;</div>";
					}
				}
				}
				else{ echo "<div class='staff-tt-empty'>&nbsp;</div>";}?>
			    </a></td>
                <?php }?>
          </tr>
			  <?php 
			  }}
			  ?>
	    </table>
		</div>
              <p>&nbsp;</p>
              <?php 
			  $pendingDate=$date[$lockdays][1];
			  $pending=array(array());
			  $pending=$staff->getPeriods($pendingDate,$startdate);
				   
			 
			  ?>
              <a name="pending"></a>
        <h2 class='heading' name="pending">Pending Attendance</h2>
        <div style="overflow:auto; height:362px; width:769px; margin-left:15px;">
          <table width="749" border="1" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <th width="110">Date</th>
                  <th width="108">Day</th>
                  <th width="113">Period</th>
                  <th width="218">Course and Section</th>
                  <th width="123">Post attendence</th>
              </tr>
                <?php	$i=0;
				while($pending['date'][$i]!="" && $pending['day'][$i]!="" && $pending['period'][$i]!="" && $pending['course'][$i]!="")
					{	
					$part=explode('-',$pending['date'][$i]);
					$pending['date'][$i]=$part[2]."-".$part[1]."-".$part[0];
					//echo "date going".$pending['date'][$i]."<br>";
					//echo $pending['period'][$i];
               if($staff->getFlag($pending['date'][$i] , $pending['period'][$i])=="true")
				{
				?>
                <tr <?php if($i%2!=0) {?>class='odd'<?php } else {?>class='even'<?php }?>>
                  <td><?php echo $pending['date'][$i]; ?></td>
                  <td><?php echo $pending['day'][$i]; ?></td>
                  <td><?php echo substr($pending['period'][$i],4,2);?></td>
                  <td><?php echo $pending['course'][$i];?></td>
                  <td><?php if($staff->getStafflock()==0){?>
                  <a href="staff_attendance_list.php?pid=<?php echo urlencode($security->encrypt(substr($pending['period'][$i],0,3))),"-"
				  ,substr($pending['period'][$i],4,2),"&date=",urlencode($security->encrypt($pending['date'][$i]));?>" title="Click here to post pending attendance. "><?php }?>Go</a></td>
                </tr>
                <?php }$i++;}?>
        </table>
        </div>
	<!--It Ends!-->
    </div>
	<img src="../images/cont-bottom.png" alt="cont-bottom"/>
	</div>
</div>
<div style="clear:both">&nbsp;</div>
</div>	

<div id="footer">
&copy; 2010 SASTRA University - SRC Campus&nbsp; | &nbsp;Engineered By GLOSS Community | <a href="../bug_filing.php?ref=staff" target="_blank">Report Bugs</a> | <a href="../feedback.php" target="_blank">Feedback</a> | <a href="../credits.php" target="_blank">Credits</a>
</div>
</div>
</body>
</html>