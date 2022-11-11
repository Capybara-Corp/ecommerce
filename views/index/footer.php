
<?php

require_once 'traduccion/Translate.php';
use \SimpleTranslation\Translate;


$idioma = $_COOKIE['idioma'] ?? 'es';
Translate::init($idioma, "lang/".$idioma.".php");

;?>

<footer class="footer">
    <div class="links">
      <a href="<?php echo constant('URL'); ?>"><?=Translate::__('inicio');?></a>
      <br>
      <a href="<?php echo constant('URL'); ?>nosotros"><?=Translate::__('nosotros');?></a>
      <br>
      <a href="<?php echo constant('URL'); ?>carrito/market"><?=Translate::__('tienda');?></a>
      <br>
      <a href="<?php echo constant('URL'); ?>login"><?=Translate::__('login');?></a>
    </div>
    <div class="contact">
      <p><?=Translate::__('contacto');?></p>
      <p>+598 94 675 436</p>
      <p>charruasboutique@charruasboutique.com</p>
    </div>
    <p id="copyright">Copyright 2022 | Charruas Boutique</p>
    <div class="weaccept">
      <p><?=Translate::__('aceptamos');?></p>
      <img src="<?php echo constant('URL')?>public/media/cards.png" id="cards">
    </div>    
    <img src="<?php echo constant('URL')?>public/media/media.png" id="redes">

</footer>
  
  <!-- TRADUCIDO -->