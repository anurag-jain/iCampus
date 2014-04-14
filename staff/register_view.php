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
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title>
SASTRA University - SRC
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script language="javascript">

window.onload=totalPresent;

function totalPresent()
{
	var t=0;
	var c=0;
	var chkbox=document.getElementsByTagName('input');
	for(var i=0;i<chkbox.length;i++)
	{
		if(chkbox[i].type=="checkbox") {
			t++;
			if(chkbox[i].checked==true)
			{
				c++;
			}
		}
	}
	document.getElementById("totalpresent").innerHTML=c;
	document.getElementById('totalstudent').innerHTML=t;
	document.getElementById("totalabsent").innerHTML=t-c;
	
}

</script>
</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="../images/header.png" alt="sastra university"/></center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome <?php echo $staffname;?>,</div>
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
  <?php
  			$date=$_GET['date'];
			$pid=$_GET['pid'];
			$date=$security->decrypt(urldecode($date));
			$pid=$security->decrypt(urldecode($pid));
			$day=date('D',strtotime($date));
			$_SESSION['date']=$date;
			$_SESSION['pid']=$pid;
			//echo $var;
			$part=explode('-',$date);
			$date=$part[2]."-".$part[1]."-".$part[0];
  
  ?>
	<div id="studenthome" class="main">
		<h2 class='heading'>Date :<?php echo $date;?></h2>
          
        <?php

			//echo $date;
			$updateList=$staff->updateList($date,$pid);
			
			
			
		?>   
        <form name="form1" action="update_done.php" method="POST">
          <table width="600" border="0" align="center" cellpadding="1" cellspacing="0" style="border:#630 dashed">
            <tr>
              <th width="57">S. No</th>
              <th width="148">Reg No</th>
              <th width="239">Student Name</th>
              <th width="148">Present / Absent</th>
            </tr>
            <?php
            $i=1;
			while($updateList[$i][2]!='$' && $updateList[$i][3]!='$')
			{
			?>
            <tr <?php if($i%2!=0) {?>class='odd'<?php } else {?>class='even'<?php }?>>
              <td><?php echo $i; ?></td>
              <td><?php echo $updateList[$i][2];?></td>
              <td><?php echo $updateList[$i][3];?></td>
              <td><?php 
                   if($updateList[$i][1]==1)
                     echo "P";
                   else
                     echo "A";
			?> </td>
            </tr>
            <?php $i++;}?>
          </table>
        </form>
 
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
</html>
