<?php
require_once(substr(__DIR__,0,strrpos(__DIR__,'application')).'router.php');
require_once Router::$Config['Language'];
require_once Router::$Controllers['Post']['List'];
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<div class="w3-card-4 w3-margin w3-white">
    <div class="w3-container w3-teal">
        <h2><?php echo Language::$LANG['UI']['Title']['PostList'];?></h2>
    </div>
    <div class="w3-container w3-padding-32">
        <div class="w3-container">
            <div id="Posts" class=" w3-padding-16 w3-bar">
                <?php
                $Posts = GetPostList();
                for($i=0; $i < count($Posts); $i++) {
                    echo '<div id="'.$Posts[$i]['Id'].'" class="w3-col l12 m12 s12 post" style="display: flex;">';
                    if($i%2==0)
                        echo '<label id="Label'.$i.'" class="w3-light-gray w3-bar-item w3-col l10 m10 s10" style="flex:1;"><b>' . $Posts[$i]['Title'] . '</b></label>';
                    else
                        echo '<label id="Label'.$i.'"  class="w3-text-gray w3-bar-item w3-col l10 m10 s10" style="flex:1;"><b>' . $Posts[$i]['Title'] . '</b></label>';
                    echo '<button id="'.$Posts[$i]['Id'].'" class="w3-button w3-border w3-teal w3-col l1 m1 s1 my-bold w3-right" onclick="EditPost('.$Posts[$i]['Id'].');" style="width: 50px;"><i class="fa fa-edit"></i></button>';
                    echo '<button id="'.$Posts[$i]['Id'].'" class="w3-button w3-border w3-red w3-col l1 m1 s1 my-bold w3-right" onclick="DeletePost('.$Posts[$i]['Id'].');" style="width: 50px;"><i class="fa fa-trash"></i></button>';
                    echo '</div>';
                }

                ?>
            </div>
        </div>
        <div class="w3-row w3-padding-16">
            <div class="w3-col s12 m1 l1 my-button w3-right">
                <p><button class="w3-button w3-padding-large w3-teal w3-text-white w3-border w3-col l12 m12 s12" onclick="NewEntry();"><b> <?php echo Language::$LANG['UI']['Button']['NewEntry']; ?></b></button></p>
            </div>
        </div>
    </div>


    <div class="w3-container w3-teal w3-center my-pagination">
        <?php
            $pages = 1+count($Posts)/8;
            $pages = ($pages < 2) ? 0 : $pages;
            for($i = 1; $i < $pages; $i++)
                echo "<a class='w3-button' onclick='ShowPage(".($i-1).");'>".$i."</a>";
        ?>
    </div>

</div>

<script>

    var Page = 0;
    function ShowPage(Id) {
        Posts = $("#Posts").find(".post");
        for(var i = 0; i < Posts.length ; i++)
            $(Posts[i]).css('display',"none");

        for(var i = Id*8; i < Id*8+Math.min(Posts.length-Id*8,8) ; i++)
            $(Posts[i]).css('display',"flex");
    }

    function DeletePost(Id) {
            request = $.ajax({
                type: "POST",
                url: "./content.php",
                data: {type:"Post",url:"Delete", Id:Id}
            });

            request.done(
                function ( response ) {

                    PostsCount = $("#Posts").find(".post").length;
                    start = parseInt($("#Posts").find("#"+Id).find("label").attr('id').substr(5))+1;
                    end = parseInt($("#Posts").find("label").last().attr('id').substr(5))+1;
                    for(var i = start; i < end; i++ )
                    {
                        Post = $("#Label"+i);
                        if(Post.hasClass("w3-text-gray")) {
                            Post.removeClass("w3-text-gray");
                            Post.addClass("w3-light-gray");
                        }
                        else {
                            Post.addClass("w3-text-gray");
                            Post.removeClass("w3-light-gray");
                        }
                    }
                    $("#Posts").find("#"+Id).remove();
                    ShowPage(Page);
                });

    }
    function EditPost(Id) {
            request = $.ajax({
                type: "GET",
                url: "./content.php",
                data: {type:"Post",url:"Edit", Id:Id}
            });
            request.done(
                function ( response ) {
                    $("#content").fadeOut(500, function () {
                        $(this).html(response).fadeIn(500);
                    });
                });
    }
    function NewEntry() {
        ServeContent("AddEntry");
    }

    ShowPage(0);



</script>