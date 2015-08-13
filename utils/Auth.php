<?
	require_once '../models/Profiles.php';
	class Auth
	{
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