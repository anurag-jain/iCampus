<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['type']=='staff')
{
$user=$_SESSION['username'];
$username=$_SESSION['staffname'];
}
else { ?>
<script type="text/javascript">
alert("Session Expired!!!");
window.location="../index.php";
</script>
<?php }
$staffid=$user;
$staffname=$username;
$department=$_SESSION['department'];
$pass=$_SESSION['password'];
include_once("../db_config.php");
include('staff_class.php');
$staff = new staff_class($staffid,$staffname,$department,$pass);
?>
<!--Author: Anurag Jain-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Staff Timetable</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function getCourseCode(dest){
	document.getElementById('desti').value=dest.id;
	var q=window.open("choosesection.html","choosecourse","width=850,height=450");
	
}
function remove()
{
	document.getElementById('Button').innerHTML="";
	return true;
	}

</script>
</head>
<body>
<?php
	$fetchQuery= "SELECT b.period,a.relationid,a.coursecode,d.year,d.program,a.section_id, c.section "
					." FROM periodlist b, relation a,sectionmaster c, program_master  d "
					." WHERE a.relationid=b.relationid and a.staffid='$staffid' "
					." and a.section_id=c.section_id and c.program_id=d.program_id GROUP BY"
					." b.period,a.coursecode,d.program,a.section_id";

//        echo $fetchQuery;
	
	$result=mysql_query($fetchQuery);
	$row=mysql_num_rows($result);
	if($row!=0)
	{
	//echo "timetable present";
	$t = array(array());
		$t[0][0] = "";
		$t['mon'][0] = "Mon";
		$t['tue'][0] = "Tue";
		$t['wed'][0] = "wed";
		$t['thu'][0] = "Thu";
		$t['fri'][0] = "Fri";
		$t['sat'][0] = "Sat";
		$t['sun'][0] = "Sun";
//
//		$t['tmon'][0] = "";
//		$t['ttue'][0] = "";
//		$t['twed'][0] = "";
//		$t['tthu'][0] = "";
//		$t['tfri'][0] = "";
//		$t['tsat'][0] = "";
//		$t['tsun'][0] = "";
		
		$t[0][1] = "0";
		$t[0][2] = "1";
		$t[0][3] = "2";
		$t[0][4] = "3";
		$t[0][5] = "4";
		$t[0][6] = "5";
		$t[0][7] = "6";
		$t[0][8] = "7";
		$t[0][9] = "8";
		$t[0][10] = "9";
		$t[0][11] = "10";
		$t[0][12] = "11";
		$t[0][13] = "12";
		$t[0][14] = "13";
		$t[0][15] = "14";
		
		
		while($rowTimetable = mysql_fetch_array($result)) {
			$position = explode("-",$rowTimetable[0]);
                        print_r($position);
                        echo "<br/>";
                        if($t[$position[0]][$position[1]+1]!="")
			$t[$position[0]][$position[1]+1] = $t[$position[0]][$position[1]+1]."|".$rowTimetable[2]."-".$rowTimetable[6]."-".$rowTimetable[5]."|";
                        else
                        $t[$position[0]][$position[1]+1] = $rowTimetable[2]."-".$rowTimetable[6]."-".$rowTimetable[5]."|";
                        echo $t[$position[0]][$position[1]+1]."<br/>";
//			$t["t".$position[0]][$position[1]+1] = $rowTimetable[7];
//                        echo $t["t".$position[0]][$position[1]+1]."hi<br/>";
	}
	}
	else
	{
	echo "No tt";
	}
