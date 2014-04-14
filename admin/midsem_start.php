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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
SASTRA University - SRC
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="ajax_post.js"></script>
<style type="text/css">
<!--
.style1 {font-size: 12px}
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
	  <h2 class='heading'>Start Mid-semesters</h2>
	  </br></br></br>
	  <center><form id="form_midsem_status_post">
	    <div style="overflow:auto; height:300px; width:750px"><table width="720" border="1" cellspacing="0" cellpadding="0">
        <tr>
          <td><div align="center" class="style1">Programme</div></td>
          <td><div align="center" class="style1">Dept.</div></td>
          <td><div align="center" class="style1">Year</div></td>
          <td><div align="center" class="style1">Sem</div></td>
          <td><div align="center" class="style1">Midsem 1</div></td>
          <td><div align="center" class="style1">Midsem 2</div></td>
          <td><div align="center" class="style1">Midsem 3</div></td>
          <td><div align="center" class="style1">Internals</div></td>
        </tr>
		<?php
		require_once('../db_config.php');
		$query = "Select program_id,program,department,year,semester,midsem_1,midsem_2,midsem_3,internals from program_master";
		$result = mysql_query($query);
		$colour_count=0;
		while($row = mysql_fetch_array($result))
		{
			$color_count++;
			if($color_count % 2 == 0) { $color = " class=\"odd\" "; } else { $color = " class=\"even\" "; }
		?>
        <tr <?php echo $color; ?>>
          <td><div align="center" class="style1"><?php echo $row[1]; ?></div></td>
          <td><div align="center" class="style1"><?php echo $row[2]; ?></div></td>
          <td><div align="center" class="style1"><?php echo $row[3]; ?></div></td>
          <td><div align="center" class="style1"><?php echo $row[4]; ?></div></td>
          <td id="<?php echo "midsem_". $row[0] . "_1"?>">
            <div align="center" class="style1">
              <?php
		  if($row[5]==0)
		  { ?>
              <div onClick="midsem_start(<?php echo $row[0] ?>,1,1)" style="background-color:#FF4F53;color:#000000;">Locked</div>
              <?php }
		  else
		  { ?>
		      <div onClick="midsem_start(<?php echo $row[0] ?>,1,0)" style="background-color:#9EEF7C;color:#000000;">Unlocked</div>
		      <?php } 
		  ?>
              </div></td>
          <td id="<?php echo "midsem_". $row[0] . "_2"?>">
            <div align="center" class="style1">
              <?php
		  if($row[6]==0)
		  { ?>
              <div onClick="midsem_start(<?php echo $row[0] ?>,2,1)" style="background-color:#FF4F53;color:#000000;">Locked</div>
              <?php }
		  else
		  { ?>
		     <div onClick="midsem_start(<?php echo $row[0] ?>,2,0)" style="background-color:#9EEF7C;color:#000000;">Unlocked</div>
		     <?php } 
		  ?>
              </div></td>
          <td id="<?php echo "midsem_". $row[0] . "_3"?>">
            <div align="center" class="style1">
              <?php
		  if($row[7]==0)
		  { ?>
              <div onClick="midsem_start(<?php echo $row[0] ?>,3,1)" style="background-color:#FF4F53;color:#000000;">Locked</div>
              <?php }
		  else
		  { ?>
		      <div onClick="midsem_start(<?php echo $row[0] ?>,3,0)" style="background-color:#9EEF7C;color:#000000;">Unlocked</div>
		      <?php } 
		  ?>
              </div></td>
          <td id="<?php echo "midsem_". $row[0] . "_4"?>">
          <div align="center" class="style1">
            <?php
		  if($row[8]==0)
		  { ?>
               <div onClick="midsem_start(<?php echo $row[0] ?>,4,1)" style="background-color:#FF4F53;color:#000000;">Locked</div>
               <?php }
		  else
		  { ?>
		      <div onClick="midsem_start(<?php echo $row[0] ?>,4,0)" style="background-color:#9EEF7C;color:#000000;">Unlocked</div>
		      <?php } 
		  ?>
          </div></td>
        </tr>
        <?php } ?>
      </table></div>
      <p>&nbsp;</p>
    </form>
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
