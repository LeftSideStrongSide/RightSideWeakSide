<?php 

// TODO: CHANGE TO WORK WITH profiles DATABASE

require_once 'BaseModel.php';

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
    public function update()
    {
        $query = 'UPDATE profiles SET username = :username, password = :password, profile_picture = :profile_picture, email = :email WHERE id = :id;';
        $stmt = self::$dbc->prepare($query);
        $stmt->bindValue(':username', $this->attributes['username'], PDO::PARAM_STR);
        $stmt->bindValue(':password', $this->attributes['password'], PDO::PARAM_STR);
        $stmt->bindValue(':profile_picture', $this->attributes['profile_picture'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->attributes['email'], PDO::PARAM_STR);
        $stmt->bindValue(':id', $this->attributes['id'], PDO::PARAM_INT);
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


}



