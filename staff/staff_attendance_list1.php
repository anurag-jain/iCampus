<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['type']=='staff')
{
$user=$_SESSION['username'];
}
else { ?>
<script>
alert("Session Expired!!!");
window.location="../index.php";
</script>
<?php }
$staffid=$user;
$staffname=$_SESSION['staffname'];
$department=$_SESSION['department'];
$pass=$_SESSION['password'];
include ('staff_class.php');
include ('security_class.php');
$staff = new staff_class($staffid,$staffname,$department,$pass);
$security=new security_class($staffid);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title>
SASTRA University - SRC
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function countChar() {
	var val=document.getElementById('textarea');
	val.value=val.value.substring(0,200);
	var cnt=200-val.value.length;
	var dest=document.getElementById('cnt');
	dest.innerHTML=cnt;
	val.value=val.value.substring(0,199);
}
function totalPresent()
{
	var t=0;
	var c=0;
	var chkbox=document.getElementsByTagName('input');
	for(var i=0;i<chkbox.length;i++)
	{
		if(chkbox[i].type=="checkbox") {
			t++;
			if(chkbox[i].checked==true)
				c++;
		}
	}
	document.getElementById("totalpresent").innerHTML=c;
	document.getElementById('totalstudent').innerHTML=t;
	document.getElementById("totalabsent").innerHTML=t-c;
	
}
function clear()
{
	alert("blank");
	document.getElementById('blank').innerHTML="";
	}
function commentFilled()
{
	
	if(document.getElementById('textarea').value=="")
	{
	document.getElementById('blank').innerHTML="*Please enter the required field";
	return false;
	}
	else 
	return true;
	}
	
function toggle()
{
	
	var form = window.document.forms[0];
	if(document.getElementById('toggler').innerHTML=="Unmark all")
	{
	document.getElementById('toggler').innerHTML="Mark all";
	
	
		for (var i = 0; i < form.elements.length; i++) {
		if (form.elements[i].type == "checkbox") {
		form.elements[i].checked="";
		totalPresent();
		}
		}
	
	
	}
	else 
	{
	document.getElementById('toggler').innerHTML="Unmark all";
		for (var i = 0; i < form.elements.length; i++) {
		if (form.elements[i].type == "checkbox") {
		form.elements[i].checked="checked";
		totalPresent();
		}
		}

	}
}
</script>
</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="../images/header.png" alt="sastra university"/></center></div>        
			<?php
			$enpid=$_GET['pid'];
			$part=explode('-',$enpid);
			$pid1=$security->decrypt(urldecode($part[0]));
			$pid=$pid1."-".$part[1];
			$list=$staff->displayStudentList($pid);
			$endate=$_GET['date'];
			$date=$security->decrypt(urldecode($endate));
			$section=$staff->getSection($list[1][2]);
			switch($pid1)
				{
					case('sun'):
								$day="Sunday";
								break;
					case('mon'):
								$day="Monday";
								break;
					case('tue'):
								$day="Tuesday";
								break;
					case('wed'):
								$day="Wednesday";
								break;
					case('thu'):
								$day="Thursday";
								break;
					case('fri'):
								$day="Friday";
								break;
					case('sat'):
								$day="Saturday";
								break;
			
					}
			$brPart=explode(':',$section);
			
			?>

<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "Date : ".$date."&nbsp;&nbsp;"."Day : ".$day."&nbsp;&nbsp;"."Branch : ".$brPart[1]."&nbsp;&nbsp;";
				echo "Year : ".$brPart[0]."&nbsp;&nbsp;"."Section : ".$brPart[2]."&nbsp;&nbsp;"."Period : ".$part[1];?></div>
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
	<div id="studenthome" class="main">
		<h2 class='heading'>Post Attendance</h2>
    	<?php
			if($staff->getFlag($date,$pid)==true)
			{
			$i=1; 
			?>
    <form name="form1" action="update_attn.php?pid=<?php echo $enpid."&date=".$endate."&section=".$list[1][2];?>" method="POST" onSubmit="return commentFilled()">   
		<div id="staff-sum">
        	
			<p>
            	Total Present : <span id="totalpresent"><?php echo $i-1;?></span>
			</p>
            <p>
            	Total Absent : <span id="totalabsent">0</span>
			</p>
			<p>
				Total Students : <span id="totalstudent"><?php echo $i-1;?></span>
			</p>
			<p></p>
			<h2 style="font-size:90%">&nbsp;&nbsp;Courses Covered&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id='cnt'>200</span></h2>
			<textarea style='margin-left:5px'  id="textarea" name="textarea" onClick="clear()" onkeyup="countChar()"></textarea>
			<p align=center>
			<input type='submit' value='Post Attendance' id='submit' name='submit' />&nbsp;
			</p>
            <p id="blank" align="center" style="color:#930"></p>
			<p align=center>&nbsp;</p>
            
		</div>
  
		<div id="staff-student-list">
		<table cellpadding=0 cellspacing=1 width=100%>
			<th>S No</th>
			<th>Reg No</th>
			<th>Student Name</th>
			<th>Present</th>
            <?php
			while($list[$i][0]!=1 && $list[$i][3]!=1)
			{
			?>
			<tr <?php if($i%2!=0) {?>class='odd'<?php } else {?>class='even'<?php }?>>
            		<td><?php echo $i;?></td>
                    <td><?php echo $list[$i][0];?></td>
                    <td><?php echo $list[$i][3]; ?></td>
                    <td>
                    <input name="<?php echo $i; ?>" type="hidden"  value="<?php echo $list[$i][1]."-A-". $list[$i][0];?>" />
        			<input name="<?php echo $i; ?>" type="checkbox" checked="checked" value="<?php echo $list[$i][1]."-P-". $list[$i][0];?>" onClick="totalPresent()"/>
                    </td>
            </tr>
			  <?php $i++;}?>
		<script language="javascript">
		totalPresent();	
		</script>
		</table>

		</div>
<div id="toggler" align="center" style="float:left; margin-left:425px; width:100px; text-decoration:underline; cursor:pointer;" onClick="toggle()">Unmark all </div>
		<p>&nbsp;</p>
        
    </form>
        <?php
			}
			else
			{
				echo "<div class=\"msg\">"."The Attendance for this day has already been posted"."</div>";
			}
		
	?>
	</div>
	<!--It Ends!-->
	<img src="../images/cont-bottom.png" alt="cont-bottom"/>
	</div>
</div>
<div style="clear:both">&nbsp;</div>
</div>	

<div id="footer">
&copy; 2010 SASTRA University - SRC Campus&nbsp; | &nbsp;Engineered By GLOSS Community | <a href="../bug_filing.php?ref=staff" target="_blank">Report Bugs</a> | <a href="../feedback.php" target="_blank">Feedback</a> | <a href="../credits.php" target="_blank">Credits</a>
</div>
</div>
</div>
</body>
</html>