?>
<div id="student-timetable">
  <div style="height:26px;background:#eed6a2;padding-top:10px;border-bottom:solid 1px #4a4949;font-weight:bolder;font-size:16px;">
    <center>
      SASTRA University Staff TIMETABLE Entry
    </center>
  </div>
  <div id="tt-student">
    <table width="1195" border="0" align="center" cellpadding="1" cellspacing="0" style="border:dashed">
      <tr>
        <td><div align="center"><strong> 7 Important Guidelines : Please read carefully before entering the timetable.</strong></div></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;&nbsp;&nbsp;1: Before entering your timetable please have the hard-copy of your time-table.</td>
      </tr>
      <tr>
        <td>&nbsp;&nbsp;&nbsp;2: Details of your courses and section is provided in the table below. Please check them once again. In case of any discrepancy contact Administrator (Mr. Senthil, IT Admin - 9952352362).</td>
      </tr>
      <tr>
        <td>&nbsp;&nbsp;&nbsp;3: For filling up a slot(period) click once on a  textbox   and choose the corresponding course-section entry for that slot from an opening window.</td>
      </tr>
      <tr>
        <td>&nbsp;&nbsp;&nbsp;4: Do not alter the values manually (by typing them) in the textbox, once it is filled. To change the textbox value click once more on that textbox and choose other entry from the opened window.</td>
      </tr>
      <tr>
        <td>&nbsp;&nbsp;&nbsp;5: After filling all the slots press submit and wait for the confirmation message.</td>
      </tr>
      <tr>
        <td>&nbsp;&nbsp;&nbsp;6: Do not refresh the page in between after you press 'Submit button'. Be patient till the confirmation message gets displayed.</td>
      </tr>
      <tr>
        <td>&nbsp;&nbsp;&nbsp;7: Do not press Confirm Timetable button more than once.</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
    <form name="form1" action="timetable_entered.php" method="post" onSubmit="return remove()">
      <table width="1235" align="center" cellpadding=0 cellspacing=0>
        <tr>
          <th width="3%" class='tt-day'></th>
          <td width="6%" class='tt-head'>0
          </td>
          <td width="6%" class='tt-head'>1
          </td>
          <td width="6%" class='tt-head'>2
          </td>
          <td width="6%" class='tt-head'>3
          </td>
          <td width="6%" class='tt-head'>4
          </td>
          <td width="6%" class='tt-head'>5
          </td>
          <td width="6%" class='tt-head'>6
          </td>
          <td width="6%" class='tt-head'>7
          </td>
          <td width="6%" class='tt-head'>8
          </td>
          <td width="6%" class='tt-head'>9
          </td>
          <td width="11%" class='tt-head'>10
          </td>
          <td width="6%" class='tt-head'>11
          </td>
          <td width="6%" class='tt-head'>12
          </td>
          <td width="6%" class='tt-head'>13
          </td>
          <td width="6%" class='tt-head'>14
          </td>
        </tr>
		<tr>
			<th class='tt-day'>Timeslots</th>
			<td width="6%" class='tt-head'>07:50-08:40
          </td>
          <td width="6%" class='tt-head'>08:40-09:30
          </td>
          <td width="6%" class='tt-head'>09:30-10:20
          </td>
          <td width="6%" class='tt-head'>10:20-11:10 / 10:40-11:30
          </td>
          <td width="6%" class='tt-head'>11:30-12:20
          </td>
          <td width="6%" class='tt-head'>12:20-01-10
          </td>
          <td width="6%" class='tt-head'>01:10-02:00 / 01:20-02:10
          </td>
          <td width="6%" class='tt-head'>02:10-03:00
          </td>
          <td width="6%" class='tt-head'>03:00-03:50
          </td>
          <td width="6%" class='tt-head'>04:00-04:50
          </td>
          <td width="11%" class='tt-head'>04:50-05:40
          </td>
          <td width="6%" class='tt-head'>05:40-06:30
          </td>
          <td width="6%" class='tt-head'>Extra
          </td>
          <td width="6%" class='tt-head'>Extra
          </td>
          <td width="6%" class='tt-head'>Extra
          </td>
		</tr>
        <tr>
          <th class='tt-day'>Mon</th>
          <td class='tt-cell'><p><input type="text" name="mon-0" id="mon-0" size="8" onClick="getCourseCode(this)" value="<?php if($t!=NULL) echo $t['mon'][1];?>"/>
          </p>
          </td>
          <td class='tt-cell'><p>
            <input type="text" name="mon-1" id="mon-1" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['mon'][2];?>"/>
          </p>
          </td>
          <td class='tt-cell'><p>
            <input type="text" name="mon-2" id="mon-2" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['mon'][3];?>"/>
          </p>
          </td>
          <td class='tt-cell'><p>
            <input type="text" name="mon-3" id="mon-3" size="8" onClick="getCourseCode(this)" value="<?php if($t!=NULL) echo $t['mon'][4];?>"/>
          </p>
          </td>
          <td class='tt-cell'><p>
            <input type="text" name="mon-4" id="mon-4" size="8" onClick="getCourseCode(this)" value="<?php if($t!=NULL) echo $t['mon'][5];?>"/>
          </p>
          </td>
          <td class='tt-cell'><p>
            <input type="text" name="mon-5" id="mon-5" size="8" onClick="getCourseCode(this)" value="<?php if($t!=NULL) echo $t['mon'][6];?>"/>
          </p>
          </td>
          <td class='tt-cell'><p>
            <input type="text" name="mon-6" id="mon-6" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['mon'][7];?>"/>
          </p>
          </td>
          <td class='tt-cell'><p>
            <input type="text" name="mon-7" id="mon-7" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['mon'][8];?>"/>
          </p>
          </td>
          <td class='tt-cell'><p>
            <input type="text" name="mon-8" id="mon-8" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['mon'][9];?>"/>
          </p>
          </td>
          <td class='tt-cell'><p>
            <input type="text" name="mon-9" id="mon-9" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['mon'][10];?>"/>
          </p>
          </td>
          <td class='tt-cell'><p>
            <input type="text" name="mon-10" id="mon-10" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['mon'][11];?>"/>
          </p>
          </td>
          <td class='tt-cell'><p>
            <input type="text" name="mon-11" id="mon-11" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['mon'][12];?>"/>
          </p>
          </td>
          <td class='tt-cell'><p>
            <input type="text" name="mon-12" id="mon-12" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['mon'][13];?>"/>
          </p>
          </td>
          <td class='tt-cell'><p>
            <input type="text" name="mon-13" id="mon-13" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['mon'][14];?>"/>
          </p>
          </td>
          <td class='tt-cell'><p>
            <input type="text" name="mon-14" id="mon-14" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['mon'][15];?>"/>
          </p>
          </td>
        </tr>
                  <tr>
          <th class='tt-day'>Tue</th>
          <td class='tt-cell'><p>
            <input type="text" name="tue-0" id="tue-0" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['tue'][1];?>"/>
          </p>
          </td>
          <td class='tt-cell'><p>
            <input type="text" name="tue-1" id="tue-1" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['tue'][2];?>"/>
          </p>
          </td>
          <td class='tt-cell'><p>
            <input type="text" name="tue-2" id="tue-2" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['tue'][3];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="tue-3" id="tue-3" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['tue'][4];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="tue-4" id="tue-4" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['tue'][5];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="tue-5" id="tue-5" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['tue'][6];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="tue-6" id="tue-6" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['tue'][7];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="tue-7" id="tue-7" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['tue'][8];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="tue-8" id="tue-8" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['tue'][9];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="tue-9" id="tue-9" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['tue'][10];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="tue-10" id="tue-10" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['tue'][11];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="tue-11" id="tue-11" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['tue'][12];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="tue-12" id="tue-12" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['tue'][13];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="tue-13" id="tue-13" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['tue'][14];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="tue-14" id="tue-14" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['tue'][15];?>"/>
          </p>
          </td>
        </tr>
                  <tr>
          <th class='tt-day'>Wed</th>
          <td class='tt-cell'><p>
            <input type="text" name="wed-0" id="wed-0" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['wed'][1];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="wed-1" id="wed-1" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['wed'][2];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="wed-2" id="wed-2" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['wed'][3];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="wed-3" id="wed-3" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['wed'][4];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="wed-4" id="wed-4" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['wed'][5];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="wed-5" id="wed-5" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['wed'][6];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="wed-6" id="wed-6" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['wed'][7];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="wed-7" id="wed-7" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['wed'][8];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="wed-8" id="wed-8" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['wed'][9];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="wed-9" id="wed-9" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['wed'][10];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="wed-10" id="wed-10" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['wed'][11];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="wed-11" id="wed-11" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['wed'][12];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="wed-12" id="wed-12" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['wed'][13];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="wed-13" id="wed-13" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['wed'][14];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="wed-14" id="wed-14" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['wed'][15]; ?>"/>
          </p>
          </td>
        </tr>
         <tr>
          <th class='tt-day'>Thu</th>
          <td class='tt-cell'><p>
            <input type="text" name="thu-0" id="thu-0" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['thu'][1];?>"/>
          </p>
          
          </td><td class="tt-cell"><p>
            <input type="text" name="thu-1" id="thu-1" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['thu'][2];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="thu-2" id="thu-2" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['thu'][3];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="thu-3" id="thu-3" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['thu'][4];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="thu-4" id="thu-4" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['thu'][5];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="thu-5" id="thu-5" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['thu'][6];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="thu-6" id="thu-6" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['thu'][7];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="thu-7" id="thu-7" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['thu'][8];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="thu-8" id="thu-8" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['thu'][9];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="thu-9" id="thu-9" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['thu'][10];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="thu-10" id="thu-10" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['thu'][11];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="thu-11" id="thu-11" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['thu'][12];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="thu-12" id="thu-12" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['thu'][13];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="thu-13" id="thu-13" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['thu'][14];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="thu-14" id="thu-14" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['thu'][15];?>"/>
          </p>
          </td>
        </tr>
                <tr>
          <th class='tt-day'>Fri</th>
          <td class='tt-cell'><p>
            <input type="text" name="fri-0" id="fri-0" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['fri'][1];?>"/>
          </p>
           </td><td class="tt-cell"><p>
            <input type="text" name="fri-1" id="fri-1" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['fri'][2];?>"/>
          </p>
           </td><td class="tt-cell"><p>
            <input type="text" name="fri-2" id="fri-2" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['fri'][3];?>"/>
          </p>
           </td><td class="tt-cell"><p>
            <input type="text" name="fri-3" id="fri-3" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['fri'][4];?>"/>
          </p>
           </td><td class="tt-cell"><p>
            <input type="text" name="fri-4" id="fri-4" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['fri'][5];?>"/>
          </p>
           </td><td class="tt-cell"><p>
            <input type="text" name="fri-5" id="fri-5" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['fri'][6];?>"/>
          </p>
           </td><td class="tt-cell"><p>
            <input type="text" name="fri-6" id="fri-6" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['fri'][7];?>"/>
          </p>
           </td><td class="tt-cell"><p>
            <input type="text" name="fri-7" id="fri-7" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['fri'][8];?>"/>
          </p>
           </td><td class="tt-cell"><p>
            <input type="text" name="fri-8" id="fri-8" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['fri'][9];?>"/>
          </p>
           </td><td class="tt-cell"><p>
            <input type="text" name="fri-9" id="fri-9" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['fri'][10];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="fri-10" id="fri-10" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['fri'][11];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="fri-11" id="fri-11" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['fri'][12];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="fri-12" id="fri-12" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['fri'][13];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="fri-13" id="fri-13" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['fri'][14];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="fri-14" id="fri-14" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['fri'][15];?>"/>
          </p>
          </td>
        </tr>
          <tr>
          <th class='tt-day'>Sat</th>
          <td class='tt-cell'><p>
            <input type="text" name="sat-0" id="sat-0" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['sat'][1];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="sat-1" id="sat-1" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['sat'][2];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="sat-2" id="sat-2" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['sat'][3];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="sat-3" id="sat-3" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['sat'][4];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="sat-4" id="sat-4" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['sat'][5];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="sat-5" id="sat-5" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['sat'][6];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="sat-6" id="sat-6" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['sat'][7];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="sat-7" id="sat-7" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['sat'][8];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="sat-8" id="sat-8" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['sat'][9];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="sat-9" id="sat-9" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['sat'][10];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="sat-10" id="sat-10" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['sat'][11];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="sat-11" id="sat-11" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['sat'][12];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="sat-12" id="sat-12" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['sat'][13];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="sat-13" id="sat-13" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['sat'][14];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="sat-14" id="sat-14" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['sat'][15];?>"/>
          </p>
          </td>
        </tr>
 
                 <tr>
          <th class='tt-day'>Sun</th>
          <td class='tt-cell'><p>
            <input type="text" name="sun-0" id="sun-0" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['sun'][1];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="sun-1" id="sun-1" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['sun'][2];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="sun-2" id="sun-2" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['sun'][3];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="sun-3" id="sun-3" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['sun'][4];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="sun-4" id="sun-4" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['sun'][5];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="sun-5" id="sun-5" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['sun'][6];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="sun-6" id="sun-6" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['sun'][7];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="sun-7" id="sun-7" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['sun'][8];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="sun-8" id="sun-8" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['sun'][9];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="sun-9" id="sun-9" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['sun'][10];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="sun-10" id="sun-10" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['sun'][11];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="sun-11" id="sun-11" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['sun'][12];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="sun-12" id="sun-12" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['sun'][13];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="sun-13" id="sun-13" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['sun'][14];?>"/>
          </p>
          </td><td class="tt-cell"><p>
            <input type="text" name="sun-14" id="sun-14" size="8" onClick="getCourseCode(this)" value="<?php  if($t!=NULL) echo $t['sun'][15];?>"/>
          </p>
          </td>
        </tr>
        <tr>
        	<td id="Button" colspan="32" align="center"><label>
        	  <input type="submit" name="button" id="button" value="Confirm Timetable" />
      	  </label>
            
            </td>
        </tr>
      </table>
    </form>
  </div>
  <div class="clear" style="background:#fff"></div>
  <div style="height:26px;background:#eed6a2;padding-top:10px;border-bottom:solid 1px #4a4949;font-weight:bolder;font-size:16px;">
    <center>
      COURSE DETAILS
    </center>
  </div>
  <div style="border:solid 1px #4a4949;" >
    <?php 
	  require_once('../db_config.php');
	  $fetchtimetableQuery="SELECT distinct a.coursecode,b.section,a.section_id, c.coursename,d.program,d.department,d.year "
	  					  ."FROM relation a, sectionmaster b,coursemaster c,program_master d WHERE "
					      ."staffid='$staffid' and a.section_id=b.section_id and a.coursecode=c.coursecode and b.program_id=d.program_id";
	
	
	  $result=mysql_query($fetchtimetableQuery) ;
	  $norow=mysql_num_rows($result);
	  
	  
	  $i=0;
	 
	  ?>
    <table id="course_table" width='100%' align="center" cellpadding=0 cellspacing=1>
      <tr>
        <th width="16%">Course Code</th>
        <th width="26%">Course name</th>
        <th width="27%">Branch and Year</th>
        <th width="17%">Section </th>
        <th width="14%" style="display:none">Section Id</th>
        </tr>
        <?php  while($row=mysql_fetch_array($result))
				{	  
		  ?>
      <tr>
        <td align="center"><?php echo $row[0]; ?></td>
        <td align="center"><?php echo $row[3]; ?></td>
        <td align="center"><?php echo $row[4].":".$row[5].":".$row[6]; ?></td>
        <td align="center"><?php echo $row[1];?></td>
        <td style="display:none" align="center"><?php echo $row[2];?></td>
      </tr>
      <?php } ?>
    </table>
    <input type="hidden" id="desti" />
  </div>
  <div class="clear" style="background:#fff"></div>
</div>
</body>
</html>