<?php

session_start();
require 'helpers.php';
require 'user.php';

 public function validate($user)
{
    $errors = [];

    $username = trim( $user->getUsername());
    if($username == "") {
        $errors['username'] = "Por favor completar con nombre y apellido";
    }

    $email = trim($user->getEmail);
    $emailExists = dbEmailSearch($email);

    if($emailExists === null){
        if($email == "") {
            $errors['email'] = "Por favor colocar el email";
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email no valido";
        }
    } else {
        $errors['email'] = "Este email ya se encuentra en uso";
    }
        
    if(!isset($user['sexo'])) {
        $errors['sexo'] = "Por favor completar tu sexo";
    }

    if(!isset($user['provincia'])) {
        $errors['provincia'] = "Por favor completar la provincia";
    }

    $direction = $user->getDireccion();
    if($direction == "") {
        $errors['direction'] = "Por favor completar la dirección";
    }

    $password = trim($user->getPassword());
    $cpassword = trim($user->getCpassword());
    
    if($password == "") {
        $errors['password'] = "Por favor completar la contraseña";
    } elseif(strlen($password) < 4) {
        $errors['password'] = "La contraseña debe ser de al menos 4 caracteres!";
    }

    if($password != $cpassword) {
        $errors['cpassword'] = "Las contraseñas no coinciden";
    }

    if(!isset($user['confirm'])) {
        $errors['confirm'] = "Tenes que aceptar terminos y condiciones";
    }

    return $errors;

}

 public function validateAvatar($user) 
{
    $errores = [];

    $username = $user->getUsername();

    if($_FILES["avatar"]["error"] == UPLOAD_ERR_OK) {
        $nombre = $_FILES["avatar"]["name"];
        $archivo = $_FILES["avatar"]["tmp_name"];
        
        $ext = pathinfo($nombre, PATHINFO_EXTENSION);

        if(strtolower($ext) != "jpg" && $ext != "png" && $ext != "jpeg") {
            $errores["avatar"] = "Solo acepto formatos jpg y png";
            return $errores;
        }

        $miArchivo = dirname(dirname(__FILE__));
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
 public function photoPath($user)
{
    // Guardame el username en la variable $username
    $username = $user->getUsername();
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



 public function createUser($user)
{
    $usuario = [
        'username' => $user->getUsername();
        'email' => $user['email'],
        'password' => password_hash($data['password'], PASSWORD_DEFAULT),
        'role' => 1,
        'direction' => $user->getDirection
    ];

    if(isset($data['provincia'])){
    $usuario['provincia'] = $data['provincia'];
    }

    $usuario['id'] = idGenerate();

    return $usuario;

}

 public function idGenerate()
{
    $file = file_get_contents("users.json");

    if($file == "") {
        return 1;
    }

    $users = explode(PHP_EOL, $file);

    $highestId = highestId($users);
    return $highestId + 1;
}

  public function saveUser($user)
{
    $jsonUser = json_encode($user);
    file_put_contents('users.json', $jsonUser . PHP_EOL, FILE_APPEND);
}
// Manejo de base de datos

// Emulamos una conexion a la base, trayendo el JSON y generando un array asociativo de usuarios
 public function dbConnect()
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
 public function dbEmailSearch($email)
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

 public function dbIdSearch($id){
    $users = dbConnect();
    foreach($users as$user){
        if($user['id'] == $id){
            return $user;
        }
    }
}

 public function deleteUser($userId) {
    $lines = file('users.json', FILE_IGNORE_NEW_LINES);
    foreach($lines as $line){
        $arr = json_decode($line, true);
        if($arr['id'] == $userId){
            unset($lines[array_search($line, $lines)]);
            $data = implode(PHP_EOL, $lines);
            file_put_contents('users.json', $data);

            //Add blank line at the end of JSON
            $json = fopen('users.json', a);
            fwrite($json, PHP_EOL);
            fclose($json);
        }
    }
}

 public function highestId($users){
    $ids = [];
    foreach($users as $user){
        $userDecoded = json_decode($user, true);
        $ids[] = $userDecoded['id'];
    }
    return max($ids);
}


 public function login($user)
{
    $_SESSION['username'] = $user['username'];
    if(isset($_POST["rememberme"])) {
    setcookie('username', $user['username'], time() + 3600 * 24 * 7, "/");
    }
    $_SESSION['email'] = $user['email'];
    if(isset($_POST["rememberme"])) {
    setcookie('email', $user['email'], time() + 3600 * 24 * 7, "/");
    }
}

public function logout() // no use esta funcion 
{ 
    if (!isset($_SESSION)){
        session_start();
    }
    session_destroy();
    setcookie('email', null, time() -1);
    redirect('index.php');

}

/* <<<<<<<<<<<<  FEED  >>>>>>>>>>>>> */

  public function feedPopulate() {

}

 public function feedConnect()
{
    $db = file_get_contents('posts.json');
    $arr = explode(PHP_EOL, $db);

    foreach($arr as $post) {
        $postArray[] = json_decode($post, true);
    }

    return $postArray;
}

 public function validatePost($post){
    $errors = [];
    if($post['title'] == ""){
        $errors['title'] = "No puedes dejar el titulo vacío.";
    }
    if($post['description'] == ""){
        $errors['description'] = "No puedes dejar la descripción vacía.";
    }
    if(!issed($post['provincia'])){
        $errors['provincia'] = "Debes escoger una provincia.";
    }

    return $errors;
}

 public function createPost($post){

}

 public function postSave($post)
{
    $jsonPost = json_encode($post);
    file_put_contents('post.json', $jsonUser . PHP_EOL, FILE_APPEND);
}

 public function validatePostAvatar($user) 
{
    $errores = [];

    $username = $user->getUsername();

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