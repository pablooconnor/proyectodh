<?php

session_start();
require 'helpers.php';
require 'Classes/loader.php';

// function login($user)
// {
//     $_SESSION['username'] = $user['username'];
//     if(isset($_POST["rememberme"])) {
//     setcookie('username', $user['username'], time() + 3600 * 24 * 7, "/");
//     }
//     $_SESSION['email'] = $user['email'];
//     if(isset($_POST["rememberme"])) {
//     setcookie('email', $user['email'], time() + 3600 * 24 * 7, "/");
//     }
// }

// function logout() // no use esta funcion 
// { 
//     if (!isset($_SESSION)){
//         session_start();
//     }
//     session_destroy();
//     setcookie('email', null, time() -1);
//     redirect('index.php');

// }

/* <<<<<<<<<<<<  FEED  >>>>>>>>>>>>> */

function feedPopulate() {

}

function feedConnect()
{
    $db = file_get_contents('posts.json');
    $arr = explode(PHP_EOL, $db);

    foreach($arr as $post) {
        $postArray[] = json_decode($post, true);
    }

    return $postArray;
}

function validatePost($post){
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

function createPost($post){

}

function postSave($post)
{
    $jsonPost = json_encode($post);
    file_put_contents('post.json', $jsonUser . PHP_EOL, FILE_APPEND);
}

function validatePostAvatar($user) 
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

/* <<<<<<<<<<<<  END-FEED  >>>>>>>>>>>>> */