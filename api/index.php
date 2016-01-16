<?php
	include('initialize.php');
	$method = $_SERVER['REQUEST_METHOD'];
	$response['status'] = 200;
	$response['method'] = $method;
	$uri = $_SERVER['REQUEST_URI'];
	$uri = explode('/', $uri);
	for($i=0; $i<=2; $i++) {
		$ele = array_shift($uri);
	}
	
	if($uri[0] == "products") {
		require_once('controllers/products.php');
	} elseif($uri[0] == "customers") {
		require_once('controllers/customers.php');
	} else {
		$response['data'] = "Invalid Request";
	}
	echo json_encode($response);
?>