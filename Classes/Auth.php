<?php

class Auth{
    public static function check(){
        return isset($_SESSION['email']);
    }

    public static function guest(){
        return !self::check();
    }

    public static function login(User $user){
        $_SESSION['username'] = $user->getUsername();
        if(isset($_POST["rememberme"])) {
            setcookie('username', $user->getUsername(), time() + 3600 * 24 * 7, "/");
        }
        $_SESSION['email'] = $user->getEmail();
        if(isset($_POST["rememberme"])) {
            setcookie('email', $user->getEmail(), time() + 3600 * 24 * 7, "/");
        }
    }

    public static function logout(){ 
        if (!isset($_SESSION)){
            session_start();
        }
        session_destroy();
        setcookie('email', null, time() -1);
        Helper::redirect('index.php');
    }
}