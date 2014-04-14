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
include('relation_class.php');
include ('security_class.php');
$security=new security_class($staffid);
$relation_obj1 = new relation_class();
$marks=$_GET['marks'];
$regno=$_GET['regno'];
$midsem=$_GET['midsem'];
$coursecode=$_GET['coursecode'];
if($marks==a)
$marks=121;
if($midsem!=4 && $marks!=121) {
$marks=round(($marks*0.4),2);
}
else
$marks=$marks;
	switch($midsem)
	{
	case 1:
	$updateCIA_query="UPDATE midsem_marks SET midsem1='$marks' WHERE ".
			" relationid in(SELECT relationid FROM `relation` where coursecode='$coursecode' and regnumber='$regno')";
	break;
	case 2:
	$updateCIA_query="UPDATE midsem_marks SET midsem2='$marks' WHERE ".
			" relationid in(SELECT relationid FROM `relation` where coursecode='$coursecode' and regnumber='$regno')";
	break;
	case 3:
	$updateCIA_query="UPDATE midsem_marks SET midsem3='$marks' WHERE ".
			" relationid in(SELECT relationid FROM `relation` where coursecode='$coursecode' and regnumber='$regno')";
	break;
	case 4:
	$updateCIA_query="UPDATE midsem_marks SET internals='$marks' WHERE ".
			" relationid in(SELECT relationid FROM `relation` where coursecode='$coursecode' and regnumber='$regno')";
	break;
	}
	$updateCIA_result=mysql_query($updateCIA_query);
	//echo $updateCIA_query;
	//$success = mysql_num_rows($updateCIA_result);
	echo "<div class='msg'>Marks Updated !!</div>";
		?>			
 	
	

	