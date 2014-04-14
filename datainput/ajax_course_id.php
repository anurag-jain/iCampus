<?php
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
<?php }
require_once('../db_config.php');
$str = $_POST['str'] . "%";
$query = "SELECT coursecode, coursename from coursemaster where coursecode like '$str' or coursename like '$str'";
$result = mysql_query($query);
$num_rows = mysql_num_rows($result) + 1;
if($num_rows > 10)
{
	$num_rows = 10;
}
if($num_rows > 1)
{
$i=1;
?>
  <ul>
    <?php
while($row = mysql_fetch_row($result))
{
	if(($i++)%2==0)
		$class='even';
	else
		$class='odd';
 ?> 
    <li onclick="copyCourse(this)" class=<?php echo "'$class'";?>><?php echo "$row[0] | $row[1]"; ?> </li>
    <?php
}
?>
  </ul>
<?php } ?>
</p>
