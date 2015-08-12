<?
	require_once '../models/BaseModel.php';
	require_once 'Input.php';
	class Auth extends BaseModel
	{
		public static function login()
		{
			if(!empty($_POST['email'])){
				BaseModel::dbConnect();

				$query = "SELECT * FROM profiles WHERE email = '" . $_POST['email'] . "'";
				$stmt = self::$dbc->query($query);
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
		public static function newUser()
		{
			$username = trim($_POST['username']);
			$email = trim($_POST['email']);
			$password = trim($_POST['password']);
			$confirmPassword = trim($_POST['confirmPassword']);
			try{
				Input::getUsername($username);
			}catch(Exception $e){
				$errors[] = $e->getMessage();
			}
			try{
				Input::getEmail($email);
			}catch(Exception $e){
				$errors[] = $e->getMessage();
			}
			try{
				Input::checkPassword($password, $confirmPassword);
			}catch(Exception $e){
				$errors[] = $e->getMessage();
			}
		}
	}










?>