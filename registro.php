<?php
require 'loader.php';

if(Auth::check()) {
    Helper::redirect('perfil.php'); // hay que crearlo
}

if($_POST) {
    // A la variable $errors asignale lo que de como resultado la funcion validate() que procese $_POST
    $errors = Validate::registerValidate($_POST, $db);
    
    // Si hay archivos, y en $_FILES la key 'error' esta seteada en 0... (para visualizar esto, hacer un dd() de $_FILES a ver que llega y COMO)
    if(empty($_FILES['avatar']['error']) == true) {
        //procesa con validateAvatar()
        $avatarErrors = Validate::validateAvatar($_POST);
        //y creame una nueva key en el array $usuario llamada 'avatar' a la cual le asignamos el value de lo que devuelve la funcion photoPath()
        $avatarPath = Validate::photoPath($_POST);
        //SI no esta vacio el array $avatarErrors...
        if(!empty($avatarErrors)) {
            //mergea con array_merge() todos los errores en un solo array $errors
            $errors = array_merge($errors, $avatarErrors); 
        }
    }
    //si count() de $errors es == a 0
    if(count($errors) == 0) {  
        //CREAR OBJETO USUARIO
        $avatarPath = (isset($avatarPath)) ? $avatarPath : "";
        $sexo = ($_POST['sexo'] == 'masculino') ? 0 : 1;
        $user = new User($_POST['username'], $_POST['email'], $sexo, $_POST['direccion'], $_POST['provincia'], password_hash($_POST['password'], PASSWORD_DEFAULT), $avatarPath);
        //guarda el usuario en Json con saveUser()
        Query::insertUser($db, 'users', $user);
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
                    <label class="label" >Nombre de usuario</label> 
                    <input class="textfield" type="text" name="username" value="<?=isset($errors['username']) ? "" : Helper::old('username'); ?>" placeholder="Nombre de usuario" >

                    <?php if(isset($errors['username'])): ?>
                        <div class="alert alert-danger">
                            <strong><?=$errors['username']; ?></strong>
                        </div>
                    <?php endif;?> 

                    <label class="label">Correo Electrónico</label>
                    <input class="textfield" type="text" name="email" value="<?=isset($errors['email']) ? "" : Helper::old('email'); ?><?=isset($_GET['email']) ? $_GET['email'] : "" ;?>" placeholder="user@email.com" >

                    <?php if(isset($errors['email'])): ?>
                        <div class="alert alert-danger">
                            <strong><?=$errors['email']; ?></strong>
                        </div>
                    <?php endif;?> 

                    <label class="label">Sexo</label>
                    <div class="radioButtons">
                        <div>
                            <input type="radio" name="sexo" value="masculino">
                            <label>Masculino</label>
                        </div>
                        <div>
                            <input type="radio" name="sexo" value="femenino">
                            <label>Femenino</label>
                        </div>
                    </div> <br>

                    <?php if(isset($errors['sexo'])): ?>
                        <div class="alert alert-danger">
                            <strong><?=$errors['sexo']; ?></strong>
                        </div>
                    <?php endif;?> 

                    <label for="avatar">Foto de perfil:</label>
                    <input type="file" name="avatar">

                    <label class="label">Provincia:</label>
                    <select class="selection" name="provincia" value="<?=isset($errors['provincia']) ? "" : Helper::old('provincia'); ?>">
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
                    <input class="textfield" type= "text" name="direccion"  value="<?=isset($errors['direccion']) ? "" : Helper::old('direccion'); ?>" >

                    <?php if(isset($errors['direccion'])): ?>
                        <div class="alert alert-danger">
                            <strong><?=$errors['direccion']; ?></strong>
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