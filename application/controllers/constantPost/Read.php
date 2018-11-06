<?php
require_once(substr(__DIR__,0,strrpos(__DIR__,'application')).'router.php');
require_once Router::$Models['ConstantPost'];
require_once Router::$Config['Database'];
require_once Router::$Config['Language'];
/**
 * Created by PhpStorm.
 * User: malasz
 * Date: 19.06.17
 * Time: 16:46
 */
session_start();
    function GetConstantPosts()
    {
        global $DB_CONFIG;

        $db = new PDO('mysql:host=' . $DB_CONFIG['host'] . ';dbname=' . $DB_CONFIG['database'].';charset=utf8', $DB_CONFIG['username'], $DB_CONFIG['password']);
        $Query = $db->prepare("SELECT * from constantposts");
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