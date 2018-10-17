<?php
    require('classes/loader.php');

    if($_POST){
        //Chequear de que formulario es (proximamente)
        $errors = validatePost($_POST);
        $post = createUser($_POST);
    // Si hay archivos, y en $_FILES la key 'error' esta seteada en 0... (para visualizar esto, hacer un dd() de $_FILES a ver que llega y COMO)
    if(empty($_FILES['avatar']['error']) == true) {
        //procesa con validateAvatar()
        $avatarErrors = validateAvatar($_POST);
        //y creame una nueva key en el array $usuario llamada 'avatar' a la cual le asignamos el value de lo que devuelve la funcion photoPath()
        $usuario['avatar'] = photoPath($_POST);
        //SI no esta vacio el array $avatarErrors...
        if(!empty($avatarErrors)) {
            //mergea con array_merge() todos los errores en un solo array $errors
            $errors = array_merge($errors, $avatarErrors); 
        }
    }
    //si count() de $errors es == a 0
    if(count($errors) == 0) {  
        //guarda el usuario en Json con saveUser()
        saveUser($usuario);
        //y redirigime a Login (NUNCA directo al perfil)
        Helper::redirect('login.php');
    }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panu</title>
    <link href="https://fonts.googleapis.com/css?family=Patrick+Hand" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="main">
        <?php include_once('header.php'); ?>
        <main>
            <h2>Crear nueva busqueda o reportar mascota encontrada</h2>
            <form class="createPost"action="" enctype="multipart/form-data" method="post">
                <div class="createTexts">
                    <input type="text" name="title" placeholder="Escribe un título...">
                    <textarea class="textarea" name="description" id="" cols="30" rows="5" placeholder="Escribe una breve descripcion (Max. 250 caracteres)" maxlength="250"></textarea>
                </div>
                <div class="createButtons">
                    <input class="file" type="file" name="foto">
                    <div class="radioButtons">
                        <div>
                            <input type="radio" name="tipo" value="found" id="found" required>
                            <label for="found">Encontré una mascota.</label>
                        </div>
                        <div>
                            <input type="radio" name="tipo" value="search" id="search">
                            <label for="found">Busco una mascota.</label>
                        </div>
                    </div>
                    <select class="selectPlace" name="provincia" id="provincia">
                        <option value="" selected hidden disabled>Seleccione la zona</option>
                        <option value="caba">C.A.B.A.</option>
                        <option value="gbanorte">G.B.A. Norte</option>
                        <option value="gbasur">G.B.A. Sur</option>
                        <option value="gbaoeste">G.B.A. Oeste</option>
                    </select>
                    <input class="submit" type="submit" value="Enviar">
                </div>
            </form>
        </main>
        <?php include_once('footer.php'); ?>
    </div>
</body>
</html>