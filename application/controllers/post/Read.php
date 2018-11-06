<?php
require_once(substr(__DIR__,0,strrpos(__DIR__,'application')).'router.php');
require_once Router::$Models['Post'];
require_once Router::$Config['Database'];
require_once Router::$Config['Language'];
session_start();

function GetPosts()
{
    global $DB_CONFIG;

    $db = new PDO('mysql:host=' . $DB_CONFIG['host'] . ';dbname=' . $DB_CONFIG['database'].';charset=utf8', $DB_CONFIG['username'], $DB_CONFIG['password']);
    $Query = $db->prepare("SELECT * from posts");
    $Query->execute();

    $PostsList = $Query->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC);
    $Ids = array_keys($PostsList);
    $Posts = array();
    for ($i = 0; $i < count($PostsList); $i++) {
        $Posts[$i] = $PostsList[$Ids[$i]][0];
        $Posts[$i]['Id']=$Ids[$i];
    }

    return $Posts;
}

?>