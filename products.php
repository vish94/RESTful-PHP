<?php require_once('requires/header.php'); ?>
<?php
	if(!isset($_SESSION['admin'])) {
		Header("Location: ".$dir_site.'login/');
	}
?>
<?php

	if(isset($_GET['action'])) {												//API Call to delete a product
		if($_GET['action']=="delete" && ctype_digit($_GET['id'])) {
			$id = $_GET['id'];
			$delurl = $apihost.'api/products/'.$id;
			$delmethod = "DELETE";
			$delresult = file_get_contents($delurl, false, 
		    stream_context_create(array(
		        'http' => array(
		            'method' => $delmethod,
		            'ignore_errors' => true,
		            )
		        ))
	    	);
    		$delresult = json_decode($delresult, true);							////
		}
	} elseif(isset($_POST['submit'])) {											//API Call to add a new product
		$data = http_build_query(
	    array(
	        'name' => $_POST['name'],
	        'price' => $_POST['price']
	    	)
		);
		$delmethod = "POST";
		$delurl = 'http://localhost/rest/api/products/';
		$delresult = file_get_contents(
	    $delurl, 
	    false, 
	    stream_context_create(array(
	        'http' => array(
	            'method' => $delmethod,
	            'ignore_errors' => true,
	            'header' => 'Content-type: application/x-www-form-urlencoded',
	            'content' => $data
	            )
	        ))
	    );
	    $delresult = json_decode($delresult, true);								////
	}
	$url = $apihost.'api/products/';											//API Call to retrieve all products
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

	<?php 
		if(isset($delresult)) {
			echo '<b> API Call: '.$delurl.'</b><br/>';
			echo '<b> Method: '.$delmethod.'</b><br/>';
			echo '<i> API Response: '; print_r($delresult); echo '</i><br/><br/><hr>';
		}

	?>
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
			echo '<td><a href="'.$dir_site.'products/edit/'.$product['id'].'">Edit</a><a href="'.$dir_site.'products/?action=delete&id='.$product['id'].'"> Delete </a></td>';
			echo '</tr>';
			$i++;
		}
	?>
	</table>

</div>

<?php require_once('requires/footer.php'); ?>