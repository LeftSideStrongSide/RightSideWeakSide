<?
	define("DB_HOST", '127.0.0.1');
	define("DB_NAME", 'adlister_db');
	define("DB_USER", 'adlister_user');
	define("DB_PASS", '');
	require 'db_connect.php';

	$dbc->exec('TRUNCATE ads');

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

	$query = "INSERT INTO ads (username, item_name, description, price, image_url) VALUES (:username, :item_name, :description, :price, :image_url)";

    $stmt = $dbc->prepare($query);

	foreach ($ads as $ad) {
			$stmt->bindValue(':username', $ad['username'], PDO::PARAM_STR);
			$stmt->bindValue(':item_name', $ad['item_name'], PDO::PARAM_STR);
			$stmt->bindValue(':description', $ad['description'], PDO::PARAM_STR);
			$stmt->bindValue(':price', $ad['price'], PDO::PARAM_STR);
			$stmt->bindValue(':image_url', $ad['image_url'], PDO::PARAM_STR);

		    $stmt->execute();

		    echo "Inserted ID: " . $dbc->lastInsertId() . PHP_EOL;
	}

	$dbc->exec('TRUNCATE profiles');

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

	$query = "INSERT INTO profiles (username, password, profile_picture, email) VALUES (:username, :password, :profile_picture, :email)";

    $stmt = $dbc->prepare($query);

	foreach ($profiles as $profile) {
			$stmt->bindValue(':username', $profile['username'], PDO::PARAM_STR);
			$stmt->bindValue(':password', $profile['password'], PDO::PARAM_STR);
			$stmt->bindValue(':profile_picture', $profile['profile_picture'], PDO::PARAM_STR);
			$stmt->bindValue(':email', $profile['email'], PDO::PARAM_STR);
			$stmt->execute();
		    echo "Inserted ID: " . $dbc->lastInsertId() . PHP_EOL;
	}
?>