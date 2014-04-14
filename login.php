<?php
if(isset($_POST['user']))
	$user=$_POST['user'];
if(isset($_POST['pass']))
	$pass=$_POST['pass'];
$pass=md5($pass);
require_once('db_config.php');	
if(is_numeric($user))
{ 
		$loginQuery = "SELECT regnumber,studentname FROM studentmaster "
						."WHERE regnumber = '$user' AND password='$pass'";
		$result=mysql_query($loginQuery);
		$success=mysql_num_rows($result);
		if($success==0)
			$msg="Username/Password mismatch";	
		else {
			$row = mysql_fetch_row($result);
			$_SESSION['username']=$user;
			$_SESSION['password']=$pass;
			$_SESSION['type']='student';
			$_SESSION['studentname']=$row[1];
			echo "<meta http-equiv='refresh' content='0;url=student/student_home.php'>";
		
	       }
}

else {
	$temp=$user;
	if($temp[0]=='C' || $temp[0]=='c' || $temp[0]=='N' || $temp[0]=='n' || $temp[0]=='v' || $temp[0]=='V') {
		$loginQuery = "SELECT staffid,staffname FROM staffmaster WHERE staffid = '$user' AND password='$pass'";
		$result=mysql_query($loginQuery);
		$success=mysql_num_rows($result);
		if($success==0)
			$msg="Username/Password mismatch";	
		else {
			$row = mysql_fetch_row($result);
			$_SESSION['username']=$user;
			$_SESSION['password']=$pass;
			$_SESSION['type']='staff';
			$_SESSION['staffname']=$row[1];
			echo "<meta http-equiv='refresh' content='0;url=staff/staff_index.php'>";
	       }
	}
	else {
		$loginQuery = "SELECT username,type,lastlogin FROM usermaster "
							."WHERE username = '$user' AND password='$pass'";
		//echo $loginQuery;
		$result=mysql_query($loginQuery);
		$success=mysql_num_rows($result);
		if($success==0)
			$msg="Username/Password mismatch";
		else {
		$row = mysql_fetch_row($result);
		$_SESSION['username']=$user;
		$_SESSION['password']=$pass;
		$_SESSION['type']=$row[1];
		$_SESSION['lastlogin']=$row[2];
		$_SESSION['department']='1';
		if($row[1]=='administrator')
			echo "<meta http-equiv='refresh' content='0;url=admin/admin_index.php'>";
		else if($row[1]=='dataentry')
			echo "<meta http-equiv='refresh' content='0;url=datainput/dataentry_index.php'>";

		}
	}
}
?>