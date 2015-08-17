<?

session_start();
require_once '../bootstrap.php';

$errors = array();
//add item name, price, and description
$csv = array();

// check there are no errors
if(!empty($_FILES) && $_FILES['csv']['error'] == 0){
	var_dump($_FILES);
    $name = $_FILES['csv']['name'];

    $type = $_FILES['csv']['type'];
    $tmpName = $_FILES['csv']['tmp_name'];

    // check the file is a csv

        if(($handle = fopen($tmpName, 'r')) !== FALSE) {
            $row = 0;

            while(($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                // number of fields in the csv
                $col_count = count($data);

				$newAd = new Ads();
				$newAd->username = $data[0];
				$newAd->item_name = $data[1];
				$newAd->description = $data[2];
				$newAd->price = $data[3];
				$newAd->image_url = $data[4];
				$newAd->save();
				// if the newly created add goes through, redirect to their users page

                // inc the row
                $row++;
            }
            fclose($handle);
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
		<?php include '../views/partials/navbar.php';?>
		<h1>Bulk Ad Upload</h1>
		<?php foreach($errors as $error): ?>
			<p><?= $error ?></p>
		<?php endforeach; ?>
		<form method = "POST" action="bulk.create.php" enctype="multipart/form-data" role="form">
			<div class="col-md-4">
				<div class="form-group">
					<label for="file">Upload CSV:</label>
					<input type="file" name="csv" id="file">
				</div>
				<button type="submit" name="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</main>
</body>
<?php include '../views/partials/footer.php'; ?>
</html>