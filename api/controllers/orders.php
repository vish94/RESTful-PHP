<?php
	if($method=="GET") {
		if(empty($uri)) {

		} else {
			$ele = array_shift($uri);
			if($ele=="orders" && (empty($uri) || empty($uri[0]))) {
				$orders = Orders::find_all();
				$response['data'] = $orders;
			} else {
				$ele = array_shift($uri);
				if($ele=="customer" && ctype_digit($uri[0])) {
					$customer_id = $uri[0];
					$response['data'] = Orders::find_by_customer_id($customer_id);
					$response['count'] = Orders::count_by_customer_id($customer_id);
				}
			}

		}

	} elseif($method=="POST") {
		$ele = array_shift($uri);
		if(empty($uri) || empty($uri[0])) {
			$order = Orders::make($_POST['customer_id'], $_POST['product_id']);
			$order->save();
			$response['data'] = "Saved";
		} 

	} elseif($method=="PUT") {

	} elseif($method=="DELETE") {
		$ele = array_shift($uri);
		if($ele=="orders" && !empty($uri[0])) {
			if(ctype_digit($uri[0])) {
				$id = $uri[0];
				$order = Orders::find_by_id($id);
				if(!empty($order)) {
					$order->delete();
					$response['data'] = "Successfully Deleted!";
					unset($order);
				} else {
					$response['data'] = "Not found";
					$response['status'] = 404;
				}
			}
		}

	} else {
		$response['data'] = "Invalid Method";
		$response['status'] = 404;
	}
?>