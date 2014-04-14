<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['type']=='staff')
{
$user=$_SESSION['username'];
$username=$_SESSION['staffname'];
}
else { ?>
<script>
alert("Session Expired!!!");
window.location="../index.php";
</script>
<?php }
$staffid=$user;
$staffname=$username;
include_once("../db_config.php");
include('relation_class.php');

$relation_obj = new relation_class();
$courses=$relation_obj->getcourse_staff($staffid);
$locks=$relation_obj->getLocks($staffid);
$lockvalue=mysql_fetch_array($locks);
$flag1=$lockvalue[0];
$flag2=$lockvalue[1];
$flag3=$lockvalue[2];
$flag4=$lockvalue[3];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="../jquery-1.2.6.min.js" type="text/javascript">
</script>
<script type="text/javascript">
$(document).ready(function(){
$('.status').hide();
$('#listview').hide();
});
function popup(divid)
{
//$('.status').slideUp("slow","");
var string = "#status_" + divid;
$(string).slideToggle("slow","");
}

function listview()
{
$('#listview').slideToggle("slow","");
//$('#listview').slideUp("slow","")
}
</script>
<style>
.status {
}
</style>
<title>
SASTRA University - SRC
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="../images/header.png" alt="sastra university"/></center></div>
<div id="welcome"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "Welcome ".$staffname; ?></strong></div>
<div id="menu">
		<img src="../images/Sastra1.png" width="170" alt="sastra university" />
		<div class="clear"></div>
		<img src="../images/menu-top.png" alt="menu-top"/>
			<div id="nav">
			<ul>
				<li><a href="staff_index.php">Home</a></li>
              	<li><a href="staff_profile.php">Profile</a></li>
				<li><a href="staff_attendance.php">Post Attendance</a></li>
                <li><a href="modify_attendance.php">Modify Attendance</a></li>
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
	<div id="staff" class="main">
	<h2 class='heading'>CIA</h2>
	<p class='heading'><a href="#" onClick="listview();">Click here to check status</a></p>
    	<div id="listview" style="border:2px #000000">
   			<table width="675" align=center cellpadding=0 cellspacing=1>
  				<th width="151">Course Code</th>
  				<th width="210">Course Name</th>
                <th width="210">Section</th>
                <th>CIA-I</th>
                <th>CIA-II</th>
                <th>CIA-III</th>
                <th>Assignment</th>
