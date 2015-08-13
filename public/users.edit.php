<!DOCTYPE html>
<?	
	require '../bootstrap.php';
	session_start();

	if(!$_SESSION['loggedIn']){ 
		header('Location: auth.login.php');
	}

	if(!empty($_POST['changePassword'])){
		$errors = Profiles::changePassword();
	}
	if(!empty($_POST['pic'])){
		if(!empty(basename($_FILES['profile_picture']['name'])) && empty($errors)) {
		    $uploads_directory = 'img/uploads/';
		    $filename = $uploads_directory . basename($_FILES['profile_picture']['name']);
		    if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $filename)) {
		        echo '<p>The file '. basename( $_FILES['profile_picture']['name']). ' has been uploaded.</p>';
		    } else {
		        echo "Sorry, there was an error uploading your file.";
		    }
			$profile_picture = $filename;

			$profiles = new Profiles();
			$profiles->profile_picture = $profile_picture;
			$profiles->email = $_SESSION['email'];
			$profiles->updateProfilePicture();   
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Create Adlister Ad</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<style>
		body{
			width: 80%;
			margin-left: auto;
			margin-right: auto;
			margin-bottom: 4em;
			padding-top: 1em;
		}
		.red{
			color: red;
		}
		.gimmeABooty{
			margin-bottom: 20px;
		}
		h1{
			margin-top: 50px;
		}
	</style>
</head>
<body>
	<h1>Edit your profile</h1>
	<? 
		require_once '../views/partials/navbar.php';
		if(!empty($errors)){
			foreach ($errors as $error) {
					echo "<p class='red'> $error </p>";
			}
		}
	?>


	<form class="whereAmI" method="POST">
		<div class="col-md-4">
			<label for="oldPassword"> Old Password:</label>
			<div class="form-group">
				<input type="text" name="oldPassword" placeholder="Old Password">
			</div>
		</div>

		<div class="col-md-4">
			<label for="newPassword"> New Password:</label>
			<div class="form-group">
				<input type="text" name="newPassword" placeholder="New Password">
			</div>
		</div>
		<div class="col-md-4">
			<label for="confirmNewPassword"> Confirm New Password:</label>
			<div class="form-group">
				<input type="text" name="confirmNewPassword" placeholder="Confirm New Password">
			</div>
		</div>
		<div class="col-md-12">
			<input type="submit" class="btn btn-primary gimmeABooty" name="changePassword" value="Submit">
		</div>	
	</form>

	<form method = "POST" action="users.edit.php" enctype="multipart/form-data" role="form">
		<div class="col-md-4">
			<div class="form-group">
				<label for="profile_picture">Update Profile Picture:</label>
				<input type="file" name="profile_picture" id="profile_picture">
			</div>
			<button type="submit" value="Submit" name="pic" class="btn btn-primary">Submit</button>
		</div>
	</form>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
