<?php
	function find_customer_name($id, $apihost) {
		$url = $apihost.'api/customers/'.$id;
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
	    $customer = $result['data'];
	    return $customer['name'];
	}

	function find_product_name($id, $apihost) {
		$url = $apihost.'api/products/'.$id;
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
	    $product = $result['data'];
	    return $product['name'];

	}

	function count_orders_by_customer_id($id, $apihost) {
		$url = $apihost.'api/orders/customer/'.$id;
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
	    return $result['count'];
	}

?>