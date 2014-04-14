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
include ('../staff/staff_class.php');
include ('../staff/security_class.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Modify Attendance</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../CALENDER/calendar_eu.js"></script>
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
function validate()
{
	if((document.getElementById("staffid").value == "") || (document.getElementById("testinput").value))
	{
		alert("Oops! Looks like the fields are unfilled!");
		return false;
	}
	else
		return true;
}
</script>
</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="../images/header.png" alt="sastra university"/></center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome <?php echo $staffname;?>,</div>
<div id="menu">
		<img src="../images/Sastra1.png" width="170" alt="sastra university" />
		<div class="clear"></div>
		<img src="../images/menu-top.png" alt="menu-top"/>
			<div id="nav">
			<ul>
				<li><a href="staff_index.php">Home</a></li>
              	<li><a href="staff_profile.php">Profile</a></li>
				<li><a href="staff_attendance.php">Post Attendance</a></li>
				<li><a href="staff_attendance.php#pending">Pending Attendance</a></li>
				<li><a href="report.php">Get Lag Report</a></li>
				<li><a href="staff_timetable.php" target="_blank">Timetable</a></li>
                <li><a href="midsem_display.php">Post CIA</a></li>
                <li><a href="../logout.php">Sign Out</a></li>
			</ul>
			</div>
		<img src="../images/menu-bottom.png" alt="menu-bottom"/>
	</div>
<div id="content">
	<div id="main">
	<img src="../images/cont-top.png" alt="cont-top"/>
	<!--Write code here!-->
	<div id="studenthome" class="main" >
	  <h2 class='heading'>Modify Attendance</h2></br></br></br>
      <div align="center">
    <form name="testform" method="post"  action="postedattendance.php">
      <table width="306" border="0" cellspacing="1" cellpadding="1">
        <tr>
          <td width="78">&nbsp;</td>
          <td width="221">&nbsp;</td>
        </tr>
        <tr>
          <td><div align="right">Date:</div></td>
          <td><input type="text" name="testinput" /><script language="JavaScript">
			new tcal ({
				// form name
				'formname': 'testform',
				// input name
				'controlname': 'testinput'
			});

			</script></td>
        </tr>
        <tr>
          <td><div align="right">Staff ID:</div></td>
          <td><input type="text" name="staffid" id="staffid" onKeyUp="getAutoComplete(this.value)"/></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td id="autocomplete">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input type="submit" name="button" id="button" value="Get List" /></td>
        </tr>
      </table>
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
&copy; 2010 SASTRA University - SRC Campus&nbsp; | &nbsp;Engineered By GLOSS Community | <a href="../bug_filing.php?ref=admin" target="_blank">Report Bugs</a> | <a href="../feedback.php" target="_blank">Feedback</a> | <a href="../credits.php" target="_blank">Credits</a>
</div>
</div>
</div>
</body>
</html>
