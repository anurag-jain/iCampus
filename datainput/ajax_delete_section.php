<?php
// Author : Sanjeev Gopinath V
// Deletes a course for a section...

session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['type']=='dataentry')
{
$user=$_SESSION['username'];
}
else {
?>
<script>
alert("Session Expired!!!");
window.location="../index.php";
</script>
<?php
}
require_once('../db_config.php');
$sectionid = $_POST['secid'];
$delete_section_course_query = "delete from relation where section_id = '$sectionid'";
$delete_section_course_result = mysql_query($delete_section_course_query) or die("Failure");
echo "Success";
?>
