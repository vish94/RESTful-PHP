<?php
    include('functions.php');
    //process client request (Via URL)
    
    if(!empty($_GET['name'])) {
        //process 
        $name = $_GET['name'];
        $price = get_price($name, $books);
        echo $price;
    } else{
        //throw error
    }
    
?>