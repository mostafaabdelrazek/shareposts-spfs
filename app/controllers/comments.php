<?php

class Comments extends Controller{
    public function __construct(){
        $this->commentModel =  $this->model('Comment');
    }
    public function add($post_id , $user_id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST , FILTER_SANITIZE_STRING);
            $data = [
                'comment' => trim($_POST['comment']),
                'post_id' => $post_id,
                'user_id' => $user_id,
            ];
            if(empty($data['comment'])){
                redirect('posts/show/'.$post_id.'');
            }else{
                if($this->commentModel->addComment($data)){
                    flash('comment' , 'Comment Added');
                    redirect('posts/show/'.$post_id.'');
                }else{
                    die('something wrong try later');
                }
            }
        }else {
            redirect('posts');
        }
    }
}