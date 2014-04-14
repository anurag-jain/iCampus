<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']))
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
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
SASTRA University - SRC
</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="images/header.png" alt="sastra university"/></center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome User,</div>
<div id="menu">
		<img src="images/Sastra1.png" width="170" alt="sastra university" />
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
	  <h2 class='heading'>Thank you!</h2>
	  <?php
	 	require_once('db_config.php');
		$type = $_POST['type'];
		$desc = $_POST['description'];
		$email = $_POST['email'];
		$mobile = $_POST['mobile'];
		$contactable = $_POST['contactable'];
		$ref = $_POST['ref'];
		$query_bug = "insert into bug_filing(userid,type,description,emailid,mobile,contactable,ref_page)"
				   . "values('$user','$type','$desc','$email','$mobile','$contactable','$ref')";
		$result_bug = mysql_query($query_bug) or die(mysql_error());
	  ?>
      <p class="confirmmsg">We have received your bug. We are actively working on fixing it. We'll get back to you soon.</p>
	  <p align="left">&nbsp;</p>
	</div>
	<img src="images/cont-bottom.png" alt="cont-bottom"/>	</div>
	&nbsp;
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
