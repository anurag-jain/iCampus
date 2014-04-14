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
function lock_unlock(str)
{
		//alert(str);
		xmlhttp2 = new XMLHttpRequest();
		var parameters = "lock=" + str;
		xmlhttp2.open("POST", "lock_unlock.php", true);
		xmlhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp2.send(parameters);
		xmlhttp2.onreadystatechange=function()
		{
			if(xmlhttp2.readyState == 4) 
			{
							alert(xmlhttp2.responseText);
							//document.location = "admin_index.php"
			}
		}
}
function time_lock_unlock(str)
{
		//alert(str);
		xmlhttp2 = new XMLHttpRequest();
		var parameters = "lock=" + str;
		xmlhttp2.open("POST", "time_lock_unlock.php", true);
		xmlhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp2.send(parameters);
		xmlhttp2.onreadystatechange=function()
		{
			if(xmlhttp2.readyState == 4) 
			{
							alert(xmlhttp2.responseText);
							//document.location = "admin_index.php"
			}
		}
}

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
	  <h2 class='heading'>Set / Reset Attendance and TimeTable Lock</h2>
	<!--- Original Code --->
	<center>
    <form action="" method="post" name="form_staff_password">
      <table width="395" border="0">
        <tr>
          <td width="159">Enter Staff Name or ID : </td>
          <td width="226"><input type="text" name="staff_name" id="staff_name" onKeyUp="getAutoComplete(this.value)" /></td>
        </tr>
        <tr id = "table_row">
          <td>&nbsp;</td>
          <td><div id = "autocomplete"></div></td>
        </tr>
        <tr>
          <td height="30">Lock Type :</td>
          <td><label>
            <input type="radio" name="lock_type" id="Attendance" value="Attendance" />
            Attendance 
            <input type="radio" name="lock_type" id="Timetable" value="Timetable" />
          Timetable</label></td>
        </tr>
        <tr>
          <td height="28">Status : </td>
          <td><label>
            <input name="lock_status" type="radio" id="lock" value="1" />
            Lock
            <input type="radio" name="lock_status" id="unlock" value="0" />
            Unlock
          </label></td>
        </tr>
        <tr>
          <td colspan="2"><div align="center">
            <label>
            <input type="button" name="button" id="button" value="Done" onClick="lock_staff()"/>
            </label>
          </div></td>
          </tr>
      </table>
      <p>-------</p>
      <table width="396" border="0">
        <tr>
          <td width="223" rowspan="2">Attendance Lock For All Staff</td>
          <td width="163"><input type="button" name="button2" id="button2" value="Lock All" onClick="lock_unlock('lock')"/>
          </label></td>
        </tr>
        <tr>
          <td><label>
            
              <input type="button" name="button3" id="button3" value="Unlock All" onClick="lock_unlock('unlock')"/>
              </label></td>
        </tr>
        <tr>
          <td rowspan="2">Timetable Lock For All Staff</td>
          <td><input type="button" name="button4" id="button4" value="Lock All" onClick="time_lock_unlock('lock')"/></td>
        </tr>
        <tr>
          <td><input type="button" name="button5" id="button5" value="Unlock All" onClick="time_lock_unlock('unlock')"/></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <label></label>
  <p>
  
    </form>

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
