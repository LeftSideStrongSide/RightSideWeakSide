<?php 
	var_dump($_POST);
	include '../utils/Auth.php';
	session_start();
	$_SESSION = [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="Sign in to adlister.">

	<title>Login Page</title>

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
		margin-bottom: 10px;
		border-top-left-radius: 0;
		border-top-right-radius: 0;
	}
	.red{
		color: red;
	}
	</style>
</head>

<body>

	<div class="container">

		<form class="form-signin" method="POST">
		<?
			if(!empty($_POST['login'])){
				Auth::login();
				if(!empty($_SESSION['loggedIn'])){
					header('Location: index.php');
				}
			}
		?>
			<h2 class="form-signin-heading">Adlister Login</h2>
			<label for="inputEmail" class="sr-only">Email address</label>
			<input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
			<label for="inputPassword" class="sr-only">Password</label>
			<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
			<p><a href="users.create.php">Not a user? Create an account</a></p>
			<button class="btn btn-lg btn-primary btn-block" name="login" value="login" type="submit">Sign in</button>
		</form>

	</div> <!-- /container -->

</body>
</html>
