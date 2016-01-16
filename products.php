<?php require_once('requires/header.php'); ?>
<?php
	$url = $apihost.'api/products/';
	$method = 'GET';
	$result = file_get_contents($url, false, 
	    stream_context_create(array(
	        'http' => array(
	            'method' => $method,
	            'ignore_errors' => true,
	            )
	        ))
	    );
    $result = json_decode($result, true);
    $products = $result['data'];

?>
<div id="content">
	<h2> All Products</h2>
	<?php echo '<b> API Call: '.$url.'</b><br/>'; ?>
	<?php echo '<b> Method: '.$method.'</b><br/>'; ?>
	<?php echo '<i> API Response: '; print_r($result); echo '</i><br/><br/><hr>'; ?>

	<table>
	<th>Sno.</th>
	<th>Product ID</th>
	<th>Product Name</th>
	<th>Price</th>
	<th>Actions</th>
	<?php
		$i=1;

		foreach($products as $product) {
			echo '<tr>';
			echo '<td>'.$i.'</td>';
			echo '<td>'.$product['id'].'</td>';
			echo '<td>'.$product['name'].'</td>';
			echo '<td>'.$product['price'].'</td>';
			echo '<td><a href="'.$dir_site.'products/edit/'.$product['id'].'">Edit</a></td>';
			echo '</tr>';
			$i++;
		}
	?>
	</table>

</div>

<?php require_once('requires/footer.php'); ?>