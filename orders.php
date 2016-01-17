<?php require_once('requires/header.php'); ?>
<?php
	if(!isset($_SESSION['admin'])) {
		Header("Location: ".$dir_site.'login/');
	}
?>
<?php
	if(isset($_GET['action'])) {										// API Call to delete an order
		if($_GET['action']=="delete" && ctype_digit($_GET['id'])) {
			$id = $_GET['id'];
			$delurl = $apihost.'api/orders/'.$id;
			$delmethod = "DELETE";
			$delresult = file_get_contents($delurl, false, 
		    stream_context_create(array(
		        'http' => array(
		            'method' => $delmethod,
		            'ignore_errors' => true,
		            )
		        ))
	    	);
    		$delresult = json_decode($delresult, true);
		}
	} elseif(isset($_POST['submit'])) {									// API Call to create a new order
		$data = http_build_query(
	    array(
	        'customer_id' => $_POST['customer'],
	        'product_id' => $_POST['product']
	    	)
		);
		$delmethod = "POST";
		$delurl = 'http://localhost/rest/api/orders/';
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
	    $delresult = json_decode($delresult, true);
	}
	$url = $apihost.'api/customers/';									// API Call to retrieve all customers for dropdown menu
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

    if(isset($_GET['custsubmit'])) {									//API Call to get orders by customer id
    	$url = $apihost.'api/orders/customer/'.$_GET['customer'];
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
	    $orders = $result['data'];
    } else {															//API Call to get all orders
		$url = $apihost.'api/orders/';
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
	    $orders = $result['data'];
	}
?>
<div id="content">
	<h2> <?php if(isset($_GET['custsubmit'])) echo find_customer_name($_GET['customer'], $apihost); ?> Orders</h2>

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

	<form action="<?php echo $dir_site.'orders/'?>" method="GET">
		<label for="textprice"> Show specific customer's orders </label><br/>
		<select name="customer" id="textprice">
			<?php
				foreach($customers as $customer) {
					echo '<option value="'.$customer['id'].'">'.$customer['name'].'</option>';
				}
			?>
		</select><br/><br/>
		<input type="submit" value="Submit" name="custsubmit">
	</form>
	<table>
	<th>Sno.</th>
	<th>Order ID</th>
	<th>Customer Name</th>
	<th>Product Name</th>
	<th>Actions </th>
	<?php
		$i=1;

		foreach($orders as $order) {
			echo '<tr>';
			echo '<td>'.$i.'</td>';
			echo '<td>'.$order['id'].'</td>';
			echo '<td>'.find_customer_name($order['customer_id'], $apihost).'</td>';	//functions defined in requires/functions.php
			echo '<td>'.find_product_name($order['product_id'], $apihost).'</td>';
			echo '<td><a href="'.$dir_site.'orders/?action=delete&id='.$order['id'].'"> Delete </a></td>';
			echo '</tr>';
			$i++;
		}
	?>
	</table>

</div>

<?php require_once('requires/footer.php'); ?>