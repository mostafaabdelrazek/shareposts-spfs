<?php
/**
 * PDO database class 
 * for connection 
 * create and prepare connection 
 * bind values 
 * return rows and results
 */
class Database{
    private $host   = DB_HOST;
    private $user   = DB_USER;
    private $pass   = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct(){
        //Set DSN
        $dsn        = "mysql:host={$this->host};dbname={$this->dbname}";
        $options    = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE   => PDO::ERRMODE_EXCEPTION,
        );
        //new PDO instance
        try{
            $this->dbh = new PDO($dsn , $this->user , $this->pass , $options);
        }catch(PDOEXCEPTION $e){
            $this->error = $e->getMessage();
            echo $this->error; 
        }
    }

    // prepare statment with query 
    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
    }

    // Bind values
    //TODO::make params array and values array ro more dynamic
    public function bind($param, $value, $type = null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

         $this->stmt->bindValue($param , $value , $type);
    }

    // Execute the prepare statment
    public function execute(){
        return $this->stmt->execute();
    }

    // Get result set as array of objects 
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
    //get single record as object 
    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
    
    //get row count
    public function rowCount(){
        return $this->stmt->rowCount();
    }

}