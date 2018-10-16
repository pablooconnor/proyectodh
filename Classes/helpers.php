<?php
require 'Classes/loader.php';

class Helper
{



// Debug
public static function dd(...$param)
{
    echo "<pre>";
    die(var_dump($param));
}

// Errores en if ternario para values en formularios
public static function old($field)
{
    if(isset($_POST[$field])){
        return $_POST[$field];
    }
}
// redirect para no andar escribiendo header(Location) sarasa todo el tiempo
 public static function redirect($url)
{
    header('Location: ' . $url);
    exit;
}

// checkeo si esta seteada la session como yo quiero que este en mi sistema 
public static function check()
{
    return isset($_SESSION['email']);
}

// funcion para mostrar (o no) contenido a usuarios no registrados
function guest()
{
    return !check();
}

// check de rol, 7 es admin, todos los usuarios que se registran en mi sistema vienen con 1 por defecto
function checkRole($email)
{
    // a la variable $user le asigno lo que me devuelva la busqueda por mail
    $user = emailSearch($email);
    // SI el rol del $user es 7
    if($user['role'] == 7) {
        //dame TRUE
        return true;
    } else {
        //cualquier otra cosa, dame FALSE
        return false;
    }
}


































