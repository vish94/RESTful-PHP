<?php
    $result = file_get_contents(
    'https://restful-php-vish94.c9users.io/RESTful-PHP/v2/server.php', 
    false, 
    stream_context_create(array(
        'http' => array(
            'method' => 'GET','ignore_errors' => true
            )
        ))
    );
    $result = json_decode($result, true);
    echo $result['method'];
?>