<?php

class Auth{
    public static function check(){
        return isset($_SESSION['email']);
    }

    public static function guest(){
        return !self::check();
    }
}