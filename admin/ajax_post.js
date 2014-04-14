function modify_cia_marks()
{
		if(document.getElementById('staffid').value == "")
		{
			alert("Oops! Looks like the Staff Id is missing.");
			return;
		}
		if(document.getElementById('regno').value == "")
		{
			alert("Oops! Looks like the Student Register Number is missing.");
			return;
		}
		if(document.getElementById('course_select').value == "")
		{
			alert("Oops! The Staff does not teach any Course to this Student.");
			return;
		}
		if(document.getElementById('type').value == "invalid")
		{
			alert("Oh! Oh! Looks like you've not chosen the midsem type.");
			return;
		}
		if(document.getElementById('marks').value == "")
		{
			alert("Oh! Oh! Looks like you've not Entered the Marks.");
			return;
		}
		xmlhttp = new XMLHttpRequest();
	    var parameters="param1="+document.getElementById('regno').value+"&param2="+document.getElementById('staffid').value;
		parameters = parameters + "&param3="+document.getElementById('course_select').value+"&param4="+document.getElementById('type').value;
		parameters = parameters + "&param5="+document.getElementById('marks').value;
	    xmlhttp.open("POST", 'modify_cia_ajax.php', true);
	    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	    xmlhttp.send(parameters);
	    xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
		{
			alert(xmlhttp.responseText);
		}
}
}

function fetch_course_code()
{
	if((document.getElementById('staffid').value == "")||(document.getElementById('regno').value == ""))
	{
		return;
	}
	xmlhttp = new XMLHttpRequest();
	var parameters="param1="+document.getElementById('regno').value+"&param2="+document.getElementById('staffid').value;
	xmlhttp.open("POST", 'fetch_course_code_ajax.php', true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send(parameters);
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState == 4) 
		{
			//alert(xmlhttp.responseText);
			document.getElementById('coursecode').innerHTML = xmlhttp.responseText;
		}
	}
}

function password_reset_student()
{
	if(document.getElementById('regno').value == "")
	{
		alert("Looks like you've forgotten to enter Student Register Number.");
		return;
	}
	if(confirm("Are you sure you want to reset Student's password?")) {
		xmlhttp = new XMLHttpRequest();
		var parameters="param1="+document.getElementById('regno').value;
		xmlhttp.open("POST", 'reset_student_password.php', true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send(parameters);
		xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				alert("Successfully Reset!");
			}
		}
	}
}

function password_reset_staff()
{
	if(document.getElementById('staff_name').value == "")
	{
		alert("Looks like you've forgotten to enter Staff ID!");
		return;
	}
	if(confirm("Are you sure you want to reset staff password?")) {
		xmlhttp = new XMLHttpRequest();
		var parameters="param1="+document.getElementById('staff_name').value;
		xmlhttp.open("POST", 'reset_staff_password.php', true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send(parameters);
		xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				alert(xmlhttp.responseText);
			}
		}
	}
}

function reset_semester_status(value)
{
	if(confirm("Are you sure you want to reset?")) {
		xmlhttp = new XMLHttpRequest();
		var parameters="param1="+value;
		xmlhttp.open("POST", 'reset_sem_status.php', true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send(parameters);
		xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				alert(xmlhttp.responseText);
			}
		}
	}
}
function attendance_lock_ajax()
{
		// Write appropriate functions to perform form validation...
		xmlhttp = new XMLHttpRequest();
		var value=encodeURIComponent(document.getElementById('attendance_tb').value);
		var parameters="param1="+value;
		xmlhttp.open("POST", 'attendance_post.php', true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send(parameters);
		xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				alert(xmlhttp.responseText);
			}
		}
}

function percentage_ajax()
{
		// Write appropriate functions to perform form validation...
		if(document.getElementById('percentage_tb').value == "")
		{
			alert("Looks like you've forgotten to enter the Attendance %");	
			return;
		}
		if((parseInt(document.getElementById('percentage_tb').value) > 100) || (parseInt(document.getElementById('percentage_tb').value) <= 0))
		{
			alert("Looks like you've entered a wrong Attendance %");	
			return;
		}
		xmlhttp = new XMLHttpRequest();
		var value=encodeURIComponent(document.getElementById('percentage_tb').value);
		var parameters="param1="+value;
		xmlhttp.open("POST", 'per_post.php', true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send(parameters);
		xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				alert(xmlhttp.responseText);
			}
		}
}

