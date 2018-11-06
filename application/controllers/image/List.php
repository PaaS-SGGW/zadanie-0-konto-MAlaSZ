<?php
/**
 * Created by PhpStorm.
 * User: malasz
 * Date: 18.06.17
 * Time: 11:14
 */

    require_once(substr(__DIR__,0,strrpos(__DIR__,'application')).'router.php');
    require_once Router::$Models['Image'];
    require_once Router::$Config['Database'];

    function GetPictures() {
        $PicturesArray = array();
        global $DB_CONFIG;
        try {
            $db = new PDO('mysql:host=' . $DB_CONFIG['host'] . ';dbname=' . $DB_CONFIG['database'].';charset=utf8', $DB_CONFIG['username'], $DB_CONFIG['password']);
            $Query = $db->prepare("SELECT * from images");
            $Query->execute();
            $Images = $Query->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC);
            $Ids = array_keys($Images);
            for($i=0; $i < count($Images); $i++)
               $PicturesArray[$i] = new Image($Ids[$i],$Images[$Ids[$i]][0]['Name'],$Images[$Ids[$i]][0]['Path']);
            return $PicturesArray;

        }
        catch (PDOException $e) {
            echo "Error!: " . $e->getMessage() . "<br/>";
            die();
        }

    }
?>