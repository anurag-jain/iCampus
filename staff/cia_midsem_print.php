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
ob_start();
include_once("../db_config.php");
include('relation_class.php');
//$staffid='C003';
//$coursecode='BICCIC601';
//$section_id=1;
$details=$_GET['value'];
$details=explode(",",$details);
	$midsem_name=$details[1];
	$section_id=$details[2];
	$coursecode=$details[3];
	$staffid=$details[0];
	$sno=0;
	//$a='0000-00-00 00:00:00';
$relation_obj1 = new relation_class();
$students=$relation_obj1-> listofstudents_staff($staffid,$section_id,$coursecode);
$marks=$relation_obj1-> getmidsem_marks($staffid,$section_id,$coursecode,$midsem_name);
$name=$relation_obj1->getstaff_name($staffid);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
SASTRA University - SRC
</title>
<script type="text/javascript">
window.onload=function(){
	window.print();
};
</script>
</head>
<body>
<div>
  <table width="668" height="136" align="center">
    <tr>
    <td width="735"><div align="center">SASTRA UNIVERSITY</div></td>
    </tr>
    <tr>
      <td><div align="center">SRINIVASA RAMANUJAN CENTRE,KUMBAKONAM</div></td>
    </tr>
    <tr>
      <td><div align="center">STUDENTS CIA REPORT</div></td>
    </tr>
    
  </table>
</div>
<?php 
$cfquery="select max_midsem1,max_midsem2,max_midsem3,max_internals,conv_midsem1,conv_midsem2,conv_midsem3,conv_internals from midsem_post "
					." where staffid='$staffid' and section_id='$section_id' and coursecode='$coursecode' ";
		$cfresult=mysql_query($cfquery);
		$cfvalue=mysql_fetch_array($cfresult);
		switch($midsem_name)
		{
		case 1:
		$cf1=$cfvalue[4]/$cfvalue[0];
		break;
		case 2:
		$cf2=$cfvalue[5]/$cfvalue[1];
		break;
		case 1:
		$cf3=$cfvalue[6]/$cfvalue[2];
		break;
		case 1:
		$cf4=$cfvalue[7]/$cfvalue[3];
		break;

		}
?>	
<p>StaffId: <?php echo $staffid; ?></p>
<p>Name: <?php echo $staffname; ?></p>
<p><?php echo "Mark List For CIA-".$midsem_name; ?></p>
<p>Course: <?php echo $coursecode; ?></p>
<table border="1" cellspacing="0" cellpadding="2" width="700px">
<tr>
<td><b>Sno</b></td>
<td><b>Regno</b></td>
<td><b>Name</b></td> 
<td><b>
<?php
switch($midsem_name)
{
case 1:
echo "For $cfvalue[0] ";
break; 
case 2:
echo "For $cfvalue[1] ";
break; 
case 3:
echo "For $cfvalue[2] ";
break; 
}?>
</b></td>
<td><b>
<?php 
switch($midsem_name)
{
case 1:
echo "For $cfvalue[4] ";
break; 
case 2:
echo "For $cfvalue[5] ";
break; 
case 3:
echo "For $cfvalue[6] ";
break; 
}?>
</b></td>
</tr>
<?php
while($row2=mysql_fetch_array($students) and $row3=mysql_fetch_array($marks))
{ 
	$sno++;
	
?>
<tr>
<td><?php echo $sno; ?></td>
<td><?php echo $row2[1]; ?></td>
<td><?php echo ucwords($row2[0]); ?></td>
<td align="center">
	<?php  
    if($row3[0]=='121')
				{ 
				echo "<span>A</span>"; 
				}
				else { 
				if($midsem_name=='1')
				echo ($row3[0]/$cf1);
				if($midsem_name=='2')
				echo ($row3[0]/$cf2);
				if($midsem_name=='3')
				echo ($row3[0]/$cf3);

				}
	?>
</td>    
<td align="center">
	<?php if($row3[0]=='121')
				{ 
				echo "<span>A</span>"; 
				}
				else { echo $row3[0]; }?>
</td>
</tr>
<?php
 }
 ?>
</table>

</div>
</body>
</html>
<?php 
if($midsem_name==1){
file_put_contents('cia1-report.html',ob_get_clean()); 
echo "<meta http-equiv='refresh' content='0;url=cia1-report.html'>"; }
if($midsem_name==2){
file_put_contents('cia2-report.html',ob_get_clean()); 
echo "<meta http-equiv='refresh' content='0;url=cia1-report.html'>"; }
if($midsem_name==3){
file_put_contents('cia3-report.html',ob_get_clean()); 
echo "<meta http-equiv='refresh' content='0;url=cia1-report.html'>"; }
if($midsem_name==4){
file_put_contents('cia4-report.html',ob_get_clean()); 
echo "<meta http-equiv='refresh' content='0;url=cia1-report.html'>"; }
?>