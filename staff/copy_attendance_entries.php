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
require_once('../db_config.php');
$date = $_POST['date'];
$section = $_POST['sectionid'];
$period = $_POST['period'];
$staff = $user;
$query = " SELECT a.relationid,DATE_FORMAT(date,'%d-%m-%Y'),a.present,substr(a.period,5,5),b.regnumber,b.coursecode,b.staffid,b.section_id"
		." FROM `attendance` a,relation b"
		." WHERE (a.relationid = b.relationid AND b.section_id = $section AND (a.date < STR_TO_DATE('$date','%d-%m-%Y') OR (a.date = STR_TO_DATE('$date','%d-%m-%Y') AND substr(a.period,5,5) < '$period')) AND b.staffid = '$staff')"
		." ORDER BY a.date DESC,substr(a.period,5,5) DESC,b.regnumber";
//echo $query;
$result = mysql_query($query) or die("Unable to use the AJAX Fetch!");
header('Content-type: text/xml');
echo "<studentlist>\n";
$row = mysql_fetch_row($result);
echo "<details date = \"$row[1]\" period = \"$row[3]\" course = \"$row[5]\" />\n";
echo "<student regnumber = \"$row[4]\" attendance = \"$row[2]\" />\n";
while($row = mysql_fetch_row($result))
{
  echo "<student regnumber = \"$row[4]\" attendance = \"$row[2]\" />\n";
}
echo "</studentlist>";
?>