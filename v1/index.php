<?php
    if(isset($_POST['submit'])) {
        $name = $_POST['bookname'];
        $response = file_get_contents('https://restful-php-vish94.c9users.io/RESTful-PHP/v1/server.php?name='.$name);
        $response = json_decode($response);
        echo "Status: ".$response['status'].'<br/>';
        echo "Message: ".$response['status_message'].'<br/>';
        echo "Price: ".$response['data'].'<br/>';
    }
?>

<html>
    <body>
        <form action="index.php" method="POST">
            <input name="bookname" type="text"></input>
            <input type="submit" value="Submit" name="submit"></input>
        </form>
        <i>Hints: php, java, c</i>
    </body>
</html>