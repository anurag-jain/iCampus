<?php
	session_start();
	unset($_SESSION['username']);
	unset($_SESSION['password']);
	if(isset($_POST['submit']))
		include('login.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
SASTRA University - SRC
</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript"  language="javascript">
function validatelogin()
{
	var flag = true;
	var user = document.getElementById("user");
	var pass = document.getElementById("pass");
	if( user.value == '') {
		flag = false;
		user.style.background='#FF0';
	}
	else
		user.style.background='#FFF';
	if( pass.value == '') {
		flag = false;
		pass.style.background='#FF0';
	}
	else
		pass.style.background='#FFF';
	
	return flag;
}
</script>
</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="images/header.png" alt="sastra university"/></center></div>
	<div id='right-panel'>
		<div id='login'>
		<form method="post" action="index.php" onsubmit="return validatelogin()">
            <strong>Username : </strong><input type="text" id="user" name="user" />
			&nbsp;&nbsp;
			<strong>Password : </strong><input type="password" id="pass" name="pass" />            
              <input type="submit" name="submit" id="submit" value="Sign In"/>
          
		<p align="center" style="color:#f20102"><?php echo $msg; ?></p>
		</form>
		</div>
		<div id='news'>
			<h2 class='heading' style='width:500px'>News and Guidelines</h2>
			<marquee scrollamount="1" scrolldelay="10" direction="up" height="290">
			<!--<div style='height:390px;overflow:auto;'>!-->
			<?php
				require_once('db_config.php');
				$newsQuery = "SELECT date_format(date,'%e-%M-%Y'),news FROM news WHERE active=0 order by date DESC";
				$newsResult = mysql_query($newsQuery);
				$numRows = mysql_num_rows($newsResult);
				if($newsResult && $numRows > 0) {
					while($news = mysql_fetch_array($newsResult)) {
						echo "<div><b>$news[0]</b> : $news[1]<hr /></div>";
					}
				}
			?>
			
			</marquee>
		</div>
	</div>
	<div id='introduction'>
	  <p align="center"><img src='./images/icon.png' alt="icampus" />      </p>
	  <p align="center">&nbsp;</p>
	  <p align="center">&nbsp;</p>
	  <p align="center">&nbsp;</p>
	  <p align="left">Feel the campus updates everywhere through iCampus and get your complete academic detais at clicks away all in one place!!! </p>
	  <p align="left">&nbsp;	</p>
	  <p align="left">iCampus for staff provides a personalized arena to post attendance, CIA, and manage them subject wise effectively.</p>
	  <p align="left">&nbsp;</p>
	  <p>&nbsp;</p>
	  <p>&nbsp;  </p>
	</div>
  </div>
</div>	
<!--<div style="clear:both">&nbsp;</div>!-->

<div id="footer">
Copyright 2010 SASTRA University - SRC Campus&nbsp; | &nbsp;Engineered By GLOSS Community | <a href="credits.php">Credits</a>
</div>
</div>
</body>
</html>
