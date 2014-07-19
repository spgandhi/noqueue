<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	require_once('functions.php');

	if(isset($_POST['id'])){
		if ($_POST['type']=='default') 
			echo "Please select One of the select option";
		else if($_POST['type'] == '0' && $_POST['max-entry']=="")
			echo "Please choose max entry";
		else if($_POST['type'] == '1' && ($_POST['time_from'] == "" || $_POST['time_to'] == ""))
			echo "Please choose the dates";
		else addRedAlert();
	}


?>

<form method="POST" action="custom_red_alert.php">
	<table>
		<tr>
			<td><input type="text" placeholder="ID" name="id"/></td>
		</tr>
		<tr>
			<td>
				<select id="type" name="type">
					<option value="default">Select Type</option>
					<option value="0">Max Entry</option>
					<option value="1">Entry/Exit between specific time</option>
				</select>
			</td>
		</tr>
		<tr id="max-entry" style="display:none">
			<td>
				<input type="text" placeholder="max-entry" name="max-entry"/>
			</td>
		</tr>
		<tr id="time_from" style="display:none">
			<td>
				<input type="text" placeholder="from" name="time_from" />
			</td>
		</tr>
		<tr id="time_to" style="display:none">
			<td>
				<input type="text" placeholder="to" name="time_to" />
			</td>
		</tr>
		<tr>
			<td>
				<input type="submit" value="submit" />
	</table>
</form>

<script>
	var card = document.getElementById("type");
    
    card.onchange = function(){
    	var value = card.value;

    	if(value==0){
    		// $('#max-entry').css({
    		// 	dislay: 'inherit'
    		// 	});
		document.getElementById('max-entry').style.display = 'inherit';
		document.getElementById('time_from').style.display = 'none';
    		document.getElementById('time_to').style.display = 'none';
    	}

    	if(value==1){
    		document.getElementById('time_from').style.display = 'inherit';
    		document.getElementById('time_to').style.display = 'inherit';
    		document.getElementById('max-entry').style.display = 'none';
    	}

    	if(value=='default'){
    		document.getElementById('time_from').style.display = 'none';
    		document.getElementById('time_to').style.display = 'none';
    		document.getElementById('max-entry').style.display = 'none';
    	}
    }	

    
 </script>