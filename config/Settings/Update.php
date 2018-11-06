<?php

require_once(substr(__DIR__,0,strrpos(__DIR__,'config')).'router.php');
require_once Router::$Config['Database'];

require_once Router::$Config['Settings']['Read'];

function UpdateSettings($Id, $Value) {
    global $DB_CONFIG;

    try{
        $db = new PDO('mysql:host=' . $DB_CONFIG['host'] . ';dbname=' . $DB_CONFIG['database'], $DB_CONFIG['username'], $DB_CONFIG['password']);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE settings SET Value = ? WHERE Id = ?";
        $Query = $db->prepare($sql);
        $Query->execute(array($Value, $Id));
        echo "OK";

    }
    catch (PDOException $e)
    {
        echo $e;
    }
}



?>
