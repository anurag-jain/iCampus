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
<?php 
}
require_once('../db_config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title>
SASTRA University - SRC
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../jquery-1.2.6.min.js"></script>
<script language="javascript">
function fillDept(obj) {
	if(obj.value!='invalid') {
	$.post("ajax_filldept.php", {prog: ""+obj.value+""}, function(data){
		$('#deptfill').html(data);
	});
	}
}
function fillSec(obj) {
	if(obj.value!='invalid') {
		var prog=document.getElementById('prog').value;
	$.post("ajax_fillsec.php", {prog: ""+prog+"",dept: ""+obj.value+""}, function(data){
		$('#secfill').html(data);
	});
	}
}
function fillStu(obj) {
	if(obj.value!='invalid') {
	var prog = document.getElementById('prog').value;
	var dept= document.getElementById('dept').value;
	$.post("ajax_fillstu.php", {prog: ""+prog+"",dept: ""+dept+"",sec: ""+obj.value+""}, function(data){
		$('#student-select').html(data);
	});
	}
}
</script>
</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="../images/header.png" alt="sastra university"/></center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome <?php echo $staffname; ?>,</div>
<div id="menu">
		<img src="../images/Sastra1.png" width="170" alt="sastra university" />
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
        <li><a href="lagreport.php">Get Lag Report</a></li>
        <li><a href="../logout.php">Sign Out</a></li>
			</ul>
			</div>
		<img src="../images/menu-bottom.png" alt="menu-bottom"/>
</div>
<div id="content">
	<div id="main">
	<img src="../images/cont-top.png" alt="cont-top"/>
   <div id="data-relation" class="main">
		<h2 class='heading'>Students to Courses</h2>
			<form action="getlagreport.php" method="post" target="_blank" onSubmit="return validatedr()">
			<div id="data-left-cs">
			<p>
			Select Programme :
			</p>
			<div style="margin-left:20px;"> 
			<select onchange='fillDept(this)' id='prog' name="prog">
				<option value='invalid'>Choose a Programme</option>
				<?php
					require_once('../db_config.php');
					$progQuery="SELECT distinct program FROM program_master";
					$progResult=mysql_query($progQuery);
					if($progResult) {
						while($row=mysql_fetch_array($progResult)) {
							echo "<option value='$row[0]'>$row[0]</option>";
						}
					}	
				?>
			</select>&nbsp;<span id="forprog" class="mandatory"> *</span>	
			</div>
			<p>
			Select Department :
			</p>
			<div id="deptfill" style="margin-left:20px;">
				<select id='dept' name="dept">
					<option value='invalid'>Choose a Programme Above</option>
				</select>&nbsp;<span id="fordept" class="mandatory"> *</span>
			</div>
			<p>
			Select Section :
			</p>
			<div id="secfill" style="margin-left:20px;">
				<select id='sec' name="section">
					<option value='invalid'>Choose a Department Above</option>
				</select>&nbsp;<span id="forsec" class="mandatory"> *</span>
			</div>
            <p>
              <label>
              <input type="submit" name="button" id="button" value="Submit" />
              </label>
            </p>
			</div>
         </form>&nbsp;
	</div>
<img src="../images/cont-bottom.png" alt="cont-bottom"/>
<div style="clear:both">&nbsp;</div>
</div>	
</div>
</div>
<div id="footer">
&copy; 2010 SASTRA University - SRC Campus&nbsp; | &nbsp;Engineered By GLOSS Community | <a href="../bug_filing.php?ref=admin" target="_blank">Report Bugs</a> | <a href="../feedback.php" target="_blank">Feedback</a> | <a href="../credits.php" target="_blank">Credits</a>
</div>
</div>
</body>
</html>