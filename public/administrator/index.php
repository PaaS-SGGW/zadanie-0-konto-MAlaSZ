<!doctype html>

<html lang="pl">
<head>
    <meta charset="utf-8">

    <title>VAGABOND - PANEL</title>
    <meta name="description" content="MyPage">
    <meta name="author" content="SitePoint">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/w3.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>

    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
    <![endif]-->
</head>

<body>

<?php
    session_start();
    require_once(substr(__DIR__,0,strrpos(__DIR__,'public')).'router.php');

    if(!isset($_SESSION['loggedIn']))
        require_once Router::$Views['Content']['Admin']['LoginSite'];
    else {
        require_once Router::$Views['Layout']['Admin']['Error'];
        echo '<div class="w3-row">';
        require_once Router::$Views['Layout']['Admin']['Sidebar'];
        echo '<div class="w3-col l10 m10 s10 w3-padding-32 my-margin"><div id="content">';
        echo '</div></div></div>';
    }
?>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="https://cdn.quilljs.com/1.2.6/quill.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/hmac-sha512.min.js"></script>
<script src="js/main.js"></script>
</body>


</html>
