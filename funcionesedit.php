<?php

session_start();
require 'helpers.php';

function validate($data)
{
    $errors = [];

    $username = trim($data['username']);
    if($username == "") {
        $errors['username'] = "Por favor completar con nombre y apellido";
    }

    $email = trim($data['email']);

    if($email == "") {
        $errors['email'] = "Por favor colocar el email";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email no valido";
    }

    $provincia = $data['provincia'];
    if($provincia == "") {
        $errors['provincia'] = "Por favor completar la provincia";
    }

    $direction = $data['direction'];
    if($direction == "") {
        $errors['direction'] = "Por favor completar la dirección";
    }

    $password = trim($data['password']);
    $cpassword = trim($data['cpassword']);
    
    if($password == "") {
        $errors['password'] = "Por favor completar la contraseña";
    } elseif(strlen($password) < 4) {
        $errors['password'] = "La contraseña debe ser de al menos 4 caracteres!";
    }

    if($password != $cpassword) {
        $errors['cpassword'] = "Las contraseñas no coinciden";
    }

    if(!isset($data['confirm'])) {
        $errors['confirm'] = "Tenes que aceptar terminos y condiciones";
    }

    return $errors;

}

function validateAvatar($data) 
{
    $errores = [];

    $username = $data["username"];

    if($_FILES["avatar"]["error"] == UPLOAD_ERR_OK) {
        $nombre = $_FILES["avatar"]["name"];
        $archivo = $_FILES["avatar"]["tmp_name"];
        
        $ext = pathinfo($nombre, PATHINFO_EXTENSION);

        if($ext != "jpg" && $ext != "png" && $ext != "jpeg") {
            $errores["avatar"] = "Solo acepto formatos jpg y png";
            return $errores;
        }

        $miArchivo = dirname(__FILE__);
        $miArchivo = $miArchivo . "/img/";
        $miArchivo = $miArchivo. "perfil" . $username . "." . $ext;
        move_uploaded_file($archivo, $miArchivo);

    } else {
        $errores["avatar"] = "Hubo un error al procesar el archivo";
    }
    return $errores;
}

// Funcion para obtener el nombre que el avatar (foto de perfil) de un usuario va a tener DEL LADO DE MI SISTEMA
// Con esto lograriamos guardar ese nombre en la key Avatar de nuestro array de usuario, para despues llamarlo en caso de 
// querer mostrarlo en su perfil
function photoPath($data)
{
    // Guardame el username en la variable $username
    $username = $data["username"];
    // Temporalmente, asigname a $nombre lo que llegue en $_FILES['avatar']['name]...
    $nombre = $_FILES["avatar"]["name"];
    // y haciendo uso de $nombre, asigna a $ext lo que devuelva la funcion pathinfo() a la cual
    // le paso como parametro el mismo, y tambien la constante PATHINFO_EXTENSION
    $ext = pathinfo($nombre, PATHINFO_EXTENSION);

    //Generame una variable $miArchivo concatenando la palabra perfil, mas el username, mas un PUNTO, mas la EXTENSION...
    $miArchivo = "perfil" . $username . "." . $ext;
    // y devolvemelo
    return $miArchivo;
}



function createUser($data)
{
    $usuario = [
        'username' => $data['username'],
        'email' => $data['email'],
        'password' => password_hash($data['password'], PASSWORD_DEFAULT),
        'role' => 1,
        'provincia' => $data['provincia'],
        'direction' => $data['direction'],
    ];

    $usuario['id'] = idGenerate();

    return $usuario;

}

function idGenerate()
{
    $file = file_get_contents("users.json");

    if($file == "") {
        return 1;
    }

    $users = explode(PHP_EOL, $file);
    array_pop($users);

    $lastUser = $users[count($users) - 1];
    $lastUser = json_decode($lastUser, true);

    return $lastUser['id'] + 1;

}

function saveUser($user)
{
    $jsonUser = json_encode($user);
    file_put_contents('users.json', $jsonUser . PHP_EOL, FILE_APPEND);
}
// Manejo de base de datos

// Emulamos una conexion a la base, trayendo el JSON y generando un array asociativo de usuarios
function dbConnect()
{
    $db = file_get_contents('users.json');
    $arr = explode(PHP_EOL, $db);

    array_pop($arr);

    foreach($arr as $user) {
        $usersArray[] = json_decode($user, true);
    }

    return $usersArray;

}
// Busqueda x email
function dbEmailSearch($email)
{
    // Donde buscamos x email a un usuario? En el array que genera la conexion emulada!
    $users = dbConnect();
    // POR CADA $users COMO $user...
    foreach($users as $user) {
        // SI el email de algun $user es === a $email (lo que lleva por parametro)
        if($user['email'] === $email) {
            // Devolveme el $user
            return $user;
        }
    }
    //Si con lo de arriba no paso nada, devolveme null
    return null;
}




function login($user)
{
    $_SESSION['username'] = $user['username'];
    setcookie('username', $user['username'], time() + 3600 * 24 * 7, "/");
    $_SESSION['email'] = $user['email'];
    setcookie('email', $user['email'], time() + 3600 * 24 * 7, "/");
}

function logout() // no use esta funcion 
{ 
    if (!isset($_SESSION)){
        session_start();
    }
    session_destroy();
    setcookie('email', null, time() -1);
    redirect('index.php');

}








 















































































































