<!DOCTYPE html>
<?	
	session_start();
	require '../utils/Auth.php';
	require '../database/db_connect.php';
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Adlister</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<style>
	/* Sticky footer styles
	-------------------------------------------------- */
	html {
	  position: relative;
	  min-height: 100%;
	}
	body {
	  /* Margin bottom by footer height */
	  margin-bottom: 60px;
	}
	.footer {
	  position: absolute;
	  bottom: 0;
	  width: 100%;
	  /* Set the fixed height of the footer here */
	  height: 60px;
	  background-color: #f5f5f5;
	}
	/* Custom page CSS
	-------------------------------------------------- */
	/* Not required for template or sticky footer method. */
	body > .container {
	  padding: 60px 15px 0;
	}
	.container .text-muted {
	  margin: 20px 0;
	}
	.footer > .container {
	  padding-right: 15px;
	  padding-left: 15px;
	}
	code {
	  font-size: 80%;
	}
	.whereAmI{
		margin-top: 100px;
	}
</style>
</head>
<body>
<?
	if(!empty($_POST['submit'])){
		Auth::login();
	}
	if(!empty($_POST['logout'])){
		Auth::logout();
	}
?>
<!-- SIMPLE LOGIN FORM FOR TESTING-->
<form method="POST" class="whereAmI">
	<? if (empty($_SESSION['loggedIn'])){
		echo '<input type="text" name="username" placeholder="Username">
		<input type="text" name="password" placeholder="Password">
		<input type="submit" name="submit" value="Submit">';
	}elseif (!empty($_SESSION['loggedIn'])) {
		echo '<input type="submit" name="logout" value="Logout">';
	}
	?>
</form>
<?var_dump($_SESSION);?>
<!-- jquery  -->
<script src="/js/jquery.js"></script>
	<?php include '../views/partials/navbar.php'; ?>
	<?php include '../views/partials/header.php'; ?>
	<?php include '../views/partials/footer.php'; ?>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
