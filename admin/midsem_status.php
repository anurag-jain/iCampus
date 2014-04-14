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
$midsem_num = $_POST['param2'];
$row_id = $_POST['param1'];
$status = $_POST['param3'];
switch($midsem_num)
{
	case 1:
		$column = "midsem_1";
		break;
	case 2:
		$column = "midsem_2";
		break;
	case 3:
		$column = "midsem_3";
		break;
	case 4:
		$column = "internals";
}
$query = "UPDATE program_master set $column = $status WHERE program_id = $row_id";
$result = mysql_query($query);
?>