<?php
  			while($coursedetails=mysql_fetch_array($courses)) 
  			{	
				
			$query1="SELECT midsem1,midsem2,midsem3,internals FROM midsem_post WHERE ". 
							" staffid='$staffid' and coursecode='$coursedetails[0]' and section_id='$coursedetails[4]'"; 
			$result1=mysql_query($query1);
			$row1=mysql_fetch_array($result1);
			$a='0000-00-00 00:00:00';
			if(($sno++)%2==0)
				$class='even';
			else
				$class='odd';
?>
    		<tr class="<?php echo $class; ?>">
			<td ><?php echo $coursedetails[0] ?></td>
			<td><?php echo ucwords($coursedetails[5]); ?></td>
			<td><?php echo ucwords($coursedetails[2]."-".$coursedetails[1]."-".$coursedetails[3]); ?></td>
			<td>
                    <?php 
					if($flag1) {
						if($row1[0]== $a || mysql_num_rows($result1)=='0') { 
						 ?>
                        <img src="../images/not-posted.png" alt="Not posted" width="20" height="20" />
						<?php } 
						else { 
						?> 
						<img src="../images/button_ok.png" alt="Posted/view" width="20" height="20" />
						<?php } 
						}
						else{ ?><img src="../images/Padlocks_48.png" alt="Locked" width="20" height="20" /> <?php }
					?>
                    </td>
    
       			<td>
                <?php 
					if($flag2) {
					if($row1[1]== $a  || mysql_num_rows($result1)=='0') { 
						?>
                        <img src="../images/not-posted.png" alt="Not posted" width="20" height="20" />
						<?php } 
						else { 
						?> 
						<img src="../images/button_ok.png" alt="Posted/view" width="20" height="20" />
						<?php } 
						}
					else { ?><img src="../images/Padlocks_48.png" alt="Locked" width="20" height="20" /> <?php }
					?> </td>
        			<td>
               	<?php 
					if($flag3) {
					if($row1[2]== $a  || mysql_num_rows($result1)=='0') { 
					?>
                        <img src="../images/not-posted.png" alt="Not posted" width="20" height="20" />
						<?php } 
						else { 
						?> 
						<img src="../images/button_ok.png" alt="Posted/view" width="20" height="20" />
						<?php } 
						} 
					else{ ?><img src="../images/Padlocks_48.png" alt="Locked" width="20" height="20" /> <?php }
					?> </td>
        			<td>
				<?php 
					if($flag4) {
					if($row1[3]== $a  || mysql_num_rows($result1)=='0') { 
					?>
                        <img src="../images/not-posted.png" alt="Not posted" width="20" height="20" />
						<?php } 
						else { 
						?> 
						<img src="../images/button_ok.png" alt="Posted/view" width="20" height="20" />
						<?php } 
						}
					else{ ?><img src="../images/Padlocks_48.png" alt="Locked" width="20" height="20" /> <?php }
					?> </td>
  		          </tr>
            <?php }
				$sno++;
				?>
			</table>
            <hr />
    </div>
	 
        <p>Click on the subject to post marks</p>
        <table width="675" align=center cellpadding=0 cellspacing=1>
  <th width="151">Course Code</th>
  <th width="209">Course Name</th>
  <th width="76">Section</th>
  <th width="232"></th>
  <?php
  $courses=$relation_obj->getcourse_staff($staffid);
  while($row2=mysql_fetch_array($courses)) 
  {	
 
			$query3="SELECT midsem1,midsem2,midsem3,internals FROM midsem_post WHERE ". 
							" staffid='$staffid' and coursecode='$row2[0]' and section_id='$row2[4]'"; 
			$result3=mysql_query($query3);
			$row3=mysql_fetch_array($result3);
			$a='0000-00-00 00:00:00';
			if(($sno++)%2==0)
				$class='even';
			else
				$class='odd';
	?>
	<tr class="<?php echo $class; ?>" id="<?php echo $sno; ?>" onClick="popup(<?php echo $sno; ?>);">
		<td ><?php echo $row2[0] ?></td>
			<td><?php echo ucwords($row2[5]); ?></td>
			<td><?php echo ucwords($row2[2]."-".$row2[1]."-".$row2[3]); ?></td>
			<td>
            <div id="status_<?php echo $sno; ?>" class="status">
			<table width=100% cellpadding=0 cellspacing=0 border=1>
				<tr class='odd'>
            		<td>
					<?php
                    if($flag1){ ?>
                    <a href="staff_studentlist.php?value=<?php echo $staffid.",".$row2[0].','.$row2[4].','.'1'; ?>">CIA-I</a></td>
            		<?php }
					else { echo "CIA-I"; } ?>
                    <td><?php 
					if($flag1) {
						if($row3[0]== $a || mysql_num_rows($result3)=='0') { echo "Not posted" ; } else { echo "Posted/View" ; } }
					else{ echo "Locked" ;}
					?></td>
        		</tr>
				<tr class='even'>
        			<td>
                    <?php
					if($flag2){ ?>
                    <a href="staff_studentlist.php?value=<?php echo $staffid.",".$row2[0].",".$row2[4].","."2" ?>">CIA-II</a></td>
                    <?php }
					else { echo "CIA-II"; }?>
            		<td><?php 
					if($flag2) {
					if($row3[1]== $a || mysql_num_rows($result3)=='0') { echo "Not Posted"; } else { echo "Posted/View"; } }
					else { echo "Locked" ; }
					?> </td>
        		</tr>
				<tr class='odd'>
        			<td>
                    <?php
					if($flag3) { ?>
                    <a href="staff_studentlist.php?value=<?php echo $staffid.",".$row2[0].",".$row2[4].","."3" ?>">CIA-III</a></td>
                    <?php }
					else { echo "CIA-III"; } ?>
            		<td><?php 
					if($flag3) {
					if($row3[2]== $a || mysql_num_rows($result3)=='0') { echo "Not posted"; } else { echo "Posted/View"; } } 
					else { echo "Locked"; }
					?> </td>
        		</tr>
				<tr class='even'>
        			<td>
                    <?php 
					if($flag4) { ?>
                    <a href="staff_studentlist.php?value=<?php echo $staffid.",".$row2[0].",".$row2[4].","."4" ?>">Internals</a></td>
                    <?php }
					else { echo "Assignments"; } ?>
            		<td><?php 
					if($flag4) {
					if($row3[3]== $a || mysql_num_rows($result3)=='0') { echo "Not posted"; } else { echo "Posted/View"; } }
					else { echo "Locked"; } 
					?> </td>
        		</tr>
                <tr class='odd'>
            		<td>
                    <a href="complete_cia_view.php?value=<?php echo $staffid.",".$row2[0].','.$row2[4].','.'5'; ?>">Cumulative</a></td>
                    <td>
                    <?php echo "View"; ?>
					</td>
        		</tr>
            </table>
            </div>
			</td>
	</tr>
	<?php }
	$sno++;
	?>
	
    </table>
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
