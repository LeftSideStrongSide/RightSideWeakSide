<?php 

// TODO: CHANGE TO WORK WITH ADS DATABASE

require_once 'BaseModel.php';

class Ads extends BaseModel
{
	//protected static property
    protected static $table = 'ads';

    public static function find($username)
    {
        self::dbConnect();
        //don't want variables in query statement
        //placeholders only
        $query = 'SELECT * FROM ads WHERE username = :username';
        $stmt = self::$dbc->prepare($query);
        $stmt->bindValue(':username', $username, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $instance = null;
        if ($result) {
            $instance = new static;
            $instance->attributes = $result;
        }
        return $instance;
    }
     public static function findItem($id)
    {
        self::dbConnect();
        //don't want variables in query statement
        //placeholders only
        $query = 'SELECT * FROM ads WHERE id = :id';
        $stmt = self::$dbc->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $instance = null;
        if ($result) {
            $instance = new static;
            $instance->attributes = $result;
        }
        return $instance;
    }
      public static function search($search)
    {
    	self::dbConnect();
    	//don't want variables in query statement
    	//placeholders only
    	$query = 'SELECT * FROM ads WHERE item_name LIKE :item_name';
    	$stmt = self::$dbc->prepare($query);
    	$stmt->bindValue(':item_name', "%" . $search . "%", PDO::PARAM_INT);
    	$stmt->execute();

    	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    	$instance = null;
        if ($result) {
            $instance = new static;
            $instance->attributes = $result;
        }
        return $instance;
    }
    // Get all rows from the ads table
    public static function all()
    {
    	//Start by connecting to the DB
    	self::dbConnect();
    	$stmt = self::$dbc->query('SELECT * FROM ads');
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
        $query = 'UPDATE ads SET username = :username, item_name = :item_name, description = :description, price = :price, image_url = :image_url WHERE id = :id;';
        $stmt = self::$dbc->prepare($query);
        $stmt->bindValue(':username', $this->attributes['username'], PDO::PARAM_STR);
        $stmt->bindValue(':item_name', $this->attributes['item_name'], PDO::PARAM_STR);
        $stmt->bindValue(':description', $this->attributes['description'], PDO::PARAM_STR);
        $stmt->bindValue(':price', $this->attributes['price'], PDO::PARAM_STR); 
        $stmt->bindValue(':image_url', $this->attributes['image_url'], PDO::PARAM_STR);
        $stmt->bindValue(':id', $this->attributes['id'], PDO::PARAM_INT);
        $stmt->execute();
    }
    public function insert()
    {
    	$query = 'INSERT INTO ads (username, item_name, description, price, image_url) VALUES (:username, :item_name, :description, :price, :image_url);';
    	$stmt = self::$dbc->prepare($query);
    	$stmt->bindValue(':username', $this->attributes['username'], PDO::PARAM_STR);
        $stmt->bindValue(':item_name', $this->attributes['item_name'], PDO::PARAM_STR);
        $stmt->bindValue(':description', $this->attributes['description'], PDO::PARAM_STR);
        $stmt->bindValue(':price', $this->attributes['price'], PDO::PARAM_STR); 
        $stmt->bindValue(':image_url', $this->attributes['image_url'], PDO::PARAM_STR);
        $stmt->execute();
	}
	public static function delete($id)
	{
        self::dbConnect();

		$query = 'DELETE FROM ads WHERE id = :id';
		$stmt = self::$dbc->prepare($query);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
	}
    public static function checkUsername($id)
    {
        self::dbConnect();
        $query = 'SELECT * FROM ads WHERE id = :id';
        $stmt = self::$dbc->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($results[0]['username']) && $results[0]['username'] === $_SESSION['username']){
            return true;
        }else{
            throw new Exception("Error Processing Request. Please try again later.");
        }
    }
    public static function numberOfAds()
    {
        self::dbConnect();
        $stmt = self::$dbc->prepare('SELECT count(*) FROM ads');
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    public static function offset()
    {
        $offset = Input::get('pageNum');
        return ($offset - 1) * 6;
    }
    public static function numberOfPages()
    {
        return (ceil(Ads::numberOfAds()/6));
    }

    public static function paginate()
    {
        self::dbConnect();
        $stmt = self::$dbc->prepare("SELECT * FROM ads LIMIT 6 OFFSET :offset");
        $stmt->bindValue(':offset', Ads::offset(), PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}



