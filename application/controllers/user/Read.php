<?php


require_once(substr(__DIR__,0,strrpos(__DIR__,'application')).'router.php');
require_once Router::$Config['Database'];
session_start();

function GetUserName($Id) {
    global $DB_CONFIG;
    $db = new PDO('mysql:host=' . $DB_CONFIG['host'] . ';dbname=' . $DB_CONFIG['database'].';charset=utf8', $DB_CONFIG['username'], $DB_CONFIG['password']);
    $Query = $db->prepare("SELECT * from users WHERE id = ?");
    $Query->execute(array($Id));

    $User = $Query->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC);
    $Ids = array_keys($User);
    return $User[$Ids[0]][0]['Name'];
}
/**
 * Created by PhpStorm.
 * User: malasz
 * Date: 18.06.17
 * Time: 19:33
 */