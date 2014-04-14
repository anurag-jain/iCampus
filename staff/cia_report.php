<?php
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
$relation_obj1 = new relation_class();
$students=$relation_obj1-> listofstudents_staff($staffid,$section_id,$coursecode);
$marks=$relation_obj1-> getmidsem_marks($staffid,$section_id,$coursecode,$midsem_name);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
SASTRA University - SRC
</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
<!--
.style1 {
	font-family: "Times New Roman", Times, serif;
	font-size: xx-large;
}
-->
</style>
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
      <td><div align="center">STUDENTS CUMULATIVE CIA REPORT</div></td>
    </tr>
    
  </table>
</div>

<table border="1" cellspacing="0" cellpadding="2" width="980px">
<tr>
<td rowspan="2" width="40px"><b>Sno</b></td>
<td rowspan="2" width="110px"><b>Regno</b></td>
<td rowspan="2" width="350px"><b>Name</b></td>
<td colspan="2" width="120px"><b>CIA-I</b></td>
<td colspan="2" width="120px"><b>CIA-II</b></td>
<td colspan="2" width="120px"><b>CIA-III</b></td>
<td rowspan="2" width="120px"><b>Assignment</b></td>
<td rowspan="2" width="80px"><b>Total</b></td>
</tr>
<tr>
<td width="60px">For 50</td>
<td width="60px">For 20</td>
<td width="60px">For 50</td>
<td width="60px">For 20</td>
<td width="60px">For 50</td>
<td width="60px">For 20</td>
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
<td>
	<?php  
    if($row3[0]=='121'){ 
		echo "A"; 
	}
	else {
		echo ($row3[0]*(10/4)); 
	}
	?>
</td>
<td>
	<?php 
	if($row3[0]=='121'){ 
		echo "A"; 
	}
	else { 
	echo $row3[0];
	}
	?>
</td>
<td>
<?php  
    if($row3[1]=='121'){ 
		echo "A"; 
	}
	else {
		echo ($row3[1]*(10/4));
	}
	?>
</td>
<td>
<?php 
	if($row3[1]=='121'){ 
		echo "A"; 
	}
	else { 
		echo $row3[1]; 
	}
	?>
</td>
<td>
<?php  
    if($row3[2]=='121')	{ 
		echo "A"; 
	}
	else { 
		echo ($row3[2]*(10/4)); 
	}
	?>
</td>
<td>
<?php 
	if($row3[2]=='121'){ 
		echo "<span>A</span>"; 
	}
	else { 
		echo $row3[2];
	}
	?>
</td>
<td>
<?php
echo $row3[3];
?>
</td>
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
<td>
<?php
$p= $marks_sort[1] + $marks_sort[2] + $row3[3];
echo $p;
?>
</td>
</tr>
<?php
 }
 ?>
</table>
</body>
</html>
<?php file_put_contents('write.html',ob_get_clean()); ?>

<?php
ini_set("memory_limit","100M");
require('pdfwrite/html2fpdf.php');
$pdf=new HTML2FPDF('P','mm','A3');
$pdf->AddPage();
$fp = fopen("write.html","r");
$strContent = fread($fp, filesize("write.html"));
fclose($fp);
$pdf->WriteHTML($strContent);
$pdf->Output("../reports/ciarep.pdf");
echo "<meta http-equiv='refresh' content='0;url=cia-cumulative.pdf'>";

//echo "<a href='ciarep.pdf'>Get It</a>";
?>
