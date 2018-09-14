<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panu - Registrarse</title>
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="main">
        <?php include_once('header.php');?>
        <main>
            <form class="form" action="" method="get">
                <h2>Crear cuenta</h2>
                <h3>Completá los campos con tus datos para crear una cuenta en Panu!</h3>
                <h3>Ya tienes cuenta? <a href="login.php">Iniciar sesión.</a></h3>
                <div class="form-flex">  
                    <label class="label" >Nombre y apellido</label> 
                    <input class="textfield" type="text" name= "nombre" placeholder="Nombre Apellido" required>

                    <label class="label">Correo Electrónico</label>
                    <input class="textfield" type="email" name="correoElectronico"placeholder="user@email.com" required>

                    <label class="label">País</label>
                    <select class="selection" name="pais">
                        <option class="selection" value="" disabled hidden selected>Seleccione su país</option>
                        <option class="selection" value="argentina">Argentina</option>                
                        <option class="selection"value="bolivia">Bolivia</option>
                        <option class="selection"value="brasil">Brasil</option>
                        <option class="selection"value="chile">Chile</option>
                        <option class="selection"value="uruguay">Uruguay</option>
                    </select>

                    <label class="label">Dirección</label>
                    <input class="textfield" type= "text"  required>
                    <label class="label">Contraseña</label>
                    <input class="textfield" type="password" required autocomplete="off"/>
                    <label class="label">Confirmar contraseña</label>
                    <input class="textfield" type="password" required autocomplete="off"/>
                    
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