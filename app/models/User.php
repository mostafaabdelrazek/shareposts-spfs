<?php 

class User {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

     //user Register 
     public function register($data){
         $this->db->query(
             'INSERT INTO USERS (NAME, EMAIL, PASSWORD) VALUES(:name , :email , :password)'
         );
         $this->db->bind(':name',$data['name']);
         $this->db->bind(':email',$data['email']);
         $this->db->bind(':password',$data['password']);
         //execute single
        return $this->db->execute() ;
    }

    //Find User by email
    public function findUserByEmail($email){
        $this->db->query(
            'SELECT * FROM USERS WHERE email = :email LIMIT 1'
        );
        //bind values
        $this->db->bind(':email' , $email);
        $row = $this->db->single();

        //check row 
        if($this->db->rowCount() > 0 ){
            return true;
        }else{
            return false;
        }
    }

    //login User
    public function login($email , $password){
        $this->db->query(
            'SELECT * FROM USERS WHERE EMAIL = :email LIMIT 1'
        );
        $this->db->bind(':email' , $email);

        $row = $this->db->single();
        $hashed_password = $row->password;
        if(password_verify($password , $hashed_password)){
           return $row; 
        }else{
            return false;
        }
    }

    public function getUserById($id){
        $this->db->query('
            SELECT * FROM users WHERE ID = :id
        ');
        $this->db->bind(':id' , $id);
        $row = $this->db->single();
        return $row;
    }

   
}