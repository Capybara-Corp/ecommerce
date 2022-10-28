<nav class="noselect">
  <!-- Es el menu superior -->
  <div id="toggle-menu" class="toggle-menu">
  <img src="public/media/menu.png" id="menupic">
  </div> <!-- Este div contiene la imagen del boton para abrir el menu -->
  <div style="text-align: center;" id="languages">
  <a href="<?php echo $_SERVER['REQUEST_URI']; ?>?lang=es"><img src="public/lang/spanish.png" class="language" id="spanish"></a>
  <a href="<?php echo $_SERVER['REQUEST_URI']; ?>?lang=en""><img src="public/lang/english.png" class="language" id="english"></a>
  <a href="<?php echo $_SERVER['REQUEST_URI']; ?>?lang=jav""><img src="public/lang/japanese.png" class="language" id="japanese"></a>
  </div>
  <ul class="main-menu" id="main-menu">
    <li><a href="<?php echo constant('URL'); ?>">INICIO</a></li>
    <li><a href="<?php echo constant('URL'); ?>nosotros">NOSOTROS</a></li>
    <li><a href="<?php echo constant('URL'); ?>carrito/market">TIENDA</a></li>
    <li><a href="">NOTICIAS</a></li>
    <li><a href="">PRODUCTOS</a></li>
    <li><a href="">CONTACTO</a></li>

    
    
    <?php 
    if(isset($_GET['lang'])){
    setcookie("idioma", $_GET['lang'], time()+ 86400 * 365); 
    } ?>

    <?php if (isset($_SESSION['uid'])): ?>



  <div class="dropdown">

  <li id="miperfil"><button onclick="mostrarmenu()" class="dropbtn">|&nbsp;&nbsp;&nbsp;MI PERFIL</button></li>

    <div id="myDropdown" class="dropdown-content">

      <a id="miperfil" href="<?php echo constant('URL'); ?>perfil?uid=<?php echo ($_SESSION['uid']); ?>">MI PERFIL</a>
      <a id="edit" href="editar?uid=<?php echo ($_SESSION['uid']); ?>">EDITAR MI PERFIL</a>
      <a id="logout" href="logout">CERRAR SESIÓN</a>
    </div>
    
  </div>
    




    <?php else: ?>

    <li><a href="<?php echo constant('URL'); ?>login">|&nbsp;&nbsp;&nbsp;LOGIN</a></li>
    <?php endif;?>

  </ul>
</nav> <!-- Aqui termina el menu -->

<script src="<?php echo constant('URL'); ?>public/js/perfil.js"></script>