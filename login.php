<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	session_start();
	require_once('functions.php');

	if(isset($_POST['username']) || isset($_POST['password'])){
		if($_POST['username']=="" || $_POST['password']==""){
			echo "Either password or username is blank";
		}

		$user = userAuth($_POST['username'], $_POST['password']);
		
		if($user->num_rows == 1){
			
			
			$profile = $user->fetch_array(MYSQLI_ASSOC);
			$_SESSION['username'] = $profile['username'];
			// print_r($profile);
			// echo $_SESSION['username'];
			header('location: index.php');
		}
		echo "hello";
	}
?>
<form action="login.php" method="POST">
	<table>
		<tr>
			<input type="text" name="username" placeholder="username" />
		</tr>
		<tr>
			<input type="password" name="password" placeholder="password" />
		</tr>
		<tr>
			<input type="submit" value="submit" />
		</tr>
	</table>
</form>