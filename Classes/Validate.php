<?php

class Validate
{
    public static function registerValidate($data, $db){
        $errors = [];
        
        $username = trim($data['username']);
        if($username == ""){
            $errors['username'] = "Por favor completar el nombre de usuario.";
        }

        $email = trim($data['email']);
        $emailExists = Query::emailSearch($email, $db, 'users');

        if(empty($emailExists)){
            if($email == "") {
                $errors['email'] = "Por favor colocar el email";
            } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Email no valido";
            }
        } else {
            $errors['email'] = "Este email ya se encuentra en uso";
        }
            
        if(!isset($data['sexo'])) {
            $errors['sexo'] = "Por favor completar tu sexo";
        }
    
        if(!isset($data['provincia'])) {
            $errors['provincia'] = "Por favor completar la provincia";
        }
    
        $direccion = $data['direccion'];
        if($direccion == "") {
            $errors['direccion'] = "Por favor completar la dirección";
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

    public static function idGenerate()
    {
    $file = file_get_contents("users.json");

    if($file == "") {
        return 1;
    }

    $users = explode(PHP_EOL, $file);

    $highestId = self::highestId($users);
    return $highestId + 1;
    }

    private static function highestId($users){
    $ids = [];
    foreach($users as $user){
        $userDecoded = json_decode($user, true);
        $ids[] = $userDecoded['id'];
    }
    return max($ids);
    }

    public static function validateAvatar($data) 
    {
    $errores = [];

    $username = $data['username'];

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
    public static function photoPath($data)
    {
        // Guardame el username en la variable $username
        $username = $data['username'];
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

    function saveUser($user)
    {   
        $jsonUser = json_encode($user);
        file_put_contents('users.json', $jsonUser . PHP_EOL, FILE_APPEND);
    }
}


