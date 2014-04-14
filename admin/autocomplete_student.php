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
$str = $_POST['str'] . "%";
$query = "SELECT regnumber, studentname from studentmaster where regnumber like '$str' or studentname like '%$str%'";
$result = mysql_query($query);
$num_rows = mysql_num_rows($result) + 1;
if($num_rows > 10)
{
	$num_rows = 10;
}
if($num_rows > 1)
{
?>
  <select name="select" size= <?php echo "$num_rows"; ?> id="select"  onchange="complete2()">
    <?php
while($row = mysql_fetch_row($result))
{
 ?> 
    <option value="<?php echo "$row[0]"; ?>"><?php echo "$row[0] - $row[1]"; ?> </option>
    <?php
}
?>
  </select>
<?php } ?>
</p>
