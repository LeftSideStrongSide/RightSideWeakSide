<?php 
require_once 'Profiles.php';
$profile = new Profiles();
$profile->password = "zach";
$profile->id = 33;
$profile->save();

