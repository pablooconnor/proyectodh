<?php

require 'funciones/funciones.php';

if(check()) {
    redirect('perfil.php');
}

if($_POST) {
    $usuario = dbEmailSearch($_POST['email']);
    if($usuario !== null) {
        if(password_verify($_POST['password'], $usuario['password']) == true) {
            login($usuario);

            redirect('perfil.php');
        } 
    }
}
        
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="main">
        <?php include_once('header.php')?>
        <main>
            <form class="form" action="" method="post">
                <h2>Inicia sesion</h2>
                <div class="form-flex">
                    <label class="label" ><b>Email</b></label>
                    <input class="textfield"  placeholder="Ingresar email" value="<?php if(isset($_COOKIE["email"])) { echo $_COOKIE["email"]; } ?>" name="email" required>
                
                    <label class="label"><b>Contraseña</b></label>
                    <input class="textfield" type="password" placeholder="Ingresar Contraseña" name="password" required>

                    <div class="label">
                        <input type="checkbox" name="rememberme" value="">
                        <label for="confirm">Recordarme</label>
                    </div>  
                    <div class="button-container">
                        <button type="submit">Iniciar sesión</button>
                    </div>
                    <span class="psw">¿Olvidaste tu contraseña? Haz click aqui para <a href="#">recuperar contraseña.</a></span>
                    <div class="social">
                        <a href="#" class="fb btn">
                            <i class="fa fa-facebook"></i> Iniciar con Facebook
                        </a>
                        <a href="#" class="google btn">
                            <i class="fa fa-google"></i> Iniciar con Google+
                        </a>
                    </div>            
            </form>
        </main>
        <?php include_once('footer.php')?>
      </div>
</body>
</html>