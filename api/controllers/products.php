<?php
	if($method=="GET") {
		if(empty($uri)) {

		} else {
			$ele = array_shift($uri);
			if($ele=="products" && (empty($uri) || empty($uri[0]))) {
				$products = Products::find_all();
				$response['data'] = $products;
			} else {
				$id = array_shift($uri);
				if(ctype_digit($id) && (empty($uri) || empty($uri[0]))) {
					$product = Products::find_by_id($id);
					if(empty($product)) {
						$response['data'] = "Not found";
						$response['status'] = 404;
					} else
						$response['data'] = $product;
				} 
			}

		}

	} elseif($method=="POST") {
		
		$product = Products::make($_POST['name'], $_POST['price']);
		$product->save();
		$response['data'] = "Saved";

	} elseif($method=="PUT") {
		parse_str(file_get_contents('php://input'), $data);
		$product = Products::find_by_id($data['id']);
		$product->name = $data['name'];
		$product->price = $data['price'];
		if($product->save())
			$response['data'] = 1;
		else
			$response['data'] = 0;
	} elseif($method=="DELETE") {
		$ele = array_shift($uri);
		if($ele=="products" && !empty($uri[0])) {
			if(ctype_digit($uri[0])) {
				$id = $uri[0];
				$product = Products::find_by_id($id);
				if(!empty($product)) {
					$product->delete();
					$response['data'] = $product;
					unset($product);
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