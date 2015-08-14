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
	  margin-bottom: 80px;
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
	.page-header{
		margin-left: 3em;
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
	.image{
		height: 200px;
		width: 200px;
	}
	img {
	    display: block;
	    max-width:90%;
	    max-height:90%;
	    width: auto;
	    height: auto;
	}#picture_holder{
		height:200px;
		width:100%;
	    overflow:hidden;
	    padding-top: 1.5em;
	}
	main{
		margin: 5em;
	}
</style>
</head>
<body>
	<?php include '../views/partials/navbar.php'; ?>
	<main>
		<div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-4">
				<img class="img-responsive img-thumbnail" src="<?= $ad['image_url'] ?>" alt="ad image">
				<h2><?= $ad['item_name']; ?></h2>
				<p><?= $ad['description']; ?></p>
				<p>$<?= $ad['price']; ?></p>
				<p><a class="btn btn-default" href="#" role="button">Buy Now &raquo;</a></p>
		    </div><!--/.col-xs-6.col-lg-4-->
		</div><!--/row-->
	</main>
	<?php include '../views/partials/footer.php'; ?>
<!-- jquery  -->
<script src="/js/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>