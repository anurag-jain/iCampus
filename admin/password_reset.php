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
	document.getElementById("staff_name").value = sel;
	document.getElementById("autocomplete").style.display = "none";
}
function getAutoComplete2(str)
{
		if (str.length==0)
  		{
  			document.getElementById("autocomplete2").innerHTML="";
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
				document.getElementById("autocomplete2").style.display = "block";
				document.getElementById("autocomplete2").innerHTML=xmlhttp.responseText;
			}
		}
}
function complete2()
{
	var sel = document.getElementById("select").value;
	document.getElementById("regno").value = sel;
	document.getElementById("autocomplete2").style.display = "none";
}
</script>
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
        <li><a href="password_reset.php">Reset Password</a></li>
        <li><a href="lock_reset.php">Set / Reset Locks</a></li>
        <li><a href="admin_service_index.php">Services &amp; Facts</a></li>
        <li><a href="change_day_order.php">Change Day Order</a></li>
        <li><a href="admin_modify_index.php">Modify Records</a></li>
        <li><a href="../logout.php">Sign Out</a></li>
      </ul>
    </div>
  <img src="../images/menu-bottom.png" alt="menu-bottom"/> </div>
<div id="content">
	<div id="main">
	<img src="../images/cont-top.png" alt="cont-top"/>
	<div id="studenthome" class="main">
	  <h2 class='heading'>Reset Staff Password</h2>
	<!--- Original Code --->
	<center>
    <table width="515" border="0">
        <tr>
          <td width="162"><div align="right">Enter Staff Name or ID: &nbsp;</div></td>
          <td width="223"><input type="text" name="staff_name" id="staff_name" onKeyUp="getAutoComplete(this.value)" /></td>
        </tr>
        <tr id="autocomplete_row">
          <td></td>
          <td><div id = "autocomplete"></div></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input type="button" name="reset_button" id="reset_button" value="Reset Password" onClick="password_reset_staff()"/></td>
        </tr>
      </table>
      <table width="515" border="0">
        <tr>
          <td colspan="2">&nbsp;</td>
          </tr>
        <tr>
          <td width="162"><div align="right">Enter Student Reg. No: &nbsp;</div></td>
          <td width="223"><input type="text" name="regno" id="regno" onKeyUp="getAutoComplete2(this.value)" /></td>
        </tr>
        <tr id="autocomplete_row2">
          <td></td>
          <td><div id = "autocomplete2"></div></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input type="button" name="reset_button2" id="reset_button2" value="Reset Password" onClick="password_reset_student()"/></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      <p>Note: The changed password will be &quot;sastra&quot;.</p>
      <label></label>
      <p>
	</center>
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
