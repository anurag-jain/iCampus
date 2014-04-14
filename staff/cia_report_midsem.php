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
</head>
<body>
<div>
  <table width="735" height="80" align="center">
    <tr >
    <td rowspan="3" width="80"><center><img src="sastra.jpg" alt="sastra img"/></center></td>
    <td width="645"><center>SASTRA UNIVERSITY</center></td>
    </tr>
    <tr>
      <td><center>SRINIVASA RAMANUJAN CENTRE,KUMBAKONAM</center></td>
    </tr>
    <tr>
      <td><center>STUDENTS CIA REPORT</center></td>
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
<td><b><?php 
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
<?php file_put_contents('write.html',ob_get_clean()); ?>


<?php
ini_set("memory_limit","100M");
require('pdfwrite/html2fpdf.php');
$pdf=new HTML2FPDF();
$pdf->AddPage();
$fp = fopen("write.html","r");
$strContent = fread($fp, filesize("write.html"));
fclose($fp);
$pdf->WriteHTML($strContent);
if($midsem_name==1){
$dest1="../reports/cia-I-report-".$staffid."-".$coursecode.".pdf";
$dest2="../reports/cia-II-report-".$staffid."-".$coursecode.".pdf";
$dest3="../reports/cia-III-report-".$staffid."-".$coursecode.".pdf";
$dest4="../reports/assign-report-".$staffid."-".$coursecode.".pdf";

$pdf->Output($dest1);
echo "<meta http-equiv='refresh' content='0;url=/reports/cia-I-report-$staffid-$coursecode.pdf'>"; }
if($midsem_name==2){
$pdf->Output($dest2);
echo "<meta http-equiv='refresh' content='0;url=/reports/cia-II-report-$staffid-$coursecode.pdf'>"; }
if($midsem_name==3) {
$pdf->Output($dest3);
echo "<meta http-equiv='refresh' content='0;url=/reports/cia-III-report-$staffid-$coursecode.pdf'>"; }
if($midsem_name==4){
$pdf->Output($dest4);
echo "<meta http-equiv='refresh' content='0;url=/reports/assign-report-$staffid-$coursecode.pdf'>"; }

?>