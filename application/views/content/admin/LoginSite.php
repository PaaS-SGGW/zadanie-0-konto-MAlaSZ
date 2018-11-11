<?php
    require_once(substr(__DIR__,0,strrpos(__DIR__,'application')).'router.php');
    require_once Router::$Config['Language'];
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>
<div id="bad-login-modal" class="w3-modal">
    <div class="w3-modal-content">

        <header class="w3-container w3-red">
            <span onclick="$('#bad-login-modal').css('display','none');" class="w3-button w3-display-topright">&times;</span>
            <h2><?php echo Language::$LANG['UI']['LoginUnsuccessful']; ?></h2>
        </header>

        <div class="w3-container">
            <p><?php echo Language::$LANG['UI']['BadLoginOrPassword']; ?> </p>
        </div>

    </div>
</div>

<div class="w3-card-4 w3-margin w3-white w3-center w3-col l8 m8 s12 my-center">
    <div class="w3-container w3-teal">
        <h2>Login</h2>
    </div>
    <div class="w3-container w3-padding-32">
        <form class="w3-container">
            <div class=" w3-padding-16">
                <label class="w3-text-teal"><b>Login:</b></label>
                <input id="loginInput" class="w3-input w3-border w3-text-black" type="text" style="width:100%">
            </div>

            <div class=" w3-padding-16">
                <label class="w3-text-teal"><b>Password:</b></label>
                <input id="passwordInput" class="w3-input w3-border w3-text-black" type="password" style="width:100%">
            </div>
            <div class="w3-padding-16 w3-col s12 m12 l12 my-button">
                <p><button class="w3-button w3-padding-large w3-border w3-teal w3-text-white w3-col l12 m12 s12" onclick="Login();" type="submit"><b> Login</b></button></p>
            </div>
        </form>

    </div>
</div>