<?php
    $method = $_SERVER['REQUEST_METHOD'];
    $response['method'] = $method;
    echo json_encode($response);
?>