<?
	require_once '../bootstrap.php';
	$stmt = Profiles::find('me@me.me');
	$stmtX = $stmt->attributes[0]['username'];



?>