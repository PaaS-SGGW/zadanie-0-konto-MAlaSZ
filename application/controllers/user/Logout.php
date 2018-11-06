<?php


function Logout() {
                session_start();
                unset($_SESSION['loggedIn']);
                unset($_SESSION['User']);
                session_destroy();
}

?>