<!DOCTYPE html>
<?	
	session_start();
	require_once '../bootstrap.php';

	$userError;	
	if(!$_SESSION['loggedIn']){ 
		header('Location: auth.login.php');
		exit();
	}
	$username = $_SESSION['username'];
	if(!empty(Ads::find($username)->attributes)){
		$userAds = Ads::find($username)->attributes;
	}
	try{
		if (!empty(Input::get('ad')) && Ads::checkUsername(Input::get('ad'))){
		    Ads::delete(Input::get('ad'));
		    header('Location: users.show.php');
			exit();
		}
	}catch(Exception $e){
		$userError = $e->getMessage();
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
	  margin-top: 60px;
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
	.blue{
		color: blue;
	}


</style>
</head>
<body>
	<?php include '../views/partials/navbar.php'; ?>
	<main>
		<div id="ads" class="row">
		    <div class="col-sm-offset-1 col-sm-10">
				<h2 class="page-header"><?= $username ?><small><a class= "pull-right" href="users.edit.php">edit your profile</a></small></h2>
				<h3>Ads</h3>
				<?= $userError ?>
				<?php if (!empty($userAds)){
					foreach($userAds as $ad): ?>
				  <div class="col-xs-12 col-sm-6 col-md-4">
				    <img class="img-responsive img-thumbnail " src="<?= $ad['image_url'] ?>" alt="ad image">
				    <h2><?= $ad['item_name']; ?></h2>
				    <p><?= $ad['description']; ?></p>
				    <p><?= $ad['price']; ?></p>
				    <p>
				    	<a id="" class="btn btn-default" href="ads.edit.php?id=<?=$ad['id']?>" role="button">Edit &raquo;</a>
				    	<a class="btn btn-default" href="?ad=<?= $ad['id'] ?>" role="button">Delete &raquo;</a>
				    </p>

				  </div><!--/.col-xs-6.col-lg-4-->
				<?php endforeach; }?>
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
