<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
SASTRA University - SRC
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function getCourseCode(dest){
	document.getElementById('desti').value=dest.id;
	var q=window.open("choosesection.html","choosecourse","width=850,height=450");
	
}
</script>

</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="../images/header.png" alt="sastra university"/></center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome Tupac Shakur,</div>
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
	  <h2 class='heading'>Timetable entry</h2>
	
      <div align="center">
        <?php 
	  require_once('../db_config.php');
	  $staffid=$_POST['staffid'];
	  $_SESSION['staffid']=$staffid;
	  $fetchtimetableQuery="SELECT distinct a.coursecode,b.section,a.section_id, c.coursename,d.program,d.department,d.year "
	  					  ."FROM relation a, sectionmaster b,coursemaster c,program_master d WHERE "
					      ."staffid='$staffid' and a.section_id=b.section_id and a.coursecode=c.coursecode and b.program_id=d.program_id";
	
	
	  $result=mysql_query($fetchtimetableQuery) ;
	  $norow=mysql_num_rows($result);
	  
	  
	  $i=0;
	 
	  ?>
        
        <table id="course_table" width="641" border="1" align="center" cellspacing="0" cellpadding="0">
          <tr>
            <th>Courses code</th>
            <th>Course name</td>
            <th>Branch and year</th>
            <th>Section</th>
            <th align="center" style="display:none">Section id</th>
            </tr>
          <?php  while($row=mysql_fetch_array($result))
				{	  
		  ?>
          <tr>
            <td><?php echo $row[0]; ?></td>
            <td><?php echo $row[3]; ?></td>
            <td><?php echo $row[4].":".$row[5].":".$row[6]; ?></td>
            <td><?php echo $row[1];?></td>
            <td style="display:none"><?php echo $row[2];?></td>
            </tr>
          <?php } ?>
        </table>	
        <input type="hidden" id="desti" />    
      </div>
      <p>&nbsp;</p>
      <p align="center">Please enter your subject and section entries in the corresponding day and period slots. Also re-check your entries before confirming.</p>
      <p align="center">&nbsp;</p>
     <form name="form1" action="timetable_entered.php" method="post">
      <table width="553" border="1" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <th width="31">&nbsp;</th>
          <th width="72">Mon</th>
          <th width="72">Tue</th>
          <th width="72">Wed</th>
          <th width="72">Thu</th>
          <th width="72">Fri</th>
          <th width="72">Sat</th>
          <th width="72">Sun</th>
        </tr>
        <tr>
          <th>I</th>
          <td><div align="center">
            <label>
              <input name="mon-1" type="text" id="mon-1" size="12" onClick="getCourseCode(this)"/>
            </label>
          </div></td>
          <td><div align="center">
            <input name="tue-1" type="text" id="tue-1" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="wed-1" type="text" id="wed-1" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="thu-1" type="text" id="thu-1" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="fri-1" type="text" id="fri-1" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="sat-1" type="text" id="sat-1" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="sun-1" type="text" id="sun-1" size="12" onClick="getCourseCode(this)"/>
          </div></td>
        </tr>
        <tr>
          <th>II</th>
          <td><div align="center">
            <label>
              <input name="mon-2" type="text" id="mon-2" size="12" onClick="getCourseCode(this)"/>
            </label>
          </div></td>
          <td><div align="center">
            <input name="tue-1" type="text" id="tue-2" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="wed-2" type="text" id="wed-2" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="thu-2" type="text" id="thu-2" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="fri-2" type="text" id="fri-2" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="sat-2" type="text" id="sat-2" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="sun-2" type="text" id="sun-2" size="12" onClick="getCourseCode(this)"/>
          </div></td>
        </tr>
        <tr>
          <th>III</th>
          <td><div align="center">
            <label>
              <input name="mon-3" type="text" id="mon-3" size="12" onClick="getCourseCode(this)"/>
            </label>
          </div></td>
          <td><div align="center">
            <input name="tue-3" type="text" id="tue-3" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="wed-3" type="text" id="wed-3" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="thu-3" type="text" id="thu-3" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="fri-3" type="text" id="fri-3" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="sat-3" type="text" id="sat-3" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="sun-3" type="text" id="sun-3" size="12" onClick="getCourseCode(this)"/>
          </div></td>
        </tr>
        <tr>
          <th>IV</th>
          <td><div align="center">
            <label>
              <input name="mon-4" type="text" id="mon-4" size="12" onClick="getCourseCode(this)"/>
            </label>
          </div></td>
          <td><div align="center">
            <input name="tue-4" type="text" id="tue-4" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="wed-4" type="text" id="wed-4" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="thu-4" type="text" id="thu-4" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="fri-4" type="text" id="fri-4" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="sat-4" type="text" id="sat-4" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="sun-4" type="text" id="sun-4" size="12" onClick="getCourseCode(this)"/>
          </div></td>
        </tr>
        <tr>
          <th>V</th>
                    <td><div align="center">
            <label>
              <input name="mon-5" type="text" id="mon-5" size="12" onClick="getCourseCode(this)"/>
            </label>
          </div></td>
          <td><div align="center">
            <input name="tue-5" type="text" id="tue-5" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="wed-5" type="text" id="wed-5" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="thu-5" type="text" id="thu-5" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="fri-5" type="text" id="fri-5" size="12" onClick="getCourseCode(this)" />
          </div></td>
          <td><div align="center">
            <input name="sat-5" type="text" id="sat-5" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="sun-5" type="text" id="sun-5" size="12" onClick="getCourseCode(this)"/>
          </div></td>
        </tr>
        <tr>
          <th>VI</th>
                    <td><div align="center">
            <label>
              <input name="mon-6" type="text" id="mon-6" size="12" onClick="getCourseCode(this)"/>
            </label>
          </div></td>
          <td><div align="center">
            <input name="tue-6" type="text" id="tue-6" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="wed-6" type="text" id="wed-6" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="thu-6" type="text" id="thu-6" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="fri-6" type="text" id="fri-6" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="sat-6" type="text" id="sat-6" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="sun-6" type="text" id="sun-6" size="12" onClick="getCourseCode(this)"/>
          </div></td>
        </tr>
        <tr>
          <th>VII</th>
                    <td><div align="center">
            <label>
              <input name="mon-7" type="text" id="mon-7" size="12" onClick="getCourseCode(this)"/>
            </label>
          </div></td>
          <td><div align="center">
            <input name="tue-7" type="text" id="tue-7" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="wed-7" type="text" id="wed-7" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="thu-7" type="text" id="thu-7" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="fri-7" type="text" id="fri-7" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="sat-7" type="text" id="sat-7" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="sun-7" type="text" id="sun-7" size="12" onClick="getCourseCode(this)"/>
          </div></td>
        </tr>
        <tr>
          <th>VIII</th>
                    <td><div align="center">
            <label>
              <input name="mon-8" type="text" id="mon-8" size="12" onClick="getCourseCode(this)"/>
            </label>
          </div></td>
          <td><div align="center">
            <input name="tue-8" type="text" id="tue-8" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="wed-8" type="text" id="wed-8" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="thu-8" type="text" id="thu-8" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="fri-8" type="text" id="fri-8" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="sat-8" type="text" id="sat-8" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="sun-8" type="text" id="sun-8" size="12" onClick="getCourseCode(this)"/>
          </div></td>
        </tr>
        <tr>
          <th>IX</th>
                    <td><div align="center">
            <label>
              <input name="mon-9" type="text" id="mon-9" size="12" onClick="getCourseCode(this)"/>
            </label>
          </div></td>
          <td><div align="center">
            <input name="tue-9" type="text" id="tue-9" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="wed-9" type="text" id="wed-9" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="thu-9" type="text" id="thu-9" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="fri-9" type="text" id="fri-9" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="sat-9" type="text" id="sat-9" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="sun-9" type="text" id="sun-9" size="12" onClick="getCourseCode(this)"/>
          </div></td>
        </tr>
        <tr>
          <th>X</th>
                   <td><div align="center">
            <label>
              <input name="mon-10" type="text" id="mon-10" size="12" onClick="getCourseCode(this)"/>
            </label>
          </div></td>
          <td><div align="center">
            <input name="tue-10" type="text" id="tue-10" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="wed-10" type="text" id="wed-10" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="thu-10" type="text" id="thu-10" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="fri-10" type="text" id="fri-10" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="sat-10" type="text" id="sat-10" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="sun-10" type="text" id="sun-10" size="12" onClick="getCourseCode(this)"/>
          </div></td>
        </tr>
        <tr>
          <th>XI</th>
                   <td><div align="center">
            <label>
              <input name="mon-11" type="text" id="mon-11" size="12" onClick="getCourseCode(this)" />
            </label>
          </div></td>
          <td><div align="center">
            <input name="tue-11" type="text" id="tue-11" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="wed-11" type="text" id="wed-11" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="thu-11" type="text" id="thu-11" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="fri-11" type="text" id="fri-11" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="sat-11" type="text" id="sat-11" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="sun-11" type="text" id="sun-11" size="12" onClick="getCourseCode(this)"/>
          </div></td>
        </tr>
        <tr>
          <th>XII</th>
                      <td><div align="center">
            <label>
              <input name="mon-12" type="text" id="mon-12" size="12" onClick="getCourseCode(this)"/>
            </label>
          </div></td>
          <td><div align="center">
            <input name="tue-12" type="text" id="tue-12" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="wed-12" type="text" id="wed-12" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="thu-12" type="text" id="thu-12" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="fri-12" type="text" id="fri-12" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="sat-12" type="text" id="sat-12" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          <td><div align="center">
            <input name="sun-12" type="text" id="sun-12" size="12" onClick="getCourseCode(this)"/>
          </div></td>
          </tr>
           <tr>
          <td height="26" colspan="8"><label>
            <div align="center">
              <input type="submit" name="button" id="button" value="Confirm Timetable" />
            </div>
          </label></td>
              </tr>
      </table>
      </form>
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
&copy; 2010 SASTRA University - SRC Campus&nbsp; | &nbsp;Engineered By GLOSS Community | <a href="../bug_filing.php?ref=staff" target="_blank">Report Bugs</a> | <a href="../feedback.php" target="_blank">Feedback</a> | <a href="../credits.php" target="_blank">Credits</a>
</div>
</div>
</div>
</body>
</html>
