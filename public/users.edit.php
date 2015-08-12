<!DOCTYPE html>
<?	
	session_start();
	var_dump($_SESSION);
	if(!$_SESSION['loggedIn']){ 
		header('Location: auth.login.php');
	}
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
		margin-left: 100px;
	}
</style>
</head>
<body>
<!-- jquery  -->
<script src="/js/jquery.js"></script>

<?
	var_dump($_POST);
	if(!empty($_POST['changePassword'])){
		$errors = Auth::changePassword();
		var_dump($errors);
		if(!empty($errors)){
			foreach ($errors as $error) {
				echo "<p><span class='red'>$error</span></p>";
			}
		}
	}
?>

	<form class="whereAmI" method="POST">
		<input type="text" name="oldPassword" placeholder="Old Password">
		<input type="text" name="newPassword" placeholder="New Password">
		<input type="text" name="confirmNewPassword" placeholder="Confirm New Password">
		<input type="submit" name="changePassword" value="Submit">
	</form>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
