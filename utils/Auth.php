<?
	require_once '../bootstrap.php';
	class Auth
	{
		public static function login($email)
	    {
			$log = new Log('loginAttempts');
	    	$log->info("User {$email} logged in.");
	    }

		public static function failedLogin($email)
	    {
			$log = new Log('loginAttempts');
	    	$log->info("User {$email} failed to login.");
	    }
	}
?>