<?php
require 'funciones.php';

if(checkRole($_SESSION['email']) == false) {
    redirect('perfil.php');
}
    
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/backend.css">
    <link rel="stylesheet" href="css/header-footer.css">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
</head>

    <?php require 'header.php' ?>
</head>
<body>
    <div class="container">

        <!-- <div class="alert alert-danger" role="alert">
            No estas autorizado en este sistema <a href="register.php" class="alert-link">Registrate!</a>
        </div> -->

        <h1>Todavia no podes hacer nada, SORRY!</h1>

    </div>
    <?php require 'footer.php' ?>
</body>
</html>