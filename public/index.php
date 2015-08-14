<!DOCTYPE html>
<?	
	session_start();
	if(!$_SESSION['loggedIn']){ 
		header('Location: auth.login.php');
	}
	require '../bootstrap.php';
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
	}
</style>
</head>
<body>
	<?php include '../views/partials/navbar.php'; ?>
	<?php include '../views/partials/header.php'; ?>
	<main>
		<div id="ads" class="row">
		    <div class="col-xs-offset-1 col-xs-10">
				<?php include 'ads.index.php'; ?> 
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
