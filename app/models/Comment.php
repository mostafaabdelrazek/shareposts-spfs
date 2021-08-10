<?php

class Comment{

    public function __construct(){
        $this->db = new Database;
    }

    public function addComment($data){
        $this->db->query('
            INSERT INTO COMMENTS ( body , post_id , user_id  ) VALUES (:body ,:post_id , :user_id  )
        ');
        $this->db->bind(':body' , $data['comment']);
        $this->db->bind(':user_id' , $data['user_id']);
        $this->db->bind(':post_id' , $data['post_id']);
        return $this->db->execute();
    }

    public function getCommentsByPostId($post_id){
        $this->db->query('
            SELECT comments.* , users.name as username FROM `comments` 
            JOIN users on users.id = comments.user_id 
            WHERE post_id = :post_id 
            ORDER BY created_at 
        ');
        $this->db->bind(':post_id' , $post_id);
        return $this->db->resultSet();
    }
}