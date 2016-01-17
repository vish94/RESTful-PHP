<?php require_once('requires/header.php'); ?>
<?php
	if(!isset($_SESSION['admin'])) {
		Header("Location: ".$dir_site.'login/');
	}
?>

<?php
	if(isset($_POST['submit'])) {										// API Call to search for product by name
		$name = $_POST['name'];
		$data = http_build_query(array(
	        'name' => $_POST['name']
	    	)
		);
		$url = $apihost.'api/products/search/';
		$method = 'POST';
		$result = file_get_contents($url, false, 
		    stream_context_create(array(
		        'http' => array(
		            'method' => $method,
		            'ignore_errors' => true,
		            'header' => 'Content-type: application/x-www-form-urlencoded',
            		'content' => $data
		            )
		        ))
		    );
	    $result = json_decode($result, true);							////
	}
?>
<div id="content">
	<h2> Search Product</h2>
	<?php 
		if(isset($result)) {
			echo '<b> API Call: '.$url.'</b><br/>';
			echo '<b> Method: '.$method.'</b><br/>';
			echo '<i> API Response: '; print_r($result); echo '</i><br/><br/><hr>';
		}

	?>
	<form method="POST" action="<?php echo $dir_site.'products/search/'; ?>">
		<label for="textname"> Product Name </label><br/>
		<input type="text" name="name" id="textname"><br/><br/>

		<input type="submit" value="Submit" name="submit">
	</form>

	<table>
	<th>Sno.</th>
	<th>Product ID</th>
	<th>Product Name</th>
	<th>Price</th>
	<th>Actions</th>
	<?php
		$i=1;
		if(isset($result)) {
			foreach($result['data'] as $product) {
				echo '<tr>';
				echo '<td>'.$i.'</td>';
				echo '<td>'.$product['id'].'</td>';
				echo '<td>'.$product['name'].'</td>';
				echo '<td>'.$product['price'].'</td>';
				echo '<td><a href="'.$dir_site.'products/edit/'.$product['id'].'">Edit</a><a href="'.$dir_site.'products/?action=delete&id='.$product['id'].'"> Delete </a></td>';
				echo '</tr>';
				$i++;
			}
		}
	?>
	</table>
</div>

<?php require_once('requires/footer.php'); ?>