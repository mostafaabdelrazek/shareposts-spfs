<?php 

class Pages extends Controller{
    
    public function __construct(){
    
    }
    public function index(){
        if(isLoggedIn()){
            redirect('posts');
        }
        $data =  [
            'title' => 'Share Posts',
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Architecto, tempora expedita consequatur nostrum est nulla porro voluptatum laboriosam officia corporis modi aspernatur in minima 
                                 recusandae cupiditate pariatur aliquid magnam nisi.',
        ];
        $this->view('pages/index' ,$data);
    }

    public function about(){
        $data = [
            'title' => 'About Us' , 
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Architecto, tempora expedita consequatur nostrum est nulla porro voluptatum laboriosam officia corporis modi aspernatur in minima 
            recusandae cupiditate pariatur aliquid magnam nisi.',
        ];

        $this->view('pages/about' , $data);
    }
}