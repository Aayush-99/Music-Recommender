<?php

//echo md5('password');

require 'connect.inc.php';
require 'core.inc.php';

if (loggedin()) {
	$firstname = getfield('firstname');
	$lastname = getfield('lastname');
	echo 'Hello! '.$firstname.' '.$lastname.', you\'re now successfully logged in ! <br><a href="logout.php">Log Out </a><br>';
}else {
	include 'loginform.inc.php';
}
?>