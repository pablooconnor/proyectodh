<?php
require 'funciones.php';

if($_POST) {
    // A la variable $errors asignale lo que de como resultado la funcion validate() que procese $_POST
    $errors = validate($_POST);
    // Sin importar si hay errores o no (por ahora), creamos un array de usuario con los datos de POST
    $usuario = createUser($_POST);
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
        redirect('login.php');
    }
}
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panu - Registrarse</title>
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
    <link rel="stylesheet" href="css/editarperfil.css">
    <link rel="stylesheet" href="css/header-footer.css">
</head>
<body>
    <div class="main">
        <?php include_once('header.php');?>
        <main>
            <form class="form" action="" method="post" enctype="multipart/form-data">
                <h2>Editar perfil</h2>
                <div class="form-flex">  
                    <label class="label" >Nombre y apellido</label> 
                    <input class="textfield" type="text" name= "username" value="<?=isset($errors['username']) ? "" : old('username'); ?>" placeholder="Nombre Apellido" >

                    <?php if(isset($errors['username'])): ?>
                        <div class="alert alert-danger">
                            <strong><?=$errors['username']; ?></strong>
                        </div>
                    <?php endif;?> 

                    <label class="label">Correo Electrónico</label>
                    <input class="textfield" type="text" name="email" value="<?=isset($errors['email']) ? "" : old('email'); ?>" placeholder="user@email.com" >

                    <?php if(isset($errors['email'])): ?>
                        <div class="alert alert-danger">
                            <strong><?=$errors['email']; ?></strong>
                        </div>
                    <?php endif;?> 

                    <label for="avatar">Foto de perfil:</label>
                    <input type="file" name="avatar">

                    <label class="label">Provincia:</label>
                    <select class="selection" name="provincia" value="<?=isset($errors['provincia']) ? "" : old('provincia'); ?>">
                        <option class="selection" value="" >Seleccione su provincia:</option>
                        <option class="selection" value="C.A.B.A.">C.A.B.A.</option> 
                        <option class="selection" value="Buenos Aires">Buenos Aires</option> 
                        <option class="selection" value="Catamarca">Catamarca</option> 
                        <option class="selection" value="Chaco">Chaco</option> 
                        <option class="selection" value="Chubut">Chubut</option> 
                        <option class="selection" value="Córdoba">Córdoba</option> 
                        <option class="selection" value="Corrientes">Corrientes</option> 
                        <option class="selection" value="Entre Ríos">Entre Ríos</option> 
                        <option class="selection" value="Formosa">Formosa</option> 
                        <option class="selection" value="Jujuy">Jujuy</option> 
                        <option class="selection" value="La Pampa">La Pampa</option> 
                        <option class="selection" value="La Rioja">La Rioja</option> 
                        <option class="selection" value="Mendoza">Mendoza</option>                
                        <option class="selection" value="Misiones">Misiones</option> 
                        <option class="selection" value="Neuquén">Neuquén</option> 
                        <option class="selection" value="Río Negro">Río Negro</option> 
                        <option class="selection" value="Salta">Salta</option> 
                        <option class="selection" value="San Juan">San Juan</option> 
                        <option class="selection" value="Santa Cruz">Santa Cruz</option> 
                        <option class="selection" value="Santa Fe">Santa Fe</option> 
                        <option class="selection"value="Santiago del Estero">Santiago del Estero</option>
                        <option class="selection"value="Tierra del Fuego">Tierra del Fuego</option>
                        <option class="selection"value="Tucumán">Tucumán</option>
                        <option class="selection"value="Islas Malvinas Argentinas">Islas Malvinas Argentinas</option>
                    </select>

                    <?php if(isset($errors['provincia'])): ?>
                        <div class="alert alert-danger">
                            <strong><?=$errors['provincia']; ?></strong>
                        </div>
                    <?php endif;?> 

                    <label class="label">Dirección</label>
                    <input class="textfield" type= "text" name="direction"  value="<?=isset($errors['direction']) ? "" : old('direction'); ?>" >

                    <?php if(isset($errors['direction'])): ?>
                        <div class="alert alert-danger">
                            <strong><?=$errors['direction']; ?></strong>
                        </div>
                    <?php endif;?>

                    <label class="label">Contraseña</label>
                    <input class="textfield"  type="password" name="password"  />

                     <?php if(isset($errors['password'])): ?>
                    <div class="alert alert-danger">
                        <strong><?=$errors['password']; ?></strong>
                    </div>
                <?php elseif(isset($errors['cpassword'])): ?>
                    <div class="alert alert-danger">
                        <strong><?=$errors['cpassword']; ?></strong>
                    </div>
                <?php endif;?>

                    <label class="label">Confirmar contraseña</label>
                    <input class="textfield" type="password" name="cpassword"  />

                    <br>

                    <input type="checkbox" name="confirm" value="">
                    <label for="confirm">Acepto los terminos y condiciones.</label>

                    <?php if(isset($errors['confirm'])): ?>
                    <div class="alert alert-danger">
                        <strong><?=$errors['confirm']; ?></strong>
                <?php endif;?>
                    
                    <div class="button-container">
                        <button type="submit">Enviar</button>
                        <button type="reset">Borrar</button>
                    </div>
                </div>
            </form> 
        </main>
        <?php include_once('footer.php')?>
    </div> 
</body>
</html>