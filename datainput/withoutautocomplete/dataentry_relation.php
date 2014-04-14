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
		$.post("ajax_fillsec.php", {prog: ""+obj.value+""}, function(data){
		$('#secfill').html(data);
	});
	}
}
function fillStu(obj) {
	if(obj.value!='invalid') {
	var prog = document.getElementById('prog').value;
	$.post("ajax_fillstu.php", {prog: ""+prog+"",sec: ""+obj.value+""}, function(data){
		$('#student-select').html(data);
	});
	}
	selectCourse();
}
function validatedr() {
	var success = true;
	var prog = document.getElementById('prog');
	var dept = document.getElementById('dept');
	var sec = document.getElementById('sec');
	var staffid = document.getElementById('staffid');
	var coursecode = document.getElementById('coursecode');
	var studentlist = document.getElementById('studentlist');
	
	if(prog.value=='invalid') {
		document.getElementById('forprog').style.display='inline';
		success=false;
	}
	else
		document.getElementById('forprog').style.display='none';
	
	if(sec.value=='invalid') {
		document.getElementById('forsec').style.display='inline';
		success=false;
	}
	else
		document.getElementById('forsec').style.display='none';
		
	/* Add pattern match for (0123456789,) */
	if(studentlist.value=='') {
		alert("Please Enter Valid List Of Students");	
		success=false;
	}
	return success;
}
function copyvalues() {
	var dest= document.getElementById('studentlist');
	dest.value='';
	var data = document.getElementById('student-select').getElementsByTagName('input');
	for(var i=0;i<data.length;i++) {
		if(data[i].type=='checkbox') 
			if(data[i].checked == true ) {
			dest.value+=data[i].value+",";
		}
	}
}
function selectStudents() {
	var listtable = document.getElementById('listtable');
		var rows = listtable.getElementsByTagName('tr');
		if(rows.length>1) {
			document.getElementById('data-right-stu').style.display="block";
			document.getElementById('listwrapper').style.display="block";
		
		}
		else {
			document.getElementById('data-right-stu').style.display="none";
			document.getElementById('listwrapper').style.display="none";
		}
}
function addStaffCourse() {
	var success=true;
	var staffid = document.getElementById('staffid');
	var coursecode = document.getElementById('coursecode');
	
	if(staffid.value=='invalid') {
		document.getElementById('forstaff').style.display='inline';
		success=false;
	}
	else
		document.getElementById('forstaff').style.display='none';
	
	if(coursecode.value=='invalid') {
		document.getElementById('forcourse').style.display='inline';
		success=false;
	}
	else
		document.getElementById('forcourse').style.display='none';
	if(success) {
		//Create new td & hidden if necessary
		var listtable = document.getElementById('listtable');
		var rows = listtable.getElementsByTagName('tr');
		//alert(rows.length);
		var newtr = document.createElement('tr');
		newtr.setAttribute('id','sc'+rows.length);
		if(rows.length%2==0)
			newtr.setAttribute('class','even');
		else
			newtr.setAttribute('class','odd');
		var stafftd = document.createElement('td');
		stafftd.setAttribute('id','staff'+rows.length);
		stafftd.setAttribute('name','staff'+rows.length);
		stafftd.innerHTML = staffid.value;
		var coursetd = document.createElement('td');
		coursetd.setAttribute('id','course'+rows.length);
		coursetd.setAttribute('name','course'+rows.length);
		coursetd.innerHTML = coursecode.value;
		var remtd = document.createElement('td');
		var rema = document.createElement('a');
		rema.setAttribute('href','javascript:removeStaffCourse(\'sc'+rows.length+'\')');
		rema.innerHTML='Remove';
		remtd.appendChild(rema);
		var newinput = document.createElement('input');
		newinput.setAttribute('type','hidden');
		newinput.setAttribute('id','sc'+rows.length);
		newinput.setAttribute('name','sc'+rows.length);
		newinput.setAttribute('value',coursecode.value+'#'+staffid.value);
		coursetd.appendChild(newinput);
		newtr.appendChild(coursetd);
		newtr.appendChild(stafftd);
		newtr.appendChild(remtd);
		//alert('sc'+rows.length);
		listtable.appendChild(newtr);
		staffid.value='invalid';
		coursecode.value='invalid';
		}
		selectStudents();
}
function removeStaffCourse(remelem) {
	
	var toRem = document.getElementById(remelem);
	var listtable = document.getElementById('listtable');
	listtable.removeChild(toRem);
	var rows = listtable.getElementsByTagName('tr');
	for(var i=1;i<rows.length;i++) {
		var courseId=/course\d+/ig;
		var staffId=/staff\d+/ig;
		var scId=/sc\d+/ig;
		var strData=rows[i].innerHTML;
		strData=strData.replace(courseId,'course'+i);
		strData=strData.replace(staffId,'staff'+i);
		strData=strData.replace(scId,'sc'+i);
		rows[i].innerHTML=strData;
		rows[i].id="sc"+i;
		rows[i].name="sc"+i;
		var clsname;
		if(i%2==0)
			clsname='even';
		else
			clsname='odd'
		rows[i].setAttribute('class',clsname);
	}
	selectStudents();
}
function selectCourse() {
	document.getElementById('staff-course').style.display="block";
}
</script>
</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="../images/header.png" alt="sastra university"/></center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome Data Entry User,</div>
<div id="menu"> <img src="../images/Sastra1.png" width="170" alt="sastra university" />
    <div class="clear"></div>
  <img src="../images/menu-top.png" alt="menu-top"/>
    <div id="nav">
      <ul>
        <li><a href="dataentry_index.php">Data Entry Home</a></li>
        <li><a href="addstaff.php">Add Staff</a></li>
        <li><a href="delstaff.php">Delete Staff</a></li>
        <li><a href="addcourse.php">Add Course</a></li>
        <li><a href="editcourse.php">Edit Course</a></li>
        <li><a href="delcourse.php">Delete Course</a></li>
        <li><a href="dataentry_section.php">Add Section</a></li>
        <li><a href="dataentry_relation.php">Populate Section</a></li>
		<li><a href="../logout.php">Sign Out</a></li>
      </ul>
    </div>
  <img src="../images/menu-bottom.png" alt="menu-bottom"/> </div>
