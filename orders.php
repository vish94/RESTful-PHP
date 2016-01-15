<?php require_once('requires/header.php'); ?>
<?php
	$url = 'http://localhost/rest/api/orders/';
	$method = 'GET';
	if(isset($_GET['action'])) {
		if($_GET['action']=="show") {
			$id = $_GET['id'];
			$url = $url.$id;
			$method = "GET";
		}
	}
	$result = file_get_contents($url, false, 
	    stream_context_create(array(
	        'http' => array(
	            'method' => $method,
	            'ignore_errors' => true,
	            )
	        ))
	    );
    $result = json_decode($result, true);
    $orders = $result['data'];

?>
<div id="content">
	<h2> All Orders</h2>
	<?php echo '<b> API Call: '.$url.'</b><br/>'; ?>
	<?php echo '<b> Method: '.$method.'</b><br/>'; ?>
	<?php echo '<i> API Response: '; print_r($result); echo '</i><br/><br/><hr>'; ?>

	<table>
	<th>Sno.</th>
	<th>Order ID</th>
	<th>Order Name</th>
	<th>Actions</th>
	<?php
		$i=1;

		foreach($orders as $order) {
			echo '<tr>';
			echo '<td>'.$i.'</td>';
			echo '<td>'.$order['id'].'</td>';
			echo '<td>'.$order['name'].'</td>';
			echo '<td><a href="orders.php?action=show&id='.$order['id'].'">Show</a></td>';
			echo '</tr>';
			$i++;
		}
	?>
	</table>

</div>

<?php require_once('requires/footer.php'); ?>