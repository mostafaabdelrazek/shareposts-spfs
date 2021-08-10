<?php 
/**
 * Base Controller 
 * Loads the models and views
 */
class Controller {
    // Load model 
    public function model($model){
        // require model file here
        require_once "../app/models/{$model}.php";
        //instantiate Model 
        return new $model();
    }

    // Load view
    public function view($view , $data = []){
        /*
        //TODO::make the key of array independant variable
        foreach($data as $single => $val){
            ${$single} = $val;
        }
        */
        // check for the view file
        if(file_exists("../app/views/{$view}.php")){
           return require_once "../app/views/{$view}.php";
            
        } else {
            die('view doesn\'t exist');
        }
    }
}