<?php
require_once(substr(__DIR__,0,strrpos(__DIR__,'application')).'router.php');
require_once Router::$Config['Language'];
require_once Router::$Controllers['Post']['Read'];
require_once Router::$Controllers['User']['Read'];
require_once Router::$Controllers['Image']['List'];
session_start();
?>
<div id='Articles' class="w3-col l9 m12 s12">
<?php
    $Posts = GetPosts();
    $Images = GetPictures();
    $Months= ['January', 'February', 'March','April','May','June','July','August','September', 'October','November','December'];
    for($i = 0; $i < count($Posts); $i++)
    {
	if($Posts[$i]['Language']==$_SESSION['Lang'])
	{
        $Images = GetPictures();
        $Image = null;
        for($j=0; $j < count($Images); $j++)
            if($Images[$j]->Id == $Posts[$i]['ImageId'])
                $Image = $Images[$j];

        echo '<div class="post" >';
        echo '<div id="'.$Posts[$i]['Id'].'" class="entry w3-card-4 w3-margin w3-white">';
        if($Image)
            echo '<img src="'.Router::$Media['Pictures'].$Image->Path.'" alt="'.$Image->Name.'" style="width:100%; max-height:500px;">';

        echo '<div class="w3-container">';
            echo '<h3 title="ArticleTitle" class="my-uppercase"><b>'.$Posts[$i]['Title'].'</b></h3>';
            $Day = substr($Posts[$i]['Date'],8,2);
            $Month = Language::$LANG['Entry']['Months'][$Months[date("n",strtotime($Posts[$i]['Date']))]];

            $Year = substr($Posts[$i]['Date'],0,4);
            echo '<h5>'.GetUserName($Posts[$i]['UserId']).', <span class="w3-opacity">'.$Day.' '.$Month.' '.$Year.'</span></h5>';
        echo '<div class="w3-container">';
        echo '<p title="ArticleSummary">'.$Posts[$i]['Summary'].'</p>';
        echo '<div class="w3-row"><div class="w3-col m8 s12">';
        echo '<p><button class="w3-button w3-padding-large w3-white w3-border" onclick="LoadEntry('.$Posts[$i]['Id'].');"><b>'.Language::$LANG['UI']['Button']['ReadMore'].' &raquo;</b></button></p>';
        echo '</div></div></div></div></div><hr></div>';
	}
    }
?>
</div>

    <div class="w3-col l3 m12 s12">
      <?php include('partials/calendar.php'); ?>
    </div>

    <div class="w3-col l9 m12 s12 ">
        <div class="w3-bar w3-center my-pagination">

            <?php
                $pages = 1+count($Posts)/4;
                $pages = ($pages < 2) ? 0 : $pages;
                for($i = 1; $i < $pages; $i++)
                    echo "<a id='pagination-".$i."' class='w3-button' onclick='ShowPage(".($i-1).");'>".$i."</a>";
                //echo "<a href='#' class='w3-button'>".$i."</a>";  ?>
        </div>
    </div>

<script>
    var Page = 0;
    function ShowPage(Id) {

        Posts = $("#Articles").find(".post");

        for(var i = 0; i < <?php echo $pages; ?>; i++)
            $('#pagination-'+i).removeClass('w3-teal');
        $('#pagination-'+(Id+1)).addClass('w3-teal');
        for(var i = 0; i < Posts.length ; i++)

            $(Posts[i]).css('display',"none");

        for(var i = Id*4; i < Id*4+Math.min(Posts.length-Id*4,4) ; i++)
            $(Posts[i]).css('display',"block");
        $("html, body").animate({ scrollTop: 0 }, "slow");
    }

    ShowPage(0);
</script>
