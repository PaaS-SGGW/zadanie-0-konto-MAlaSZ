<?php
require_once(substr(__DIR__,0,strrpos(__DIR__,'application')).'router.php');
require_once Router::$Models['Post'];
require_once Router::$Config['Database'];
require_once Router::$Config['Language'];


function GetPostList()
{
    global $DB_CONFIG;
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $UserId = (get_object_vars($_SESSION['User'])[Id]);
    $db = new PDO('mysql:host=' . $DB_CONFIG['host'] . ';dbname=' . $DB_CONFIG['database'].';charset=utf8', $DB_CONFIG['username'], $DB_CONFIG['password']);
    $Query = $db->prepare("SELECT * from Posts WHERE UserId = ?");
    $Query->execute(array($UserId));

    $PostsList = $Query->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC);
    $Ids = array_keys($PostsList);
    $Posts = array();
    for ($i = 0; $i < count($PostsList); $i++) {
        $Posts[$i] = $PostsList[$Ids[$i]][0];
        $Posts[$i]['Id']=$Ids[$i];
    }

    return $Posts;
}

function GetBlogPageList()
{
    global $DB_CONFIG;
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $db = new PDO('mysql:host=' . $DB_CONFIG['host'] . ';dbname=' . $DB_CONFIG['database'].';charset=utf8', $DB_CONFIG['username'], $DB_CONFIG['password']);
    $Query = $db->prepare("SELECT * from Posts");
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