<?php
require 'funciones/funciones.php';

if(check()) {
    redirect('perfil.php'); // hay que crearlo
}

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
    <link rel="stylesheet" href="css/formulario.css">
</head>
<body>
    <div class="main">
        <?php include_once('header.php');?>
        <main>
            <form class="form" action="" method="post" enctype="multipart/form-data">
                <h2>Crear cuenta</h2>
                <h3>Completá los campos con tus datos para crear una cuenta en Panu!</h3>
                <h3>Ya tienes cuenta? <a href="login.php">Iniciar sesión.</a></h3>
                <div class="form-flex">  
                    <label class="label" >Nombre y apellido</label> 
                    <input class="textfield" type="text" name= "username" value="<?=isset($errors['username']) ? "" : old('username'); ?>" placeholder="Nombre Apellido" >

                    <?php if(isset($errors['username'])): ?>
                        <div class="alert alert-danger">
                            <strong><?=$errors['username']; ?></strong>
                        </div>
                    <?php endif;?> 

                    <label class="label">Correo Electrónico</label>
                    <input class="textfield" type="text" name="email" value="<?=isset($errors['email']) ? "" : old('email'); ?><?=isset($_GET['email']) ? $_GET['email'] : "" ;?>" placeholder="user@email.com" >

                    <?php if(isset($errors['email'])): ?>
                        <div class="alert alert-danger">
                            <strong><?=$errors['email']; ?></strong>
                        </div>
                    <?php endif;?> 

                    <label for="avatar">Foto de perfil:</label>
                    <input type="file" name="avatar">

                    <label class="label">Provincia:</label>
                    <select class="selection" name="provincia" value="<?=isset($errors['provincia']) ? "" : old('provincia'); ?>">
                        <option class="selection" name="provincia" value="" selected hidden disabled>Seleccione su provincia:</option>
                        <option class="selection" name="provincia" value="C.A.B.A.">C.A.B.A.</option> 
                        <option class="selection" name="provincia" value="Buenos Aires">Buenos Aires</option> 
                        <option class="selection" name="provincia" value="Catamarca">Catamarca</option> 
                        <option class="selection" name="provincia" value="Chaco">Chaco</option> 
                        <option class="selection" name="provincia" value="Chubut">Chubut</option> 
                        <option class="selection" name="provincia" value="Córdoba">Córdoba</option> 
                        <option class="selection" name="provincia" value="Corrientes">Corrientes</option> 
                        <option class="selection" name="provincia" value="Entre Ríos">Entre Ríos</option> 
                        <option class="selection" name="provincia" value="Formosa">Formosa</option> 
                        <option class="selection" name="provincia" value="Jujuy">Jujuy</option> 
                        <option class="selection" name="provincia" value="La Pampa">La Pampa</option> 
                        <option class="selection" name="provincia" value="La Rioja">La Rioja</option> 
                        <option class="selection" name="provincia" value="Mendoza">Mendoza</option>                
                        <option class="selection" name="provincia" value="Misiones">Misiones</option> 
                        <option class="selection" name="provincia" value="Neuquén">Neuquén</option> 
                        <option class="selection" name="provincia" value="Río Negro">Río Negro</option> 
                        <option class="selection" name="provincia" value="Salta">Salta</option> 
                        <option class="selection" name="provincia" value="San Juan">San Juan</option> 
                        <option class="selection" name="provincia" value="Santa Cruz">Santa Cruz</option> 
                        <option class="selection" name="provincia" value="Santa Fe">Santa Fe</option> 
                        <option class="selection"name="provincia" value="Santiago del Estero">Santiago del Estero</option>
                        <option class="selection"name="provincia" value="Tierra del Fuego">Tierra del Fuego</option>
                        <option class="selection"name="provincia" value="Tucumán">Tucumán</option>
                        <option class="selection"name="provincia" value="Islas Malvinas Argentinas">Islas Malvinas Argentinas</option>
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
                    </div>
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