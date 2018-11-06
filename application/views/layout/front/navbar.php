<?php
require_once(substr(__DIR__,0,strrpos(__DIR__,'application')).'router.php');
require_once Router::$Config['Language'];
require_once Router::$Config['Settings']['Read'];
$Settings = ReadSettings();
session_start();
?>
<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div id="myNavbar" class="w3-bar w3-white w3-card-2 w3-animate-top">
    <a class="w3-bar-item w3-button w3-hover-black w3-right visibility-small" href="javascript:void(0);" onclick="toggleMenu();" title="Toggle Navigation Menu">
      <i class="fa fa-bars"></i>
    </a>
    <a id="Home" class="w3-bar-item w3-button ajax-link visibility-large"><i class="fa fa-home"></i> <?php echo Language::$LANG['UI']['Navbar']['Home'];?></a>
    <a id="Blog" class="w3-bar-item w3-button ajax-link visibility-large"><i class="fa fa-bars"></i> <?php echo Language::$LANG['UI']['Navbar']['Blog'];?></a>
      <?php
        if($Settings['AboutPage'] == 'Enabled')
            echo '<a id="About" class="w3-bar-item w3-button ajax-link visibility-large"><i class="fa fa-user"></i> '.Language::$LANG['UI']['Navbar']['About'].'</a>';
        if($Settings['ContactPage'] == 'Enabled')
            echo '<a id="Contact" class="w3-bar-item w3-button ajax-link visibility-large"><i class="fa fa-envelope"></i> '.Language::$LANG['UI']['Navbar']['Contact'].'</a>';
      ?>

    <a id="Language" class="w3-bar-item w3-button w3-right w3-hover-teal visibility-large"  onclick="$('#select-lang-modal').css('display','block');"><i class="fa fa-globe"></i> <?php echo Language::$LANG['UI']['Title']['SelectLanguage'];?></a>
<!--    <a href="#" class="w3-bar-item w3-button w3-right w3-hover-red visibility-large">-->
<!--      <i class="fa fa-search"></i>-->
<!--    </a>-->
  </div>

  <!-- Navbar on small screens -->
  <div id="navMobile" class="w3-bar-block w3-white w3-col s12 m12 l12 visibility-small" style="position: fixed; display:none;">
      <a class="w3-bar-item w3-button "  onclick="toggleMenu('Home')"><i class="fa fa-home"></i> <?php echo Language::$LANG['UI']['Navbar']['Home'];?></a>
      <a class="w3-bar-item w3-button "  onclick="toggleMenu('Blog')"><i class="fa fa-bars"></i> <?php echo Language::$LANG['UI']['Navbar']['Blog'];?></a>
      <a class="w3-bar-item w3-button "  onclick="toggleMenu('About')"><i class="fa fa-user"></i> <?php echo Language::$LANG['UI']['Navbar']['About'];?></a>
      <a class="w3-bar-item w3-button "  onclick="toggleMenu('Contact')"><i class="fa fa-envelope"></i> <?php echo Language::$LANG['UI']['Navbar']['Contact'];?></a>
      <a class="w3-bar-item w3-button"  onclick="$('#select-lang-modal').css('display','block');"><i class="fa fa-globe"></i> <?php echo Language::$LANG['UI']['Title']['SelectLanguage'];?></a>
  </div>
</div>

