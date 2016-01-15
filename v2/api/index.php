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
	if($method=="GET") {
		if(empty($uri)) {

		} else {
			$ele = array_shift($uri);
			if($ele=="orders") {
				$orders = Myorders::find_all();
				$response['data'] = $orders;
			}

		}

	} elseif($method=="POST") {
		$data = $_POST['content'];
		echo $data;

	} elseif($method=="PUT") {

	} elseif($method=="DELETE") {

	} else {
		$response['data'] = "Invalid Method";
		$response['status'] = 404;
	}
	//echo json_encode($response);
?>