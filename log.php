<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	
	if(!isset($_GET['page'])) header('location: ?page=1');
	include 'header.php';
	require_once 'functions.php';
	require_once 'MysqlRequest.php';
?>
<?php

			if(isset($_GET['page'])){
				$offset = 'offset '.(string) (( (int)($_GET['page'])-1 )*10);
			}
			// $offset='0';

			$mysqlRequest = new MysqlRequest();
			$result = $mysqlRequest->select(array(
				'what' => '*',
				'table' => ' from histroy',
				'limit' => 'limit 10',
				'offset' => $offset
				));
		?>		
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
			while($row = mysqli_fetch_array($result)){
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
</div>


		<?php 
			$totalLogs = countMysqlRows(array(
				'what' => 'count(*)',
				'table' => 'from histroy'
				));
			
			if($totalLogs%10 == 0)
			$totalPages = (int)($totalLogs/10);
			else $totalPages = (int)($totalLogs/10)+1;
		?>

		<?php
			if(isset($_GET['page'])){ 
				$nextUrl = '?page='.(string)((int)($_GET['page'])+1); 
				$previousUrl = '?page='.(string)((int)($_GET['page'])-1); 
			}

		?>
		<div class="pagination">
			<?php if($_GET['page']!='1') echo '<a href="'.$previousUrl.'">Previous</a>';?>
			<?php if($_GET['page']!=$totalPages) echo '<a href="'.$nextUrl.'">Next</a>';?>
		</div>

