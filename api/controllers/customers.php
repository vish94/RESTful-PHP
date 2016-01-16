<?php
	if($method=="GET") {
		if(empty($uri)) {

		} else {
			$ele = array_shift($uri);
			if($ele=="customers" && (empty($uri) || empty($uri[0]))) {
				$customers = Customers::find_all();
				$response['data'] = $customers;
			} else {
				$id = array_shift($uri);
				if(ctype_digit($id) && (empty($uri) || empty($uri[0]))) {
					$customer = Customers::find_by_id($id);
					if(empty($customer)) {
						$response['data'] = "Not found";
						$response['status'] = 404;
					} else
						$response['data'] = $customer;
				} 
			}

		}

	} elseif($method=="POST") {
		
		$customer = Costumers::make($_POST['name']);
		$customer->save();
		$response['data'] = "Saved";

	} elseif($method=="PUT") {

	} elseif($method=="DELETE") {
		$ele = array_shift($uri);
		if($ele=="customers" && !empty($uri[0])) {
			if(ctype_digit($uri[0])) {
				$id = $uri[0];
				$customer = Costumers::find_by_id($id);
				if(!empty($customer)) {
					$customer->delete();
					$response['data'] = $customer;
					unset($customer);
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