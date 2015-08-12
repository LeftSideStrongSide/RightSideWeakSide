<?php 

// TODO: CHANGE TO WORK WITH PROFILES DATABASE

require_once 'BaseModel.php';

class User extends Model
{
	//protected static property
    protected static $table = 'profiles';

    public static function find($email)
    {
    	self::dbConnect();
    	//don't want variables in query statement
    	//placeholders only
    	$query = 'SELECT * FROM users WHERE email = :email';
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
    // Get all rows from the users table
    public static function all()
    {
    	//Start by connecting to the DB
    	self::dbConnect();
    	$stmt = self::$dbc->query('SELECT * FROM users');
    	//Assign results to a variable
    	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    	$instance = null;
        if ($result) {
            $instance = new static;
            $instance->attributes = $result;
        }
        return $instance;

    }
    public static function save()
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
    public static function update()
    {
        $query = 'UPDATE profiles SET username = :username, profile_picture = :profile_picture WHERE email = :email;';
        $stmt = self::$dbc->prepare($query);
        $stmt->bindValue(':username', $this->attributes['username'], PDO::PARAM_STR);
        $stmt->bindValue(':profile_picture', $this->attributes['profile_picture'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->attributes['email'], PDO::PARAM_STR);
        $stmt->execute();
    }
    public static function insert()
    {
    	$query = 'INSERT INTO profiles (first_name, last_name) VALUES (:first_name, :last_name);';
    	$stmt = self::$dbc->prepare($query);
    	$stmt->bindValue(':first_name', $this->attributes['first_name'], PDO::PARAM_STR);
    	$stmt->bindValue(':last_name', $this->attributes['last_name'], PDO::PARAM_STR);
    	$stmt->execute();
	}
	public static function delete()
	{
		$query = 'DELETE * FROM profiles WHERE id = :id';
		$stmt = self::$dbc->prepare($query);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
	}


}



