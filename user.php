<?php
	
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	include('header.php');
	require_once('functions.php');
	$id = $_GET['id'];

?>

<?php
	
		$offset="offset 0";
		if(isset($_GET['page'])){
				$offset = 'offset '.(string) (( (int)($_GET['page'])-1 )*10);
			}
		$profile = getUserProfile($id);
		$logs = getUserLog($id,$offset);
		if ($profile['isCheckedIn'] == '0') {
			$currentStatus = "Out";
		}else{
			$currentStatus = "In";
		}
?>

<table>
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Mobile</th>
		<th>Last In</th>
		<th>Last Out</th>
		<th>Current Status</th>
	</tr>
	<tr>
		<td><?php echo $profile['id']; ?> </td>
		<td><?php echo $profile['name']; ?></td>
		<td><?php echo $profile['mobile']; ?> </td>
		<td><?php echo $profile['intime']; ?></td>
		<td><?php echo $profile['outtime']; ?> </td>
		<td><?php echo $currentStatus; ?></td>

</table>

<table>
	<tr>
		<th>ID</th>
		<th>Time</th>
		<th>Date</th>
		<th>InorOut</th>
	<tr>
		<?php foreach($logs as $log){ ?>
		<?php if($log['inORout']=='0') $inorout = "In";
		else $inorout = "Out"; 
		?>
		<td><?php echo $log['id']; ?></td>
		<td><?php echo substr($log['time'],11); ?></td>
		<td><?php echo substr($log['time'], 0,10); ?></td>
		<td><?php echo $inorout; ?></td>
	</tr>
	<?php } ?>

</table>


<?php 
			$totalLogs = countMysqlRows(array(
				'what' => 'count(*)',
				'table' => 'from histroy',
				'where' => "where id='".$id."'"
				));
			if($totalLogs%10 == 0)
			$totalPages = (int)($totalLogs/10);
			else $totalPages = (int)($totalLogs/10)+1;
		?>

		<?php
			if(isset($_GET['page'])){ 
				$nextUrl = '?id='.$id.'&page='.(string)((int)($_GET['page'])+1); 
				$previousUrl = '?id='.$id.'&page='.(string)((int)($_GET['page'])-1); 
			}

		?>
		<div class="pagination">
			<?php if($_GET['page']!='1') echo '<a href="'.$previousUrl.'">Previous</a>';?>
			<?php if($_GET['page']!=$totalPages) echo '<a href="'.$nextUrl.'">Next</a>';?>
		</div>

