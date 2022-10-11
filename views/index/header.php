<nav class="noselect">
      <!-- Es el menu superior -->
      <div id="toggle-menu" class="toggle-menu">
        <img src="public/media/menu.png">
      </div> <!-- Este div contiene la imagen del boton para abrir el menu -->
      <ul class="main-menu" id="main-menu">
        <li><a href="<?php echo constant('URL'); ?>">INICIO</a></li>
        <li><a href="<?php echo constant('URL'); ?>nosotros">NOSOTROS</a></li>
        <li><a href="<?php echo constant('URL'); ?>carrito/market">CARRITO</a></li>
        <li><a href="">NOTICIAS</a></li>
        <li><a href="">PRODUCTOS</a></li>
        <li><a href="">CONTACTO</a></li>


        <?php if(!empty($user)): ?>
          <li><a href="<?php echo constant('URL'); ?>views/login/perfil.php?uid=<?php echo ($_SESSION['uid']); ?>">|&nbsp;&nbsp;&nbsp;MI PERFIL</a></li>
    <?php else: ?>
      <li><a href="<?php echo constant('URL'); ?>login">|&nbsp;&nbsp;&nbsp;LOGIN</a></li>
    <?php endif; ?>

      </ul>
    </nav> <!-- Aqui termina el menu -->