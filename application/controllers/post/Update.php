<?php
require_once(substr(__DIR__,0,strrpos(__DIR__,'application')).'router.php');
require_once Router::$Models['Post'];
require_once Router::$Config['Database'];
require_once Router::$Config['Language'];
session_start();
function Update($Id, $Title, $ImageId, $UserId, $Content, $Summary, $Language){
    global $DB_CONFIG;
    if(strlen($Title)==0)
        return Language::$LANG['UI']['Error']['TitleEmpty'];
    if(strlen($ImageId)==0)
        return Language::$LANG['UI']['Error']['ImageEmpty'];
    if($Content=="<p><br></p>")
        return Language::$LANG['UI']['Error']['ContentEmpty'];
    if(strlen($Summary)==0)
        return Language::$LANG['UI']['Error']['SummaryEmpty'];
    if(strlen($Language)!=5)
        return Language::$LANG['UI']['Error']['LangEmpty'];


    try{
        $Post = new Post($Id,$Title,$ImageId,-1, $UserId, $Content, $Summary, $Language);
        $db = new PDO('mysql:host=' . $DB_CONFIG['host'] . ';dbname=' . $DB_CONFIG['database'].';charset=utf8', $DB_CONFIG['username'], $DB_CONFIG['password']);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE posts SET Title = ?, UserId = ?, Content = ?, Summary = ?, Language = ?, ImageId = ? WHERE Id=?";
        $Query = $db->prepare($sql);
        $Query->execute(array($Post->Title, $Post->UserID, $Post->Content, $Post->Summary, $Post->Language, $Post->ImageId, $Post->Id));
        echo "OK";
    }
    catch (PDOException $e)
    {
        echo $e;
    }

}

?>