<?

session_start();
require_once '../bootstrap.php';

$errors = array();
//add item name, price, and description
if (!empty($_SESSION['username']) && Input::has('item_name') && Input::has('description') && Input::has('price')){
	try{
		$username = $_SESSION['username'];
	}catch(Exception $e){
		$errors[] = $e->getMessage();
	}
	try{
		$item_name = Input::getString('item_name');
	}catch(Exception $e){
		$errors[] = $e->getMessage();
	}
	try{
		$description = Input::getString('description');
	}catch(Exception $e){
		$errors[] = $e->getMessage();
	}
	try{
		$price = Input::getNumber('price');
	}catch(Exception $e){
		$errors[] = $e->getMessage();
	}
	if(!empty(basename($_FILES['image_url']['name'])) && empty($errors)) {
	    $uploads_directory = 'img/uploads/';
	    $filename = $uploads_directory . basename($_FILES['image_url']['name']);
	    if (move_uploaded_file($_FILES['image_url']['tmp_name'], $filename)) {
	        echo '<p>The file '. basename( $_FILES['image_url']['name']). ' has been uploaded.</p>';
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
		$image_url = $filename;   
	}else{
		$image_url = 'img/uploads/colored_dots.jpg';   
	}
	if(empty($errors)){
		$newAd = new Ads();
		$newAd->username = $username;
		$newAd->item_name = $item_name;
		$newAd->description = $description;
		$newAd->price = $price;
		$newAd->image_url = $image_url;
		$newAd->save();
		// if the newly created add goes through, redirect to their users page
		header('Location: users.show.php');
		exit();
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
		main{
			width: 80%;
			margin-left: auto;
			margin-right: auto;
		}
		h1{
			padding-top: 2em;
		}	/* Sticky footer styles
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
	</style>
</head>
<body>
	<main>
		<?php include '../views/partials/navbar.php'; ?>
		<h1>Create an Ad</h1>
		<?php foreach($errors as $error): ?>
			<p><?= $error ?></p>
		<?php endforeach; ?>
		<form method = "POST" action="ads.create.php" enctype="multipart/form-data" role="form">
			<div class="form-group">
				<div class="col-md-4">
					<label for="item_name">Item Name:</label>
					<input value="<?= Input::get('item_name'); ?>" id="item_name" name="item_name" type="text" class="form-control">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="price">Price:</label>
					<input value="<?= Input::get('price'); ?>" name="price" type="text" class="form-control" id="price">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="image_url">Upload Image:</label>
					<input type="file" name="image_url" id="image_url">
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
				  <label for="description">Description:</label>
				  <textarea name="description" value="<?= Input::get('description'); ?>"class="form-control" rows="5" id="description"></textarea>
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</main>
</body>
<?php include '../views/partials/footer.php'; ?>
</html>