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
?>
<html>
<head>
<script>
function redirect()
{
window.location="midsem_display.php";
};
</script>
</head>
<body>
<?php
include_once("../db_config.php");
include('relation_class.php');
$coursecode=$_POST['coursecode'];
$section_id=$_POST['section_id'];
$midsem_name=$_POST['midsem_name'];
$max_marks=$_POST['max_marks'];
$conv_marks=$_POST['conv_marks'];
/*echo $staffid;
echo $section_id;
echo $coursecode;
echo $max_marks;
echo $conv_marks;*/
$relation_obj1 = new relation_class();
$students=$relation_obj1-> listofstudents_staff($staffid,$section_id,$coursecode);
$sno=1;

while($row=mysql_fetch_array($students))
{ 
	//echo $row[1];
	$marks=$_POST[$sno];
	//echo $marks;
  	//$cmarks=$relation_obj1-> calculate_marks($marks);
	echo $_POST[$s];
	$query1="SELECT relationid FROM relation where regnumber='$row[1]' and staffid='$staffid' and coursecode='$coursecode' and 			 				section_id='$section_id'";
	$result1=mysql_query($query1);
	$row1=mysql_fetch_array($result1);
	$success = mysql_num_rows($result1);
	$relationid=$row1[0];
	if($success == 0)
	{
	echo " Data missing!!! FATAL error."; 
	echo "</br>";
	echo "Insertion Failed";
	echo "</br>";
	echo "Contact Admin";
	exit;
	}
	else{
	
	$relation_obj1-> update_midsempost_details($staffid,$coursecode,$section_id,$midsem_name,$max_marks,$conv_marks);		
	$relation_obj1-> insert_midsem_marks($relationid,$marks,$midsem_name,$staffid,$coursecode,$section_id);
	?>
<script>
redirect();
</script>
	<?php
    }
		
$sno++;
}
?>

</body>
</html>