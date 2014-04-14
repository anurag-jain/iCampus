<?php
session_start();
$_SESSION['username']='';
$_SESSION['password']='';
unset($_SESSION['username']);
unset($_SESSION['password']);
echo "<meta http-equiv='refresh' content='0;url=index.php'>";
?>