<?
		    $_SESSION = array();
		    if (ini_get("session.use_cookies")) {
		        $params = session_get_cookie_params();
		        setcookie(session_name(), '', time() - 42000,
		            $params["path"], $params["domain"],
		            $params["secure"], $params["httponly"]
		        );
		    }
		    session_destroy();
		    //MAKES THE USER THINK ITS PROCESSING THEIR LOGOUT REQUEST	
			sleep(1);
		    header('Location: auth.login.php');
		    exit();
?>
