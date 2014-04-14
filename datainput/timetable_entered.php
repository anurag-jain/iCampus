<?php
/*
Author : Anurag
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
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
SASTRA University - SRC
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />

</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="../images/header.png" alt="sastra university"/></center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome Data Entry User,</div>
<div id="menu">
		<img src="../images/Sastra1.jpg" width="170" alt="sastra university" />
		<div class="clear"></div>
		<img src="../images/menu-top.png" alt="menu-top"/>
			<div id="nav">
		<ul>
                <li><a href="dataentry_index.php">Data Entry Home</a></li>
        <li><a href="addstaff.php">Add Staff</a></li>
		<li><a href="editstaff.php">Edit Staff</a></li>
        <li><a href="delstaff.php">Delete Staff</a></li>
		<li><a href="addstudent.php">Add Student</a></li>
		<li><a href="editstudent.php">Edit Student</a></li>
        <li><a href="delstudent.php">Delete Student</a></li>
		<li><a href="addcourse.php">Add Course</a></li>
        <li><a href="editcourse.php">Edit Course</a></li>
        <li><a href="delcourse.php">Delete Course</a></li>
		<li><a href="adddept.php">Add Department</a></li>
		<li><a href="deletedept.php">Delete Department</a></li>
		<li><a href="dataentry_section.php">Add Section</a></li>
        <li><a href="dataentry_relation.php">Populate Section</a></li>
		<li><a href="timetable_entry.php">Add Timetable</a></li>
		<li><a href="stafflist.php">Staff List</a></li>
		<li><a href="courselist.php">Course List</a></li>
		<li><a href="sectionlist.php">Section List</a></li>
		<li><a href="deptlist.php">Department List</a></li>
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
	  <h2 class='heading'>Timetable entry</h2>
	  </br></br></br>
	  <p>&nbsp;</p>
      <br />
      <div id="staffid_div" align="center">
      <?php
	  
		require_once('../db_config.php');	  
	  	$mon=array();
		$tue=array();
		$wed=array();
		$thu=array();
		$fri=array();
		$sat=array();
		$sun=array();
		
	  
		
	
		$i=1;
		
		
		
	  	while($i<=12)
		{
			
	  		$mon[$i]=$_POST['mon-'.$i];
		
			$i++;
			
		}		
		
		$i=1;
	
			while($i<=12)
		{
			
	  		$tue[$i]=$_POST['tue-'.$i];
			
			$i++;
		}
		$i=1;

			while($i<=12)
		{
			
	  		$wed[$i]=$_POST['wed-'.$i];
			
			$i++;
		}
		$i=1;
	
			while($i<=12)
		{
			
	  		$thu[$i]=$_POST['thu-'.$i];
			$i++;
		}
		$i=1;
		
			while($i<=12)
		{
			
	  		$fri[$i]=$_POST['fri-'.$i];
			
			$i++;
		}
		$i=1;
		
			while($i<=12)
		{
			
	  		$sat[$i]=$_POST['sat-'.$i];
			
			$i++;
		}
		$i=1;
		
			while($i<=12)
		{
			
	  		$sun[$i]=$_POST['sun-'.$i];
			
			$i++;
		}
		
		//-------------Monday
		$j=1;
	
		while($j<sizeof($mon))
		{
			if($mon[$j]!="")
			{
		$part=explode('-',$mon[$j]);
		//echo $part[0]." ".$part[2];
		$monQuery="SELECT relationid FROM relation WHERE coursecode='$part[0]' and section_id=$part[2] ";
		//echo $monQuery.":-";
		$result=mysql_query($monQuery);
		$count=mysql_num_rows($result);
		$i=1;
		
		while($i<$count)
		{
			while($row=mysql_fetch_array($result))
			{
			
			
			$moninsertQuery="INSERT into periodlist VALUES($row[0],concat('mon-',$j))";
			//echo $moninsertQuery." - ";
			//echo $row[0];
			$result2=mysql_query($moninsertQuery);
			
			}
			$i++;
		}
		 $j++;
			}
			else
			$j++;
		}
		
		
		//---------------Tuesday----
		$j=1;
	
		while($j<sizeof($tue))
		{
			if($tue[$j]!="")
			{
		$part=explode('-',$tue[$j]);
		//echo $part[0]." ".$part[2];
		$tueQuery="SELECT relationid FROM relation WHERE coursecode='$part[0]' and section_id=$part[2] ";
		//echo $tueQuery.":-";
		$result=mysql_query($tueQuery);
		$count=mysql_num_rows($result);
		$i=1;
		
		while($i<$count)
		{
			while($row=mysql_fetch_array($result))
			{
			
			
			$tueinsertQuery="INSERT into periodlist VALUES($row[0],concat('tue-',$j))";
			//echo $tueinsertQuery." - ";
			//echo $row[0];
			$result2=mysql_query($tueinsertQuery);
			
			}
			$i++;
		}
		 $j++;
			}
			else
			$j++;
		}
		
		//------------Wednesday----
		
		$j=1;
	
		while($j<sizeof($wed))
		{
			if($wed[$j]!="")
			{
		$part=explode('-',$wed[$j]);
		//echo $part[0]." ".$part[2];
		$wedQuery="SELECT relationid FROM relation WHERE coursecode='$part[0]' and section_id=$part[2] ";
		//echo $wedQuery.":-";
		$result=mysql_query($wedQuery);
		$count=mysql_num_rows($result);
		$i=1;
		
		while($i<$count)
		{
			while($row=mysql_fetch_array($result))
			{
			
			
			$wedinsertQuery="INSERT into periodlist VALUES($row[0],concat('wed-',$j))";
			//echo $wedinsertQuery." - ";
			//echo $row[0];
			$result2=mysql_query($wedinsertQuery);
			
			}
			$i++;
		}
		 $j++;
			}
			else
			$j++;
		}
		
		//-------Thursday---
		
		$j=1;
	
		while($j<sizeof($thu))
		{
			if($thu[$j]!="")
			{
		$part=explode('-',$thu[$j]);
		//echo $part[0]." ".$part[2];
		$thuQuery="SELECT relationid FROM relation WHERE coursecode='$part[0]' and section_id=$part[2] ";
		//echo $thuQuery.":-";
		$result=mysql_query($thuQuery);
		$count=mysql_num_rows($result);
		$i=1;
		
		while($i<$count)
		{
			while($row=mysql_fetch_array($result))
			{
			
			
			$thuinsertQuery="INSERT into periodlist VALUES($row[0],concat('thu-',$j))";
			//echo $thuinsertQuery." - ";
			//echo $row[0];
			$result2=mysql_query($thuinsertQuery);
			
			}
			$i++;
		}
		 $j++;
			}
			else
			$j++;
		}
		
		//-------Friday-----
		$j=1;
	
		while($j<sizeof($fri))
		{
			if($fri[$j]!="")
			{
		$part=explode('-',$fri[$j]);
		//echo $part[0]." ".$part[2];
		$friQuery="SELECT relationid FROM relation WHERE coursecode='$part[0]' and section_id=$part[2] ";
		//echo $friQuery.":-";
		$result=mysql_query($friQuery);
		$count=mysql_num_rows($result);
		$i=1;
		
		while($i<$count)
		{
			while($row=mysql_fetch_array($result))
			{
			
			
			$friinsertQuery="INSERT into periodlist VALUES($row[0],concat('fri-',$j))";
			//echo $friinsertQuery." - ";
			//echo $row[0];
			$result2=mysql_query($friinsertQuery);
			
			}
			$i++;
		}
		 $j++;
			}
			else
			$j++;
		}
		
		//---------saturday----
		
		$j=1;
	
		while($j<sizeof($sat))
		{
			if($sat[$j]!="")
			{
		$part=explode('-',$sat[$j]);
		//echo $part[0]." ".$part[2];
		$satQuery="SELECT relationid FROM relation WHERE coursecode='$part[0]' and section_id=$part[2] ";
		//echo $satQuery.":-";
		$result=mysql_query($satQuery);
		$count=mysql_num_rows($result);
		$i=1;
		
		while($i<$count)
		{
			while($row=mysql_fetch_array($result))
			{
			
			
			$satinsertQuery="INSERT into periodlist VALUES($row[0],concat('sat-',$j))";
			//echo $satinsertQuery." - ";
			//echo $row[0];
			$result2=mysql_query($satinsertQuery);
			
			}
			$i++;
		}
		 $j++;
			}
			else
			$j++;
		}
		
		//-------Sunday-------
		$j=1;
	
		while($j<sizeof($sun))
		{
			if($sun[$j]!="")
			{
		$part=explode('-',$sun[$j]);
		//echo $part[0]." ".$part[2];
		$sunQuery="SELECT relationid FROM relation WHERE coursecode='$part[0]' and section_id=$part[2] ";
		//echo $sunQuery.":-";
		$result=mysql_query($sunQuery);
		$count=mysql_num_rows($result);
		$i=1;
		
		while($i<$count)
		{
			while($row=mysql_fetch_array($result))
			{
			
			
			$suninsertQuery="INSERT into periodlist VALUES($row[0],concat('sun-',$j))";
			//echo $suninsertQuery." - ";
			//echo $row[0];
			$result2=mysql_query($suninsertQuery);
			
			}
			$i++;
		}
		 $j++;
			}
			else
			$j++;
		}
		
		echo "<div class='confirmmsg'>The timetable entry was done. Please check with the staff timetable once.</div>";
	  ?>
      </div>	
     
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p><br />
      </p>
      
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
