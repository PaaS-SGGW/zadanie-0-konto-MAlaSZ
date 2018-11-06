<?php
require_once(substr(__DIR__,0,strrpos(__DIR__,'config')).'router.php');
require_once Router::$Config['Database'];

function ReadSettings() {
    global $DB_CONFIG;

    $db = new PDO('mysql:host=' . $DB_CONFIG['host'] . ';dbname=' . $DB_CONFIG['database'], $DB_CONFIG['username'], $DB_CONFIG['password']);
    $Query = $db->prepare("SELECT * from settings");
    $Query->execute();

    $Settings = $Query->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC);
    $Ids = array_keys($Settings);
    $Sets = array();
    for ($i = 0; $i < count($Settings); $i++)
        $Sets[$Ids[$i]] = $Settings[$Ids[$i]][0]['Value'];

    return $Sets;
}
?>
