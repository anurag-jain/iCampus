<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['type']=='student')
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
$regnumber=$user;
$studentname=$username;
include_once("../db_config.php");
include('student_class.php');
$student=new student_class($user,$pass);
$student->setValues();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
SASTRA University - SRC
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function showPass()
{
	var obj=document.getElementById('password');
	if(obj.style.display!="block")
		obj.style.display="block";
	else
		obj.style.display="none";
}
function validatePass()
{
	var oldp = document.getElementById('oldpass');
	var newp = document.getElementById('newpass');
	var conp = document.getElementById('confirmp');
	var suc = true;
	
	if(oldp.value == "") {
		document.getElementById('foroldpass').style.display='inline';
		suc = false;
	}
	else {
		document.getElementById('foroldpass').style.display='none';
	}
	if(newp.value == "") {
		document.getElementById('fornewpass').style.display='inline';
		suc = false;
	}
	else {
		document.getElementById('fornewpass').style.display='none';
	}
	if(conp.value == "") {
		document.getElementById('forconfirmpass').style.display='inline';
		suc = false;
	}
	else {
		document.getElementById('forcomfirmpass').style.display='none';
	}
	
	return suc;
}
function ajaxSave()
{
		
		xmlhttp = new XMLHttpRequest();
		var value1=encodeURIComponent(document.getElementById('email').value);
		var value2=encodeURIComponent(document.getElementById('phone').value);
		var value3=encodeURIComponent(document.getElementById('address').value);
		var value4=encodeURIComponent(document.getElementById('quote').value);
		var parameters="param1="+ value1 + "&param2="+ value2 + "&param3="+ value3 + "&param4="+ value4;
		xmlhttp.open("POST", 'student_update_profile.php', true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send(parameters);
		xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				document.getElementById('confirm').innerHTML=xmlhttp.responseText;
				
			}
		}	
	
document.getElementById('toggle').innerHTML="<div align=\"center\" onclick=\"editprofile()\"><img src=\"../images/Crayon_v2.png\" width=\"19\" height=\"17\"/>Edit Profile</div>";
	
document.getElementById('email').disabled="disabled";
document.getElementById('phone').disabled="disabled";
document.getElementById('address').disabled="disabled";
document.getElementById('quote').disabled="disabled";
}


function editprofile()
{
document.getElementById('email').disabled="";
document.getElementById('phone').disabled="";
document.getElementById('address').disabled="";
document.getElementById('quote').disabled="";
document.getElementById('toggle').innerHTML="<div align=\"center\" onclick=\"ajaxSave()\"><img src=\"../images/save.png\" width=\"19\" height=\"17\"/>Apply Changes</div>";
}

</script>

</script>
</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="../images/header.png" alt="sastra university"/></center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome  <?php echo $student->getUserName();?></div>
<div id="menu">
		<img src="../images/Sastra1.png" width="170" alt="sastra university" />
		<div class="clear"></div>
		<img src="../images/menu-top.png" alt="menu-top"/>
			<div id="nav">
			<ul>
				<li><a href="student_home.php">Home</a></li>
                <li><a href="student_attendance.php">Attendance</a></li>
				<li><a href="student_absentinfo.php">Absent Details</a></li>
				<li><a href="student_timetable.php">Timetable</a></li>
				<li><a href="student_internals.php">CIA Marks</a></li>
                <li><a href="student_profile.php">View Profile</a></li>
				<li><a href="../logout.php">Sign Out</a></li>
			</ul>
			</div>
		<img src="../images/menu-bottom.png" alt="menu-bottom"/>
	</div>
