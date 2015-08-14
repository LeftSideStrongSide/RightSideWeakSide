<?
	require_once '../bootstrap.php';
		$newAd = new Ads();
		$newAd->id = 10;
		$newAd->username = 'me';
		$newAd->item_name = "item_name";
		$newAd->description = "description";
		$newAd->price = 3.5;
		$newAd->image_url = "image_url";
		$newAd->save();


?>