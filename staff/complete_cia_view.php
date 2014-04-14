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
include ('security_class.php');
$security=new security_class($staffid);
include('relation_class.php');
$details=$_GET['value'];
$details=urldecode($details);
$details=explode(",",$details);
	$midsem_name=$details[3];
	$section_id=$details[2];
	$coursecode=$details[1];
	$sno=0;
	//$a='0000-00-00 00:00:00';
$relation_obj1 = new relation_class();
$students=$relation_obj1-> listofstudents_staff($staffid,$section_id,$coursecode);
$cia_update=$relation_obj1->check_cia_update($staffid,$section_id,$coursecode,$midsem_name);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
SASTRA University - SRC
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="../images/header.png" alt="sastra university"/></center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Welcome <?php echo $staffname; ?></strong></div>
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
    <div  class="main">
	<div id="staff-cia-post">
	<h2 class='heading'>CIA-Cumulative View</h2>
    <?php 
if($cia_update!=null) 
{
$row1=mysql_fetch_row($cia_update);
	$marks=$relation_obj1-> getmidsem_marks($staffid,$section_id,$coursecode,$midsem_name);
	$cfquery="select max_midsem1,max_midsem2,max_midsem3,max_internals,conv_midsem1,conv_midsem2,conv_midsem3,conv_internals from midsem_post "
					." where staffid='$staffid' and section_id='$section_id' and coursecode='$coursecode' ";
		$cfresult=mysql_query($cfquery);
		$cfvalue=mysql_fetch_array($cfresult);
		$cf1=$cfvalue[4]/$cfvalue[0];
		$cf2=$cfvalue[5]/$cfvalue[1];
		$cf3=$cfvalue[6]/$cfvalue[2];
		$cf4=$cfvalue[7]/$cfvalue[3];
?>
	<table width="600" cellspacing=1 cellpadding=0 align="center" id="mytable">
	<th>Sno</th>
	<th>Regno</th>
	<th>Name</th>
	<th>Midsem-I
	<table width="100%">
	<th width="50%">(<?php echo $cfvalue[0]; ?>)</th>
	<th width="50%">(<?php echo $cfvalue[4]; ?>)</th>
	</table>
	</th>
	<th>Midsem-II
	<table width="100%">
	<th width="50%">(<?php echo $cfvalue[1]; ?>)</th>
	<th width="50%">(<?php echo $cfvalue[5]; ?>)</th>
	</table>
	</th>
	<th>Midsem-III
	<table width="100%">
	<th width="50%">(<?php echo $cfvalue[2]; ?>)</th>
	<th width="50%">(<?php echo $cfvalue[6]; ?>)</th>
	</table>
	</th>
	<th>Assignments(<?php echo $cfvalue[7]; ?>)</th>
	<th>Total</th>
<?php
	while($row2=mysql_fetch_array($students) and $row3=mysql_fetch_array($marks))
	{ 
	if(($sno++)%2==0)
		$class='odd';
	else
		$class='even';
	echo "<tr class='$class'>";
?>
	<td><?php echo $sno; ?></td>
	<td><?php echo $row2[1]; ?></td>
	<td><?php echo ucwords($row2[0]); ?></td>
	<td>
	<table width="100%">
    <tr>
	<td width="50%"><?php
	if($row3[0]==-1)
	$row3[0]=0;  
    if($row3[0]=='121')
				{ 
				echo "<span class='mandatory' style='display:inline'>Absent</span>"; 
				}
				
				else { 
				echo ($row3[0]/$cf1); 
				}?>
    </td>
	<?php //Midsem 2 ?>
	<td width="50%"><?php if($row3[0]=='121')
				{ 
				echo "<span class='mandatory' style='display:inline'>Absent</span>"; 
				}
				else { echo $row3[0]; }?></td>
	</tr>
    </table>
	</td>
	<td>
	<table width="100%">
    <tr>
	<td width="50%"><?php
	if($row3[1]==-1)
	$row3[1]=0;  
  
    if($row3[1]=='121')
				{ 
				echo "<span class='mandatory' style='display:inline'>Absent</span>"; 
				}
				else { echo ($row3[1]/$cf2); }?>
    </td>
	<td width="50%"><?php if($row3[1]=='121')
				{ 
				echo "<span class='mandatory' style='display:inline'>Absent</span>"; 
				}
				else { echo $row3[1]; }?></td>
	</tr>
    </table>
	</td>
	<?php //Midsem 3 ?>
	<td>
	<table width="100%">
    <tr>
	<td width="50%"><?php
	if($row3[2]==-1)
	$row3[2]=0;  
  
    if($row3[2]=='121')
				{ 
				echo "<span class='mandatory' style='display:inline'>Absent</span>"; 
				}
				else { echo ($row3[2]/$cf3); }?>
    </td>
	<td width="50%"><?php if($row3[2]=='121')
				{ 
				echo "<span class='mandatory' style='display:inline'>Absent</span>"; 
				}
				else { echo $row3[2]; }?></td>
	</tr>
    </table>
</td>
<?php //Assignment ?>
	<td><?php 
	if($row3[3]=='121'){
	$row3[3]=0;
	echo "<span class='mandatory' style='display:inline'>Absent</span>"; 
	}
	else if($row3[3]=='-1'){
	$row3[3]=0;
	echo $row3[3];
	}
	else
	echo ($row3[3]/$cf3);; 
	?></td>
	<?php 
	$marks_sort=array();
	$marks_sort[0]=$row3[0];
	$marks_sort[1]=$row3[1];
	$marks_sort[2]=$row3[2];
	$i=0; 
	while($i<=2)
	{
		if($marks_sort[$i]==121)
		{
		$marks_sort[$i]=0;
		}
		$i++;
	}
	sort($marks_sort);
?>
	<td><?php
	$p= $marks_sort[1] + $marks_sort[2] + $row3[3];
	echo $p;
?>
	</td>
	</tr>
<?php
 }
 ?>
</table>
<?php
}  
 else {
?>
<div class="msg">Data Not Found!!</div>
<?php } ?>
</div>
<!-- <label><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="cia_report.php?value=<?php echo $staffid.",".$midsem_name.",".$section_id.",".$coursecode;  ?>" target="_blank"><img src="../images/pdf.jpg" alt="PDF" width="30" height="30" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="cia_print.php?value=<?php echo $staffid.",".$midsem_name.",".$section_id.",".$coursecode;  ?>" target="_blank"><img src="../images/printer.jpg" alt="PRINT" width="30" height="30" /></a></label>!-->
	<img src="../images/cont-bottom.png" alt="cont-bottom"/>	</div>
</div>
<div style="clear:both">&nbsp;</div>
</div>	

<div id="footer">
Copyright 2009-10 SASTRA University - SRC Campus&nbsp; | &nbsp;Powered By GLOSS Community&nbsp;&nbsp;&nbsp;&nbsp;
</div>
</div>
</body>
</html>


