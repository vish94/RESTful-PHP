<?php require_once('requires/header.php'); ?>
<?php
	if(!isset($_SESSION['admin'])) {
		Header("Location: ".$dir_site.'login/');
	}
?>
<?php
	if(isset($_POST['submit'])) {					//API Call to edit a customer
		$id = $_GET['id'];
		$data = http_build_query(array(
	        'id' => $id,
	        'name' => $_POST['name']
	    	)
		);
		$editurl = $apihost.'api/customers/';
		$editmethod = 'PUT';
		$saveresult = file_get_contents($editurl, false, 
		    stream_context_create(array(
		        'http' => array(
		            'method' => $editmethod,
		            'ignore_errors' => true,
		            'header' => 'Content-type: application/x-www-form-urlencoded',
            		'content' => $data
		            )
		        ))
		    );
	    $saveresult = json_decode($saveresult, true);
	}
	if(isset($_GET['id'])) {						//API Call to get details of current customer
		$id = $_GET['id'];
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
	}
	

?>
<div id="content">
	<h2> Edit Customer</h2>
	<?php 
		if(isset($saveresult)) {
			echo '<b> API Call: '.$editurl.'</b><br/>';
			echo '<b> Method: '.$editmethod.'</b><br/>';
			echo '<i> API Response: '; print_r($saveresult); echo '</i><br/><br/><hr>';
		}

	?>
	<?php echo '<b> API Call: '.$url.'</b><br/>'; ?>
	<?php echo '<b> Method: '.$method.'</b><br/>'; ?>
	<?php echo '<i> API Response: '; print_r($result); echo '</i><br/><br/><hr>'; ?>
	<form method="POST" action="<?php echo $dir_site.'customers/edit/'.$id.'/'; ?>">
		<label for="textname"> Customer Name </label><br/>
		<input type="text" name="name" id="textname" value='<?php echo $customer['name'] ?>'><br/><br/>

		<input type="submit" value="Submit" name="submit">

</div>

<?php require_once('requires/footer.php'); ?>