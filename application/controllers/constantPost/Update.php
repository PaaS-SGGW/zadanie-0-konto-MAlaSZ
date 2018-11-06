<?php
require_once(substr(__DIR__,0,strrpos(__DIR__,'application')).'router.php');
require_once Router::$Models['ConstantPost'];
require_once Router::$Config['Database'];
require_once Router::$Config['Language'];
session_start();
function Update($Id, $Type, $Language, $Title,  $Content, $ImageId) {
    global $DB_CONFIG;
    if(strlen($Id) == 0)
        return;
    if(strlen($Title)==0)
        return Language::$LANG['UI']['Error']['TitleEmpty'];
    if($Content=="<p><br></p>")
        return Language::$LANG['UI']['Error']['ContentEmpty'];
    if(strlen($Language)!=5)
        return Language::$LANG['UI']['Error']['LangEmpty'];
    if(!is_numeric( $Type ) )
        return Language::$LANG['UI']['Error']['TypeIncorrect'];
    if(strlen($ImageId)==0)
        return Language::$LANG['UI']['Error']['ImageEmpty'];

    try{
        $ConstantPost = new ConstantPost($Id,$Language, $Type, $Title, $Content, $ImageId);

        $db = new PDO('mysql:host=' . $DB_CONFIG['host'] . ';dbname=' . $DB_CONFIG['database'].';charset=utf8', $DB_CONFIG['username'], $DB_CONFIG['password']);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE constantposts SET Language = ?, Type = ?, Title = ?, Content = ?, ImageId = ? WHERE Id = ?";
        $Query = $db->prepare($sql);
        $Query->execute(array($ConstantPost->Language, $ConstantPost->Type, $ConstantPost->Title, $ConstantPost->Content, $ConstantPost->ImageId, $ConstantPost->Id));
        echo "OK";

    }
    catch (PDOException $e)
    {
        echo $e;
    }
}



?>