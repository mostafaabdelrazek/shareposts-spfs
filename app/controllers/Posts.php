<?php

class Posts extends Controller{

    public function __construct(){
        if(!isLoggedIn()){
            redirect('users/login');
        }
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
        $this->commentModel = $this->model('Comment');
    }

    public function index(){
        //Get Posts
        $posts = $this->postModel->getPosts();
        $data = [
            'posts' => $posts
        ];
        $this->view('posts/index' , $data);
    }
    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST Array 
            $_POST = filter_input_array(INPUT_POST , FILTER_SANITIZE_STRING);
            //validate data
            $data = [
                'title' =>  trim($_POST['title']),
                'body' =>  trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];
            // validate title 
            if(empty($data['title'])){
                $data['title_err'] = 'please fill title';
            }
            if(empty($data['body'])){
                $data['body_err'] = 'please fill body';
            }

            //sure no errors
            if(empty($data['title_err']) && empty($data['body_err'])){
                //validated 
                if($this->postModel->addPost($data)){
                    flash('post_message' , 'you add new post successfully');
                    redirect('posts');
                }else{
                    die('something wrong try again');
                }
            }else{
                $this->view('posts/add' , $data);
            }
        }else{   
            $data = [
                'title' => '' ,
                'body' => '',
            ];
            
            $this->view('posts/add' , $data);
        }
    }

    public function show($id){
        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post->user_id);
        $comments = $this->commentModel->getCommentsByPostId($id);
        $data = [
            'post' => $post,
            'user' => $user,
            'comments' => $comments
        ];
        $this->view('posts/show' , $data);
    }

    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST' ){
            // Sanitize POST Array 
            $_POST = filter_input_array(INPUT_POST , FILTER_SANITIZE_STRING);
            //validate data
            $data = [
                'id' => $id,
                'title' =>  trim($_POST['title']),
                'body' =>  trim($_POST['body']),
               // 'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];
            // validate title 
            if(empty($data['title'])){
                $data['title_err'] = 'please fill title';
            }
            if(empty($data['body'])){
                $data['body_err'] = 'please fill body';
            }

            //sure no errors
            if(empty($data['title_err']) && empty($data['body_err'])){
                //validated 
                if($this->postModel->updatePost($data) ){
                    flash('post_message' , 'you add update post successfully');
                    redirect('posts');
                }else{
                    die('something wrong try again');
                }
            }else{
                $this->view('posts/edit' , $data);
            }
        }else{
            //get post 
            $post = $this->postModel->getPostById($id); 
            //check post owner
            if($post->user_id != $_SESSION['user_id']){
                redirect('posts');
            }

            $data = [
                'id' => $id,
                'title' => $post->title ,
                'body' => $post->body,
            ];
            
            $this->view('posts/edit' , $data);
        }
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
           //not neccessary 
            $post = $this->postModel->getPostById($id); 
            //check post owner
            if($post->user_id != $_SESSION['user_id']){
                redirect('posts');
            }

            $this->postModel->deletePost($id);
            flash('post_message' , 'you Delete post successfully' , 'alert alert-danger');
            redirect('posts');
        }else{
            redirect('posts');
        }
    }

}