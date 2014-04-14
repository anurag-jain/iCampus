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
<?php }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
SASTRA University - SRC
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="ajax_post.js"></script>
<script type="text/javascript">
function getAutoComplete(str)
{
		if (str.length==0)
  		{
  			document.getElementById("autocomplete").innerHTML="";
  			return;
  		}
		// Write appropriate functions to perform form validation...
		xmlhttp = new XMLHttpRequest();
		var value=encodeURIComponent(str);
		var parameters="str="+value;
		xmlhttp.open("POST", "autocomplete_staff_id.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send(parameters);
		xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState == 4) 
			{
				document.getElementById("autocomplete").style.display = "block";
				document.getElementById("autocomplete").innerHTML=xmlhttp.responseText;
			}
		}
}
function complete()
{
	var sel = document.getElementById("select").value;
	document.getElementById("staffid").value = sel;
	document.getElementById("autocomplete").style.display = "none";
}
function getAutoComplete2(str)
{
		if (str.length==0)
  		{
  			document.getElementById("autocomplete").innerHTML="";
  			return;
  		}
		// Write appropriate functions to perform form validation...
		xmlhttp = new XMLHttpRequest();
		var value=encodeURIComponent(str);
		var parameters="str="+value;
		xmlhttp.open("POST", "autocomplete_student.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send(parameters);
		xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState == 4) 
			{
				document.getElementById("autocomplete").style.display = "block";
				document.getElementById("autocomplete").innerHTML=xmlhttp.responseText;
			}
		}
}
function complete2()
{
	var sel = document.getElementById("select").value;
	document.getElementById("regno").value = sel;
	document.getElementById("autocomplete").style.display = "none";
}
</script>
<style type="text/css">
<!--
.style1 {color: #000000}
-->
</style>
</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="../images/header.png" alt="sastra university"/></center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome Administrator,</div>
<div id="menu"> <img src="../images/Sastra1.png" width="170" alt="sastra university" />
    <div class="clear"></div>
  <img src="../images/menu-top.png" alt="menu-top"/>
    <div id="nav">
      <ul>
        <li><a href="admin_index.php">Home</a></li>
        <li><a href="password_reset.php">Modify Attendance</a></li>
        <li><a href="lock_reset.php">Modify CIA</a></li>
        <li><a href="admin_service_index.php">Modify Student's Course</a></li>
        <li><a href="change_day_order.php">Modify Student's Program</a></li>
        <li><a href="../logout.php">Sign Out</a></li>
        </ul>
    </div>
  <img src="../images/menu-bottom.png" alt="menu-bottom"/> </div>
<div id="content">
	<div id="main">
	<img src="../images/cont-top.png" alt="cont-top"/>
	<div id="studenthome" class="main">
	  <h2 class='heading'>Modify CIA Marks</h2>
	<!--- Original Code --->
    <table width="770" border="0" cellspacing="1" cellpadding="1">
      <tr>
        <td width="188"><div align="right">Staff ID :</div></td>
        <td width="250"><label>
          <input type="text" name="staffid" id="staffid" onKeyUp="getAutoComplete(this.value)" onChange="fetch_course_code()"/>
        </label></td>
        <td width="322" rowspan="7"><div align="left"  id="autocomplete"></div></td>
      </tr>
      <tr>
        <td><div align="right">Student Reg. No :</div></td>
        <td><input type="text" name="regno" id="regno" onKeyUp="getAutoComplete2(this.value)" onChange="fetch_course_code()"/></td>
        </tr>
      <tr>
        <td><div align="right">Course Code :</div></td>
        <td id="coursecode">&nbsp;</td>
        </tr>
      <tr>
        <td><div align="right">CIA Type :</div></td>
        <td><select id="type" name="type">
          <option value="invalid"><i>Choose a type</i></option>
          <option value="midsem1">CIA I</option>
          <option value="midsem2">CIA II</option>
          <option value="midsem3">CIA III</option>
          <option value="internals">Assignment</option>
        </select></td>
        </tr>
      <tr>
        <td><div align="right">Marks (50) : </div></td>
        <td><label>
          <input name="marks" type="text" id="marks" size="5" />
        </label></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td><label></label></td>
        <td><label>
          <input type="button" name="change" id="change" value="Change" onClick="modify_cia_marks()"/>
        </label></td>
        </tr>
    </table>
    <p></p>
    <!--- Original Code --->
	</div>
	<!--It Ends!-->
	<img src="../images/cont-bottom.png" alt="cont-bottom"/>
	</div>
</div>
<div style="clear:both">&nbsp;</div>
</div>	

<div id="footer">
&copy; 2010 SASTRA University - SRC Campus&nbsp; | &nbsp;Engineered By GLOSS Community | <a href="../bug_filing.php?ref=admin" target="_blank">Report Bugs</a> | <a href="../feedback.php" target="_blank">Feedback</a> | <a href="../credits.php" target="_blank">Credits</a>
</div>
</div>
</div>
</body>
</html>
