<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['type']=='administrator')
{
$user=$_SESSION['username'];
}
else { ?>
<script>
alert("Session Expired!!!");
window.location="../index.php";
</script>
<?php }
$staffid = $_POST['staffid'];
include ('../staff/staff_class.php');
include ('../staff/security_class.php');
require_once('../db_config.php');
$query_class = "SELECT staffid,staffname,department,password from staff_master where staffid = '$staffid'";
$result_class = mysql_query($query_class);
$row = mysql_fetch_row($result_class);
echo "($row[0],$row[1],$row[2],$row[3])";
$staff = new staff_class($row[0],$row[1],$row[2],$row[3]);
$security=new security_class($row[0]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title>
SASTRA University - SRC
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script language="javascript">
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
				c++;
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
		<h2 class='heading'>Update Attendance</h2>
          
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
			//echo $date;
			$updateList=$staff->updateList($date,$pid);
			
			
			if($updateList[1][2]!="" && $updateList[1][2]!="")
			{
		?>   
        <form name="form1" action="update_done.php" method="POST">
		<div id="staff-sum">
						<p>
            	Total Present : <span id="totalpresent"><?php echo $i-1;?></span>
			</p>
            <p>
            	Total Absent : <span id="totalabsent">0</span>
			</p>
			<p>
				Total Students : <span id="totalstudent"><?php echo $i-1;?></span>
			</p>
			  <input type='submit' value='Post' id='submit' name='submit' />
  &nbsp;			</p>
        </div>
		<div id="staff-student-list">
		<table cellpadding=0 cellspacing=1 width=100%>
			<th>S No</th>
			<th>Reg No</th>
			<th>Student Name</th>
			<th>Present</th>
            <?php
			
			$i=1;
			while($updateList[$i][2]!='$' && $updateList[$i][3]!='$')
			{
			?>
			<tr <?php if($i%2!=0) {?>class='odd'<?php } else {?>class='even'<?php }?>>
                <td><?php echo $i; ?></td>
                <td><?php echo $updateList[$i][2];?></td>
                <td><?php echo $updateList[$i][3]; ?></td>
                <td>
				<?php
                   if($updateList[$i][1]==1)
                     $chk = "checked";
                   else
                     $chk = "";//"unchecked";
                 ?>
           <input name="<?php  echo $i; ?>" type="hidden"  value="<?php echo $updateList[$i][0]."-A-".$updateList[$i][2];?>" />
           <input name="<?php echo $i; ?>" type="checkbox" <?php echo $chk; ?> value="<?php echo $updateList[$i][0]."-P-".$updateList[$i][2];?>" onClick="totalPresent()"/>
         		</td>
            </tr>
         	<?php  $i++;}?>
			
		</table>
		</div>
        
		 </form>
   <?php }?>
	</div>
   
	<!--It Ends!-->
	<img src="../images/cont-bottom.png" alt="cont-bottom"/>
	</div>
</div>

<div style="clear:both">&nbsp;</div>
</div>	

<div id="footer">
&copy; 2010 SASTRA University - SRC Campus&nbsp; | &nbsp;Engineered By GLOSS Community | <a href="../bug_filing.php?ref=admin" target="_blank">Report Bugs</a> | <a href="../feedback.php" target="_blank">Feedback</a> | <a href="../credits.php" target="_blank">Credits</a>
</div>
</div>
</div>
</body>
</html>
