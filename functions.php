<?php

	// require 'config.php';
    require_once 'MysqlRequest.php';

	function checkIn($id){

		$datein = date('Y/m/d G:i:s', time());

		$mysqlRequest = new MysqlRequest();

        $result = $mysqlRequest->update(array(
            'table' => 'main',
            'set' => "SET intime='$datein', isCheckedIn='1'",
            'where' => "where id='$id'"
            ));
        
        return $result;
	}

	function checkOut($id){
		$dateout = date('Y/m/d G:i:s', time());

        $mysqlRequest = new MysqlRequest();

        $result = $mysqlRequest->update(array(
            'table' => 'main',
            'set' => "SET outtime='$dateout', isCheckedIn='0'",
            'where' => "where id='$id'"
            ));

        if(!$result) echo "Sorry. Error in checkout";
        
        // print_r($result);
        return $result;
       
	}


	function isCheckedIn($id){

        $mysqlRequest = new MysqlRequest();

        $result = $mysqlRequest->select(array(
            'what' => "*",
            'table' => 'from main',
            'where' => "where id='$id'"
            ));

    	// $result = $mysqli->query("SELECT isCheckedIn From main where id = '$id'");      	
    	if($result){
            $rows = $result->num_rows;
        	$profile = mysqli_fetch_array($result);
            if($profile['isCheckedIn'] == true) return true;
            else return false;
        }

        return false;
    }

    function history($id, $what){
        // 
        $date = date('Y/m/d G:i:s', time());
        $mysqlRequest = new MysqlRequest();

        $result = $mysqlRequest->insert(array(
            'into' => 'into histroy',
            'set' => "(id, time, inORout) values('$id', '$date', '$what')",
            ));

    }

    function userExist($id){

        $mysqlRequest = new MysqlRequest();
        $result = $mysqlRequest->select(array(
            'what' => '*',
            'table' => 'from main',
            'where' => "where id = '$id'"
            ));

        if($result->num_rows != 0) return true;
        else return false;
    }


    function countMysqlRows($array){
        $mysqlRequest = new MysqlRequest();
        $result = $mysqlRequest->select($array);
        $row = $result->fetch_row();
        
        return $row[0];

    }

    function getUserProfile($id){
        $mysqlRequest = new MysqlRequest();
        $result = $mysqlRequest->select(array(
            'what' => '*',
            'table' => 'from main',
            'where' => "where id = '$id'"
            ));

        return $result->fetch_array(MYSQLI_ASSOC);
    }

    function getUserLog($id,$offset){
        $mysqlRequest = new MysqlRequest();
        $result = $mysqlRequest->select(array(
            'what' => '*',
            'table' => 'from histroy',
            'where' => "where id = '$id'",
            'limit' => 'limit 10',
            'offset' => $offset
            ));

        return $result;
    }

    function userAuth($username, $password){
        $mysqlRequest = new MysqlRequest();
        $result = $mysqlRequest->select(array(
            'what' => '*',
            'table' => 'from admin',
            'where' => "where username ='".$username."' and password ='".$password."'"
            ));
        // print_r($result);
        return $result;
    }

    function getUserCustomLog($id, $from, $to){
        $mysqlRequest = new MysqlRequest();
        $result = $mysqlRequest->select(array(
            'what' => '*',
            'table' => 'from histroy',
            'where' => "where id='".$id."' and time>='".$from."' and time<='".$to."'"
            ));
        // print_r($result);
        return $result;
    }