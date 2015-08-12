<?

session_start();
require_once '../utils/Input.php';
require_once '../models/Ads.php';


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
		$image_url = '#.png';   
	}
	if(empty($errors)){
		$newAd = new Ads();
		$newAd->username = $username;
		$newAd->item_name = $item_name;
		$newAd->description = $description;
		$newAd->price = $price;
		$newAd->image_url = $image_url;
		$newAd->save();
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
	</style>
</head>
<body>
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
	
</body>
</html>