<?php
require_once('../db_config.php');
$newsid=$_POST['newsid'];
$deleteQuery = "UPDATE news SET active=1";
if($newsid>=0) {
	$deleteQuery=$deleteQuery." where id=$newsid";
}
mysql_query($deleteQuery);

		$selectNewsQuery = "SELECT id,date_format(date,'%e-%M-%Y'),news FROM news WHERE active=0";
		$newsResult = mysql_query($selectNewsQuery);
		$numRows = mysql_num_rows($newsResult);
		echo "<table width='700px' align='center'>";
		echo "<tr><th>&nbsp;Date&nbsp;</th><th>&nbsp;News Content&nbsp;</th><th width='45px'>&nbsp;<a href='javascript:deleteNews(-1);'>Delete All</a>&nbsp;</th><th>&nbsp;&nbsp;</th></tr>";
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