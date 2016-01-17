<?php require_once('requires/header.php'); ?>

<?php
	if(isset($_POST['submit'])) {
		$data = http_build_query(
	    array(
	        'username' => $_POST['username'],
	        'password' => $_POST['password']
	    	)
		);
		$result = file_get_contents(
	    'http://localhost/rest/api/login/', 
	    false, 
	    stream_context_create(array(
	        'http' => array(
	            'method' => 'POST',
	            'ignore_errors' => true,
	            'header' => 'Content-type: application/x-www-form-urlencoded',
	            'content' => $data
	            )
	        ))
	    );
	    $result = json_decode($result, true);
	    if($result['data']==1) {
	    	$_SESSION['admin'] = 1;
	    	header("Location: ".$dir_site);
	    } else {
	    	$error = "Invalid Username and Password!";
	    }
	}
?>

<div id="content">
	<h2> Login</h2>
	<?php
		if(isset($error)) {
			echo $error.'<br/>';
			print_r($result);
		}
	?>
	<form method="POST" action="<?php echo $dir_site.'login/'; ?>">
		<label for="textname"> Username </label><br/>
		<input type="text" name="username" id="textname"><br/><br/>
		<label for="textprice"> Password </label><br/>
		<input type="password" name="password" id="textprice"><br/><br/>

		<input type="submit" value="Submit" name="submit">
	</form>

</div>

<?php require_once('requires/footer.php'); ?>