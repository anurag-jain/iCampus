<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['type']=='administrator')
{
$user=$_SESSION['username'];
if(isset($_POST['submit'])) {
	require_once('../db_config.php');
	
	$news=$_POST['news-content'];
	$addNewsQuery = "INSERT INTO news(news) VALUES('$news')";
	$addNewsResult = mysql_query($addNewsQuery);
}
unset($_POST['submit']);
}
else { 



?>
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
<script type="text/javascript" src="../jquery-1.2.6.min.js"></script>
<script type="text/javascript">
function deleteNews(what) {
	$.post("ajax_deletenews.php", {newsid: ""+what+""}, function(data){
	$('#list-news').html(data);
	});
}
</script>
</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="../images/header.png" alt="sastra university"/></center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome Administrator,</div>
<div id="menu">
		<img src="../images/Sastra1.png" width="170" alt="sastra university" />
		<div class="clear"></div>
		<img src="../images/menu-top.png" alt="menu-top"/>
			<div id="nav">
			<ul>
				<li><a href="admin_index.php">Home</a></li>
                <li><a href="../logout.php">Sign Out</a></li>
			  </ul>
	  </div>
		<img src="../images/menu-bottom.png" alt="menu-bottom"/>
	</div>
<div id="content">
	<div id="main">
	<img src="../images/cont-top.png" alt="cont-top"/>
	<div id="studenthome" class="main">
		<h2 class='heading'>News Content</h2>
		<div id="add-news" style="margin-left:30px;width:730px">
			<form action='admin_news.php' method=post>
			&nbsp;&nbsp;News : <br />
			&nbsp;&nbsp;<textarea id='news-content' rows="3" cols=90" name='news-content'></textarea>
			<p>
			<input type='submit' id='submit' name='submit' value='Post' />
			</p>
			</form>
			<hr />
		</div>
		
		<div id="list-news" >
		<?php
		require_once('../db_config.php');
		$selectNewsQuery = "SELECT id,date_format(date,'%e-%M-%Y'),news FROM news WHERE active=0";
		$newsResult = mysql_query($selectNewsQuery);
		$numRows = mysql_num_rows($newsResult);
		echo "<table width='700px' align='center'>";
		echo "<tr><th width='100px'>&nbsp;Date&nbsp;</th><th>&nbsp;News Content&nbsp;</th><th width='45px'>&nbsp;<a href='javascript:deleteNews(-1);'>Delete All</a>&nbsp;</th><th>&nbsp;&nbsp;</th></tr>";
		echo "<tbody style='height:300px;overflow:auto'>";
		if($newsResult && $numRows > 0) {
		$sno=1;
		while($newsRow = mysql_fetch_array($newsResult)) {
			if(($sno++)%2==0)
				$class='even';
			else
				$class='odd';
			echo "<tr class='$class'>";
			echo "<td>$newsRow[1]</td>";
			echo "<td>$newsRow[2]</td>";
			echo "<td><a href='javascript:deleteNews($newsRow[0])'>Delete</a></td><td>&nbsp;&nbsp;&nbsp;</td>";
			echo "</tr>";
		}
		
		}
		else {
			echo "<tr><td colspan=3><center><b>No News Added</b></center></td></tr>";
		}
			echo "</tbody></table>";
		
		?>
		</div>
	
	</div>
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
