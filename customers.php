<?php require_once('requires/header.php'); ?>
<?php

	if(isset($_GET['action'])) {
		if($_GET['action']=="delete" && ctype_digit($_GET['id'])) {
			$id = $_GET['id'];
			$delurl = $apihost.'api/customers/'.$id;
			$delmethod = "DELETE";
			$delresult = file_get_contents($delurl, false, 
		    stream_context_create(array(
		        'http' => array(
		            'method' => $delmethod,
		            'ignore_errors' => true,
		            )
		        ))
	    	);
    		$delresult = json_decode($delresult, true);
		}
	}
	$url = $apihost.'api/customers/';
	$method = 'GET';
	if(isset($_GET['action'])) {
		if($_GET['action']=="show") {
			$id = $_GET['id'];
			$url = $url.$id;
			$method = "GET";
		}
	}
	$result = file_get_contents($url, false, 
	    stream_context_create(array(
	        'http' => array(
	            'method' => $method,
	            'ignore_errors' => true,
	            )
	        ))
	    );
    $result = json_decode($result, true);
    $customers = $result['data'];

?>
<div id="content">
	<h2> All customers</h2>

	<?php 
		if(isset($delresult)) {
			echo '<b> API Call: '.$delurl.'</b><br/>';
			echo '<b> Method: '.$delmethod.'</b><br/>';
			echo '<i> API Response: '; print_r($delresult); echo '</i><br/><br/><hr>';
		}

	?>
	<?php echo '<b> API Call: '.$url.'</b><br/>'; ?>
	<?php echo '<b> Method: '.$method.'</b><br/>'; ?>
	<?php echo '<i> API Response: '; print_r($result); echo '</i><br/><br/><hr>'; ?>

	<table>
	<th>Sno.</th>
	<th>Customer ID</th>
	<th>Customer Name</th>
	<th>Actions</th>
	<?php
		$i=1;

		foreach($customers as $customer) {
			echo '<tr>';
			echo '<td>'.$i.'</td>';
			echo '<td>'.$customer['id'].'</td>';
			echo '<td>'.$customer['name'].'</td>';
			echo '<td><a href="'.$dir_site.'customers/edit/'.$customer['id'].'">Edit</a> <a href="'.$dir_site.'customers/?action=delete&id='.$customer['id'].'"> Delete </a></td>';
			echo '</tr>';
			$i++;
		}
	?>
	</table>

</div>

<?php require_once('requires/footer.php'); ?>