<!DOCTYPE html>
<?	
	session_start();
	require_once '../bootstrap.php';

	$numberOfAds = Ads::numberOfAds();
	if(!$_SESSION['loggedIn']){ 
		header('Location: auth.login.php');
		exit();
	}

	//if no page number go to first page
	if(empty($_GET)){
		header('Location: ?pageNum=1');
		exit();
	}
	if(Input::get('pageNum') < 1){
		header('Location: ?pageNum=' . Ads::numberOfPages());
		exit();
	}
	if(Input::get('pageNum') > Ads::numberOfPages()){
		header('Location: ?pageNum=1');
		exit();
	}

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
		margin-top: 6em;
		margin-left: -10px;
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
	}
	#picture_holder{
		height:200px;
		width:100%;
	    overflow:hidden;
	    padding-top: 1.5em;
	}
	.pagination{
		margin:0 auto;
		padding-top: 20px;
		padding-bottom: 0px;
	}
</style>
</head>
<body>
	<?php include '../views/partials/navbar.php';?>
	<main>
		<div id="ads" class="row">
		    <div class="col-xs-offset-1 col-xs-10">
				<?php include '../views/partials/header.php'; ?>
				<?php include 'ads.index.php'; ?> 
				<nav id="pagination" class='text-center'>
					<ul class="pagination">
						<li>
							<a href="?pageNum=<?= (Input::get('pageNum') - 1 ) ?>" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
							</a>
						</li>
						<? for($x = 1; $x <= Ads::numberOfPages(); $x++): ?>
							<li class="<?= Input::get('pageNum')==$x ? 'active': ''; ?>"><a href="?pageNum=<?= $x ?>"><?= $x ?></a></li>
						<? endfor; ?>
						<li>
							<a href="?pageNum=<?= (Input::get('pageNum') + 1 ) ?>" aria-label="Next">
								<span aria-hidden="true">&raquo;</span>
							</a>
						</li>
					</ul>
				</nav>
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
