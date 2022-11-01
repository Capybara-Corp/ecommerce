<?php

require_once 'traduccion/Translate.php';
use \SimpleTranslation\Translate;


$idioma = $_COOKIE['idioma'] ?? 'es';
Translate::init($idioma, "lang/".$idioma.".php");

;?>

<nav class="noselect">
  <!-- Es el menu superior -->
  <div id="toggle-menu" class="toggle-menu">
  <img src="../public/media/menu.png" id="menupic">
  </div> <!-- Este div contiene la imagen del boton para abrir el menu -->
  <div style="text-align: center;" id="languages">
  <a href="<?php echo constant('URL'); ?>?lang=es"><img src="../public/lang/spanish.png" class="language" id="spanish"></a>
  <a href="<?php echo constant('URL'); ?>?lang=en"><img src="../public/lang/english.png" class="language" id="english"></a>
  <a href="<?php echo constant('URL'); ?>?lang=jav"><img src="../public/lang/japanese.png" class="language" id="japanese"></a>
  </div>
  <ul class="main-menu" id="main-menu">
    <li><a href="<?php echo constant('URL'); ?>"><?=Translate::__('inicio');?></a></li>
    <li><a href="<?php echo constant('URL'); ?>nosotros"><?=Translate::__('nosotros');?></a></li>
    <li><a href="<?php echo constant('URL'); ?>carrito/market"><?=Translate::__('tienda');?></a></li>
    <li><a href=""><?=Translate::__('noticias');?></a></li>
    <li><a href=""><?=Translate::__('productos');?></a></li>
    <li><a href=""><?=Translate::__('contacto');?></a></li>

    
    
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
      <a id="edit" href="editar?uid=<?php echo ($_SESSION['uid']); ?>"><?=Translate::__('editarmiperfil');?></a>
      <a id="logout" href="logout"><?=Translate::__('cerrarsesion');?></a>
    </div>

<script src="<?php echo constant('URL'); ?>public/js/perfil.js"></script>