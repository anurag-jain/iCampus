<?php
session_start();
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
include ('security_class.php');
$security=new security_class($staffid);
$relation_obj1 = new relation_class();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
if(isset($_POST['customize']))
{
$midsem_name=$_POST['midsem_name'];
$section_id=$_POST['section_id'];
$coursecode=$_POST['coursecode'];
$edit=$_POST['edit'];
$customize=$_POST['customize'];
$max_marks=$_POST['max_marks'];
$conv_marks=$_POST['conv_marks'];
}
else
{ 
$details=$_GET['value'];
$details=urldecode($details);
$details=explode(",",$details);
	$midsem_name=$details[3];
	$section_id=$details[2];
	$coursecode=$details[1];
	//$section=$details[5];
	$edit=$details[4];
	//echo $section;
	//echo $section_id;
	//echo $coursecode;	
}
$sno='1';
$a='0000-00-00 00:00:00';
$students=$relation_obj1->listofstudents_staff($staffid,$section_id,$coursecode);
$cia_update=$relation_obj1->check_cia_update($staffid,$section_id,$coursecode,$midsem_name);
$course="SELECT a.department,a.year,b.section FROM program_master a,sectionmaster b where b.program_id=a.program_id and b.section_id='$section_id'";
$course_result=mysql_query($course);
$course_details=mysql_fetch_array($course_result);


//$max_marks=50;
//$conv_marks=10;

//$cf=0.4;

if($cia_update!=null)
$cia_update_row1=mysql_fetch_row($cia_update);
?>
<head>
<title>
SASTRA University - SRC
</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">

function Inint_AJAX() {
/*try { return new ActiveXObject("Msxml2.XMLHTTP");  } catch(e) {} //IE
try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
try { return new XMLHttpRequest();          } catch(e) {} //Native Javascript
alert("XMLHttpRequest not supported");
return null;*/
var xmlhttp=false;
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{
						try{
							xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
							}
						catch(e){
									try{
										xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
										}
									catch(e1){
										xmlhttp=false;
										}
								}
					}

		return xmlhttp;
	}	
function change_marks(marks,sno,temp,regno,midsem,coursecode,cf)
{
if(midsem==4)
truth=validate(midsem);
else
truth=calculate_marks(marks,sno,temp,cf);
//calculate_marks(marks,sno,temp);

var strURL="edit_cia.php?marks="+marks+"&regno="+regno+"&midsem="+midsem+"&coursecode="+coursecode;


if(truth!=false && confirm("Proceed to change marks of "+regno+" to "+marks))
{
var req = Inint_AJAX();        
    // var req = getXMLHTTP(); // fuction to get xmlhttp object
     if (req)
     {
      req.onreadystatechange = function()
     {
      if (req.readyState == 4) { //data is retrieved from server
       if (req.status == 200) { // which reprents ok status                    
         document.getElementById('msgdiv').innerHTML=req.responseText;
      }
      else
      { 
         alert("There was a problem while using XMLHTTP:\n");
      }
      }            
      }        
    req.open("GET", strURL, true); //open url using get method
    req.send(null);
     }
	 } 
    }

function calculate_marks(marks,sno,temp,cf)
{
valid=true;
//alert("first");
//alert(marks);
	if(marks=="a" || marks=="ab" || marks=="A" || marks=="Ab")
		{	//alert("a");
			marks="A";
			document.getElementById(sno).value=marks;
			document.getElementById(sno).style.background='#fff';
			document.getElementById(temp).style.background='#fff';
			//alert("here");
			return true;
		}
		else 
		{
			if(isNaN(marks))
			{	
				document.getElementById(sno).style.background='#E4C9C9';
				document.getElementById(temp).style.background='#E4C9C9';
				//document.form1.marks.style.background='#f00';
				return false;
			}
			else
			{
				document.getElementById(sno).style.background='#fff';
				document.getElementById(temp).style.background='#fff';
			}
		}	
		
	if(marks!="A" && marks <= 50 && marks >= 0)
	{
		var fraction = marks % 10;
			if(fraction>=0.5)
				{
					marks=Math.round((marks*cf)*100)/100;
				}
				else
				{
					marks=Math.round((marks*cf)*100)/100;
				}
		//document.getElementById(sno).value=marks;
	}
	else{
			document.getElementById(sno).style.background='#f00';
			document.getElementById(temp).style.background='#f00';
			return false;
		}
				
		
	document.getElementById(sno).value=marks;	
}

