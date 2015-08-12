<?
	require_once '../models/Profiles.php';
	class Auth
	{

		public static function changePassword()
		{
			if(!empty($_POST['changePassword'])){
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
			$profiles = new Profiles();
			try{
				Profiles::getUsername($username);
			}catch(Exception $e){
				$errors[] = $e->getMessage();
			}
			try{
				Profiles::getEmail($email);
			}catch(Exception $e){
				$errors[] = $e->getMessage();
			}
			try{
				Profiles::checkPassword($password, $confirmPassword);
			}catch(Exception $e){
				$errors[] = $e->getMessage();
			}
		    if(empty($errors)){

				$profiles->username = $username;
				$profiles->email = $email;
				$profiles->password = hash("sha256", $password);
				$profiles->profile_picture = "#.png";
			    $stmt->execute();
		    }else{
		    	return $errors;
		    }
			$profiles->save();
			$_SESSION['loggedIn'] = true;
			$_SESSION['email'] = $email;
			header('Location: index.php'); 
		}
	}










?>