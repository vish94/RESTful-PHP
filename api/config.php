<?php

	if($_SERVER['HTTP_HOST']=="localhost") {
		defined('DB_SERVER') ? null : define('DB_SERVER', 'localhost');
		defined('DB_USER') ? null : define('DB_USER', 'root');
		defined('DB_PASS') ? null : define('DB_PASS', '');
		defined('DB_NAME') ? null : define('DB_NAME', 'orders');
	} else {
		defined('DB_SERVER') ? null : define('DB_SERVER', 'localhost');
		defined('DB_USER') ? null : define('DB_USER', 'srdtuorg_vishesh');
		defined('DB_PASS') ? null : define('DB_PASS', 'NEO.ALwl(i,0');
		defined('DB_NAME') ? null : define('DB_NAME', 'srdtuorg_srdtu');
	}

?>