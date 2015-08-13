<?
require_once 'Ads.php';
$newAd = new Ads();
$newAd->id = 3;
$newAd->username = 'alissa';
$newAd->item_name = 'bubble wrap';
$newAd->description = 'test';
$newAd->price = '3.50';
$newAd->image_url = 'alissa.png';
$newAd->save();

