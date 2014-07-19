<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	require_once('calendar/classes/tc_calendar.php');
	require_once('functions.php');

	if(isset($_GET['id'])){
		$from = isset($_REQUEST["date3"]) ? $_REQUEST["date3"] : ""; 
		$to = isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "";
		$result = getUserCustomLog($_GET['id'], $from, $to);

	}
?>

	


<html>
<head>
	<link href="calendar/calendar.css" rel="stylesheet" type="text/css" />
	<script language="javascript" src="calendar/calendar.js"></script>
</head>
<body>
<form action"search.php" method="GET">
	<table>
		<tr>
			<td>
				<input type="text" placeholder="id" name="id" />
			</td>
		</tr>
		<tr>
			<td>

				<?php
					$date3_default = date('Y/m/d', time());
			      $date4_default = date('Y/m/d', time());

				  $myCalendar = new tc_calendar("date3", true, false);
				  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
				  $myCalendar->setDate(date('d', strtotime($date3_default))
			            , date('m', strtotime($date3_default))
			            , date('Y', strtotime($date3_default)));
				  $myCalendar->setPath("calendar/");
				  $myCalendar->setYearInterval(2013, 2020);
				  $myCalendar->setAlignment('left', 'bottom');
				  $myCalendar->setDatePair('date3', 'date4', $date4_default);
				  $myCalendar->writeScript();	  
				  
				  echo "   TO   ";
				  $myCalendar = new tc_calendar("date4", true, false);
				  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
				  $myCalendar->setDate(date('d', strtotime($date4_default))
			           , date('m', strtotime($date4_default))
			           , date('Y', strtotime($date4_default)));
				  $myCalendar->setPath("calendar/");
				  $myCalendar->setYearInterval(1970, 2020);
				  $myCalendar->setAlignment('left', 'bottom');
				  $myCalendar->setDatePair('date3', 'date4', $date3_default);
				  $myCalendar->writeScript();	  
				?>
			</td>
		</tr>
		<tr>
			<td><input type="submit" />
			</td>
		</tr>
	</table>
</form>


	<div class="log">
	<table>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Mobile</th>
			<th>In/Out</th>
			<th>Time</th>
			<th>Date</th>
		</tr>
		<?php 
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$url = 'user.php?id='.$row['id'].'&page=1';
		?>
		<tr>
			<td><?php echo '<a href="'.$url.'">'.$row['id'].'</a>'; ?></td>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['mobile']; ?></td>
			<td><?php echo $row['inORout']; ?></td>
			<td><?php echo substr($row['time'],11); ?></td>
			<td><?php echo substr($row['time'], 0,10); ?></td>
			
		</tr>
				<?php 	} 
		?>
	</table>

</body>
</html>
