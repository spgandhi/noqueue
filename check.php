<?php

	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	require_once 'functions.php';

	if(userExist($_POST['id'])){

		if(!isCheckedIn($_POST['id'])){
			$result = checkIn($_POST['id']);
			if(!$result){
				header("location: index.php?status=error");
			}else{
				history($_POST['id'],0);
				header("location: index.php?status=checkin");
			}
		}
			
		else {
			$result = checkOut($_POST['id']);
			if(!$result){
				 header("location: index.php?status=error");
			}else{
				history($_POST['id'],1);
				header("location: index.php?status=checkout");
			}
		}
	}else{
		header('location: index.php?status=error');
	}
?>

	