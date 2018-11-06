<?php
session_start();
//echo $_SESSION['entryid'];

require_once Router::$Config['Language'];
require_once Router::$Controllers['Post']['List'];
require_once Router::$Controllers['User']['Read'];
require_once Router::$Controllers['Image']['List'];

?>

    <?php
    $Posts = GetBlogPageList();
    for($i=0; $i < count($Posts); $i++)
        if($Posts[$i]['Id'] == $_SESSION['entryid'])
            $Post = $Posts[$i];
    $Images = GetPictures();
    echo count($Posts);
    for($i=0; $i < count($Images); $i++)
        if($Images[$i]->Id == $Post['ImageId'])
            $Image =$Images[$i];
    $Months= ['January', 'February', 'March','April','May','June','July','August','September', 'October','November','December'];
        echo '<div class="post" >';
        echo '<div id="'.$Post['Id'].'" class="entry w3-card-4 w3-margin w3-white">';
        echo '<img src="'.Router::$Media['Pictures'].$Image->Path.'" alt="'.$Image->Name.'" style="width:100%">';
        echo '<div class="w3-container">';
        echo '<h3 title="ArticleTitle" class="my-uppercase"><b>'.$Post['Title'].'</b></h3>';
        $Day = substr($Post['Date'],8,2);
        $Month = Language::$LANG['Entry']['Months'][$Months[date("n",strtotime($Post['Date']))]];

        $Year = substr($Post['Date'],0,4);
        echo '<h5>'.GetUserName($Post['UserId']).', <span class="w3-opacity">'.$Day.' '.$Month.' '.$Year.'</span></h5>';
        echo '<div class="w3-container">';
        echo '<p title="ArticleContent">'.str_replace('<img','<img style="width:100%;"',$Post['Content']).'</p>';
        echo '<div class="w3-row"><div class="w3-col m8 s12">';
        echo '<p><button class="w3-button w3-padding-large w3-white w3-border" onclick="ServeContent(\'Blog\');"><b> &laquo; '.Language::$LANG['UI']['Button']['Back'].'</b></button></p>';
        echo '</div></div></div></div></div><hr></div>';
    ?>
