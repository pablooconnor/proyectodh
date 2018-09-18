<?php
require 'funciones.php';
if(check()) {
    redirect('perfil.php');
}
    
    }
     if($_POST) {
        $usuario = dbEmailSearch($_POST['email']);
        if($usuario !== null) {
            if(password_verify($_POST['password'], $usuario['password']) == true) {
                login($usuario);
        
                redirect('perfil.php');
            } 
        }
        
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/header-footer.css">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
</head>
<body>
    <div class="main">
        <?php include_once('header.php')?>
        <main>
        <form class="form" action="" method="post">
            <h2>Inicia sesion</h2>
            
                <div class="form-flex">
                  <label class="lable" ><b>Usuario</b></label>
                  <input class="textfield"  placeholder="Ingresar Usuario" name="uname" required>
              
                  <label class="lable"><b>Contraseña</b></label>
                  <input class="textfield" type="password" placeholder="Ingresar Contraseña" name="psw" required>

                  <div class="button-container">
                  <button type="submit">Iniciar sesión</button>
                  <label>

                  <button type="button" class="cancelbtn">Cancelar</button>
                </div>

                  <span class="psw">¿Olvidaste tu <a href="#">contraseña?</a></span>

                <div class="col">
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