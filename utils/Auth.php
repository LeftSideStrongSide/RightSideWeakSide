<?
	//CONNECT TO DB
	define("DB_HOST", '127.0.0.1');
	define("DB_NAME", 'adlister_db');
	define("DB_USER", 'adlister_user');
	define("DB_PASS", '');
	include 'Input.php';
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
				}else{
					echo "<span class='red'>Username and password combination does not match.</span>";
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
			if(!empty($_POST['userCreate'])){
				require '../database/db_connect.php';

				$username = trim($_POST['username']);
				$password = hash("sha256",trim($_POST['password']));
				$confirmPassword = hash("sha256",trim($_POST['confirmPassword']));
				$email = trim($_POST['email']);

				$query = "INSERT INTO profiles (username, password, email, profile_picture) VALUES (:username, :password, :email, :profile_picture)";
			    $stmt = $dbc->prepare($query);	
			    try{
			    	Input::getUsername($username);
			    	$stmt->bindValue(':username', $username, PDO::PARAM_STR);
			    }catch(Exception $e){
			    	$errors[] = $e->getMessage();
			    }
				try{
					Input::getEmail($email);
				    $stmt->bindValue(':email',  $email,  PDO::PARAM_STR);
			    }catch(Exception $e){
					$errors[] = $e->getMessage();
				}
				try{
					Input::checkPassword($password, $confirmPassword);
				    $stmt->bindValue(':password',  $password,  PDO::PARAM_STR);
			    }catch(Exception $e){
					$errors[] = $e->getMessage();
				}
			    $stmt->bindValue(':profile_picture', "image.png", PDO::PARAM_STR);
			    if(empty($errors)){
			    	$_SESSION['loggedIn'] = true;
			    	$_SESSION['email'] = $email;
			    	var_dump($_SESSION);
				    $stmt->execute();
				    header('Location: index.php');
				    exit();
			    }else{
			    	return $errors;
			    }
			}
		}

		public static function changePassword()
		{
			if(!empty($_POST['changePassword'])){
				require '../database/db_connect.php';
				$oldPassword = hash("sha256",trim($_POST['oldPassword']));
				$password = hash("sha256",trim($_POST['newPassword']));
				$confirmPassword = hash("sha256",trim($_POST['confirmNewPassword']));
				$email = trim($_SESSION['email']);

				$query = "	UPDATE profiles
							SET password = :password
							WHERE email = :email";
			    $stmt = $dbc->prepare($query);	
				try{
				    $stmt->bindValue(':email',  $email,  PDO::PARAM_STR);
			    }catch(Exception $e){
					$errors[] = $e->getMessage();
				}
				try{
					Input::oldPassword($oldPassword, $email);
			    }catch(Exception $e){
					$errors[] = $e->getMessage();
				}
				try{
					Input::checkPassword($password, $confirmPassword);
			    }catch(Exception $e){
					$errors[] = $e->getMessage();
				}

			    if(empty($errors)){
				    $stmt->bindValue(':password',  $password,  PDO::PARAM_STR);
				    $stmt->execute();
			    }else{
			    	return $errors;
			    }
			}
		}
	}










?>