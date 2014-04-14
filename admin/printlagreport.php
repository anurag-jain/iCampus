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
ob_start();
require_once('../db_config.php');
$details=$_GET['value'];
$details=explode(",",$details);
	$sectionid=$details[0];
	$dept=$details[1];
	$name=$details[2];
	echo $name;
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
<div>
  <table width="668" height="136" align="center">
    <tr>
    <td rowspan="3"><img src="Sastra1.jpg" width="83" height="64"></td>
    <td width="735"><div align="center">SASTRA UNIVERSITY</div></td>
    </tr>
    <tr>
      <td><div align="center">SRINIVASA RAMANUJAN CENTRE,KUMBAKONAM</div></td>
    </tr>
    <tr>
      <td><div align="center">OVERALL  LAG REPORT</div></td>
    </tr>
    
  </table>
</div>
<?php echo $prog."-".$dept."-".$row[1]."-".$row[0]; ?>
<script type="text/javascript">
window.onload=function(){
	window.print();
};
</script>
</head>
<body>
<table border="1" cellspacing="0" cellpadding="2" width="700px">
<tr>
<td width="40px">Sno</td>
<td width="110px">Regnumber</td>
<td width="350px">Name</td>
<td width="120px">Attendance Percentage</td>
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
if($present_row[0]!='0' && $total_row[0]!='0'){
	$percentage=round((($present_row[0]/$total_row[0])*100),2);
		if($percentage<=75){

?>
<tr>
<td><?php echo $i; ?></td>
<td><?php echo $students_row[0]; ?></td>
<td><?php echo $students_row[1]; ?></td>
<td><?php echo $percentage; ?></td></tr>
<?php 
			}
	}
else {
echo "Exception"; 
break;
} 
	
$i++;
}

?>
</table>
</body>
</html>
<?php file_put_contents('lagreport.html',ob_get_clean()); 
echo "<meta http-equiv='refresh' content='0;url=lagreport.html'>";
?>