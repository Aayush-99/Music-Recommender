<?php

require 'core.inc.php';

if (!loggedin()) {

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password_again']) && isset($_POST['firstname'])  && isset($_POST['lastname'])) {

	$username = $_POST['username'];
	$password = $_POST['password'];
	$password_again = $_POST['password_again'];
	$password_hash = md5($password);
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];

	if (!empty($username) && !empty($password) && !empty($password_again) && !empty($firstname) && !empty($lastname)) {

		if ($password!=$password_again) {
			echo 'Passwords do not match!';
		} else {
			//start registration process

			// see if the user is already in the database
			$query = "SELECT username from users WHERE username='$username'";
			$query_run = mysqli_query(@mysqli_connect('localhost','root','','a_database'), $query);
			if (@mysqli_num_rows($query_run)==1) {
				echo 'The username '.$username.' already exists.';
			}else {
				$query = "INSERT INTO users (username, password, firstname, lastname) VALUES ('$username', '$password_hash', '$firstname', '$lastname')";
				if ($query_run = mysqli_query(@mysqli_connect('localhost','root','','a_database'), $query)) {
					header('Location: register_success.php');
				} else {
					echo 'Couldn\'t register you at this moment, try again later..';
				}
			}
		}
	}else {
		echo 'All fields are required!';
	}
}

?>
<link rel="stylesheet" type="text/css" href="css/loginstyle.css">
<form action="register.php" method="POST">
	<h1> SIGN UP </h1><br>

<p>Username: <br> <input type='text' name='username' maxlength="40" value='<?php if(isset($username)) {echo $username;} ?>'><br><br>
Password: <br> <input type='password' name='password'><br><br>
Enter Password Again: <br> <input type='password' name='password_again'><br><br>
Firstname: <br> <input type='text' name='firstname' maxlength="40" value='<?php if (isset($firstname)) {echo $firstname;} ?>'><br><br>
Lastname: <br><input type='text' name='lastname' maxlength="40" value='<?php if (isset($lastname)) {echo $lastname;} ?>'><br><br>
<input type='submit' value='register'>
<br><a href="loginform.inc.php">Already a User? Log In</a>
</form>

<?php
}else if (loggedin()) {
	echo 'You\'ve already registered and logged in';
}

?>
