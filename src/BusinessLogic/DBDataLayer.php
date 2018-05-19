<?php

namespace BusinessLogic;

class DBDataLayer implements DataLayer{

    private $host;
    private $user;
    private $password;
    private $database;

    public function __construct(){
        $this->host = "localhost";
        $this->user = "root";
        $this->password = "";
        $this->database = "scr4";
    }


    public function getProducts(){

        $products = array();
        $con = $this->getConnection();
        $res = $this->executeQuery($con, 'SELECT * FROM products');
        while($p = $res->fetch_object()){
            $products[] = new \Models\Product($p->product_id,  $p->author, $p->name ,$p->manufacturer , $this->getNumberOfRatings($p->product_id) , $this->getAverageRating($p->product_id), $p->category);
        }
        $res->close();
        $con->close();
        return $products;
    }

    private function getNumberOfRatings($product_id){
        $con = $this->getConnection();
        $val =  $this->executeQuery($con, "SELECT getNumberOfRatings($product_id) value")->fetch_assoc ()["value"];
        $con->close();
        return $val;
    }

    private function getAverageRating($product_id){
        $con = $this->getConnection();
        $val =  $this->executeQuery($con, "SELECT getAverageRating($product_id) value")->fetch_assoc ()["value"];
        $con->close();
        return $val;
    }

    public function getRatingsForProduct($product_id){
        $ratings = array();
        $con = $this->getConnection();
        $stat = $this->prepareStatement($con, 'SELECT * FROM ratings WHERE product_id=? ORDER BY date DESC',
        function($s) use ($product_id){
            $s->bind_param('i', $product_id);
        });
        $stat->execute();
        $res = $stat->get_result();
        while($r = $res->fetch_object()){
            $ratings[] = new \Models\Rating($r->rating_id, $r->product_id, $r->author, $r->date, $r->value, $r->comment);
        }

        $stat->close();
        $con->close();
        return $ratings;
    }

    public function getProductsFromQuery($query){

        if($query == null)
            return null;

        $query = "%$query%";

        $products = array();
        $con = $this->getConnection();
        $stat = $this->prepareStatement($con, 'SELECT * FROM products WHERE name LIKE ? OR manufacturer LIKE ?',
        function($s) use ($query){
            $s->bind_param('ss', $query,$query);
        });
        $stat->execute();
        $res = $stat->get_result();
        while($p = $res->fetch_object()){
            $products[] = new \Models\Product($p->product_id,  $p->author, $p->name ,$p->manufacturer , $this->getNumberOfRatings($p->product_id) , $this->getAverageRating($p->product_id), $p->category);
        }

        $stat->close();
        $con->close();
        return $products;
    }

    public function getProductWithId($product_id){
        $product = null;
        $con = $this->getConnection();
        $stat = $this->prepareStatement($con, 'SELECT * FROM products WHERE product_id=?',
        function($s) use ($product_id){
            $s->bind_param('i', $product_id);
        });
        $stat->execute();
        $res = $stat->get_result();
        $p = $res->fetch_assoc();
        $product =  new \Models\Product($p['product_id'],  $p['author'], $p['name'] ,$p['manufacturer'] , $this->getNumberOfRatings($p['product_id']) , $this->getAverageRating($p['product_id']), $p['category']);
        
        $stat->close();
        $con->close();
        return $product;
    }

    public function registerUser($username, $password){

        /* Check if user exists */
        if($this->getUser($username) != null)
            return false;

        /* Insert user into DB */
        $con = $this->getConnection();
        $con->autocommit(false);
        $stat = $this->executeStatement($con, 'INSERT INTO users (username, password)
        VALUES (?,?)',
        function($s) use ($username, $password){
            $s->bind_param('ss', $username, password_hash($password, PASSWORD_DEFAULT));
        });
        $stat->close();
        $con->commit();
        $con->close();
        
        return true;
    }

    public function addProduct($username, $name, $manufacturer, $category){

         $con = $this->getConnection();
         $con->autocommit(false);
         $stat = $this->executeStatement($con, 'INSERT INTO products (author, name, manufacturer, category)
         VALUES (?,?,?,?)',
         function($s) use ($username, $name, $manufacturer, $category){
             $s->bind_param('ssss', $username, $name, $manufacturer, $category);
         });
         $pid = $stat->insert_id;
         $stat->close();
         $con->commit();
         $con->close();
         return $pid;

    }

    public function editProduct($pid, $name, $manufacturer, $category){

        $con = $this->getConnection();
        $con->autocommit(false);
        $stat = $this->executeStatement($con, 'UPDATE products SET name=?, manufacturer=?, category=? WHERE product_id=?',
        function($s) use ($pid, $name, $manufacturer, $category){
            $s->bind_param('sssi', $name, $manufacturer, $category, $pid);
        });
        $stat->close();
        $con->commit();
        $con->close();
   }



    public function getCategories(){
        $categories = array();
        $con = $this->getConnection();
        $res = $this->executeQuery($con, 'SELECT name FROM categories');
        while($cat = $res->fetch_object()){
            $categories[] = new \Models\Category($cat->name);
        }
        $res->close();
        $con->close();
        return $categories;
    }
    
    public function getUser($username){
        $user = null;
        $con = $this->getConnection();
        $stat = $this->executeStatement(
            $con,
            'SELECT username FROM users WHERE username = ?',
            function($s) use($username){
                $s->bind_param('s', $username);
            }

        );
        $stat->bind_result($username);
        if($stat->fetch()){
            $user = new \Models\User($username);

        }
        $stat->close();
        $con->close();

        return $user;
    }
    
    public function getUserForUsernameAndPassword($username, $password){
        $user = null;

        $con = $this->getConnection();
        $stat = $this->executeStatement(
            $con,
            'SELECT username, password FROM users WHERE username = ?',
            function($s) use($username){
                $s->bind_param('s', $username);
            }

        );
        $stat->bind_result($username, $passwordHash);
        if($stat->fetch() && password_verify($password, $passwordHash)){
            $user = new \Models\User($username);

        }
        $stat->close();
        $con->close();

        return $user;
    }
    
   

    /* Helpers */
    private function getConnection(){
        $con = new \mysqli($this->host, $this->user, $this->password, $this->database);
        if(!$con){
            die("Unable to connect to database! Error: " . mysqli_connect_error());
        }
        return $con;
    }

    private function executeQuery($connection, $query){
        $result = $connection->query($query);
        if(!$result){
            die("Error in prepared statement $query: $connection->error");
        }
        return $result;
    }

    private function executeStatement($connection, $query, $bindFunc){
        $statement = $connection->prepare($query);
        if(!$statement){
            die("Error in prepared statement $query: $connection->error");
        }
        $bindFunc($statement);
        if(!$statement->execute()){
            die("Error executing statement $query: " . $statement->error);
        }

        return $statement;

    }

    private function prepareStatement($connection, $query, $bindFunc){
        $statement = $connection->prepare($query);
        if(!$statement){
            die("Error in prepared statement $query: $connection->error");
        }
        $bindFunc($statement);

        return $statement;

    }
}