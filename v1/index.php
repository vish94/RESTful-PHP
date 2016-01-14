<?php
    include('functions.php');
    //process client request (Via URL)
    header("Content-Type:application/json");
    if(!empty($_GET['name'])) {
        //process 
        $name = $_GET['name'];
        $price = get_price($name, $books);
        
        if(empty($price)) {
            //book not found
        } else {
            //respond with price
        }
    } else{
        //throw error
    }
    
    function deliver_response($status, $status_message, $data) {
        header('HTTP/1.1'. $status.' '.$status_message);
        $response['status'] = $status;
        $response['status_message'] = $status_message;
        $response['data'] = $data;
        $json_response = jason_encode($response);
        echo $json_response;
    }
    
?>