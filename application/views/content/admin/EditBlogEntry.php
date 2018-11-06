<?php
require_once(substr(__DIR__,0,strrpos(__DIR__,'application')).'router.php');
require_once Router::$Config['Language'];
require_once Router::$Controllers['ConstantPost']['Read'];
require_once Router::$Controllers['Image']['List'];
session_start();

$Posts = GetConstantPosts();
for($i=0; $i < count($Posts); $i++)
    if($Posts[$i]['Id'] == $_SESSION['entryid'])
        $Post =$Posts[$i];


?>
<link href="https://cdn.quilljs.com/1.2.6/quill.snow.css" rel="stylesheet">
<div class="w3-card-4 w3-margin w3-white">
    <div class="w3-container w3-teal">
        <h2><?php echo Language::$LANG['UI']['Title']['EditBlogPost'];?></h2>
    </div>
    <div class="w3-container w3-padding-32">
        <form class="w3-container">
            <div class=" w3-padding-16">
                <label class="w3-text-teal"><b><?php echo Language::$LANG['UI']['PostForm']['Title'];?></b></label>
                <input id='PostTitle' class="w3-input w3-border w3-text-black" type="text" style="width:100%">
            </div>
            <div class="w3-padding-16">
                <select id='PostImage' class="w3-select" name="background">
                    <option value="" disabled selected><?php echo Language::$LANG['UI']['PostForm']['SelectImage'];?></option>
                </select>
            </div>
            <div class="w3-padding-16">
                <select id='PostLanguage' class="w3-select" name="background">
                    <option value="" disabled selected><?php echo Language::$LANG['UI']['PostForm']['SelectLang'];?></option>
                    <?php
                    $lang_keys = array_keys(Language::$OPTIONS);
                    for($i = 0; $i < count(Language::$OPTIONS); $i++)
                        echo '<option value="'.$lang_keys[$i].'">'.Language::$OPTIONS[$lang_keys[$i]].'</option>';
                    ?>
                </select>
            </div>
            <div class="w3-padding-16">
                <select id='PostType' class="w3-select" name="background">
                    <option value="" disabled selected><?php echo Language::$LANG['UI']['PostForm']['SelectType'];?></option>
                    <option value="1" ><?php echo Language::$LANG['Entry']['Blog']['Home'];?></option>
                    <option value="2" ><?php echo Language::$LANG['Entry']['Blog']['About'];?></option>
                    <option value="3" ><?php echo Language::$LANG['Entry']['Blog']['Contact'];?></option>
                </select>
            </div>
            <div class=" w3-padding-16">
                <label class="w3-text-teal"><b><?php echo Language::$LANG['UI']['PostForm']['Content'];?></b></label>
                <div id="editor">
                </div>
            </div>

        </form>
        <div class="w3-row w3-padding-16">
            <div class="w3-col s12 m1 l1 my-button ">
                <p><button class="w3-button w3-padding-large w3-white w3-border w3-col l12 m12 s12" onclick="ServeContent('BlogEntryList');"><b> <?php echo Language::$LANG['UI']['Button']['Back'];?></b></button></p>
            </div>
            <div class=" w3-col s12 m1 l1 w3-right my-button">
                <p><button class="w3-button w3-padding-large w3-border w3-teal w3-text-white w3-col l12 m12 s12" onclick="EditEntry();"><b> <?php echo Language::$LANG['UI']['Button']['Save'];?></b></button></p>
            </div>
        </div>
    </div>
</div>



<!-- Initialize Quill editor -->
<script>

    function EditEntry() {
        if($('#PostTitle').val().length === 0) {
            ShowError(<?php echo "'".Language::$LANG['UI']['Error']['CannotSendPost'] . "','" . Language::$LANG['UI']['Error']['TitleEmpty']."'"; ?>);
            return 0;
        }
        if(!$('#PostImage').val()) {
            ShowError(<?php echo "'".Language::$LANG['UI']['Error']['CannotSendPost'] . "','" . Language::$LANG['UI']['Error']['ImageEmpty']."'"; ?>);
            return;
        }
        if(!$('#PostLanguage').val()) {
            ShowError(<?php echo "'".Language::$LANG['UI']['Error']['CannotSendPost'] . "','" . Language::$LANG['UI']['Error']['LangEmpty']."'"; ?>);
            return;
        }
        if(quill.root.innerHTML === "<p><br></p>") {
            ShowError(<?php echo "'".Language::$LANG['UI']['Error']['CannotSendPost'] . "','" . Language::$LANG['UI']['Error']['ContentEmpty']."'"; ?>);
            return;
        }
        if($('#PostType').val().length === 0) {
            ShowError(<?php echo "'".Language::$LANG['UI']['Error']['CannotSendPost'] . "','" . Language::$LANG['UI']['Error']['IncorrectType']."'"; ?>);
            return;
        }
        var request = $.ajax({
            type: "POST",
            url: "./content.php",
            data: {
                type: "ConstantPost",
                url: "Edit",
                Id: <?php echo $Post['Id'];?>,
                Title:$('#PostTitle').val(),
                ImageId:$('#PostImage').val(),
                Content: quill.root.innerHTML,
                Language: $('#PostLanguage').val(),
                PostType: $('#PostType').val()
            }
        });
        request.done(function (response) {
            if(response.trim()==="OK")
                ServeContent("BlogEntryList");
            else
                ShowError(<?php echo "'".Language::$LANG['UI']['Error']['CannotSendPost']. "'"; ?>, response);


        });
    }
    var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        ['blockquote', 'code-block'],

        [{ 'header': 1 }, { 'header': 2 }],               // custom button values
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
        [{ 'direction': 'rtl' }],                         // text direction

        [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        [{ 'font': [] }],
        [{ 'align': [] }],
        ['link', 'image'],

        ['clean']                                         // remove formatting button
    ];
    var quill = new Quill('#editor',
        { theme: 'snow', modules: { toolbar: toolbarOptions} }
        //{ theme: 'bubble', readOnly:true , modules: {}   } --odczyt
    );
    function GetPictures() {
        var request = $.ajax({
            type: "GET",
            url: "./content.php",
            data: {
                type: "Images",
                url:"List"
            }
        });

        request.done(
            function ( response ) {
                var data = JSON.parse(response);
                for(var i = 0; i<data.length;i++)
                    $('<option value="'+data[i]['Id']+'">'+data[i]['Name']+'</option>').appendTo("#PostImage");
            });
    }
    function AssignData() {
        $('#PostTitle').val('<?php echo $Post['Title'];?>');
        $('#PostImage').val('<?php echo $Post['ImageId'];?>');
        quill.root.innerHTML = '<?php echo str_replace('\'',"\'",$Post['Content']);?>';
        $('#PostLanguage').val('<?php echo $Post['Language'];?>');
        $('#PostType').val('<?php echo $Post['Type'];?>');
    }

    GetPictures();
    AssignData();

</script>
