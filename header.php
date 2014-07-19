<html>
<head>
	<title>DAIICT Register</title>
</head>
<body>
	<div class="header">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="log.php">Log</a></li>

			<?php if(isset($_SESSION['username'])) echo '<li><a href="logout.php">Logout</a></li>'; ?>
		</ul>
	</div>


