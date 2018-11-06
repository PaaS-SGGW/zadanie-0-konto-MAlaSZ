<?php
require_once(substr(__DIR__,0,strrpos(__DIR__,'application')).'router.php');
require_once Router::$Config['Language'];
require_once Router::$Controllers['ConstantPost']['Read'];
require_once Router::$Controllers['Image']['List'];
session_start();

$Posts = GetConstantPosts();
$Images = GetPictures();


$ContactPosts = array();
$Post = null;
for ($i=0; $i < count($Posts); $i++)
    if($Posts[$i]['Type'] == 3){
        if($Posts[$i]->Language == $_SESSION['Lang'])
            $Post = $Posts[$i];
        array_push($ContactPosts,$Posts[$i]);
    }

    if($Post == null && count($ContactPosts) > 0)
        $Post = $ContactPosts[0];
    if($Post)
    {
        $Images = GetPictures();
        for($i=0; $i < count($Images); $i++)
            if($Images[$i]->Id == $Post['ImageId'])
                $Image = $Images[$i];
        echo '<div class="w3-row"><div class="w3-col s8 m8 l8 w3-card-4 w3-margin w3-white my-center" style="margin-left:16.66666% !important;">';
        echo '<img src="'.Router::$Media['Pictures'].$Image->Path.'" alt="'.$Image->Name.'" style="width:100%; max-height:600px;">';
        echo '<div class="w3-container"><h3 title="ArticleTitle" class="my-uppercase w3-center"><b>'.$Post['Title'].'</b></h3>';
        echo '</div><div class="w3-container"><div class="w3-col l10 m10 s10 w3-justify my-center">';
        echo '<p title="ArticleContent" >'.$Post['Content'].'</p>';
        echo '</div></div></div></div><hr>';
    }
    else
        require_once Router::$Views['404'];

?>
