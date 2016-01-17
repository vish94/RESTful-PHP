<?php require_once('requires/header.php'); ?>
<?php
	if(!isset($_SESSION['admin'])) {
		Header("Location: ".$dir_site.'login/');
	}
?>

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

    $url = $apihost.'api/customers/';
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
    $customers = $result['data'];
?>
<div id="content">
	<h2> New Order</h2>
	<form method="POST" action="<?php echo $dir_site.'orders/'; ?>">
		<label for="textname"> Product Name </label><br/>
		<select name="product" id="textname">
			<?php
				foreach($products as $product) {
					echo '<option value="'.$product['id'].'">'.$product['name'].'</option>';
				}
			?>
		</select><br/><br/>
		<label for="textprice"> Customer Name </label><br/>
		<select name="customer" id="textprice">
			<?php
				foreach($customers as $customer) {
					echo '<option value="'.$customer['id'].'">'.$customer['name'].'</option>';
				}
			?>
		</select><br/><br/>
		<input type="submit" value="Submit" name="submit">
	</form>

</div>

<?php require_once('requires/footer.php'); ?>