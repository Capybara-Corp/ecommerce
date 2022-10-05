<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login PDO example</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c89cf96150.js" crossorigin="anonymous"></script>
</head>
<body>
    <span id="message" class="noselect"></span>
    <img id="fondo" src="design/8247.jpg" alt="">
    <section id="login" class="noselect">
        <h1>log in <br>system</h1>
            <form action="login_verify.php" method="post" id="form_fetch">
                <input onclick="clear_input_style(e,0)" class="inputs_form" name="user_correo" type="text" placeholder="CORREO">
                <input onclick="clear_input_style(e,1)" class="inputs_form" name="user_pass" type="password" placeholder="CONTRASEÑA">
                <button type="button" onclick="verify_data_state()">CONNECT &nbsp;&nbsp;<i class="fa-solid fa-circle-chevron-right"></i></button>
            </form>
        <p>¿ no tienes usuario ?</p>
        <p>¿ olvidaste tu pass ?</p>
    </section>
</body>
</html>

<style>
    html,body 
    {
        overflow:hidden;
        margin:0;
        padding:0;
    }

    #login 
    {
        width: auto;
        height:auto;
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        justify-content: center;
        align-items: center;
        align-content: center;
        margin:30vh auto;
    }

    #login h1
    {
        color:white;
        font-size:25px;
        font-weight:900;
        text-align:center;
    }

    #login form 
    { 
        width:auto;
        padding:20px;
        height: auto;
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        justify-content: center;
        align-items: center;
        align-content: center;
        background:rgba(35,36,60,255);
        border-radius:6px;
        box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
        margin-bottom:25px;
    }

    #fondo
    {
        width:100%;
        height:101vh;
        position:absolute;
        top:0;
        left:0;
        z-index: -1;
        object-fit:cover;
    }

    #login p 
    {
        padding:0;
        margin:0;
        color: #62627d;
        cursor:pointer;
        margin-bottom:5px;
    }

    #login p:hover 
    {
        transition: all ease 1s;
        color:white;
        text-decoration:underline;
    }

    #login form input 
    {
        background:rgba(67,68,89,255);
        height:30px;
        border:none;
        border-radius:6px;
        width:250px;
        padding-left:10px;
        font-size: 11px;
        color:white;
        font-weight:600;
        box-shadow: rgba(0, 0, 0, 0.2) 0px 8px 24px;
    }

    #login form input:nth-child(1){margin-bottom:15px}

    #login form input:nth-child(2){margin-bottom:50px}

    #login form button
    {
        border:none;
        height:30px;
        width:120px;
        font-size:9px;
        border-radius:15px;
        font-weight:700;
        cursor:pointer;
    }

    #login form button:hover
    {
        transition: all ease 1s;
        background:rgba(35,36,60,255);
        color:white;
        border:1px solid white;
    }

    #login form button:hover > i
    {
        transition: color ease 1s;
        color:white;
    }

    button, input, h1, p, #message {font-family: 'Maven Pro', sans-serif}

    .noselect 
    {
        -webkit-touch-callout: none; /* iOS Safari */
        -webkit-user-select: none; /* Safari */
        -khtml-user-select: none; /* Konqueror HTML */
        -moz-user-select: none; /* Old versions of Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
        user-select: none; /* Non-prefixed version, currently*/
    }

    i{color:#23b0db}

    .error_input
    {
        transition: all 1s ease;
        border: 1px solid #960018!important;
    }

    #message
    {
        background:rgba(35,36,60,255);
        border-radius:6px;
        color:white;
        position:fixed;
        top: 5px; 
        left: 5px;
        padding:15px;
        font-size:12px;
    }
</style>

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
