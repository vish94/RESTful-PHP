<?php
	$data = array("1"=>"name");
	$data = json_encode($data);
	$result = file_get_contents(
    'http://localhost/rest/api', 
    false, 
    stream_context_create(array(
        'http' => array(
            'method' => 'POST',
            'ignore_errors' => true,
            'header' => 'Content-Type: application/json',
            'content' => $data
            )
        ))
    );
    $result = json_decode($result, true);
    echo $result;
    /*if(!empty($result['data'])) {
	    foreach($result['data'] as $order) {
	    	echo $order['name'];
	    }
	}*/
?>