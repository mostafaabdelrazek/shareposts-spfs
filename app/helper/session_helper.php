<?php
    session_start();

    // Flash Messege helper
    // EXAMPLE - flash('regiser_success' , 'You are now registered' , 'alert alert-warrning');
    //TODO:: make array of messages in session class that apear and deleted from flash method at frist
    function flash($name = '' , $message = '' , $class = 'alert alert-success'){
        if(!empty($name)){
            if(!empty($message) && empty($_SESSION[$name])){
                $_SESSION[$name] = $message;
                $_SESSION[$name . '_class'] = $class;
            }elseif(empty($message) && !empty($_SESSION[$name])){
                echo "<div class='".$_SESSION[$name . '_class']."' id='msg-flash'> "  .$_SESSION[$name] . " </div>";
                unset($_SESSION[$name]);
                unset($_SESSION[$name . '_class']);
            }
        }

    }

    //check loggedin user

    function isLoggedIn(){
        if(isset($_SESSION['user_id'])){
            return true;
        }else{
            return false;
        }
    }