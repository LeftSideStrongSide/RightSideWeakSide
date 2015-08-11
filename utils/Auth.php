<?
	//CONNECT TO DB
	define("DB_HOST", '127.0.0.1');
	define("DB_NAME", 'adlister_db');
	define("DB_USER", 'adlister_user');
	define("DB_PASS", '');
	class Auth{
		public static function login()
		{
			if(!empty($_POST['username'])){
				$_SESSION = [];
				require '../database/db_connect.php';
				$query = "SELECT * FROM profiles WHERE username = '" . $_POST['username'] . "'";
				$stmt = $dbc->query($query);
				$stmtX = $stmt->fetch(PDO::FETCH_ASSOC);
				if(hash("sha256",$_POST['password']) === $stmtX['password']){
					$_SESSION['loggedIn'] = true;
					$_SESSION['username'] = $_POST['username'];
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

		}
	}



?>