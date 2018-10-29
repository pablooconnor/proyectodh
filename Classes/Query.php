<?php

class Query{

    public static function index($tabla, $db)
    {
        $query = $db->prepare("SELECT * FROM $tabla");
        $query->execute();

        $resultados = $query->fetchAll(PDO::FETCH_ASSOC);

        return $resultados;
    }

    public static function show($base, $tabla, $id)
    {
        $query = $base->prepare("SELECT * FROM $tabla WHERE id = $id");
        $query->execute();
        
        $resultados = $query->fetch(PDO::FETCH_ASSOC);

        return $resultados;
    }

    public static function insertUser($base, $tabla, $user){
        $username = $user->getUsername();
        $email = $user->getEmail();
        $sexo = $user->getSexo();
        $provincia = $user->getProvincia();
        $direccion = $user->getDireccion();
        $password = $user->getPassword();
        $avatar = ($user->getAvatar() == "") ? null : $user->getAvatar();
        
        // $query = $base->prepare("INSERT INTO users (email,password, name) VALUES (:username,:password,:name)");
        $query = $base->prepare("INSERT INTO `panu_db`.`users` (`username`, `email`, `sexo`, `provincia`, `direccion`, `password`, `avatar`)
        VALUES (:username, :email, :sexo, :provincia, :direccion, :password, :avatar);
        ");
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':email', $email);
        $query->bindParam(':sexo', $sexo);
        $query->bindParam(':provincia', $provincia);
        $query->bindParam(':direccion', $direccion);
        $query->bindParam(':password', $password);
        $query->bindParam(':avatar', $avatar);
        
        $query->execute();
    }

    // // Busqueda x email
    public static function emailSearch($email, $db, $tabla)
    {    
        $query = $db->prepare("SELECT * FROM $tabla where email='$email'");
        $query->execute();

        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $resultado;
    }
}


    // // Emulamos una conexion a la base, trayendo el JSON y generando un array asociativo de usuarios
    // public static function dbConnect()
    // {
    //     $db = file_get_contents('users.json');
    //     $arr = explode(PHP_EOL, $db);

    //     array_pop($arr);

    //     if(!empty($arr)){
    //         foreach($arr as $user) {
    //             $usersArray[] = json_decode($user, true);
    //         }
    //         return $usersArray;
    //     }
    // }

    

    // public static function dbIdSearch($id){
    //     $users = dbConnect();
    //     foreach($users as$user){
    //         if($user['id'] == $id){
    //             return $user;
    //         }
    //     }
    // }



    // public static function deleteUser($userId) {
    //     $lines = file('users.json', FILE_IGNORE_NEW_LINES);
    //     foreach($lines as $line){
    //         $arr = json_decode($line, true);
    //         if($arr['id'] == $userId){
    //             unset($lines[array_search($line, $lines)]);
    //             $data = implode(PHP_EOL, $lines);
    //             file_put_contents('users.json', $data);

    //             //Add blank line at the end of JSON
    //             $json = fopen('users.json', a);
    //             fwrite($json, PHP_EOL);
    //             fclose($json);
    //         }
    //     }
    // }

    // public static function highestId($users){
    //     $ids = [];
    //     foreach($users as $user){
    //         $userDecoded = json_decode($user, true);
    //         $ids[] = $userDecoded['id'];
    //     }
    //     return max($ids);
    // }