<?php
	if($method=="POST") {
		$username = trim($_POST['username']);
		$password = sha1(trim($_POST['password']));
		$user = User::authenticate($username, $password);
		if($user) {
			$response['data'] = 1;
		} else
			$response['data'] = 0;
		$response['username'] = $username;
		$response['password'] = $password;

	} else {
		$response['data'] = "Invalid Method";
		$response['status'] = 404;
	}
?>