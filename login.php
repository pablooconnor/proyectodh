<?php

require 'loader.php';

if(Helper::check()) {
    Helper::redirect('perfil.php');
}

if($_POST) {
    // echo '<pre>';
    // var_dump(stripos($_POST['user'], '@'));
    // echo '</pre>';
    // exit;
    if(stripos($_POST['user'], '@')){
        $user = Query::emailSearch($_POST['user'], $db, 'users');
        if($user !== false) {
            if(password_verify($_POST['password'], $user->getPassword())) {
                Auth::login($user);

                Helper::redirect('perfil.php');
            } else {
                $passwordError = true;
            } 
        } else {
            $emailError = true;
        }
    } else {
        $user = Query::usernameSearch($_POST['user'], $db, 'users');
        if($user !== false) {
            if(password_verify($_POST['password'], $user->getPassword())) {
                Auth::login($user);

                Helper::redirect('perfil.php');
            } else {
                $passwordError = true;
            } 
        } else {
            $emailError = true;
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
                    <label class="label" ><b>Usuario o Email</b></label>
                    <input class="textfield"  placeholder="Ingresar email" value="<?php if(isset($_COOKIE["email"])) { echo $_COOKIE["email"]; } ?>" name="user" required>
                    <?php if(isset($emailError)): ?>
                        <div class="alert alert-danger">
                            <strong>Este usuario o email no esta registrado en una cuenta. <a href="registro.php">Registrarse</a></strong>
                        </div>
                    <?php endif;?>
                    <label class="label"><b>Contraseña</b></label>
                    <input class="textfield" type="password" placeholder="Ingresar Contraseña" name="password" required>
                    <?php if(isset($passwordError)): ?>
                        <div class="alert alert-danger">
                            <strong><?="Contraseña incorrecta, si la olvido "; ?><a href="#">recupere su contraseña.</a></strong>
                        </div>
                    <?php endif;?>
                    <div class="label">
                        <input type="checkbox" name="rememberme" value="">
                        <label for="confirm">Recordarme</label>
                    </div>  
                    <div class="loginbutton">
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