<div id="content">
	<div id="main">
	<img src="../images/cont-top.png" alt="cont-top"/>
	<!--Write code here!-->
    <div id="studenthome" class="main">
	  <h2 class='heading'>My profile</h2>
      <?php
		if(isset($_GET['success']))
		{
			if($_GET['success']==1)
					echo '<div class="confirmmsg">Password Changed Successfully</div>';
			if($_GET['success']==0)
					echo '<div class="msg">Password Changing Failed</div>';
		
		}
		?>
	  </br></br></br>
      <div align="center">
        <table width="700" border="0" cellspacing="0" cellpadding="0">
         
          <tr>
            <td width="200"><div align="left">Register Number: </div></td>
            <td colspan="2"><div align="left"><?php echo $student->getUserId();?></div></td>
            </tr>
          <tr>
            <td><div align="left">Name : </div></td>
            <td colspan="2"><div align="left"><?php echo $student->getUserName();?></div></td>
            </tr>
            <tr>
            <td><div align="left">Department :</div></td>
            <td colspan="2"><div align="left"><?php echo $student->getDepartment();?></div></td>
            </tr>
          <tr>
            <td colspan="3"><div align="left">&nbsp;</div></td>
            </tr>
          <tr>
            <td><div align="left">Email Id : </div></td>
            <td colspan="2"><div align="left">
              <label>
                <input type="text" name="email" id="email" size="30" disabled="disabled" value="<?php echo $student->getEmailid(); ?>"/>
              </label>
            </div></td>
            </tr>
          <tr>
            <td><div align="left">Phone number :</div></td>
            <td colspan="2"><div align="left">
              <input type="text" name="phone" id="phone" size="30" disabled="disabled" value="<?php echo $student->getContact(); ?>"/>
            </div></td>
            </tr>
          <tr>
            <td><div align="left">Address :</div></td>
            <td colspan="2"><div align="left">
              <textarea name="address" cols="30" rows="3" disabled="disabled" id="address"><?php echo $student->getAddress(); ?></textarea>
            </div></td>
            </tr> 
          <tr>
            <td><div align="left">&nbsp;</div></td>
            <td colspan="2"><div align="left">&nbsp;</div></td>
            </tr>
          <tr>
            <td>My Quote :</td>
            <td colspan="2"><input type="text" name="quote" id="quote" size="75" disabled="disabled" value="<?php echo $student->getMyquote(); ?>"/></td>
          </tr>
          <tr>
            <td><div align="left"></div></td>
            <td width="346" ><div align="left" id="confirm" style="color:#930" ></div></td>
            <td width="118" style="cursor:pointer" id="toggle" ><div align="center" onClick="editprofile()"><img src="../images/Crayon_v2.png" width="19" height="17"/>Edit profile</div></td>
            </tr>
        </table>
      </div>
      <p>
		<a href="javascript:showPass()" >Change Password</a>
		</p>
		<div id="password" style="display:none">
		<form action="changepass.php" method="post" name="passchange" onSubmit="return validatePass()">
			<p>
				Old Password &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <input type="password" id="oldpass" name="oldpass" />
				<span id="foroldpass" class="mandatory"> *</span>
			</p>
			<p>
				New Password &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <input type="password" id="newpass" name="newpass" />
				<span id="fornewpass" class="mandatory"> *</span>
			</p>
			<p>
				Confirm Password &nbsp;: <input type="password" id="confirmp" name="confirmp" />
				<span id="forconfirmpass" class="mandatory"> *</span>
			</p>
			<center><span id="mismatch" class="mandatory">Passwords Do Not Match</span></center>
			<p>
				<input type="submit" id="submit" name="submit" value="Change" />
			</p>
		</form>
		</div>
    </div>
	<!--It Ends!-->
	<img src="../images/cont-bottom.png" alt="cont-bottom"/>
	</div>
</div>
<div style="clear:both">&nbsp;</div>
</div>	

<div id="footer">
&copy; 2010 SASTRA University - SRC Campus&nbsp; | &nbsp;Engineered By GLOSS Community | <a href="../bug_filing.php?ref=student" target="_blank">Report Bugs</a> | <a href="../feedback.php" target="_blank">Feedback</a> | <a href="../credits.php" target="_blank">Credits</a>
</div>
</div>
</body>
</html>
