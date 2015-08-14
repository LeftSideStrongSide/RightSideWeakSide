<?php  
	require_once '../bootstrap.php';
	session_start();
	if(isset($_GET['details']) && !empty($_SESSION['username'])){
		$ad = Ads::findItem(Input::get('details'))->attributes;
	}else{
		header('Location: index.php');
		exit();
	} 
	$ad = $ad[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Show Movie Info</title>
</head>
<body>
	<div class="row">
	    <div class="col-xs-12 col-sm-6 col-md-4">
			<img class="img-responsive img-thumbnail" src="<?= $ad['image_url'] ?>" alt="ad image">
			<h2><?= $ad['item_name']; ?></h2>
			<p><?= $ad['description']; ?></p>
			<p>$<?= $ad['price']; ?></p>
	    </div><!--/.col-xs-6.col-lg-4-->
	</div><!--/row-->
</body>
</html>