function lock_staff()
{
		var value1 = document.getElementById('Attendance').checked;
		var value2 = document.getElementById('lock').checked;
		var value3 = document.getElementById('staff_name').value;
		if(value3 == "")
		{
			alert("Looks like you've forgotten to enter the Staff Name or Id.");	
			return;
		}
		//alert("Hello! " + value1 + " " + value2 + " " + value3);
		xmlhttp1 = new XMLHttpRequest();
		var parameters="lock_status=" + value2 + "&lock_type=" + value1 + "&staff_id=" + value3;
		xmlhttp1.open("POST", 'lock_staff.php', true);
		xmlhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp1.send(parameters);
		xmlhttp1.onreadystatechange=function()
		{
			if(xmlhttp1.readyState == 4 && xmlhttp1.status == 200) 
			{
							alert(xmlhttp1.responseText);
							document.location = "admin_index.php";
			}
		}
}

function cia_lock_ajax()
{
		// Write appropriate functions to perform form validation...
		xmlhttp = new XMLHttpRequest();
		var value=encodeURIComponent(document.getElementById('cia_tb').value);
		var parameters="param1="+value;
		xmlhttp.open("POST", 'cia_post.php', true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send(parameters);
		xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				alert(xmlhttp.responseText);
			}
		}
}

function minpercentage_ajax()
{
		// Write appropriate functions to perform form validation...
		xmlhttp = new XMLHttpRequest();
		var value=encodeURIComponent(document.getElementById('min_att_tb').value);
		var parameters="param1="+value;
		xmlhttp.open("POST", 'per_post.php', true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send(parameters);
		xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				alert(xmlhttp.responseText);
			}
		}
}

function StartSemester(value_id)
{
		if(document.getElementById('date_tb').value == "")
		{
			alert("Looks like the date's missing.");
			return;
		}
		// Write appropriate functions to perform form validation...
		xmlhttp = new XMLHttpRequest();
		var value=encodeURIComponent(value_id);
		var date_value = encodeURIComponent(document.getElementById('date_tb').value);
		var parameters="param1=" + value + "&param2=" + date_value;
		xmlhttp.open("POST", 'semester_start.php', true);
     	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send(parameters);
		xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				alert(xmlhttp.responseText);
				string = "row_" + value_id;
				document.getElementById(string).innerHTML = "Active";
			}
		}
}

function midsem_start(row_id,number,status_open)
{
		xmlhttp = new XMLHttpRequest();
		var value1=encodeURIComponent(row_id);
		var value2=encodeURIComponent(number);
		var value3=encodeURIComponent(status_open);
		var parameters="param1="+value1 + "&param2="+value2 + "&param3=" + value3;
		xmlhttp.open("POST", "midsem_status.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send(parameters);
		xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState == 4) 
			{
				if(status_open==0)
				{
					//alert("The Mid Semester Examination has been Successfully Started.");
			        var elementid = "midsem_" + row_id + "_" + number;
					var midsem_js = "midsem_start(" + row_id + "," + number + "," + "1)";
					document.getElementById(elementid).innerHTML = "<div align=\"center\" class=\"style1\">" +
					"<div style=\"background-color:#FF4F53;color:#000000;\" onClick=" + midsem_js + ">Locked</div></div>";
				}
				else
				{
					//alert("The Mid Semester Examination has been Successfully Closed.");
					var midsem_js = "midsem_start(" + row_id + "," + number + "," + "0)";
			        var elementid = "midsem_" + row_id + "_" + number;
					document.getElementById(elementid).innerHTML = "<div align=\"center\" class=\"style1\">" 
					+"<div style=\"background-color:#9EEF7C;color:#000000;\" onClick=" + midsem_js + ">Unlocked</div></div>";
				}
			}
		}
}

function change_order()
{
		if(document.getElementById('date_tb').value == "")
		{
			alert("Looks like the date field is blank :)");
			return;
		}
		xmlhttp = new XMLHttpRequest();
		var value1=encodeURIComponent(document.getElementById('date_tb').value);
		var value2=encodeURIComponent(document.getElementById('select').value);
		var parameters="param1="+value1+"&param2="+value2;
		xmlhttp.open("POST", 'admin_dayorder_code.php', true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send(parameters);
		xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState == 4) 
			{
				var d=document.getElementById('date_tb').value;
				document.getElementById('changedlist').innerHTML=document.getElementById('changedlist').innerHTML+"<tr><td>"+d+"</td><td>"+d+"</td><td>"+d+"</td></tr>";
				alert(xmlhttp.responseText);
			}
		}
}