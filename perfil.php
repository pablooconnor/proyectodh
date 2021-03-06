<?php
    require 'loader.php';

    if(Helper::guest()) {
        Helper::redirect('registro.php');
    }
    // si me llega una $_SESSION con la key 'email' seteada...
    if(isset($_SESSION['email'])) {
        // buscame el usuario por mail y guardalo en $user (necesitamos usar los otros datos y solamente tenemos el email guardado en session!)
        $user = Query::emailSearch($_SESSION['email'], $db, 'users');
        // asigname a $username el nombre de usuario
        $username = $user->getUsername();
        // Si tiene una foto de perfil, va a tener una key 'avatar' seteada...
        $email = $user->getEmail();
        $provincia = $user->getProvincia();
        $direccion = $user->getDireccion();

        if(array_key_exists('avatar', $user)){
            // Entonces asigname el valor de esa key a la variable $avatar
            $avatar = $user->getAvatar();
        }
    }


?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=isset($username) ? $username : "Perfil";?> - Panu</title>
    <link href="https://fonts.googleapis.com/css?family=Patrick+Hand" rel="stylesheet">
    <link rel="stylesheet" href="css/perfil.css">
    <link rel="stylesheet" href="css/header-footer.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
</head>
<body>
    <div class="main">
        <?php include_once('header.php');?>
        <main>

        <?php //Checkeamos que no sea un GUEST, y en caso de serlo, error ?>
            <?php if(Helper::guest()):?>
                <div class="alert alert-danger" role="alert">
                    No estas autorizado en este sistema <a href="register.php" class="alert-link">registrese</a> o <a href="login.php" class="alert-link">inicie sesión</a>
                </div>
            <?php else: ?>
                <div class="container">
                    <div class="profile">
                        <div class="avatar">
                            <?php //si NO TIENE AVATAR ?>
                            <?php if(!isset($avatar)):?>
                            <?php //si Cargame la imagen de d10s ?>
                            <img class="img-circle img-responsive" src="img/default.png" alt="avatar default">
                            <?php else: ?>
                            <?php // ELSE -----> cargame su avatar ?>
                            <img class="img-circle img-responsive" src="img/<?=$avatar?>" alt="avatar">
                            <?php endif;?>
                        </div>
                        <div class="information">
                            <h3><?="Bienvenido $username!" ?></h3>
                            <p> <?="Email: $email" ?></p>
                            <p><?="Provincia: $provincia" ?></p>
                            <p> <?="Direccion: $direccion" ?></p>
                        </div>
                        <div class="button-container">
                            <button type="submit"><a href="editarperfil.php">Editar</button>
                            <button type="submit" ><a href="logout.php">Logout</a></button>
                            <?php if(Helper::checkRole($_SESSION['email'], $db) == true): ?>
                            <button type=""><a class="nav-link" href="backend.php">Administrar</a></button>
                            <?php endif; ?>
                            <?php // mail: admin@gmail.com password:123456 roll:7 ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </main>    
        <?php include_once('footer.php');?>
    </div>   
</body>
</html>