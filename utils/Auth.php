<?
	//CONNECT TO DB
	define("DB_HOST", '127.0.0.1');
	define("DB_NAME", 'adlister_db');
	define("DB_USER", 'adlister_user');
	define("DB_PASS", '');
	class Auth{
		public static function login()
		{
			if(!empty($_POST['email'])){
				require '../database/db_connect.php';

				$query = "SELECT * FROM profiles WHERE email = '" . $_POST['email'] . "'";
				$stmt = $dbc->query($query);
				$stmtX = $stmt->fetch(PDO::FETCH_ASSOC);
				if(hash("sha256",$_POST['password']) === $stmtX['password']){
					$_SESSION['loggedIn'] = true;
					$_SESSION['email'] = $_POST['email'];
				}
			}
		}
		
		public static function logout()
		{
		    $_SESSION = array();
		    if (ini_get("session.use_cookies")) {
		        $params = session_get_cookie_params();
		        setcookie(session_name(), '', time() - 42000,
		            $params["path"], $params["domain"],
		            $params["secure"], $params["httponly"]
		        );
		    }
		    session_destroy();
		}

		public static function newUser()
		{
			if(!empty($_POST['#'])){
				require '../database/db_connect.php';

				$username = trim($_POST['username']);
				$passwordA = hash("sha256",trim($_POST['password']));
				$passwordB = hash("sha256",trim($_POST['confirmPassword']));
				$email = trim($_POST['email']);

				$query = "INSERT INTO profiles (username, password, email, profile_picture) VALUES (:username, :password, :email, :profile_picture)";
			    $stmt = $dbc->prepare($query);				
			    try{
				    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
			    }catch(Exception $e){
			    	echo "Username is already taken.";
			    }
			    if($passwordA === $passwordB){
			    	try{
			    		$stmt->bindValue(':password', $passwordA, PDO::PARAM_STR);
			    	}catch(Exception $e){
			    		echo "Password is not valid.";
			    	}
			    }
			    try{
			    	$stmt->bindValue(':email', $email, PDO::PARAM_STR);
			    }catch(Exception $e){
			    	echo "Email is not valid.";
			    }
			    try{
			    	$stmt->execute();
			    }catch(Exception $e){
			    	echo "An error has occured. Please try again later.";
			    }


			}
		}
	}



?>