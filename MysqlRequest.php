<?php
	
	require 'config.php'; 
	date_default_timezone_set('Asia/Kolkata');
	Class MysqlRequest{

		function select($array){
			$con = $this->connect();

			$queryExtras = "";

			if(array_key_exists('what', $array))
				$queryExtras = $queryExtras.' '.$array['what'];

			if(array_key_exists('table', $array))
				$queryExtras = $queryExtras.' '.$array['table'];

			if(array_key_exists('where', $array))
				$queryExtras = $queryExtras.' '.$array['where'];

			if(array_key_exists('group_by', $array))
				$queryExtras = $queryExtras.' '.$array['group_by'];

			if(array_key_exists('limit', $array))
				$queryExtras = $queryExtras.' '.$array['limit'];

			if(array_key_exists('offset', $array))
				$queryExtras = $queryExtras.' '.$array['offset'];

			$query = "Select".$queryExtras;
			// echo $query;

			$mysqli = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
			$result = $mysqli->query($query);

			if(!$result) echo mysqli_error($con).'<br>';

			// print_r($result);

			return $result;

		}	

		function insert($array){

			$con = $this->connect();

			$queryExtras = "";

			if(array_key_exists('into', $array))
				$queryExtras = $queryExtras.' '.$array['into'];

			if(array_key_exists('set', $array))
				$queryExtras = $queryExtras.' '.$array['set'];

			$query = "Insert".$queryExtras;

			$result = mysqli_query($con, $query);
			if(!$result) echo mysqli_error($con).'<br>';


			return $result;

		}

		function update($array){

			$con = $this->connect();

			$queryExtras = "";

			if(array_key_exists('table', $array))
				$queryExtras = $queryExtras.' '.$array['table'];

			if(array_key_exists('set', $array))
				$queryExtras = $queryExtras.' '.$array['set'];

			if(array_key_exists('where', $array))
				$queryExtras = $queryExtras.' '.$array['where'];

			$query = "update".$queryExtras;
			

			$result = mysqli_query($con, $query);

			if(!$result) echo mysqli_error($con).'<br>';

			return $result;

		}

		function connect(){

			$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

			if (mysqli_connect_errno()) {
    			printf("Connect failed: %s\n", mysqli_connect_error());
    			exit();
    		}

    		return $con;
		}
	}
	