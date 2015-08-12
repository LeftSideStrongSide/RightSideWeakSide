<?

	require_once '../models/Ads.php';
	require_once '../models/Profiles.php';

	$ads = array
	(
		[
			'username' => 'Zakkyzebra',
			'item_name' => 'Large black hawk',
			'description' => 'A hawk of massive proportions. Color: black',
			'price' => '3.50',
			'image_url' => '../public/#.png'
		],
		[
			'username' => 'AlissaBelissa',
			'item_name' => 'pudding',
			'description' => 'Some bland chocolate pudding',
			'price' => '25.00',
			'image_url' => '../public/#.png'
		],
		[
			'username' => 'AngryDuck',
			'item_name' => 'Cups',
			'description' => 'Cups.',
			'price' => '1.50',
			'image_url' => '../public/#.png'
		]
	);

	foreach ($ads as $ad) {
		$newAd = new Ads();
		$newAd->username = $ad['username'];
		$newAd->item_name = $ad['item_name'];
		$newAd->description = $ad['description'];
		$newAd->price = $ad['price'];
		$newAd->image_url = $ad['image_url'];
		$newAd->save();
	}

	$profiles = array
	(
		[
			'username' => 'Zakkyzebra',
			'password' => 'Large black hawk',
			'profile_picture' => '../public/#.png',
			'email' => 'zachattack@gmail.com'
		],
		[
			'username' => 'AlissaBelissa',
			'password' => 'pudding',
			'profile_picture' => '../public/#.png',
			'email' => 'alissa.stephens1@gmail.com'
		],
		[
			'username' => 'AngryDuck',
			'password' => 'Cups',
			'profile_picture' => '../public/#.png',
			'email' => 'angryducks@gmail.com'
		]
	);

	foreach ($profiles as $profile)
		$newProfile = new Profiles();
		$newProfile->username = $profile['username'];
		$newProfile->password = $profile['item_name'];
		$newProfile->profile_picture = $profile['description'];
		$newProfile->email = $profile['price'];
		$newProfile->save();

?>