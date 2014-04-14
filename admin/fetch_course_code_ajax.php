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
require_once('../db_config.php');
$regno = $_POST['param1'];
$staffid = $_POST['param2'];
$query = "SELECT a.coursecode,b.coursename from relation a,coursemaster b where regnumber='$regno' and staffid='$staffid' and a.coursecode = b.coursecode";
$result = mysql_query($query);
?>
  <select name="course_select" id="course_select">
    <?php
while($row = mysql_fetch_row($result))
{
 ?> 
    <option value="<?php echo "$row[0]"; ?>"><?php printf("%s..",substr("$row[0] - $row[1]",0,30)); ?> </option>
    <?php
}
?>
  </select>
</p>
