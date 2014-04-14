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
$password=$_SESSION['password'];
include ('staff_class.php');
include ('security_class.php');
$staff = new staff_class($staffid,$staffname,$department,$password);
$security=new security_class($staffid);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
SASTRA University - SRC
</title>
</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
  <div id="content">
    <div id="main">
      <!--Write code here!-->
		<div align="center">	
	  <h2 class='heading'>Coursewise student lag Report</h2></div>
	  </br></br></br>
       <?php
		$course=$_GET['course'];
		$section=$_GET['secid'];
		$report=$staff->generateReport($section,$course);
		?>
      <div align="center">
        <p>List of Student having attendance below <?php echo $report[0][4]."%";?></p>
        <p>Course code : <?php echo $course; ?></p>
      </div>
      <p>&nbsp; </p>
	  <table width="579" height="48" border="1" align="center" cellpadding="0" cellspacing="0">
    
	  <tr>
      	<th width="85" height="25">Sno</th>
      	<th width="152">Register number</th>
	    <th width="212">Student name</th>
	    <th width="120">Attendance %</th>
	    </tr>
       
        <?php
		$i=0; 
		while($report[$i][0]!=99999 && $report[$i][1]!=99999)
		{
	?>
	  <tr>
      	<td height="20"><div align="center"><?php echo $i+1;  ?></div></td>
      	<td><div align="center"><?php echo $report[$i][1];  ?></div></td>
	    <td><div align="center"><?php echo $report[$i][2];  ?></div></td>
	    <td><div align="center"><?php echo round($report[$i][3],2);  ?></div></td>
	    </tr>
        <?php $i++; }?>
	  </table>
	  <p>&nbsp;</p>
	</div>
	<!--It Ends!-->

</div>
</div>
</div>
</body>
</html>
