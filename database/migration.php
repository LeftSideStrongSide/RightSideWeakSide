<?php 
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'adlister_db');
define('DB_USER', 'adlister_user');
define('DB_PASS', '');

// Get new instance of PDO object
$dbc = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
// Tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//echo out the status
//echo $dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";

// delete table if exists
$dbc->exec('DROP TABLE IF EXISTS `ads`');
$dbc->exec('DROP TABLE IF EXISTS `profiles`');
// Create the query and assign to var
$createAdsTable = 
	'CREATE TABLE ads (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    username VARCHAR(20) NOT NULL,
    item_name VARCHAR(50) NOT NULL,
    description VARCHAR(5000) NOT NULL,
    price DOUBLE(12,2) NOT NULL,
    image_url VARCHAR(500) NOT NULL,
    PRIMARY KEY (id))';
// Run query, if there are errors they will be thrown as PDOExceptions
$dbc->exec($createAdsTable);
// Create the query and assign to var
$createProfilesTable = 
	'CREATE TABLE profiles (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    username VARCHAR(20) NOT NULL,
    password VARCHAR(500) NOT NULL,
    email VARCHAR(200) NOT NULL,
    profile_picture VARCHAR(500) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY email (email),
	UNIQUE KEY username (username))';
// Run query, if there are errors they will be thrown as PDOExceptions
$dbc->exec($createProfilesTable);