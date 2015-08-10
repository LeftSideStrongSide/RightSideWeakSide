<?php

// Get new instance of PDO object
$dbc = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
// Tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//echo out the status
//echo $dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";