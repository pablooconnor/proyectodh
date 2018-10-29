<?php

require 'Classes/User.php';
require 'Classes/Validate.php';
require 'Classes/Auth.php';
require 'Classes/DB.php';
require 'Classes/Query.php';
require 'Classes/Helper.php';

session_start();
$db = DB::Connect();

// $users = Query::index("users", $db);

// $user = new User("ASd22", "asdasdasd@gmail.com", 1, "asdasd 123", "Buenos Aires", "qwe123123", "perfil.jpg");
// Query::insertUser($db, "users", $user);
// echo '<pre>';
// var_dump($users);
// echo '</pre>';