function validate(midsem_name)
{
var success=true;
var st_list=document.getElementsByTagName('input');
for(var i=0;i<st_list.length;i++) {
	if(st_list[i].type=='text') { 
		if(st_list[i].value=="a" || st_list[i].value=="A" || st_list[i].value=="ab"){
			success=true; }
		else {	
				if(st_list[i].value=="" || isNaN(st_list[i].value) || st_list[i].value > 50 || st_list[i].value < 0) {
					st_list[i].style.background='#ffcccc';
					success=false;	}
				else
				st_list[i].style.background='#fff';
			}	
	}
}
if(midsem_name==4)
{
var st_list=document.getElementsByTagName('input');
for(var i=0;i<st_list.length;i++) {
	if(st_list[i].type=='text') { 
		if(st_list[i].value=="a" || st_list[i].value=="A" || st_list[i].value=="ab"){
			success=true; }
		else {	
				if(st_list[i].value=="" || isNaN(st_list[i].value) || st_list[i].value > 10 ) {
					st_list[i].style.background='#FF9966';
					success=false;	
					}
				else
				st_list[i].style.background='#fff';
			}	
	}
}
}
return success;
}

function findlist(marks)
{
	var list=document.getElementsByTagName("tr");
		for(var t=1;t<list.length;t++) {
			list[t].style.display='';
		}
		if(marks!="" && !isNaN(marks)) {
			
			for(var i=1;i<list.length;i++) {
				var children=list[i].getElementsByTagName('td');
				var str=children[4].innerHTML;
				if(str.search(/Absent/) > 0){
					
					}
				else {
					if(parseFloat(str) > marks) {
					list[i].style.display="none";
					}
				}
			}
		}
		if(marks=='a'){
				for(var i=1;i<list.length;i++) {
					var children=list[i].getElementsByTagName('td');
					var str=children[4].innerHTML;
					if(str.search(/Absent/) < 0)
						list[i].style.display="none";
						}
					}	
			
				
}

function disable(){
	if(confirm("All entered values will be cleared!!!")){
	/*var list=document.getElementsByTagName("tr");
	for(var i=2;i<list.length;i++) {
				var children=list[i].getElementsByTagName('td');
				children[4].style.background='#FFFFFF';
					//list[i].style.display="none";
	}*/
	var list=document.getElementsByTagName('input');
	for(var i=0;i<list.length;i++) {
	if(list[i].type=='text') {
	list[i].style.background='#ffffff'; }
		}
	}
	else{
	return false; }				
}



</script>

</head>
<body>
<div id="wrapper_outer"><div id="wrapper">
<div id="header"><center><img src="../images/header.png" alt="sastra university"/></center></div>
<div id="welcome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Welcome <?php echo $staffname; ?></strong></div>
<div id="menu">
		<img src="../images/Sastra1.png" width="170" alt="sastra university" />
		<div class="clear"></div>
		<img src="../images/menu-top.png" alt="menu-top"/>
			<div id="nav">
			<ul>
				<li><a href="staff_index.php">Home</a></li>
                <li><a href="staff_profile.php">Profile</a></li>
                <li><a href="staff_attendance.php">Post Attendance</a></li>
                <li><a href="modify_attendance.php">Modify Attendance</a></li>
                <li><a href="staff_attendance.php#pending">Pending Attendance</a></li>
                <li><a href="report.php">Get Lag Report</a></li>
                <li><a href="staff_timetable.php" target="_blank">Timetable</a></li>
                <li><a href="attendance_register.php">Attendance Register</a></li>
                <li><a href="midsem_display.php">Post CIA</a></li>
                <li><a href="../logout.php">Sign Out</a></li>
			</ul>
			</div>
		<img src="../images/menu-bottom.png" alt="menu-bottom"/>
	</div>
