<?php
require_once(substr(__DIR__,0,strrpos(__DIR__,'application')).'router.php');
require_once Router::$Config['Language'];
require_once Router::$Models['User'];
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}



$User = new User(
    (get_object_vars($_SESSION['User'])[Id]),
    (get_object_vars($_SESSION['User'])[Name]),
    (get_object_vars($_SESSION['User'])[Login]),
    (get_object_vars($_SESSION['User'])[Password]),
    (get_object_vars($_SESSION['User'])[Salt]),
    (get_object_vars($_SESSION['User'])[Language])
);
foreach(get_object_vars($_SESSION['User']) as $t)
    error_log($t);
?>
<link href="https://cdn.quilljs.com/1.2.6/quill.snow.css" rel="stylesheet">
<div id='A01' class="w3-card-4 w3-margin w3-white">
    <div class="w3-container w3-teal">
        <h2><?php echo Language::$LANG['UI']['Title']['AccountSettings'];?></h2>
    </div>
    <div class="w3-container w3-padding-32">
        <form class="w3-container">
            <div class=" w3-padding-16">
                <label class="w3-text-teal"><b><?php echo Language::$LANG['UI']['PostForm']['Name'];?></b></label>
                <input id="FormName" class="w3-input w3-border w3-text-black" type="text" style="width:100%">
            </div>
            <div class=" w3-padding-16">
                <label class="w3-text-teal"><b><?php echo Language::$LANG['UI']['PostForm']['Login'];?></b></label>
                <input id="FormLogin" class="w3-input w3-border w3-text-black" type="text" style="width:100%">
            </div>

            <div class=" w3-padding-16">
                <label class="w3-text-teal"><b><?php echo Language::$LANG['UI']['PostForm']['Password'];?></b></label>
                <input id="FormPassword" class="w3-input w3-border w3-text-black" type="password" style="width:100%">
            </div>

            <div class=" w3-padding-16">
                <label class="w3-text-teal"><b><?php echo Language::$LANG['UI']['PostForm']['ConfirmPassword'];?></b></label>
                <input id="FormConfirmPassword" class="w3-input w3-border w3-text-black" type="password" style="width:100%">
            </div>
            <div class="w3-padding-16">
                <select id='FormLanguage' class="w3-select" name="background">
                    <option value="" disabled selected><?php echo Language::$LANG['UI']['PostForm']['SelectLang'];?></option>
                    <?php
                    $lang_keys = array_keys(Language::$OPTIONS);
                    for($i = 0; $i < count(Language::$OPTIONS); $i++)
                        echo '<option value="'.$lang_keys[$i].'">'.Language::$OPTIONS[$lang_keys[$i]].'</option>';
                    ?>
                </select>
            </div>

        </form>
        <div class="w3-row w3-padding-16">
            <div class="w3-col s12 m1 l1 my-button ">
                <p><button class="w3-button w3-padding-large w3-white w3-border w3-col l12 m12 s12" onclick="ServeContent('EntryList');"><b> <?php echo Language::$LANG['UI']['Button']['Back'];?></b></button></p>
            </div>
            <div class=" w3-col s12 m1 l1 w3-right my-button">
                <p><button class="w3-button w3-padding-large w3-border w3-teal w3-text-white w3-col l12 m12 s12" onclick="UpdateAccount();"><b> <?php echo Language::$LANG['UI']['Button']['Save'];?></b></button></p>
            </div>
        </div>
    </div>
</div>



<!-- Initialize Quill editor -->
<script>
    function SetValues() {
        $("#FormName").val('<?php echo $User->Name; ?>');
        $("#FormLogin").val('<?php echo $User->Login; ?>');
        $("#FormLanguage").val('<?php echo $User->Language; ?>');
    }
    function UpdateAccount() {
        if($('#FormName').val().length === 0) {
            ShowError(<?php echo "'".Language::$LANG['UI']['Error']['CannotSendPost'] . "','" . Language::$LANG['UI']['Error']['EmptyName'].'a'."'"; ?>);
            return 0;
        }
        if($('#FormLogin').val().length === 0) {
            ShowError(<?php echo "'".Language::$LANG['UI']['Error']['CannotSendPost'] . "','" . Language::$LANG['UI']['Error']['EmptyLogin'].'b'."'"; ?>);
            return;
        }
        if($('#FormLogin').val().length < 5) {
            ShowError(<?php echo "'".Language::$LANG['UI']['Error']['CannotSendPost'] . "','" . Language::$LANG['UI']['Error']['LoginTooShort'].'c'."'"; ?>);
            return;
        }
        if($('#FormPassword').val().length === 0) {
            ShowError(<?php echo "'".Language::$LANG['UI']['Error']['CannotSendPost'] . "','" . Language::$LANG['UI']['Error']['EmptyPassword'].'c'."'"; ?>);
            return;
        }
        if($('#FormPassword').val() < 8) {
            ShowError(<?php echo "'".Language::$LANG['UI']['Error']['CannotSendPost'] . "','" . Language::$LANG['UI']['Error']['PasswordTooShort'].'d'."'"; ?>);
            return;
        }
        if($('#FormConfirmPassword').val()!==$('#FormPassword').val()) {
            ShowError(<?php echo "'".Language::$LANG['UI']['Error']['CannotSendPost'] . "','" . Language::$LANG['UI']['Error']['PasswordsDontMatch'].'e'."'"; ?>);
            return;
        }
        if(!$('#FormLanguage').val()) {
            ShowError(<?php echo "'".Language::$LANG['UI']['Error']['CannotSendPost'] . "','" . Language::$LANG['UI']['Error']['IncorrectLang'].'f'."'"; ?>);
            return;
        }
        request = $.ajax({
            type: "POST",
            url: "./content.php",
            data: {
                type: "User",
                url: "Update",
                Name:$('#FormName').val(),
                Login:$('#FormLogin').val(),
                Password: $('#FormPassword').val().toString(),
                ConfirmPassword: $('#FormConfirmPassword').val().toString(),
                Language: $('#FormLanguage').val()
            }
        });
        request.done(function (response) {

            if(response.trim()==="OK")
                window.location.reload();
            // ServeContent("EntryList");
            else
                ShowError(<?php echo "'".Language::$LANG['UI']['Error']['CannotSendPost']. "'"; ?>, response);


        });
    }
    SetValues();
</script>