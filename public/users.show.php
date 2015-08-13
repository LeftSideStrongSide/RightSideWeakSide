<!DOCTYPE html>
<?	
	session_start();
	require_once '../bootstrap.php';
	//TODO: change to only grab adds for this username
	if(!$_SESSION['loggedIn']){ 
		header('Location: auth.login.php');
	}
	$username = $_SESSION['username'];
	if(!empty(Ads::find($username)->attributes)){
		$userAds = Ads::find($username)->attributes;
	}

	
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Adlister Profile</title>
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
</style>
</head>
<body>
	<?php include '../views/partials/navbar.php'; ?>
	<?php include '../views/partials/header.php'; ?>
	<main>
		<div id="ads" class="row">
		    <div class="col-sm-offset-1 col-sm-10">
				<h2>username: <?= $username ?></h2>
				<?php if (!empty($userAds){
					foreach($userAds as $ad): ?>
				  <div class="col-xs-12 col-sm-6 col-md-4">
				    <img class="img-responsive img-thumbnail " src="<?= $ad['image_url'] ?>" alt="ad image">
				    <h2><?= $ad['item_name']; ?></h2>
				    <p><?= $ad['description']; ?></p>
				    <p><a class="btn btn-default" href="#" role="button">Edit &raquo;</a><a class="btn btn-default" href="#" role="button">Delete &raquo;</a></p>
				  </div><!--/.col-xs-6.col-lg-4-->
				<?php endforeach;?>
		    </div><!--/"col-sm-10-->
		</div><!--/row-->
	</main>
	<?php include '../views/partials/footer.php'; ?>
<!-- jquery  -->
<script src="/js/jquery.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
