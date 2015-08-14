<!DOCTYPE html>
<?	
	session_start();
	require '../bootstrap.php';
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>About</title>
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
	}#picture_holder{
		height:200px;
		width:100%;
	    overflow:hidden;
	    padding-top: 1.5em;
	}
	.styleMe{
		margin-top: 70px;
		margin-left: 20px;
	}
</style>
</head>
<body>
	<?php include '../views/partials/navbar.php'; ?>
	<h1 class ="styleMe page-header"> Contact Us </h1>
	<p class="styleMe">Yeah... this project was a nightmare. If something goes wrong. Goodluck</p>
	<p class="styleMe">Unless you want to donate... then <a href="">Donate here</a></p>

	<?php include '../views/partials/footer.php'; ?>
<!-- jquery  -->
<script src="/js/jquery.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
