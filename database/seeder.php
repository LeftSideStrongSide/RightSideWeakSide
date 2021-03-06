<?

	require_once '../bootstrap.php';

	$ads = array
	(
		[
			'username' => 'Zakkyzebra',
			'item_name' => 'Large black hawk',
			'description' => 'A hawk of massive proportions. Color: black',
			'price' => '3.50',
			'image_url' => 'img/uploads/ctrl_escape.png'
		],
		[
			'username' => 'AlissaBelissa',
			'item_name' => 'pudding',
			'description' => 'Some bland chocolate pudding',
			'price' => '25.00',
			'image_url' => 'img/uploads/chameleon.jpg'
		],
		[
			'username' => 'me',
			'item_name' => 'Cups',
			'description' => 'Cups.',
			'price' => '1.50',
			'image_url' => 'img/uploads/oranges.png'
		],
		[
			'username' => 'me',
			'item_name' => 'Cups',
			'description' => 'Cups.',
			'price' => '1.50',
			'image_url' => 'img/uploads/oranges.png'
		],
		[
			'username' => 'me',
			'item_name' => 'Cups',
			'description' => 'Cups.',
			'price' => '1.50',
			'image_url' => 'img/uploads/oranges.png'
		],
		[
			'username' => 'me',
			'item_name' => 'Cups',
			'description' => 'Cups.',
			'price' => '1.50',
			'image_url' => 'img/uploads/oranges.png'
		],
		[
			'username' => 'me',
			'item_name' => 'Cups',
			'description' => 'Cups.',
			'price' => '1.50',
			'image_url' => 'img/uploads/oranges.png'
		],
		[
			'username' => 'me',
			'item_name' => 'Cups',
			'description' => 'Cups.',
			'price' => '1.50',
			'image_url' => 'img/uploads/oranges.png'
		],
		[
			'username' => 'me',
			'item_name' => 'Cups',
			'description' => 'Cups.',
			'price' => '1.50',
			'image_url' => 'img/uploads/oranges.png'
		],
		[
			'username' => 'me',
			'item_name' => 'Cups',
			'description' => 'Cups.',
			'price' => '1.50',
			'image_url' => 'img/uploads/oranges.png'
		],
		[
			'username' => 'me',
			'item_name' => 'Cups',
			'description' => 'Cups.',
			'price' => '1.50',
			'image_url' => 'img/uploads/oranges.png'
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
			'profile_picture' => 'img/uploads/giraffe.jpg',
			'email' => 'zachattack@gmail.com'
		],
		[
			'username' => 'AlissaBelissa',
			'password' => 'pudding',
			'profile_picture' => 'img/uploads/giraffe.jpg',
			'email' => 'alissa.stephens1@gmail.com'
		],
		[
			'username' => 'AngryDuck',
			'password' => 'Cups',
			'profile_picture' => 'img/uploads/giraffe.jpg',
			'email' => 'angryducks@gmail.com'
		],
		[
			'username' => 'me',
			'password' => hash("sha256", "me"),
			'profile_picture' => 'img/uplaods/giraffe.jpg',
			'email' => 'me@me.me'
		]
	);

	foreach ($profiles as $profile){
		$newProfile = new Profiles();
		$newProfile->username = $profile['username'];
		$newProfile->password = $profile['password'];
		$newProfile->profile_picture = $profile['profile_picture'];
		$newProfile->email = $profile['email'];
		$newProfile->save();
	}

?>