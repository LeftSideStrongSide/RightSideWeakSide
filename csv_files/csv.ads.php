<?
	$file_handle = fopen("ads.csv", "r");

	while (!feof($file_handle) ) {

		$line_of_text = fgetcsv($file_handle, 50000);

		print_r($line_of_text);

	}

	fclose($file_handle);
?>