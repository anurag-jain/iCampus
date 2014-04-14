<?php
/*
Author : KP
Date : 28/02/2010
*/
/*
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['type']=='dataentry')
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
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
SASTRA University - SRC
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="datetimepicker.js"></script>
<script language="javascript">
function validateData() {
	var success=copyDept();
	var dataid = document.getElementById('dataid');
	var datapass = document.getElementById('passw');
	if(dataid.value=='') {
		document.getElementById('forsid').style.display='inline';
		success=false;
		}
	else
		document.getElementById('forsid').style.display='none';
	
	if(datapass.value=='') {
		document.getElementById('forpass').style.display='inline';
		success=false;
		}
	else
		document.getElementById('forpass').style.display='none';
	
	return success;
}
function copyDept() {
	var dept = document.getElementById('dept');
	var dep='';
	var data = document.getElementById('deptlist').getElementsByTagName('input');
	for(var i=0;i<data.length;i++) {
		if(data[i].type=='checkbox') 
			if( data[i].checked == true) {
				dep+=data[i].value+'#';
		}
	}
	if(dep=='') {
		alert("Please Select Atleast One Department!!");
		return false;
		}
	dept.value=dep;
	return true;
}
</script>
</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="../images/header.png" alt="sastra university"/></center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome Day Entry User,</div>
<div id="menu">
		<img src="../images/Sastra1.png" width="170" alt="sastra university" />
		<div class="clear"></div>
		<img src="../images/menu-top.png" alt="menu-top"/>
			<div id="nav">
			<ul>
				<li><a href="dataentry_index.php">Data Entry Home</a></li>
				<li><a href="addstaff.php">Add Staff</a></li>
				<li><a href="editstaff.php">Edit Staff</a></li>
				<li><a href="delstaff.php">Delete Staff</a></li>
				<li><a href="addcourse.php">Add Course</a></li>
				<li><a href="editcourse.php">Edit Course</a></li>
				<li><a href="delcourse.php">Delete Course</a></li>
                     <li><a href="dataentry_section.php">Add Section</a></li>
        <li><a href="dataentry_relation.php">Populate Section</a></li>
		<li><a href="../logout.php">Sign Out</a></li>		
			</ul>
			</div>
		<img src="../images/menu-bottom.png" alt="menu-bottom"/>
	</div>
<div id="content">
	<div id="main">
	<img src="../images/cont-top.png" alt="cont-top"/>
	<!--Write code here!-->
	<div id="addstaff" class="main">
		<h2 class="heading">Add Data Entry User</h2>
		<?php
		if(isset($_POST['submit']))
		{
			require_once('../db_config.php');
			if(isset($_POST['dataid']))
				$dataid=$_POST['dataid'];
			
			if(isset($_POST['passw']))
				$password=$_POST['passw'];
			
			if(isset($_POST['sdept']))
				$deptlist=$_POST['sdept'];
			
			$deptl=explode('#',$deptlist);
			$dept='';
			$err=1;
			foreach ($deptl as $dl) {
				if($dl!="") {
					$prog=explode('|',$dl);
					$prgidQuery = "SELECT program_id FROM program_master "
								."WHERE program = '$prog[0]' AND department = '$prog[1]'";
					$prgRes=mysql_query($prgidQuery);
					if($prgRes) {
						while($row=mysql_fetch_row($prgRes)) {
							$dept=$dept.$row[0].'-';
						}
					}
					else {
						echo '<div class="msg">Error While Adding Data</div>';	
						$err=0;
					}
				}
			}
			if($err==1) {
				$querychk = "SELECT type FROM usermaster WHERE username='$dataid'";
				$chkres = mysql_query($querychk);
				if($chkres) {
					$num =mysql_num_rows($chkres);
				}
				if($num!=0)
					echo '<div class="msg">Error While Adding Data</div>';	
				else {
					$querym="INSERT INTO usermaster(username,password,type,department) VALUES('$dataid','".md5('$password')."','dataentry','$dept')";
					$resultm=mysql_query($querym);
					if($resultm==1)
						echo '<div class="confirmmsg">Data Added Successfully</div>';
					else
						echo '<div class="msg">Error While Adding Data</div>';	
				}
			}
			unset($_POST['submit']);
		}
		?>
		<form action="adddatauser.php" method="post" name="adddatauser" onsubmit="return validateData()">
		<input type="hidden" id='dept' name="sdept" value=''/>
		<p>
			Data Entry User ID : <input type="text" id="dataid" name="dataid" /><span id="forsid" class="mandatory"> *</span>
        </p>
		<p>
			Password &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <input type="password" id="passw" name="passw" /><span id="forpass" class="mandatory"> *</span>
        </p>
		<p>Select Department :</p>
		<div id='deptlist' style="margin-left:80px;width:500px;height:100px;overflow:auto;border:solid 1px">
			<?php
					require_once('../db_config.php');
					$listQuery="SELECT distinct program,department FROM program_master";
					$listResult = mysql_query($listQuery);
					if($listResult) {
					$i=1;
					echo "<table width='500px'>";
					while($row=mysql_fetch_array($listResult)) {
						echo "<tr><td width='450px'>$row[0] - $row[1]</td><td><input type='checkbox' id='$i'name='$i' value='$row[0]|$row[1]' /></td></tr>";
						$i++;	
					}
					echo "</table>";
					}
					else {
						echo "No Departments Found";
					}
				?>
		</div>
		<p>
			<br />
			<input type="submit" id="submit" name="submit" value="Add User"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" />
        </p>
			<p>&nbsp;</p>
		</form>
		&nbsp;</div>
	<!--It Ends!-->
	<img src="../images/cont-bottom.png" alt="cont-bottom"/>
	</div>
</div>
<div style="clear:both">&nbsp;</div>
</div>	

<div id="footer">
Copyright 2010 SASTRA University - SRC Campus&nbsp; | &nbsp;Engineered By GLOSS Community | <a href="bug_filing.php?ref=top">Report Bugs</a> | <a href="feedback.php">Feedback</a> | <a href="credits.php">Credits</a>
</div>
</div>
</body>
</html>
