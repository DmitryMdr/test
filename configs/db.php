<?php

	$server = "localhost";
	$username = "root";
	$password = "";
	$dbname = "kvart";

	$connect = mysqli_connect($server, $username, $password, $dbname);

	mysqli_set_charset($connect, 'utf8');

?>