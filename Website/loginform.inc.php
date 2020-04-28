<?php

if (isset($_POST['username'])&&isset($_POST['password'])) {
	$username = $_POST['username'];
	$password = md5($_POST['password']);

	if (!empty($username) && !empty($password)) {
		
		$query = "SELECT id FROM users WHERE username='$username' AND password='$password'";
		if ($query_run = mysqli_query($conn, $query)){
			$query_num_rows = mysqli_num_rows($query_run);
			if ($query_num_rows==0) {
				echo 'Invalid username/password combination';
			} else if ($query_num_rows==1){
				$query_row = mysqli_fetch_assoc($query_run);
				$user_id = $query_row['id'];
				$_SESSION['user_id']=$user_id;
				header('Location: index.php');
			}
		}
	} else {
		echo 'You must supply a username and password';
	}
}
?>
<link rel="stylesheet" type="text/css" href="loginstyle.css">
<form action="<?php echo $current_files; ?>" method="POST">
	<h1> SIGN IN </h1><br>

	<p>Username: <input type="text" name="username"> <br><br>Password: <input type="password" name="password"><br><br>
	<input type="submit" value="Log In"><br>
	<br><a href="register.php">New User? Register Here!</a>
</form>