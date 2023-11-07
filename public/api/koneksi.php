<?php
	define('HOSTNAME', 'localhost');
	define('USERNAME', 'u8665933_kurungannyawa');
	define('PASSWORD', '@kurungannyawa123');
	define('DB_SELECT', 'u8665933_kurungannyawa_main');

	$koneksi = new mysqli(HOSTNAME,USERNAME,PASSWORD,DB_SELECT) or die(mysqli_errno());


?>