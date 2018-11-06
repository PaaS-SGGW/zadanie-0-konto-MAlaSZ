<?php

function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

if(is_ajax())
{
    require_once (substr(__DIR__,0,strrpos(__DIR__,'public')).'router.php');
    $type = $_POST['type'];

    if($type == 'Login')
    {
        require_once Router::$Controllers['User']['Login'];

        $login = $_POST['login'];
        $password = $_POST['password'];
        Login($login,$password);
    }
    if($type == 'Logout')
    {
        require_once Router::$Controllers['User']['Logout'];
        Logout();
    }




}


?>