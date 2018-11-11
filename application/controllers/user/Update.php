<?php


require_once(substr(__DIR__,0,strrpos(__DIR__,'application')).'router.php');
require_once Router::$Config['Database'];
require_once Router::$Config['Language'];
require_once Router::$Models['User'];
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function Update($User) {
    global $DB_CONFIG;

    $db = new PDO('mysql:host=' . $DB_CONFIG['host'] . ';dbname=' . $DB_CONFIG['database'].';charset=utf8', $DB_CONFIG['username'], $DB_CONFIG['password']);

    $Query = $db->prepare("UPDATE Users SET Name = ?, Login = ?, Password = ?, Salt = ?, Language = ? WHERE Id=?");
    $Query->execute(array($User->Name, $User->Login,$User->Password,$User->Salt,$User->Language, $User->Id));
    $Query->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC);
    $_SESSION['User'] = $User;
    $_SESSION['Lang'] = $User->Language;
    echo "OK";
}
/**
 * Created by PhpStorm.
 * User: malasz
 * Date: 18.06.17
 * Time: 19:33
 */