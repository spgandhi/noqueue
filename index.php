<?php
	
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	session_start();
	if(!isset($_SESSION['username'])) header('location:login.php');
	
	include 'header.php';

	if(isset($_GET['status'])){
		if($_GET['status']=='checkin') echo 'Checked In';
		if($_GET['status']=='checkout') echo 'Checked Out';
		if($_GET['status']=='error') echo 'error';
	}
?>



<div class="in-out-form">
	<form method="POST" action="check.php">
		<input type="text" placeholder="ID" name="id" />
		<input type="submit" value="Submit" />
	</form>
</div>

