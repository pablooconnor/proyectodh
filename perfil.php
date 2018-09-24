<?php
    require 'funciones/funciones.php';

    // if(guest()) {
    //     redirect('register.php');
    // }
    // si me llega una $_SESSION con la key 'email' seteada...
    if(isset($_SESSION['email'])) {
        // buscame el usuario por mail y guardalo en $user (necesitamos usar los otros datos y solamente tenemos el email guardado en session!)
        $user = dbEmailSearch($_SESSION['email']);
        // asigname a $username el nombre de usuario
        $username = $user['username'];
        // Si tiene una foto de perfil, va a tener una key 'avatar' seteada...
        $email = $user['email'];
        $provincia = $user ['provincia'];
        $direction = $user ['direction'];

        if(array_key_exists('avatar', $user)){
            // Entonces asigname el valor de esa key a la variable $avatar
            $avatar = $user['avatar'];
        }
    }


?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=isset($username) ? $user['username'] : "Perfil";?> - Panu</title>
    <link href="https://fonts.googleapis.com/css?family=Patrick+Hand" rel="stylesheet">
    <link rel="stylesheet" href="css/perfil.css">
    <link rel="stylesheet" href="css/header-footer.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <div class="main">
        <?php include_once('header.php');?>
        <main>

        <?php //Checkeamos que no sea un GUEST, y en caso de serlo, error ?>
            <?php if(guest()):?>
                <div class="alert alert-danger" role="alert">
                    No estas autorizado en este sistema <a href="register.php" class="alert-link">registrese</a> o <a href="login.php" class="alert-link">inicie sesión</a>
                </div>
            <?php else: ?>
                <div class="container">
                    <div class="row">
                        <div class=" col-lg-offset-3 col-lg-6">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6 col-lg-offset-3 col-lg-6">
                                                    <?php //si NO TIENE AVATAR ?>
                                                    <?php if(!isset($user['avatar'])):?>
                                                    <?php //si Cargame la imagen de d10s ?>
                                                    <img class="img-circle img-responsive" src="img/default.png" alt="avatar default">
                                                    <?php else: ?>
                                                    <?php // ELSE -----> cargame su avatar ?>
                                                    <img class="img-circle img-responsive" src="img/<?=$avatar?>" alt="avatar">
                                                    <?php endif;?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="centered-text col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6 col-lg-offset-3 col-lg-6">
                                                    <div>
                                                        <h3><?="Bienvenido $username!" ?></h3>
                                                        <p> <?="Email: $email" ?></p>
                                                        <p><?="Provincia: $provincia" ?></p>
                                                        <p> <?="Direccion: $direction" ?></p>
                                                    </div>
                                                    <div class="button-container">
                                                        <button type="submit"><a href="editarperfil.php">Editar</button>
                                                        <button type="reset" ><a href="logout.php">Logout</a></button>
                                                        <?php if(checkRole($_SESSION['email']) == true): ?>
                                                        <button type="reset"><a class="nav-link" href="backend.php">Administrar</a></button>
                                                        <?php endif; ?>
                                                        <?php // mail: admin@gmail.com password:123456 roll:7 ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </main>    
        <?php include_once('footer.php');?>
    </div>   
</body>
</html>