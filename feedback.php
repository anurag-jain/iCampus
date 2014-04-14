<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']))
{
$user=$_SESSION['username'];
}
else { ?>
<script>
alert("Session Expired!!!");
window.location="index.php";
</script>
<?php }
$name=$user;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
SASTRA University - SRC
</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">



function validate()
{
var a=document.getElementById('comment').value;
var b=document.getElementById('email').value;

if(a=="" && b=="")
{
document.getElementById('hi').innerHTML="*Required"
document.getElementById('bye').innerHTML="*Required"
return false;
}
if(a=="")
{
document.getElementById('hi').innerHTML="*Required"
return false;
}
if(b=="")
{
document.getElementById('bye').innerHTML="*Required"
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
<div id="header"><center><img src="images/header.png" alt="sastra university"/></center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome ,</div>
<div id="menu">
		<img src="images/Sastra1.jpg" width="170" alt="sastra university" />
		<div class="clear"></div>
		<img src="images/menu-top.png" alt="menu-top"/>
			<div id="nav">
			<ul>
			  <li><a href="javascript:window.close()">Close</a></li>
              <li><a href="logout.php">Sign Out</a></li>
			</ul>
			</div>
		<img src="images/menu-bottom.png" alt="menu-bottom"/>
	</div>
<div id="content">
	<div id="main">
	<img src="images/cont-top.png" alt="cont-top"/>
	<!--Write code here!-->
	<div id="studenthome" class="main">
	  <h2 class='heading'>Like iCampus..?</h2>
	  <p>If you think iCampus has really crossed your imagination and in-depth assessment or you might like to say a 'Hi'</p>
	  <p>find some time to furnish your valuable feedbacks, comments, ideas, or any feature you'd like to see </p>
	  <p>in upcoming versions 8-). You can alternatively mail us @ icampus@src.sastra.edu</p>
	  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please rate iCampus on following terms:</p>
      <form name="form1" method="post" action="feedback_done.php" onSubmit="return validate()">
	  <table width="735" height="497" border="0" align="center" cellpadding="1" cellspacing="0">
	    <tr>
    <th>&nbsp;</th>
    <th>Strongly Agree</th>
    <th>Agree</th>
    <th>Neutral/ No Comments</th>
    <th>Disagree</th>
    <th>Strongly Disagree</th>
  </tr>
  <tr class="even">
    <td width="217" height="53"> <p>You love iCampus.</p></td>
    <td width="99"><label>
      <input name="1" type="radio" id="1" value="1" checked="checked" />
    </label>
    
    </td>
    <td width="74"><input type="radio" name="1" id="1" value="2" /></td>
    <td width="154"><input type="radio" name="1" id="1" value="3" /></td>
    <td width="65"><input type="radio" name="1" id="1" value="4" /></td>
    <td width="114"><input type="radio" name="1" id="1" value="5" /></td>
  </tr>
  <tr class="odd">
    <td height="58">It was easy for you to understand and navigate through iCampus.</td>
    <td><input name="2" type="radio" id="2" value="1" checked="checked" /></td>
    <td><input type="radio" name="2" id="2" value="2" /></td>
    <td><input type="radio" name="2" id="2" value="3" /></td>
    <td><input type="radio" name="2" id="2" value="4" /></td>
    <td><input type="radio" name="2" id="2" value="5" /></td>
  </tr>
  <tr class="even">
    <td height="64">You are satisfied with the time it takes iCampus to load.</td>
    <td><input name="3" type="radio" id="3" value="1" checked="checked" /></td>
    <td><input type="radio" name="3" id="3" value="2" /></td>
    <td><input type="radio" name="3" id="3" value="3" /></td>
    <td><input type="radio" name="3" id="3" value="4" /></td>
    <td><input type="radio" name="3" id="3" value="5" /></td>
  </tr>
  <tr class="odd">
    <td height="58">You find icampus aesthetically appealing and useful.</td>
    <td><input name="4" type="radio" id="4" value="1" checked="checked" /></td>
    <td><input type="radio" name="4" id="4" value="2" /></td>
    <td><input type="radio" name="4" id="4" value="3" /></td>
    <td><input type="radio" name="4" id="4" value="4" /></td>
    <td><input type="radio" name="4" id="4" value="5" /></td>
  </tr>
  <tr class="even">
    <td height="58">You find contents in iCampus clearly readable and fonts are visually accessible.</td>
    <td><input name="5" type="radio" id="5" value="1" checked="checked" /></td>
    <td><input type="radio" name="5" id="5" value="2" /></td>
    <td><input type="radio" name="5" id="5" value="3" /></td>
    <td><input type="radio" name="5" id="5" value="4" /></td>
    <td><input type="radio" name="5" id="5" value="5" /></td>
  </tr>
    <tr class="odd">
      <td height="75">Do you have any suggestions for improvement? </td>
      <td colspan="3"><div align="left">
        <textarea name="comment" id="comment" cols="45" rows="5"></textarea>
      </div></td>
      <td id="hi" style="color:#F03">&nbsp;</td>
      <td>&nbsp;</td>
      
   <tr class="even">
    <td height="29">Your Email Id</td>
    <td colspan="3"><label>
      <div align="left"> 
        <input type="text" name="email" id="email" size="40" />
      </div>
    </label></td>
    <td id="bye" style="color:#F03">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr class="odd">
    <td height="20" colspan="6"><label>
      <input type="submit" name="button" id="button" value="Submit Feedback" />
    </label></td>
    </tr>
</table>
</form>
<p>&nbsp;</p>
	</div>
	<!--It Ends!-->
	<img src="images/cont-bottom.png" alt="cont-bottom"/>
	</div>
</div>
<div style="clear:both">&nbsp;</div>
</div>	

<div id="footer">
Copyright 2010 SASTRA University - SRC Campus&nbsp; | &nbsp;Engineered By GLOSS Community | <a href="bug_filing.php?ref=top">Report Bugs</a> | <a href="feedback.php">Feedback</a> | <a href="credits.php">Credits</a>
</div>
</div>
</body>
