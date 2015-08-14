<?php 
	session_start();
	require_once '../bootstrap.php';
	if(!empty($_SESSION['loggedIn'])){
		header('Location: index.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="Create an account for Adlister.">

	<title>New Adlister User</title>

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<style>
	body {
		padding-top: 40px;
		padding-bottom: 40px;
		background-color: #eee;
	}

	.form-signin {
		max-width: 330px;
		padding: 15px;
		margin: 0 auto;
	}
	.form-signin .form-signin-heading,
	.form-signin .checkbox {
		margin-bottom: 10px;
	}
	.form-signin .checkbox {
		font-weight: normal;
	}
	.form-signin .form-control {
		position: relative;
		height: auto;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		padding: 10px;
		font-size: 16px;
	}
	.form-signin .form-control:focus {
		z-index: 2;
	}
	.form-signin input[type="email"] {
		margin-bottom: -1px;
		border-bottom-right-radius: 0;
		border-bottom-left-radius: 0;
	}
	.form-signin input[type="password"] {
		border-top-left-radius: 0;
		border-top-right-radius: 0;
	}
	#confirmPassword{
		margin-bottom: 20px;
	}
	.red{
		color: red;
	}
	</style>
</head>

<body>

	<div class="container">
<?
if(!empty($_POST['userCreate'])){
	$errors = Auth::newUser();
	var_dump($errors);
	if(!empty($errors)){
		foreach ($errors as $error) {
			echo "<p><span class='red'>$error</span></p>";
		}
	}
}
?>
		<form method="POST" class="form-signin">
			<h2 class="form-signin-heading">Create a New User</h2>
			<label for="username" class="sr-only">Username</label>
			<input type="text" id="username" class="form-control" placeholder="Username" name='username' required autofocus>
			<label for="inputEmail" class="sr-only">Email address</label>
			<input type="email" id="inputEmail" class="form-control" placeholder="Email address" name='email' required>
			<label for="inputPassword" class="sr-only">Password</label>
			<input type="password" id="inputPassword" class="form-control" placeholder="Password" name='password' required>
			<label for="confirmPassword" class="sr-only">Confirm Password</label>
			<input type="password" id="confirmPassword" class="form-control" placeholder="Confirm Password" name='confirmPassword' required>
			<p><a href="auth.login.php">Already have an account? Log in here</a></p>
			<button class="btn btn-lg btn-primary btn-block" name="userCreate" value="Submit" type="submit">Sign in</button>
		</form>

	</div> <!-- /container -->

</body>
</html>
