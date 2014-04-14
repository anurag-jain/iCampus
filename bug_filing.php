<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']))
{
$user=$_SESSION['username'];
}
else { ?>
<script>
alert("Session Expired!!!");
window.location="../index.php";
</script>
<?php }
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
SASTRA University - SRC
</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper_outer">
<div id="wrapper">
<div id="header"><center><img src="images/header.png" alt="sastra university"/></center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome User,</div>
<div id="menu">
		<img src="images/Sastra1.png" width="170" alt="sastra university" />
		<div class="clear"></div>
		<img src="images/menu-top.png" alt="menu-top"/>
			<div id="nav">
			<ul>
				<li><a href="javascript:window.close()">Close</a></li>
                <li><a href="logout.php">Sign Out</a></li>
			  </ul>
	  </div>
		<img src="images/menu-bottom.png" alt="menu-bottom"/>
	</div>
<div id="content">
	<div id="main">
	<img src="images/cont-top.png" alt="cont-top"/>
	<!--Write code here!-->
	<div id="studenthome" class="main">
	  <h2 class='heading'>File Bugs</h2>
	&nbsp; 
	<p>For any emergency bug reports, please email to <b>icampus@src.sastra.edu</b> and may alternatively contact <b>+91-9791397567 (or) +91-9629613610</b>. If you find any bugs/usability issues in our product, please fill in the following form.</p>
	<br/>
	<form id="form1" name="form1" method="post" action="bug_filing_done.php">
            
            <div align="center">
              <table width="402" border="0" cellpadding="1" cellspacing="1" bgcolor="#F2F2F2">
                <tr>
                  <td width="163"><div align="right">Type : </div></td>
                  <td width="232">
                    <select name="type" id="type">
                      <option value="Usability Issue">Usability Issue</option>
                      <option value="Too Slow">Too Slow</option>
                      <option value="Unable To Load">Unable To Load</option>
                      <option value="Wrong Values">Wrong Values</option>
                                                            </select>
                  </td>
                </tr>
                <tr>
                  <td height="85"><div align="right">Description : </div></td>
                  <td>
                    <textarea name="description" cols="20" rows="5" id="description"></textarea>
                  </td>
                </tr>
                <tr>
                  <td height="24"><div align="right">Email Id: </div></td>
                  <td>
                    <input type="text" name="email" id="email" />
                  </td>
                </tr>
                <tr>
                  <td height="24"><div align="right">Mobile Number :</div></td>
                  <td>
                    <input name="mobile" type="text" id="mobile" maxlength="15" />
                  </td>
                </tr>
                <tr>
                  <td height="24"><div align="right">Can we contact you? : </div></td>
                  <td>
                    <input name="contactable" type="radio" id="Yes" value="Yes" checked="checked" />
                  Yes 
                  <input type="radio" name="contactable" id="No" value="No" />
                  No</td>
                </tr>
                <tr>
                  <td colspan="2"><div align="center">
                    <input name="ref" type="hidden" value="<?php echo $_GET['ref']; ?>" />
                    <input type="submit" name="button" id="button" value="Report Bug!" />
                  </div></td>
                </tr>
                                  </table>
            </div>
            <p align="left">
              
            </p>
	</form>
	<p align="left">&nbsp;</p>
	</div>
	<img src="images/cont-bottom.png" alt="cont-bottom"/>	</div>
	&nbsp;
</div>
</div>
<div style="clear:both">&nbsp;</div>
</div>	

<div id="footer">
Copyright 2010 SASTRA University - SRC Campus&nbsp; | &nbsp;Engineered By GLOSS Community | <a href="bug_filing.php?ref=top">Report Bugs</a> | <a href="feedback.php">Feedback</a> | <a href="credits.php">Credits</a>
</div>
</div>
</body>
</html>
