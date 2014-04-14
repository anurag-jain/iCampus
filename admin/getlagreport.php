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
<?php 
}
require_once('../db_config.php');
include ('../staff/security_class.php');
$sectionid=$_POST['sec'];
//$security=new security_class($sectionid);
$prog=$_POST['prog'];
$dept=$_POST['dept'];
$query="SELECT sectionmaster.section,program_master.year from sectionmaster,program_master where sectionmaster.program_id=program_master.program_id and sectionmaster.section_id='$sectionid'";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
SASTRA University - SRC
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<div id="wrapper_outer"><div id="wrapper">
<div id="header"><center><img src="../images/header.png" alt="sastra university"/></center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Welcome <?php echo $user; ?></strong></div>
<div id="menu">
		<img src="../images/Sastra1.png" width="170" alt="sastra university" />
		<div class="clear"></div>
		<img src="../images/menu-top.png" alt="menu-top"/>
			<div id="nav">
			 <ul>
        <li><a href="admin_index.php">Home</a></li>
        <li><a href="password_reset.php">Reset Password</a></li>
        <li><a href="lock_reset.php">Set / Reset Locks</a></li>
        <li><a href="admin_service_index.php">Services &amp; Facts</a></li>
        <li><a href="change_day_order.php">Change Day Order</a></li>
        <li><a href="admin_modify_index.php">Modify Records</a></li>
        <li><a href="lagreport.php">Get Lag Report</a></li>
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
	<h2 class='heading'>Overall Lag Report</h2>
    <h2 class='heading'><?php echo $prog."-".$dept."-".$row[1]."-".$row[0]; ?></h2>
 	<div id="staff-cia-post">
	<table width=98% cellspacing=1 cellpadding=0 align="center" id="mytable">
<tr>
<th>Sno</th>
<th>Regnumber</th>
<th>Name</th>
<th>Attendance Percentage</th>
</tr>
<?php 
$students_section="SELECT relation.regnumber,studentmaster.studentname from relation,studentmaster where relation.section_id='$sectionid' and relation.regnumber=studentmaster.regnumber";
$students_query=mysql_query($students_section);
$i=1;
while($students_row=mysql_fetch_array($students_query))
{
$present_query="select count(present) from attendance where ".
				"relationid in(select relationid from relation where section_id='$sectionid' and regnumber='$students_row[0]') and present='1'";
				
$present_result=mysql_query($present_query);
$present_row=mysql_fetch_array($present_result);




$total_query="select count(present) from attendance where ".
				"relationid in(select relationid from relation where section_id='$sectionid' and regnumber='$students_row[0]') ";
				
$total_result=mysql_query($total_query);
$total_row=mysql_fetch_array($total_result);
if($present_row[0]!='0' && $total_row[0]!='0')
{
	$percentage=round((($present_row[0]/$total_row[0])*100),2);
		if($percentage<=75)
		{
					if(($i++)%2==0)
						$class='even';
					else
						$class='odd';
						
  				echo "<tr class='$class'>";
?>
<td><?php echo $i; ?></td>
<td><?php echo $students_row[0]; ?></td>
<td><?php echo $students_row[1]; ?></td>
<td><?php echo $percentage; ?></td></tr>
<?php 
		}
		else {
			?>
			<div class="msg">No lag so far!!</div>
			<?php 
			break;
		}
	}	
else {
?>
<div class="msg">Data Not Found!!</div>
<?php 
break;
} 
	
$i++;
}
?>
</table>
  </div>
  <label><a href="htmllagreport.php?value=<?php echo $sectionid.",".$dept.",".$prog ; ?>" target="_blank"><br />
              <img src="../images/pdf.jpg" alt="PDF" width="30" height="30" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="printlagreport.php?value=<?php echo $sectionid.",".$dept.",".$prog ; ?>" target="_blank"><img src="../images/printer.jpg" alt="PRINT" width="30" height="30" /></a></label>
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