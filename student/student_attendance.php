<?php
/*
Author : KP
*/

session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['type']=='student')
{
$user=$_SESSION['username'];
$username=$_SESSION['studentname'];
$pass=$_SESSION['password'];
}
else { ?>
<script>
alert("Session Expired!!!");
window.location="../index.php";
</script>
<?php 
}
$regnumber=$user;
$studentname=$username;
include_once("../db_config.php");
include('student_class.php');
$student=new student_class($user,$pass);
$student->setValues();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title>
SASTRA University - SRC
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="../images/header.png" alt="sastra university"/></center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome <?php $name=$student->getUsername();echo $name; ?>,</div>
<div id="menu">
		<img src="../images/Sastra1.png" width="170" alt="sastra university" />
		<div class="clear"></div>
		<img src="../images/menu-top.png" alt="menu-top"/>
			<div id="nav">
			<ul>
				<li><a href="student_home.php">Home</a></li>
                <li><a href="student_attendance.php">Attendance</a></li>
				<li><a href="student_absentinfo.php">Absent Details</a></li>
				<li><a href="student_timetable.php" target="_blank">Timetable</a></li>
				<li><a href="student_internals.php">CIA Marks</a></li>
                <li><a href="student_profile.php">View Profile</a></li>
				<li><a href="../logout.php">Sign Out</a></li>
			</ul>
			</div>
		<img src="../images/menu-bottom.png" alt="menu-bottom"/>
	</div>
<div id="content">
	<div id="main">
	<img src="../images/cont-top.png" alt="cont-top"/>
	<!--Write code here!-->
	<div id="attendance" class="main">
		<h2 class='heading'>Attendance</h2>	
			<?php
				require_once('../db_config.php');
				$ATTENDANCE_PERCENT=75;
				$totaldata=$student->getTotalClasses();
				if($totaldata) {
					$totalWorking=0;
					$totalPresent=0;
					$totalCredits=0;
					echo '<table cellpadding="0" cellspacing=1 align=center width=90%>';
					echo '<th>Course Code</th>';
					echo '<th>Course Name</th>';
					echo '<th>Credits</th>';
					echo '<th>No Of Present</th>';
					echo '<th>No Of Absent</th>';
					echo '<th>Total Classes</th>';
					echo '<th>Present %</th>';
					echo '<th>Last Updated</th>';
					$s=1;
					$fetch = true;
					
					while($rowtotal=mysql_fetch_row($totaldata)) {
						
						if(($s++)%2==0)
							$class='even';
						else
							$class='odd';
						$lastQuery = "select date from remark where coursecode = '$rowtotal[0]' and section_id = '$rowtotal[1]' order by date desc limit 1";
						
						$lastResult=mysql_query($lastQuery) or die("error");	
						if($lastResult && mysql_num_rows($lastResult)==1){
							$lastdate=mysql_fetch_row($lastResult);
							$lastdate = $lastdate[0];
							
							$today = date_parse_from_format('Y-m-d',date('Y-m-d'));
							$lDate = date_parse_from_format('Y-m-d',$lastdate);
							$days = gregoriantojd($today[month],$today[day],$today[year])- gregoriantojd($lDate[month],$lDate[day],$lDate[year]);
							$weeks = $day/7;
							$days = $days%7;
							$lastdate = " ";
							if($weeks!=0)
								$lastdate=$lastdate.$weeks." weeks".",";
							if($days!=0)
								$lastdate=$lastdate.$days." days";
							else if($days==0 && $week==0)
								$lastdate="today";
							if($days==0 && $week==0);
							else
								$lastdate=$lastdate." ago";
						}
						else
							$lastdate="Not Found";
						
						$abs=$rowtotal[4]-$rowtotal[3];
						$per=round((100*$rowtotal[3]/$rowtotal[4]),2);
						$value="<td>$rowtotal[0]</td>"
								."<td>$rowtotal[2]</td>"
								."<td>$rowtotal[5]</td>"
								."<td>$rowtotal[3]</td>"
								."<td>$abs</td>"
								."<td>$rowtotal[4]</td>"
								."<td>$per</td>"
								."<td>$lastdate</td>";
						if($per<$ATTENDANCE_PERCENT)
							$class=$class.' limitcrossed';
						echo "<tr class='$class'>$value</tr>";
						$totalWorking=$totalWorking+$rowtotal[3];
						$totalPresent=$totalPresent+$rowd[3];
						$totalCredits=$totalCredits+$rowd[2];
						
					}
						if(($s++)%2==0)
							$class='even';
						else
							$class='odd';
						$per=round((100*$totalPresent/$totalWorking),2);
						$value="<td>&nbsp;</td>"
								."<td>Total</td>"
								."<td>$totalCredits</td>"
								."<td>$totalPresent</td>"
								."<td>".($totalWorking-$totalPresent)."</td>"
								."<td>$totalWorking</td>"
								."<td>".$per."</td><td>&nbsp;</td>";
							if($per<$ATTENDANCE_PERCENT)
							$class=$class.' limitcrossed';
						echo "<tr class='$class'>$value</tr>";
					echo '</table>';
				}
				else 
					echo '<div class="msg">No Course Found</div>';
				
			?>
		</div>
		<!--It Ends!-->
	<img src="../images/cont-bottom.png" alt="cont-bottom"/>
	</div>
</div>
<div style="clear:both">&nbsp;</div>
</div>	

<div id="footer">
&copy; 2010 SASTRA University - SRC Campus&nbsp; | &nbsp;Engineered By GLOSS Community | <a href="../bug_filing.php?ref=student" target="_blank">Report Bugs</a> | <a href="../feedback.php" target="_blank">Feedback</a> | <a href="../credits.php" target="_blank">Credits</a>
</div>
</div>
</body>
</html>
