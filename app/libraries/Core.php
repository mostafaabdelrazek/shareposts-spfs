<?php

/**
 * App Core Class
 * creates URLs & Load core controller
 * URL Format - /controller/method/params
 */

class Core {
    
    protected $currentController    = 'Pages';
    protected $currentMethod        = 'index';
    protected $params               = [];

    public function __construct(){
        //url 
        $url = $this->getUrl();

        if(file_exists("../app/controllers/{$url[0]}.php")){
            //If exists , set as controller
            $this->currentController = ucwords($url[0]);
            // Unset 0 Index 
            unset($url[0]);
        }

        // Rerquire the controller 
        require_once "../app/controllers/{$this->currentController}.php";

        //Instantiate controller class 
        $this->currentController = new $this->currentController;

        //check for action of url 
        if(isset($url[1])){
            //check to see if method exists in controller
            if(method_exists($this->currentController , $url[1])){
                $this->currentMethod = $url[1];
             // Unset index 1
                unset($url[1]);
            }else{
                //TODO::Redirect to 404 Not found page
            }
        }

        //check for params
        $this->params = $url ? array_values($url) : [];

        // call a callback with array of params
        call_user_func_array([
            $this->currentController ,
             $this->currentMethod
             ],
              $this->params
        );
    }


    public function getUrl(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'] , '/');
            $url = filter_var($url , FILTER_SANITIZE_URL);
            $url = explode('/' , $url);
            return $url;
        }
    }

}
