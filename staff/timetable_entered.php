<?php
session_start();
echo "step 1";
if(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['type']=='staff')
{
$user=$_SESSION['username'];
$username=$_SESSION['staffname'];
}
else { ?>
<script>
alert("Session Expired!!!");
window.location="../index.php";
</script>
<?php }

$staffid=$user;
$staffname=$username;
include_once("../db_config.php");
include('relation_class.php');
set_time_limit(2000);
$relation_obj = new relation_class();
?>
<!--Author: Anurag Jain-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SASTRA University - SRC</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper_outer">
  <div id="wrapper">
    <div id="header">
      <center>
        <img src="../images/header.png" alt="sastra university"/>
      </center>
    </div>
    <div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome <?php echo $staffname; ?>,</div>
    <div id="menu"> <img src="../images/Sastra1.jpg" width="170" alt="sastra university" />
      <div class="clear"></div>
      <img src="../images/menu-top.png" alt="menu-top"/>
      <div id="nav">
        <ul>
          <li><a href="staff_index.php">Home</a></li>
          <li><a href="../logout.php">Sign Out</a></li>
        </ul>
      </div>
      <img src="../images/menu-bottom.png" alt="menu-bottom"/> </div>
    <div id="content">
      <div id="main"> <img src="../images/cont-top.png" alt="cont-top"/>
        <!--Write code here!-->
        <div id="studenthome" class="main">
          <h2 class='heading'>Timetable entered</h2>
          <br/>
          <br/>
          <br/>
          <p>&nbsp;</p>
          <br />
          <div id="staffid_div" align="center">
            <?php
	  require_once('../db_config.php');
	  $relationQuery="SELECT relationid FROM relation where staffid='$staffid'";
	  $rresult=mysql_query($relationQuery);
	  while($row=mysql_fetch_array($rresult))
	  {
		  $delQuery="DELETE FROM periodlist WHERE relationid='$row[0]'";
		  
		  $delresult=mysql_query($delQuery);
		}
	  
	  $nullQuery="UPDATE staffmaster SET flag=0 WHERE staffid='$staffid'";
		$nullresult=mysql_query($nullQuery);
	  
	  
	  ?>
            <?php
	  
		require_once('../db_config.php');	  
	  	$mon=array();
		$tue=array();
		$wed=array();
		$thu=array();
		$fri=array();
		$sat=array();
		$sun=array();
		
	
		$i=0;
		
	  	while($i<=14)
		{
			
	  		$mon[$i]=$_POST['mon-'.$i];
			//echo "Monday-".$i."-".$mon[$i]."<br/>";
			$i++;
			
		}		
		
		$i=0;
	
			while($i<=14)
		{
			
	  		$tue[$i]=$_POST['tue-'.$i];
			//echo "Tuesday-".$i."-".$tue[$i]."<br/>";
			$i++;
		}
		$i=0;

			while($i<=14)
		{
			
	  		$wed[$i]=$_POST['wed-'.$i];
			//echo "Wednesday-".$i."-".$wed[$i]."<br/>";
			$i++;
		}
		$i=0;
	
			while($i<=14)
		{
			
	  		$thu[$i]=$_POST['thu-'.$i];
	  		//echo "Thursday-".$i."-".$thu[$i]."<br/>";
			$i++;
		}
		$i=0;
		
			while($i<=14)
		{
			
	  		$fri[$i]=$_POST['fri-'.$i];
			//echo "Friday-".$i."-".$fri[$i]."<br/>";
			$i++;
		}
		$i=0;
		
			while($i<=14)
		{
			
	  		$sat[$i]=$_POST['sat-'.$i];
			//echo "Saturday-".$i."-".$sat[$i]."<br/>";
			$i++;
		}
		$i=0;
		
			while($i<=14)
		{
			
	  		$sun[$i]=$_POST['sun-'.$i];
			//echo "Sunday-".$i."-".$sun[$i]."<br/>";
			$i++;
		}
		
		//-------------Monday
		$j=0;
		
		while($j<sizeof($mon))
		{
                 	if($mon[$j]!="")
			{
                            $datum=explode('|',$mon[$j]);
                            $k=0;
                            while($k<sizeof($datum)-1)
                            {
                                $part=explode('-',$datum[$k]);
                                $monQuery="SELECT relationid FROM relation WHERE coursecode='$part[0]' and section_id=$part[2] and staffid='$staffid'";
                                $result=mysql_query($monQuery);
                                $count=mysql_num_rows($result);
                                $i=1;

                                        while($row=mysql_fetch_array($result))
                                        {
                                        $moninsertQuery="INSERT into periodlist VALUES($row[0],concat('mon-',$j))";
                                        $result2=mysql_query($moninsertQuery);
                                        $i++;
                                        }
                        $k++;
                        }
                    }
                    $j++;
                }
		
		
		//---------------Tuesday----
		$j=0;

		while($j<sizeof($tue))
		{
                 	if($tue[$j]!="")
			{
                            $datum=explode('|',$tue[$j]);
                            $k=0;
                            while($k<sizeof($datum)-1)
                            {
                                $part=explode('-',$datum[$k]);
                                $tueQuery="SELECT relationid FROM relation WHERE coursecode='$part[0]' and section_id=$part[2] and staffid='$staffid'";

                                $result=mysql_query($tueQuery);
                                $count=mysql_num_rows($result);
                                $i=1;

                                        while($row=mysql_fetch_array($result))
                                        {
                                        $tueinsertQuery="INSERT into periodlist VALUES($row[0],concat('tue-',$j))";
                                        $result2=mysql_query($tueinsertQuery);
                                        $i++;
                                        }
                        $k++;
                        }
                    }
                    $j++;
                }
		
		
		//------------Wednesday----
		
				$j=0;

		while($j<sizeof($wed))
		{
                 	if($wed[$j]!="")
			{
                            $datum=explode('|',$wed[$j]);
                            $k=0;
                            while($k<sizeof($datum)-1)
                            {
                                $part=explode('-',$datum[$k]);
                                $wedQuery="SELECT relationid FROM relation WHERE coursecode='$part[0]' and section_id=$part[2] and staffid='$staffid'";

                                $result=mysql_query($wedQuery);
                                $count=mysql_num_rows($result);
                                $i=1;

                                        while($row=mysql_fetch_array($result))
                                        {
                                        $wedinsertQuery="INSERT into periodlist VALUES($row[0],concat('wed-',$j))";
                                        $result2=mysql_query($wedinsertQuery);
                                        $i++;
                                        }
                        $k++;
                        }
                    }
                    $j++;
                }
		//-------Thursday---
		
				$j=0;

		while($j<sizeof($thu))
		{
                 	if($thu[$j]!="")
			{
                            $datum=explode('|',$thu[$j]);
                            $k=0;
                            while($k<sizeof($datum)-1)
                            {
                                $part=explode('-',$datum[$k]);
                                $thuQuery="SELECT relationid FROM relation WHERE coursecode='$part[0]' and section_id=$part[2] and staffid='$staffid'";

                                $result=mysql_query($thuQuery);
                                $count=mysql_num_rows($result);
                                $i=1;

                                        while($row=mysql_fetch_array($result))
                                        {
                                        $thuinsertQuery="INSERT into periodlist VALUES($row[0],concat('thu-',$j))";
                                        $result2=mysql_query($thuinsertQuery);
                                        $i++;
                                        }
                        $k++;
                        }
                    }
                    $j++;
                }
		//-------Friday-----
				$j=0;

		while($j<sizeof($fri))
		{
                 	if($fri[$j]!="")
			{
                            $datum=explode('|',$fri[$j]);
                            $k=0;
                            while($k<sizeof($datum)-1)
                            {
                                $part=explode('-',$datum[$k]);
                                $friQuery="SELECT relationid FROM relation WHERE coursecode='$part[0]' and section_id=$part[2] and staffid='$staffid'";

                                $result=mysql_query($friQuery);
                                $count=mysql_num_rows($result);
                                $i=1;

                                        while($row=mysql_fetch_array($result))
                                        {
                                        $friinsertQuery="INSERT into periodlist VALUES($row[0],concat('fri-',$j))";
                                        $result2=mysql_query($friinsertQuery);
                                        $i++;
                                        }
                        $k++;
                        }
                    }
                    $j++;
                }
		//---------saturday----
		
				$j=0;

		while($j<sizeof($sat))
		{
                 	if($sat[$j]!="")
			{
                            $datum=explode('|',$sat[$j]);
                            $k=0;
                            while($k<sizeof($datum)-1)
                            {
                                $part=explode('-',$datum[$k]);
                                $satQuery="SELECT relationid FROM relation WHERE coursecode='$part[0]' and section_id=$part[2] and staffid='$staffid'";

                                $result=mysql_query($satQuery);
                                $count=mysql_num_rows($result);
                                $i=1;

                                        while($row=mysql_fetch_array($result))
                                        {
                                        $satinsertQuery="INSERT into periodlist VALUES($row[0],concat('sat-',$j))";
                                        $result2=mysql_query($satinsertQuery);
                                        $i++;
                                        }
                        $k++;
                        }
                    }
                    $j++;
                }
		//-------Sunday-------
				$j=0;

		while($j<sizeof($sun))
		{
                 	if($sun[$j]!="")
			{
                            $datum=explode('|',$sun[$j]);
                            $k=0;
                            while($k<sizeof($datum)-1)
                            {
                                $part=explode('-',$datum[$k]);
                                $sunQuery="SELECT relationid FROM relation WHERE coursecode='$part[0]' and section_id=$part[2] and staffid='$staffid'";

                                $result=mysql_query($sunQuery);
                                $count=mysql_num_rows($result);
                                $i=1;

                                        while($row=mysql_fetch_array($result))
                                        {
                                        $suninsertQuery="INSERT into periodlist VALUES($row[0],concat('sun-',$j))";
                                        $result2=mysql_query($suninsertQuery);
                                        $i++;
                                        }
                        $k++;
                        }
                    }
                    $j++;
                }
		
		$updateQuery="UPDATE staffmaster SET flag=1 WHERE staffid='$staffid'";
		$result=mysql_query($updateQuery);
		echo "<div class='confirmmsg'>The timetable entry was done. Please check with the staff timetable once.</div>";
	  ?>
          </div>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p><br />
          </p>
        </div>
        <!--It Ends!-->
        <img src="../images/cont-bottom.png" alt="cont-bottom"/> </div>
    </div>
    <div style="clear:both">&nbsp;</div>
  </div>
  <div id="footer"> Copyright 2010 SASTRA University - SRC Campus&nbsp; | &nbsp;Engineered By GLOSS Community | <a href="bug_filing.php?ref=top">Report Bugs</a> | <a href="feedback.php">Feedback</a> | <a href="credits.php">Credits</a> </div>
</div>
</body>
</html>
