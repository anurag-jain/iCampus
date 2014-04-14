<?php
ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
SASTRA University - SRC
</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<p>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h2>SASTRA University - Srinivasa Ramanujan Centre</h2><br></br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Staff List</b>
</p>
<?php  
			include_once('../db_config.php');
			$slQuery="SELECT staffid,staffname,department FROM staffmaster order by staffid";
			$result=mysql_query($slQuery);
			if($result) {
				$num=mysql_num_rows($result);
				if($num>0) {
					echo "<table width='650px' border='1px' cellspacing='1' cellpadding='0'>";
					echo "<tr width='40px'><td><b>S No</b></td>";
					echo "<td width='70px'><b>Staff ID</b></td>";
					echo "<td width='300px'><b>Staff Name</b></td>";
					echo "<td width='200px'><b>Department</b></td>";
					echo "</tr>";
					$i=1;
				while($row=mysql_fetch_row($result)) {
					$value = "<td>$i</td>"
							."<td>$row[0]</td>"
							."<td>$row[1]</td>"	
							."<td>$row[2]</td>";
					echo "<tr>$value</tr>";
					$i++;
				}
					echo "</table>";
				}
				else
					echo '<div>No Staff Found</div>';
			}
			else 
				echo '<div>Error! Please Try again Later</div>';
		
		?>
</body>
</html>
<?php file_put_contents('write.html',ob_get_clean()); ?>

<?php
ini_set("memory_limit","100M");
require('pdfwrite/html2fpdf.php');
$pdf=new HTML2FPDF();
$pdf->AddPage();
$fp = fopen("write.html","r");
$strContent = fread($fp, filesize("write.html"));
fclose($fp);
$pdf->WriteHTML($strContent);
$pdf->Output("stafflist.pdf");
	echo "<meta http-equiv='refresh' content='0;url=stafflist.pdf'>";
?>
