<?php
	//GET Query
	//GET all orders
	/*$result = file_get_contents(
    'http://localhost/rest/api/orders/', 
    false, 
    stream_context_create(array(
        'http' => array(
            'method' => 'GET',
            'ignore_errors' => true,
            )
        ))
    );
    $result = json_decode($result, true);
    print_r($result);
    /*if(!empty($result['data'])) {
	    foreach($result['data'] as $order) {
	    	echo $order['name'];
	    }
	}*/
?>

<?php
	//POST Query
	//POST a new entry into database
	/*$data = http_build_query(
    array(
        'id' => '1',
        'name' => 'iPhone'
    	)
	);
	$result = file_get_contents(
    'http://localhost/rest/api/', 
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
    print_r($result);

?>

<?php
	//GET specific order from database by ID
	$result = file_get_contents(
    'http://localhost/rest/api/orders', 
    false, 
    stream_context_create(array(
        'http' => array(
            'method' => 'GET',
            'ignore_errors' => true,
            )
        ))
    );
    $result = json_decode($result, true);
    print_r($result);


?>