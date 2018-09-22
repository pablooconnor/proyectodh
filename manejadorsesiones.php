<?php

require "funciones.php";

if(check()) {
    redirect('perfil.php');
}

if($_POST) {
    $usuario = dbEmailSearch($_POST['email']);
    if($usuario !== null) {
        if(password_verify($_POST['password'], $usuario['password']) == true) {
            login($usuario);
            // var_dump($_COOKIE);
            // exit;
            redirect('perfil.php');
        } 
    }
    
}
 
/* Sabemos que en el caso que exista el usuario se encontrará en una de estas 
dos tablas, por lo tanto se guardará en alguno de nuestras dos variables 
que guardan nuestra consulta */
 
/* Ahora comprobamos que variable contiene al usuario*/
if($_POST($socio) > 0) 
{
    /* Si entra en este if significa que el que intenta acceder es un socio o visitante, 
    por lo tanto le creamos una sesión */
    session_start();
 
    $_SESSION['socio']="$usuario";
 
    /* Nos dirigimos al espacio de los alumnos usando header que nos 
    redireccionará a la página que le indiquemos */
    header("Location: perfil.php");
 
    /* terminamos la ejecución ya que si redireccionamos ya no nos interesa 
    seguir ejecutando código de este archivo */
    exit(); 
}
 
/* Ahora comprobamos si el que intenta acceder es un administrador */
else if($_POST($admin) > 0) 
{
    session_start();
    $_SESSION['admin']="$usuario";
    header("Location: perfiladmin.php");
    exit(); 
} 
else 
{
   /* Si no el usuario no se encuentra en ninguna de las dos tablas 
   imprime el siguiente mensaje */
   $mensajeaccesoincorrecto = "El usuario y la contraseña son incorrectos, por favor vuelva a introducirlos.";
   echo $mensajeaccesoincorrecto; 

?>