<?php

require_once 'traduccion/Translate.php';
use \SimpleTranslation\Translate;


$idioma = $_COOKIE['idioma'] ?? 'es';
Translate::init($idioma, "lang/".$idioma.".php");

;?>

<script>
  var activado = 0;

</script>



<nav class="noselect">
  <!-- Es el menu superior -->
  <div id="toggle-menu" class="toggle-menu">
  <img src="<?php echo constant('URL'); ?>public/media/menu.png" id="menupic">
  </div> <!-- Este div contiene la imagen del boton para abrir el menu -->

  <ul class="main-menu" id="main-menu">
    <li><a href="<?php echo constant('URL'); ?>"><?=Translate::__('inicio');?></a></li>
    <li><a href="<?php echo constant('URL'); ?>nosotros"><?=Translate::__('nosotros');?></a></li>
    <li><a href="<?php echo constant('URL'); ?>carrito/market"><?=Translate::__('tienda');?></a></li>
    <li><a href=""><?=Translate::__('noticias');?></a></li>
    <li><a href=""><?=Translate::__('contacto');?></a></li>
    <li><a id="idioma"><button onclick="mostraridiomas()" class="dropbtnLan"><?=Translate::__('idioma');?></button></a></li>
    

    
    
    <?php 
    if(isset($_GET['lang'])){
    setcookie("idioma", $_GET['lang'], time()+ 86400 * 365); 
    } ?>

    <?php if (isset($_SESSION['uid'])): ?>



  <div class="dropdown">

  <li id="miperfil"><button onclick="mostrarmenu()" class="dropbtn">|&nbsp;&nbsp;&nbsp;<?=Translate::__('miperfil');?></button></li>

    
    
  </div>
    




    <?php else: ?>

    <li><a href="<?php echo constant('URL'); ?>login">|&nbsp;&nbsp;&nbsp;<?=Translate::__('login');?></a></li>
    <?php endif;?>

  </ul>
</nav> <!-- Aqui termina el menu -->

<div id="myDropdown" class="dropdown-content">

      <a id="miperfil" href="<?php echo constant('URL'); ?>perfil?uid=<?php echo ($_SESSION['uid']); ?>"><?=Translate::__('miperfil');?></a>
      <a id="edit" href="<?php echo constant('URL'); ?>editar?uid=<?php echo ($_SESSION['uid']); ?>"><?=Translate::__('editarmiperfil');?></a>
      <a id="logout" href="<?php echo constant('URL'); ?>logout"><?=Translate::__('cerrarsesion');?></a>
    </div>



<div id="myLanguages" class="languages-content">
    <a href="<?php echo constant('URL'); ?>?lang=es" id="es">Español</a>
    <a href="<?php echo constant('URL'); ?>?lang=en" id="en" class="conborde">English</a>
    <a href="<?php echo constant('URL'); ?>?lang=jav" id="jav" class="conborde">日本語</a>
    <a href="<?php echo constant('URL'); ?>?lang=ru" id="ru" class="conborde">русский</a>
    <a href="<?php echo constant('URL'); ?>?lang=ch" id="ch" class="conborde">中文</a>
    <a href="<?php echo constant('URL'); ?>?lang=co" id="co" class="conborde">한국어</a>
    <a href="<?php echo constant('URL'); ?>?lang=fr" id="fr" class="conborde">Français</a>
    <a href="<?php echo constant('URL'); ?>?lang=ar" id="ar" class="conborde">اللغة العربية</a>
    <a href="<?php echo constant('URL'); ?>?lang=gri" id="gri" class="conborde">Ελληνικά</a>
    <a href="<?php echo constant('URL'); ?>?lang=hin" id="hin" class="conborde">हिन्दी</a>
</div>

<script src="<?php echo constant('URL'); ?>public/js/perfil.js"></script>
<script src="<?php echo constant('URL'); ?>public/js/menu.js"></script>
<script src="<?php echo constant('URL'); ?>public/js/languages.js"></script>