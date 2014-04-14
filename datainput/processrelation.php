<?php
/*
Author : KP
Date : 28/02/2010
*/
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['type']=='dataentry')
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
$success=0;
function deleteData($studentlist,$coursecode,$staffid) {
	require_once('../db_config.php');
	foreach($studentlist as $regno) {
		if($regno !='') {
			$delquery="DELETE FROM relation WHERE "
					."regnumber='$regno' AND coursecode='$coursecode' AND staffid='$staffid'";
			$dresult = mysql_query($delquery);
		}
	}
}
?>
<?php
set_time_limit(2000);
require_once('../db_config.php');
	if(isset($_POST['coursecode']))
		$sec = $_POST['sec'];
	
	if(isset($_POST['studentlist']))
		$studentdata = $_POST['studentlist'];
	
	$studentlist = explode(',',$studentdata);
	$studentlist = array_unique($studentlist);
	
	$c=1;
	$sclist=array();
	while(isset($_POST['sc'.$c])) {
		if(isset($_POST['sc'.$c])!='') {
		$sctemp = $_POST['sc'.$c];
		$scl=explode('#',$sctemp);
		$scc=explode('|',$scl[0]);
		$sclist[$c]=$scc[0].'-'.$scl[1];
		$c++;
		//$scc[0] = coursecode and $scc[1]=staff id
		deleteData($studentlist,$scc[0],$scl[1]);
		}
	}
	?>
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
SASTRA University - SRC
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../jquery-1.2.6.min.js"></script>
</head>
<body>
<div id="wrapper_outer">
<div id="header" style="width:100%"><center><img src="../images/header.png" alt="sastra university"/></center></div>
<div style="position:fixed;width:100%;margin:0 auto;border-bottom:2px solid #0a568c;font-weight:bold;font-size:20px;background:#ffffff;color:#ff2233;opacity:0.7"><center>Do not refresh/reload. Wait till the Page Gets Stabilized. Scroll Down for Options.</center></div>
<script>
function refreshParent() {
  window.opener.location.href = window.opener.location.href;

  if (window.opener.progressWindow)
		
 {
    window.opener.progressWindow.close()
  }
  window.close();
}
function addRelationData(regno,coursecode,staffid,sec) {
	var s=true;
	$.post("ajax_insrel.php", {regno: ""+regno+"",coursecode: ""+coursecode+"",staffid: ""+staffid+"",sec: ""+sec+""}, function(data){
	$('#output').append(data);
	});
	return s;
}
function delRelationData(regno,coursecode) {
	var s=true;
	alert(regno);
	$.post("ajax_delrel.php", {regno: ""+regno+"",coursecode: ""+coursecode+""}, function(data){
	$('#output').append(data);
	});
	return s;
}
function processRelation(stud,cour,staf,sec) {
	var res=true;
	
	for(var j=0;j<cour.length;j++) {
		var coursecode=cour[j];
		var staffid=staf[j];
		for(var i=0;i<stud.length && res;i++) {
			var regno=stud[i];
			res=addRelationData(regno,coursecode,staffid,sec);
		}
	}
	
	if(!res) {
		res=true;
		for(var i=0;i<stud.length;i++) {
			res=delRelationData(stud[i],coursecode);
		}	
	}
	if(res) 
		alert("Operation Completed Successfully.. Click here to continue...");
	else
		alert("Operation Failed! Click here to continue...");
	//refreshParent();
}
</script>
<div id="output" style="width:800px;margin:0 auto;margin-top:40px;font-size:10px">
&nbsp;
</div>
<?php

	echo '<script> var students=new Array();';
	$i=0;
	foreach($studentlist as $regno) {
	if($regno !='') {
			echo "students[$i]='$regno';";
			$i++;
		}
	}
	echo 'var course=new Array();';
	echo 'var staff=new Array();';
	$i=0;
	foreach($sclist as $sc) {
		if($sc!='') {
			$scr=explode('-',$sc);
			echo "course[$i]='$scr[0]';";
			echo "staff[$i]='$scr[1]';";
			$i++;
		}
	}
	echo "processRelation(students,course,staff,'$sec');</script>";
	?>
<div style="width: 100%; background: none repeat scroll 0pt 0pt rgb(0, 255, 255); font-size: 20px; font-weight: bold; position: absolute;" align='center'><a href='v_and_d_section.php?secid=<?php echo $sec; ?>'>1. Verify and Delete</a> (or) <a href='dataentry_relation.php'>2. Populate Another Section?</a></div>
</div>
</body>
</html>