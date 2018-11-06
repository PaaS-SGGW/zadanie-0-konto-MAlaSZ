<?php

require_once(substr(__DIR__,0,strrpos(__DIR__,'application')).'router.php');
require_once Router::$Config['Language'];
session_start();

?>
<div id="select-lang-modal" class="w3-modal">
    <div class="w3-modal-content">

        <header class="w3-container w3-teal">
<!--            <span onclick="$('#select-lang-modal').css('display','none');" class="w3-button w3-display-topright">&times;</span>-->
            <h5><?php echo Language::$LANG['UI']['Title']['SelectLanguage'];?></h5>
        </header>

        <div class="w3-container">
            <div class="w3-padding-16">
                <select id='SelectedLanguage' class="w3-select" name="background">
                    <option value="" disabled selected><?php echo Language::$LANG['UI']['PostForm']['SelectLang'];?></option>
                    <?php
                    $lang_keys = array_keys(Language::$OPTIONS);
                    for($i = 0; $i < count(Language::$OPTIONS); $i++)
                        echo '<option value="'.$lang_keys[$i].'">'.Language::$OPTIONS[$lang_keys[$i]].'</option>';
                    ?>
                </select>
            </div>
            <div class="w3-row w3-padding-16">
                <div class="w3-col s12 m2 l2 my-button ">
                    <p><button class="w3-button w3-padding-large w3-white w3-border w3-col l12 m12 s12" onclick="$('#select-lang-modal').css('display','none');"><b> <?php echo Language::$LANG['UI']['Button']['Cancel'];?></b></button></p>
                </div>
                <div class=" w3-col s12 m2 l2 w3-right my-button">
                    <p><button class="w3-button w3-padding-large w3-border w3-teal w3-text-white w3-col l12 m12 s12" onclick="SetLang();"><b> <?php echo Language::$LANG['UI']['Button']['OK'];?></b></button></p>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function SetLang() {
        request = $.ajax({
            type: "POST",
            url: "./content.php",
            data: {
                type: "Lang",
                url: "Set",
                Language: $('#SelectedLanguage').val()
            }
        });
        request.done(function (response) {
            window.location.reload();
        });

    }
</script>