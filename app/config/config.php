<?php
session_start();

// DB Params
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'appchat');

// App Root
define('APPROOT', dirname(dirname(__FILE__)));
// URL Root
define('URLROOT', 'http://localhost/MokhlisBelhaj_chat/');
// Site Name
define('SITENAME', 'appchat');
function isLoggedIn(){
    if(isset($_SESSION['user_id'])){
        return true;
    }else{
        return false;
    }
}

  function redirect($page){
    header('Location:'.URLROOT.$page);

}