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
</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="images/header.png" alt="sastra university"/></center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome <?php echo $staffname;?> ,</div>
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
	  <h2 class='heading'>Thank you. :)</h2>
<?php 
$q1=$_POST['1'];
$q2=$_POST['2'];
$q3=$_POST['3'];
$q4=$_POST['4'];
$q5=$_POST['5'];
$comment=$_POST['comment'];
$email=$_POST['email'];

require_once('db_config.php');
$feedback="INSERT INTO feedback(user_id,email_id,source_page,q1,q2,q3,q4,q5,comment) VALUES ('$name','$email','staff.php',$q1,$q2,$q3,$q4,$q5,'$comment')";
$result=mysql_query($feedback);

?>	  
<p><div class="confirmmsg">Your Feedback was submitted successfully. Thank you.</div></p>

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
