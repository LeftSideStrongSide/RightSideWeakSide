<?
	session_start();
	define("DB_HOST", '127.0.0.1');
	define("DB_NAME", 'adlister_db');
	define("DB_USER", 'adlister_user');
	define("DB_PASS", '');
	require '../database/db_connect.php';
	require_once '../utils/Input.php';

$_SESSION['username'] = 'testuser';
$errors = array();
//add item name, price, and description
$newAd = $dbc->prepare('INSERT INTO ads (username, item_name, description, price, image_url) VALUES (:username, :item_name, :description, :price, :image_url)');
if (!empty($_SESSION['username']) && Input::has('item_name') && Input::has('description') && Input::has('price')){
	$newAd->bindValue(':username', $_SESSION['username'], PDO::PARAM_STR);
	try{
		$newAd->bindValue(':item_name', Input::getString('item_name'), PDO::PARAM_STR);
	}catch(InvalidArgumentException $e){
		$errors[] = $e->getMessage();
	}catch(OutOfRangeException $e){
		$errors[] = $e->getMessage();
	}catch(DomainException $e){
		$errors[] = $e->getMessage();
	}catch(LengthException $e){
		$errors[] = $e->getMessage();
	}catch(Exception $e){
		$errors[] = $e->getMessage();
	}
	try{
	    $newAd->bindValue(':description',  Input::getString('description'),  PDO::PARAM_STR);
    }catch(Exception $e){
		$errors[] = $e->getMessage();
	}
	try{
	    $newAd->bindValue(':price',  Input::getNumber('price'),  PDO::PARAM_STR);
    }catch(Exception $e){
		$errors[] = $e->getMessage();
	}
	//upload photos
	if(!empty(basename($_FILES['image_url']['name']))) {
	    $uploads_directory = 'img/uploads/';
	    $filename = $uploads_directory . basename($_FILES['image_url']['name']);
	    if (move_uploaded_file($_FILES['image_url']['tmp_name'], $filename)) {
	        echo '<p>The file '. basename( $_FILES['image_url']['name']). ' has been uploaded.</p>';
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
		$newAd->bindValue(':image_url',  $filename,  PDO::PARAM_STR);   
	}else{
		$newAd->bindValue(':image_url',  '#.png',  PDO::PARAM_STR);
	}
	var_dump($_FILES);
	print_r($errors);
	if(empty($errors)){
	    $newAd->execute();
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