<?php

$conn = @mysqli_connect('localhost','root','','a_database');

if (mysqli_connect_errno()) {
	echo 'Failed to connect to MySQL Database : '.mysqli_connect_error();
	exit();
}
?>