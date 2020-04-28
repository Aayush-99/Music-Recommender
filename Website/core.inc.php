<?php
ob_start();			// to use headers
session_start();	//to make a user session login
$current_files = $_SERVER['SCRIPT_NAME'];

if (isset($_SERVER['HTTP_REFERER'])) {
	$http_referer = $_SERVER['HTTP_REFERER']; //tells which page we've come from
}

function loggedin() {
	if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
		return true;
	} else {
		return false;
	}
}

function getfield($field) {
	$sess_id = $_SESSION['user_id'];
	$query = "SELECT $field from users WHERE id=$sess_id";
	if ($query_run = mysqli_query(@mysqli_connect('localhost','root','','a_database'), $query)) {
		$query_row = mysqli_fetch_assoc($query_run);
		if ($query_result = $query_row[$field]) {
			return $query_result;
		}
	}
}

?>