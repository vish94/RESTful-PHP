<?php
	
	$xml=simplexml_load_file("config.xml");
	defined('DB_SERVER') ? null : define('DB_SERVER', $xml->host);
	defined('DB_USER') ? null : define('DB_USER', $xml->user);
	defined('DB_PASS') ? null : define('DB_PASS', $xml->pass);
	defined('DB_NAME') ? null : define('DB_NAME', $xml->name);


?>