<div id="content">
<div id="main">
<img src="../images/cont-top.png" alt="cont-top"/>
<!--Write code here!-->
<div class="main">
<h2 class='heading'>CIA Entry-<?php echo $midsem_name ?> marks for <?php echo $coursecode;?></h2>
<h3 class="heading">Section:<?php echo $course_details[0]."-".$course_details[1]."-".$course_details[2]; ?></h3>
<div id="msgdiv"></div>

<div id="staff-cia-post">
<?php 
//if(($cia_update_row1[0]=="" || $cia_update_row1[0]==$a) && $edit==2)
if($edit==2)/* none is posted */
{
$cf=$conv_marks/$max_marks;
 ?>	
 <span style="margin-left:500px;color:#1030fe">Note : Use <b>A</b> for Absent</span>
 	<form id="form1" method="post" action="studentlist_post.php">
	
<input type="hidden" name="coursecode" value="<?php echo $coursecode ?>" />
<input type="hidden" name="section_id" value="<?php echo $section_id ?>" />
<input type="hidden" name="midsem_name" value="<?php echo $midsem_name ?>" />
<input type="hidden" name="max_marks" value="<?php echo $max_marks; ?>"/>
<input type="hidden" name="conv_marks" value="<?php echo $conv_marks ?>"/>

	
  <div id="staff-cia-list">
	<table width=98% cellspacing=1 cellpadding=0 align="center" id="mytable">
  	<tr>
    <th width=4% >Sno</th>
    <th width=25% >Reg No.</th>
    <th width=50%>Name</th>
    <th>
    <?php
	if($midsem_name!=4)
	echo "CIA-".$midsem_name."(".$max_marks.")";
	else
	echo "Assignments($max_marks)";
	?>
    </th>
    <?php 
	if($midsem_name!=4) { ?>
    <th width=5% ><?php echo "CIA-".$midsem_name."(".$conv_marks.")"; ?></th>
   <?php } 
   else  { ?>
   <th width=5% ><?php echo "Assignments($max_marks)"; ?></th>
  <?php } ?>
  </tr>
  	
  <?php
			$sno=0;
  			while($row=mysql_fetch_array($students))
  				{ 
  					if(($sno++)%2==1)
						$class='even';
					else
						$class='odd';
						
  				echo "<tr class='$class'>";
				?>
    			<td><?php echo $sno ?></td>
    			<td><?php echo $row[1] ?></td>
    			<td><?php echo $row[0] ?></td>
    			<td>
    			<input name="marks" type="text" id="<?php echo $sno+300; ?>" size="5" maxlength="5" 
    					onChange="calculate_marks(this.value,<?php echo $sno; ?>,<?php echo $sno+300; ?>,<?php echo $cf; ?>)" tabindex="<?php echo $sno; ?>" value=""/>
    			</td>
				<td><div align="center">
	  				<input type="text" id="<?php echo $sno; ?>" size="5" readonly name="<?php echo $sno; ?>" value=""/>
	  			</div>
                </td>
                <?php } 
				/*else { ?>
				<div align="center">
	  			<input type="text" id="<?php echo $sno; ?>" size="5" name="<?php echo $sno; ?>" />
	  			</div>
                </td>
				<?php }*/
				?> 
   				</tr>
  					<?php 
	//				echo $row[1];
  					
  					?>
</table>
</div>
<p>
  <div align="center"><label>
  <input type="submit" name="button" id="button" value="Submit" tabindex="<?php echo $sno; ?>" onClick="return validate(<?php echo $midsem_name ?>)"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" id="reset" name="reset" value="reset" onClick="return disable();"/>
  </label></div>
</p>
</form>
<?php 
}
/* EDIT CIA PART */
else {
		$cfquery="select max_midsem1,max_midsem2,max_midsem3,max_internals,conv_midsem1,conv_midsem2,conv_midsem3,conv_internals from midsem_post "
					." where staffid='$staffid' and section_id='$section_id' and coursecode='$coursecode' ";
		$cfresult=mysql_query($cfquery);
		$cfvalue=mysql_fetch_array($cfresult);
		switch($midsem_name)
		{
		case 1:
		$cf=$cfvalue[4]/$cfvalue[0];
		break;
		case 2:
		$cf=$cfvalue[5]/$cfvalue[1];
		break;
		case 1:
		$cf=$cfvalue[6]/$cfvalue[2];
		break;
		case 1:
		$cf=$cfvalue[7]/$cfvalue[3];
		break;

		}
		$update=$relation_obj1->check_cia_update($staffid,$section_id,$coursecode,$midsem_name);
		if($update!=null)
			$update_row=mysql_fetch_array($update);

		$posteddate=$update_row[0];
		$today=date("y-m-d");
		//echo $today;
		if($edit==1)
			{
			$sno=1;
			$students=$relation_obj1-> listofstudents_staff($staffid,$section_id,$coursecode);
			$marks=$relation_obj1-> getmidsem_marks($staffid,$section_id,$coursecode,$midsem_name);
			?>
			<div id="staff-cia-list">
	<table width=98% cellspacing=1 cellpadding=0 align="center" id="mytable">
  	<tr>
    <th width=4% >Sno</th>
    <th width=25% >Reg No.</th>
    <th width=50%>Name</th>
    <th>
    <?php
	if($midsem_name!=4)
	echo "CIA-".$midsem_name;
	else
	echo "Assignments($cfvalue[3])";
	?>
    <?php 
	if($midsem_name!=4){ ?>
    <th width=5% >Marks(<?php echo $cfvalue[7]; ?>)</th>
    <?php } ?>
  </tr>
			<?php
			$sno=0;			
			while($row2_edit=mysql_fetch_array($students) and $row3_edit=mysql_fetch_array($marks))
			{

  					if(($sno++)%2==1)
						$class='even';
					else
						$class='odd';
						
  				echo "<tr class='$class'>";
				?>
    			<td><?php echo $sno; ?></td>
    			<td><?php echo $row2_edit[1]; ?></td>
    			<td><?php echo $row2_edit[0]; ?></td>
    			<td>
                <?php 
				$a=$row2_edit[1];
				if($midsem_name!=4)
				{ 
				//$a="'".$row2_edit[1]."','".$midsem_name."','".$coursecode."'";
			
				
				?>	                
   				  <input name="marks" type="text" id="<?php echo $sno+300; ?>" size="5" maxlength="5" 
    					onChange="change_marks(this.value,<?php echo $sno; ?>,<?php echo $sno+300; ?>,<?php echo "'$a'"; ?>,<?php echo $midsem_name; ?>,
						<?php echo "'$coursecode'"; ?>,<?php echo "'$cf'"; ?> )" tabindex="<?php echo $sno; ?>" 
                        value=" <?php 
					if($row3_edit[0]=='121')
						{ 
							 
							echo "A";
							
						}
						else { echo ($row3_edit[0]/$cf); 
						}				
						?>"/>
    			</td>
				<td>
	  				<input type="text" id="<?php echo $sno; ?>" size="5" readonly name="<?php echo $sno; ?>" 
                    value="<?php 
					if($row3_edit[0]=='121')
					echo "A";
					else
					echo $row3_edit[0]; ?>"/>
                </td>
                </tr>
                <?php 
				} 
				else { ?>
          				<div align="center">
	  					<input type="text" id="<?php echo $sno; ?>" size="5" name="<?php echo $sno; ?>" onChange="change_marks(this.value,<?php echo $sno; ?>,<?php echo 							$sno+300; ?>,<?php echo "'$a'"; ?>,<?php echo $midsem_name; ?>,<?php echo "'$coursecode'"; ?>)" tabindex="<?php echo $sno; ?>" 
                        value="<?php 
					if($row3_edit[0]=='121')
					echo "A";
					else
					echo $row3_edit[0]; ?>"/>
	  					</div>
                		</td>
   						</tr>
                <?php
                	}
  				} 
				?>
  					
</table>
 </div>
			<?php 
			}
			/* CIA VIEW PART  */
			else
			{ 
			$cfquery="select max_midsem1,max_midsem2,max_midsem3,max_internals,conv_midsem1,conv_midsem2,conv_midsem3,conv_internals from midsem_post "
					." where staffid='$staffid' and section_id='$section_id' and coursecode='$coursecode' ";
		$cfresult=mysql_query($cfquery);
		$cfvalue=mysql_fetch_array($cfresult);
		switch($midsem_name)
		{
		case 1:
		$cf=$cfvalue[4]/$cfvalue[0];
		break;
		case 2:
		$cf=$cfvalue[5]/$cfvalue[1];
		break;
		case 1:
		$cf=$cfvalue[6]/$cfvalue[2];
		break;
		case 1:
		$cf=$cfvalue[7]/$cfvalue[3];
		break;

		}
			?>
<div id="search" align="center" >Find students of marks less than <input name="mark_search" type="text" id="mark_search" size="4" maxlength="4"  onchange="findlist(this.value);"/> out of 20</div>
<table width=98% cellpadding=0 cellspacing=1 align="center">
<tr>	
<th>S No</th>
<th>Register Number</th>
<th>Student Name</th>
<th> 
    <?php
	switch($midsem_name)
	{
	case 1:
	echo "CIA-I($cfvalue[0])";
	break;
	case 2:
	echo "CIA-II($cfvalue[1])";
	break;
	case 3:
	echo "CIA-III($cfvalue[2])";
	break;
	case 4:
	echo "Assignment($$cfvalue[3])";
	break;
	}?>
	</th>
 <th> 
    <?php
	switch($midsem_name)
	{
	case 1:
	echo "CIA-I($cfvalue[4])";
	break;
	case 2:
	echo "CIA-II($cfvalue[5])";
	break;
	case 3:
	echo "CIA-III($cfvalue[6])";
	break;
	case 4:
	echo "Assignment($cfvalue[7])";
	break;
	}?>
	</th>
   
  </tr>

  	
<?php  
$students=$relation_obj1-> listofstudents_staff($staffid,$section_id,$coursecode);
$marks=$relation_obj1-> getmidsem_marks($staffid,$section_id,$coursecode,$midsem_name);
while($row2=mysql_fetch_array($students) and $row3=mysql_fetch_array($marks))
{
if($sno%2==0)
	$class='even';
else
	$class='odd';	 
?>

  				<tr class= <?php echo $class; ?>>
    			<td ><?php echo $sno; ?></td>
    			<td ><?php echo $row2[1]; ?></td>
    			<td ><?php echo ucwords($row2[0]); ?></td>
                <td id="<?php echo $sno ?>" class="marks"><?php 	
				if($row3[0]=='121')
				{ 
				echo "<span class='mandatory' style='display:inline'>Absent</span>"; 
				}
				else { echo ($row3[0]/$cf); }				
				?>
				</td>
    			<td id="<?php echo $sno ?>" class="marks"><?php 
				if($row3[0]=='121')
				{ 
				echo "<span class='mandatory' style='display:inline'>Absent</span>"; 
				}
				else { echo $row3[0]; }
				?>
				</td>
              
   				</tr>
  					<?php 
  				$sno++;
  				}
  					?>
</table>
<label><a href="cia_report_midsem.php?value=<?php echo $staffid.",".$midsem_name.",".$section_id.",".$coursecode;  ?>" target="_blank"><br />
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/pdf.jpg" alt="PDF" width="30" height="30" /></a>
              <a href="cia_midsem_print.php?value=<?php echo $staffid.",".$midsem_name.",".$section_id.",".$coursecode;  ?>" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/printer.jpg" alt="PRINT" width="30" height="30" /></a>
  </label>
<?php
}
}
?>
   </div>
  	</div>

	<!--It Ends!-->
	<img src="../images/cont-bottom.png" alt="cont-bottom"/>
	</div>
</div>
<div style="clear:both">&nbsp;</div>
</div>	

<div id="footer">
Copyright 2009-10 SASTRA University - SRC Campus&nbsp; | &nbsp;Powered By GLOSS Community&nbsp;&nbsp;&nbsp;&nbsp;
</div>
</div>
</body>
</html>
