<?php
require_once(substr(__DIR__,0,strrpos(__DIR__,'application')).'router.php');
require_once Router::$Config['Language'];
require_once Router::$Config['Settings']['Update'];
session_start();
?>
<div class="w3-card-4 w3-margin w3-white">
    <div class="w3-container w3-teal">
        <h2><?php echo Language::$LANG['UI']['Title']['BlogSettings']; ?></h2>
    </div>
    <div class="w3-container w3-padding-32">
        <div class="w3-container">
            <div class=" w3-padding-16 w3-bar">
                <div class="w3-col l12 m12 s12" style="display: flex;">
                    <label class="w3-light-gray w3-bar-item w3-col l10 m10 s10" style="flex:1;"><b><?php echo Language::$LANG['Entry']['Blog']['Home']; ?></b></label>
                </div>
                <div class="w3-col l12 m12 s12" style="display: flex;">
                    <label class="w3-text-gray w3-bar-item w3-col l10 m10 s10" style="flex:1;"><b><?php echo Language::$LANG['Entry']['Blog']['About']; ?></b></label>
                    <button id="AboutButton" class="w3-button w3-border w3-green w3-col l1 m1 s1 my-bold w3-right" onclick="ToggleAbout();" style="width: 50px;"><i class="fa fa-toggle-on"></i></button>
                </div>
                <div class="w3-col l12 m12 s12" style="display: flex;">
                    <label class="w3-light-gray w3-bar-item w3-col l10 m10 s10" style="flex:1;"><b><?php echo Language::$LANG['Entry']['Blog']['Contact']; ?></b></label>
                    <button id="ContactButton" class="w3-button w3-border w3-green w3-col l1 m1 s1 my-bold w3-right" onclick="ToggleContact();" style="width: 50px;"><i class="fa fa-toggle-on"></i></button>
                </div>

            </div>
        </div>
        <div class="w3-row w3-padding-16">
            <div class="w3-col s12 m1 l1 my-button ">
                <p><button class="w3-button w3-padding-large w3-white w3-border w3-col l12 m12 s12" onclick="ServeContent('EntryList');"><b> <?php echo Language::$LANG['UI']['Button']['Back']; ?></b></button></p>
            </div>
            <div class="w3-col s12 m1 l1 my-button w3-right">
                <p><button class="w3-button w3-padding-large w3-teal w3-text-white w3-border w3-col l12 m12 s12" onclick="ServeContent('EntryList');"><b> <?php echo Language::$LANG['UI']['Button']['NewEntry']; ?></b></button></p>
            </div>
        </div>
    </div>
    <div class="w3-container w3-teal w3-center">
        <h4> </h4>
    </div>
</div>
<script>
    function ToggleAbout() {
        request = $.ajax({
            type: "POST",
            url: "./content.php",
            data: {
                type: "Settings",
                url: "AboutPage"
            }
        });
        request.done(function (response) {
            Button = $("#AboutButton");

            if (Button.hasClass('w3-green')) {
                Button.removeClass('w3-green');
                Button.addClass('w3-red');
                Button.find('i').removeClass('fa-toggle-on');
                Button.find('i').addClass('fa-toggle-off');
            }
            else {
                Button.removeClass('w3-red');
                Button.addClass('w3-green');
                Button.find('i').removeClass('fa-toggle-off');
                Button.find('i').addClass('fa-toggle-on');
            }

        });
    }
    function ToggleContact() {
        request = $.ajax({
            type: "POST",
            url: "./content.php",
            data: {
                type: "Settings",
                url: "ContactPage"
            }
        });
        request.done(function (response) {
        Button = $("#ContactButton");

        if (Button.hasClass('w3-green')) {
            Button.removeClass('w3-green');
            Button.addClass('w3-red');
            Button.find('i').removeClass('fa-toggle-on');
            Button.find('i').addClass('fa-toggle-off');
        }
        else {
            Button.removeClass('w3-red');
            Button.addClass('w3-green');
            Button.find('i').removeClass('fa-toggle-off');
            Button.find('i').addClass('fa-toggle-on');
        }

        });
    }
</script>


