<?php

class DB{
    // Emulamos una conexion a la base, trayendo el JSON y generando un array asociativo de usuarios
    public static function dbConnect()
    {
        $db = file_get_contents('users.json');
        $arr = explode(PHP_EOL, $db);

        array_pop($arr);

        if(!empty($arr)){
            foreach($arr as $user) {
                $usersArray[] = json_decode($user, true);
            }
            return $usersArray;
        }
    }

    // Busqueda x email
    public static function emailSearch($email):User
    {
        // Donde buscamos x email a un usuario? En el array que genera la conexion emulada!
        $users = self::dbConnect();
        
        if($users != null){
            foreach($users as $user) {
                // SI el email de algun $user es === a $email (lo que lleva por parametro)
                if($user['email'] === $email) {
                    // Devolveme el $user
                    $userObject = new User($user, $user['avatar'], false);
                    
                    return $userObject;
                }
            }
        }
        //Si con lo de arriba no paso nada, devolveme null
        return null;
    }

    public static function dbIdSearch($id){
        $users = dbConnect();
        foreach($users as$user){
            if($user['id'] == $id){
                return $user;
            }
        }
    }

    public static function saveUser(User $user)
    {
        $jsonUser = $user->toJson();
        file_put_contents('users.json', $jsonUser . PHP_EOL, FILE_APPEND);
    }

    public static function deleteUser($userId) {
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

    public static function highestId($users){
        $ids = [];
        foreach($users as $user){
            $userDecoded = json_decode($user, true);
            $ids[] = $userDecoded['id'];
        }
        return max($ids);
    }
}