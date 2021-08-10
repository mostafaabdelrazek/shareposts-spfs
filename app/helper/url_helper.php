<?php
// Simple page redirect 
function redirect($page = null){
    header("location:" . URLROOT ."/$page" );
}