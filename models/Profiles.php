<?php 

// TODO: CHANGE TO WORK WITH profiles DATABASE

require_once 'BaseModel.php';
require_once '../bootstrap.php';

class Profiles extends BaseModel
{
    //protected static property
    protected static $table = 'profiles';

    public static function find($email)
    {
        self::dbConnect();
        $query = 'SELECT * FROM profiles WHERE email = :email';
        $stmt = self::$dbc->prepare($query);
        $stmt->bindValue(':email', $email, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $instance = null;
        if ($result) {
            $instance = new static;
            $instance->attributes = $result;
        }
        return $instance;
    }
    // Get all rows from the profiles table
    public static function all()
    {
        //Start by connecting to the DB
        self::dbConnect();
        $stmt = self::$dbc->query('SELECT * FROM profiles');
        //Assign results to a variable
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $instance = null;
        if ($result) {
            $instance = new static;
            $instance->attributes = $result;
        }
        return $instance;

    }
    public function save()
    {
        self::dbConnect();
        //Ensure attributes array has properties
        if($this->attributes){
            if(isset($this->attributes['id'])){
                $this->update();
            }else{
                $this->insert();
            }

        }
    }
    public function updateProfilePicture()
    {
        $query = 'UPDATE profiles SET profile_picture = :profile_picture WHERE email = :email;';
        $stmt = self::$dbc->prepare($query);
        $stmt->bindValue(':profile_picture', $this->attributes['profile_picture'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->attributes['email'], PDO::PARAM_STR);
        $stmt->execute();
    }
    public function insert()
    {
        $query = 'INSERT INTO profiles (username, password, profile_picture, email) VALUES (:username, :password, :profile_picture, :email);';
        $stmt = self::$dbc->prepare($query);
        $stmt->bindValue(':username', $this->attributes['username'], PDO::PARAM_STR);
        $stmt->bindValue(':password', $this->attributes['password'], PDO::PARAM_STR);
        $stmt->bindValue(':profile_picture', $this->attributes['profile_picture'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->attributes['email'], PDO::PARAM_STR);
        $stmt->execute();
    }
    public static function delete($email)
    {
        self::dbConnect();

        $query = 'DELETE FROM profiles WHERE email = :email';
        $stmt = self::$dbc->prepare($query);
        $stmt->bindValue(':email', $email, PDO::PARAM_INT);
        $stmt->execute();
    }

    public static function getUsername($key)
    {
        self::dbConnect();
        $query = "SELECT * FROM profiles WHERE username = '" . $key . "'";
        $stmt = self::$dbc->query($query);
        $stmtX = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($stmtX['username'] === $key) {
            throw new Exception("Username is already in use.");
        }

    }

    public static function getEmail($key)
    {
        self::dbConnect();
        $query = "SELECT * FROM profiles WHERE email = '" . $key . "'";
        $stmt = self::$dbc->query($query);
        $stmtX = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($stmtX['email'] === $key) {
            throw new Exception("Email is already in use.");
        }
    }

    public static function checkPassword($key, $confirmKey)
    {
        if ($key !== $confirmKey) {
            throw new Exception("Passwords do not match.");
        }
    }
    public static function oldPassword($key, $email)
    {
        self::dbConnect();
        $query = "SELECT * FROM profiles WHERE email = '" . $email . "'";
        $stmt = self::$dbc->query($query);
        $stmtX = $stmt->fetch(PDO::FETCH_ASSOC);
        if($stmtX['password'] !== $key){
            throw new Exception("Please enter your correct current password.");
        }
    }
    public static function login()
    {
        if(!empty($_POST['email'])){
            self::dbConnect();
            $query = "SELECT * FROM profiles WHERE email = '" . $_POST['email'] . "'";
            $stmt = self::$dbc->query($query);
            $stmtX = $stmt->fetch(PDO::FETCH_ASSOC);
            if(hash("sha256",$_POST['password']) === $stmtX['password']){
                $_SESSION['loggedIn'] = true;
                $_SESSION['email'] = $_POST['email'];
                Auth::login($_SESSION['email']);
                $login = Profiles::find('me@me.me');
                $username = $login->attributes[0]['username'];
                $_SESSION['username'] = $username;
            }else{
                echo "<span class='red'>Username and password combination does not match.</span>";
                Auth::failedLogin($_POST['email']);
            }
        }
    }
    public static function changePassword()
    {
        if(!empty($_POST['changePassword'])){
            self::dbConnect();
            $oldPassword = hash("sha256",trim($_POST['oldPassword']));
            $password = hash("sha256",trim($_POST['newPassword']));
            $confirmPassword = hash("sha256",trim($_POST['confirmNewPassword']));
            $email = trim($_SESSION['email']);

            $query = "  UPDATE profiles
                        SET password = :password
                        WHERE email = :email";
            $stmt = self::$dbc->prepare($query);  
            try{
                $stmt->bindValue(':email',  $email,  PDO::PARAM_STR);
            }catch(Exception $e){
                $errors[] = $e->getMessage();
            }
            try{
                Profiles::oldPassword($oldPassword, $email);
            }catch(Exception $e){
                $errors[] = $e->getMessage();
            }
            try{
                Profiles::checkPassword($password, $confirmPassword);
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
            }else{
                return $errors;
            }
            $profiles->save();
            $_SESSION['loggedIn'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $username;
            header('Location: index.php'); 
        }
        public static function doNothin()
        {

        }


}



