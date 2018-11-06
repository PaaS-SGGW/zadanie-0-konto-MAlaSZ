<?php
require_once(substr(__DIR__,0,strrpos(__DIR__,'application')).'router.php');
require_once Router::$Models['Post'];
require_once Router::$Config['Database'];
session_start();
function Delete($Id){
    global $DB_CONFIG;


    try{
        $db = new PDO('mysql:host=' . $DB_CONFIG['host'] . ';dbname=' . $DB_CONFIG['database'].';charset=utf8', $DB_CONFIG['username'], $DB_CONFIG['password']);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "DELETE FROM posts WHERE Id=?";
        $Query = $db->prepare($sql);
        $Query->execute(array($Id));
        echo "OK";

    }
    catch (PDOException $e)
    {
        echo $e;
    }

}

?>