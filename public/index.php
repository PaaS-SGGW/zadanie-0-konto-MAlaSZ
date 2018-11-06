<?php
require_once(substr(__DIR__,0,strrpos(__DIR__,'public')).'router.php');
require_once Router::$Config['Language'];
?>
<!doctype html>

<html lang="pl">
<head>
  <meta charset="utf-8">

  <title>VAGABOND</title>
    <meta name="description" content="Phobos">
    <meta name="author" content="SitePoint">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="css/w3.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
    <script>var CurrentPage;</script>
  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>

  <![endif]-->
</head>

<body>
<?php
    require_once Router::$Views['Layout']['Front']['Navbar'];
    require_once Router::$Views['Layout']['Front']['LangSelector'];
?>

<div class="w3-content w3-padding-32" style="max-width: 1400px;">

    <div id="content">

    </div>


</div>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/main.js"></script>
<script type="text/javascript" src="//ciasteczka.eu/cookiesEU-latest.min.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function(){ jQuery.fn.cookiesEU();});
</script>
</body>


</html>