<div id="content">
	<div id="main">
	<img src="../images/cont-top.png" alt="cont-top"/>
	<!--Write code here!-->
		<div id="data-relation" class="main">
		<h2 class='heading'>Students to Courses</h2>
			<form action="processrelation.php" method="post" target="_blank" onsubmit="return validatedr()">
			<div id="data-left-cs">
			<p>
			Select Programme :
			</p>
			<div style="margin-left:20px;"> 
			<select onchange='fillSec(this)' id='prog'>
				<option value='invalid'>Choose a Programme</option>
				<?php
					require_once('../db_config.php');
					$progids=$_SESSION['department'];
					$progs = explode('-',$progids);
					$progQuery="SELECT distinct program,department FROM program_master where program_id=$progs[0]";
					$i=1;
					while($progs[$i]!="") {
						$progQuery=$progQuery." or program_id='$progs[$i]'";
						$i++;
					}
					
					$progResult=mysql_query($progQuery);
					if($progResult) {
						while($row=mysql_fetch_array($progResult)) {
							echo "<option value='$row[0]-$row[1]'>$row[0] - $row[1]</option>";
						}
					}	
				?>
			</select>&nbsp;<span id="forprog" class="mandatory"> *</span>	
			</div>
			<p>
			Select Section :
			</p>
			<div id="secfill" style="margin-left:20px;">
				<select id='sec' onchange="selectCourse()">
					<option value='invalid'>Choose a Programme Above</option>
				</select>&nbsp;<span id="forsec" class="mandatory"> *</span>
			</div>
			<div id="staff-course" style="display:none">
			<hr>
			<p>
			Select Staff :
			</p>
			<p><select id="staffid" name='staffid'>
			<option value='invalid'>Choose a Staff</option>
			<?php
			require_once('../db_config.php');
			$staffQuery="SELECT staffid,staffname FROM staffmaster";
			$staffResult=mysql_query($staffQuery);
			if($staffResult) {
				while($row=mysql_fetch_array($staffResult)) {
					echo "<option value='$row[0]'>$row[1] - $row[0]</option>";
				}
			}
			?>
			</select>&nbsp;<span id="forstaff" class="mandatory"> *</span></p>
			<p>
			Select Course :
			</p>
			<p><select id="coursecode" name='coursecode'>
			<option value='invalid'>Choose a Course</option>
			<?php
				require_once('../db_config.php');
				$courseQuery="SELECT coursecode,coursename FROM coursemaster";
				$courseResult=mysql_query($courseQuery);
				if($courseResult) {
					while($row=mysql_fetch_array($courseResult)) {
						echo "<option value='$row[0] | $row[1]'>$row[0] - $row[1]</option>";
					}
				}
			?>
			</select>&nbsp;<span id="forcourse" class="mandatory"> *</span></p>
				
				&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" onclick='addStaffCourse()'>Add Course</button>
				
				<div id="listwrapper" style='border:dotted 1px;width:700px;margin:0 auto;padding-top:10px;display:none;'>
					<table id='listtable' cellpadding=0 cellspacing=1 width='690px' align=center >
					<th width='68%'> Course Id & Name </th>
					<th width='25%'>Staff Id</th>
					<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
					</table>
				</div>
				
			</div>
			</div>
			
			<div id="data-right-stu" style="display:none">
				<hr>
				<div id="data-stu-list">
				<p>
				Select Student List :
				</p>
					<div style="float:right">
					<textarea id="studentlist" name="studentlist"></textarea>
					</div>
					<div id="student-select">
					&nbsp;&nbsp;&nbsp;&nbsp;Please Select Programme, Year and Section 
					</div>
					
				</div>
				<p>
				<input type="submit" id="submit" name="submit" value="Add Students" />
				</p>
			</div>
			</form>&nbsp;
		</div>
	<!--It Ends!-->
	<img src="../images/cont-bottom.png" alt="cont-bottom"/>
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
