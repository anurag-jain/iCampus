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
$staff = new staff_class($staffid,$staffname,$department);
$security=new security_class($staffid);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Listview</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="../images/header.png" alt="sastra university"/></center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome Staff,</div>
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
	  <h2 class='heading'>Timetable - List View</h2>
    <?php  
    $listview=$_SESSION['listview'];
    $startdate=$_SESSION['startdate'];
    $c=0;
    ?>
    <table width="626" height="68" border="1" align="center" cellpadding="0" cellspacing="0">
	    <tr>
          <th width="71"><div align="center" style="color:#FFF">Date</div></td>
          <th width="83"><div align="center" style="color:#FFF">Day</div></td>
          <th width="81"><div align="center" style="color:#FFF">Period</div></td>
          <th width="284"><div align="center" style="color:#FFF">Course and Section</div></td>
          <th width="250"><div align="center" style="color:#FFF">Post Attendence</div></td>
        </tr>
  <?php
 
  for($i=0;$i<7;$i++)
  {
	  for($j=1;$j<12;$j++)
	  {
		  if($listview[$i]['course'][$j]!="" && strtotime($listview[$i]['date'][$j])>=strtotime($startdate))
		  {
  ?>
      <tr>
        <td><div align="center"><?php echo $listview[$i]['date'][$j];?></div></td>
        <td><div align="center"><?php echo $listview[$i]['day'][$j];?></div></td>
        <td><div align="center"><?php echo $j ;?></div></td>
        <td><div align="center"><?php echo $listview[$i]['course'][$j];?></div></td>
        <td><div align="center">
          <?php if($staff->getFlag($listview[$i]['date'][$j],substr($listview[$i]['day'][$j],0,3)."-".$j)){?>
          <a href="staff_attendance_list.php?pid=
		<?php echo $listview[$i]['link1'][$j]."-".$j;?>&date=<?php echo $listview[$i]['link2'][$j];?>">
            <?php 
			}?>
            Post Attendence</a></div></td>
 	  </tr>
  <?php 
  		 } 
      }
  }
  ?>
 </table>
    <p>&nbsp;</p>
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