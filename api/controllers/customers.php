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
		
		$customer = Customers::make($_POST['name']);
		if($customer->save())
			$response['data'] = "Saved";
		else
			$response['data'] = "Error";

	} elseif($method=="PUT") {
		parse_str(file_get_contents('php://input'), $data);
		$customer = Customers::find_by_id($data['id']);
		$customer->name = $data['name'];
		if($customer->save())
			$response['data'] = 1;
		else
			$response['data'] = 0;

	} elseif($method=="DELETE") {
		$ele = array_shift($uri);
		if($ele=="customers" && !empty($uri[0])) {
			if(ctype_digit($uri[0])) {
				$id = $uri[0];
				$customer = Customers::find_by_id($id);
				if(!empty($customer)) {
					$customer->delete();
					$response['data'] = "Successfully Deleted!";
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