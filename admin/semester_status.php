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
<?php }
?>
<html>
<head>
<title>
SASTRA University - SRC
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="ajax_post.js"></script>
<script type="text/javascript" src="../jquery.js.js"></script>
<script type="text/javascript" src="../calendar_eu.js"></script>
<style type="text/css">
<!--
.style1 {
	font-size: 12px;
	font-weight: bold;
}
.style2 {font-size: 12px}
.style3 {color: #990033}
-->
</style>
</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="../images/header.png" alt="sastra university"/></center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome Administrator,</div>
<div id="menu"> <img src="../images/Sastra1.png" width="170" alt="sastra university" />
    <div class="clear"></div>
  <img src="../images/menu-top.png" alt="menu-top"/>
    <div id="nav">
      <ul>
        <li><a href="admin_index.php">Home</a></li>
        <li><a href="attendance_lock.php">Attendance Lock</a></li>
        <li><a href="cia_lock.php">CIA Lock</a><a href="semester_status.php">Semester Status</a></li>
        <li><a href="midsem_start.php">Midsem Status</a></li>
        <li><a href="percentage_page.php">Attendance %</a></li>
        <li><a href="lagreport.php">Lag Report</a></li>
        <li><a href="../logout.php">Sign Out</a></li>
      </ul>
    </div>
  <img src="../images/menu-bottom.png" alt="menu-bottom"/> </div>
<div id="content">
	<div id="main">
	<img src="../images/cont-top.png" alt="cont-top"/>
	<div id="studenthome" class="main">
	  <h2 class='heading'>Semester Status</h2>
	<!--- Original Code --->
    <center>
	<form id="semester_status_form">
	<p>Set Date : 
	<input type="text" id="date_tb" name="date_tb"/>
	<script language="JavaScript">
	new tcal ({
		// form name
		'formname': 'semester_status_form',
		// input name
		'controlname': 'date_tb'
	});
	</script></p>
    <center>
	<div style="overflow:auto; height:300px; width:750px"><table width="696" border="1" cellspacing="0" cellpadding="0">
      <tr>
        <td width="78"><div align="center" class="style1">Programme
        </div></td>
        <td width="302"><div align="center" class="style1">Department
        </div></td>
        <td width="44"><div align="center" class="style1">Year
        </div></td>
        <td width="101"><div align="center" class="style1">Semester</div></td>
        <td width="91"><div align="center" class="style1">Start / Date
        </div></td>
        <td width="66"><div align="center" class="style1">Reset</div></td>
        </tr>
	  <?php
	  require_once('../db_config.php');
      $query_sem_status = "SELECT program,department,year,semester,start_date,program_id from program_master";
	  $result_sem_status = mysql_query($query_sem_status);
	  $colour_count=0;
	  while($rows = mysql_fetch_array($result_sem_status)) { 
     		$color_count++;
			if($color_count % 2 == 0) { $color = " class=\"odd\" "; } else { $color = " class=\"even\" "; }
	  ?>
	  <tr <?php echo $color; ?>>
        <td><div align="center"><span class="style2"><?php echo $rows[0]; ?></span></div></td>
        <td><div align="center"><span class="style2"><?php echo $rows[1]; ?></span></div></td>
        <td><div align="center"><span class="style2"><?php echo $rows[2]; ?></span></div></td>
        <td><div align="center"><span class="style2"><?php echo $rows[3]; ?></span></div></td>
        <td id=<?php echo "row_" . $rows[5]; ?>><div align="center"><span class="style2">
            <?php if(($rows[4]=='0000-00-00')||($rows[4]==NULL))
		{ ?>
            <input type="button" onClick="StartSemester(<?php echo $rows[5]; ?>)" name="submit_sem_start" id="submit_sem_start" value="Initiate">
            <?php }
		else
		{
			echo $rows[4];
		}
		?>
        </span></div></td>
        <td id=<?php echo "row_" . $rows[5]; ?> onClick="reset_semester_status(<?php echo $rows[5]; ?>)"><div align="center" class="style1 style3"><strong>Reset?</strong></div></td>
        </tr>
      <?php } ?>
    </table>
	</div></center>
	</form> &nbsp;
	</center>
	<!--- Original Code --->
	</div>
	<!--It Ends!-->
	<img src="../images/cont-bottom.png" alt="cont-bottom"/>
	</div>
</div>
<div style="clear:both">&nbsp;</div>
</div>	

<div id="footer">
&copy; 2010 SASTRA University - SRC Campus&nbsp; | &nbsp;Engineered By GLOSS Community | <a href="../bug_filing.php?ref=admin" target="_blank">Report Bugs</a> | <a href="../feedback.php" target="_blank">Feedback</a> | <a href="../credits.php" target="_blank">Credits</a>
</div>
</div>
</div>
</body>
</html>
