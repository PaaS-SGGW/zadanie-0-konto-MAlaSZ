<?php
require_once(substr(__DIR__,0,strrpos(__DIR__,'application')).'router.php');
require_once Router::$Config['Language'];
require_once Router::$Controllers['Post']['List'];
require_once Router::$Controllers['User']['Read'];
?>

<!-- Blog entries -->

  <!-- Blog entry -->
  <div id='A01' class="entry w3-card-4 w3-margin w3-white">
    <img src="images/forest.jpg" alt="Forest" style="width:100%">
    <div class="w3-container">
      <h3 title="ArticleTitle" class="my-uppercase"><b>PraWO CYWILNE I PRAWO KARNE W PRAKTYCE</b></h3>
      <h5>Imię Nazwisko, <span class="w3-opacity">5 marca 2017</span></h5>
    </div>

    <div class="w3-container">
      <p title="ArticleContent">Mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at. Phasellus sed ultricies mi non congue ullam corper. Praesent tincidunt sed
        tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.[...]</p>
      <div class="w3-row">
        <div class="w3-col m8 s12">
          <p><button class="w3-button w3-padding-large w3-white w3-border" onclick="LoadEntry('A01');"><b>CZYTAJ DALEJ &raquo;</b></button></p>
        </div>
      </div>
    </div>
  </div>
  <hr>
<!-- END BLOG ENTRIES -->
