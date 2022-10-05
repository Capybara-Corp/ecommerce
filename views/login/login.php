<?php 
    include'../../config/config.php'; // * Para que funcione la constant URL
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesion</title>
    <link rel="stylesheet" href="../../public/css/login/login.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@200&family=Roboto+Condensed:wght@400;700&family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c89cf96150.js" crossorigin="anonymous"></script>
</head>
<body>

    <nav class="noselect"> <!-- Es el menu superior -->
			<div id="toggle-menu" class="toggle-menu">
			<img src="../../public/media/menu.png" id="menupic">
			</div>  <!-- Este div contiene la imagen del boton para abrir el menu -->
			<ul class="main-menu" id="main-menu">
			 <li><a href="<?php echo constant('URL'); ?>">INICIO</a></li>
        	<li><a href="<?php echo constant('URL'); ?>nosotros">NOSOTROS</a></li>
        	<li><a href="<?php echo constant('URL'); ?>carrito/market">PRODUCTOS</a></li>
        	<li>NOTICIAS</li>
        	<li>CARRITO</li>
        	<li>CONTACTO</li>
			
			<li>|&nbsp;&nbsp;&nbsp;LOGIN</li>
		</ul>
	</nav> <!-- Aqui termina el menu -->

    <span id="message" class="noselect"></span>
    <img id="fondo" src="design/8247.jpg" alt="">
    <section id="login" class="noselect">
        <h1>Iniciar sesión</h1>
            <form action="login_verify.php" method="post" id="form_fetch">
                <input onclick="clear_input_style(e,0)" class="inputs_form" name="user_correo" type="text" placeholder="CORREO">
                <input onclick="clear_input_style(e,1)" class="inputs_form" name="user_pass" type="password" placeholder="CONTRASEÑA">
                <button type="button" onclick="verify_data_state()">CONNECT &nbsp;&nbsp;<i class="fa-solid fa-circle-chevron-right"></i></button>
            </form>
        <a href="signup.php">¿ no tienes usuario ?</a>
        <a>¿ olvidaste tu pass ?</a>
    </section>

    <script src="<?php echo constant('URL'); ?>public/js/menu.js"></script>

</body>
</html>

<script>
    /*creo listener que permita retirar clase que resalta error de en inputs*/
    function clear_input_style(e,x)
    {
        e.preventDefault();
        e.stopPropagation();
        let elements=document.getElementsByClassName("inputs_form");
        elements[x].classList.remove("error_input");
    }

    /*envio de data por fetch*/
    function fetch_send(data_set)
    {
        fetch('login_verify.php', 
        {
            method: 'POST',
            body: data_set
        })
        .then(function(response) 
        {
            if(response.ok) 
            {
                return response.text();
            } else 
            {
                throw "Error";
            }
        })
        .then(function(texto) 
        {
            document.getElementById("message").textContent = texto;
        })
        .catch(function(err) 
        {
            console.log(err);
        });
    }

    /*funcion que verifica la
     validez de los input antes de invocar funcion fetch*/ 
    function verify_data_state()
    {
        const data = new FormData(document.getElementById('form_fetch'));
        let usr = data.get("user_correo");
        let psw = data.get("user_pass");

        /*me aseguro que los datos ingresados al menos tengan 5 caracteres de lenght (lo define cada sistema)*/ 
        if(usr.length >=5 && psw.length >=5){fetch_send(data);}else
        {
            /*caso de error, campos vacios o con menos de 5 caracteres*/
            let form = document.querySelector("#form_fetch");
            if(usr.length <5){form.children[0].classList.add("error_input")}
            if(psw.length <5){form.children[1].classList.add("error_input")}
        } 
    }
</script>
