<?php
require 'funciones/funciones.php';

if(checkRole($_SESSION['email']) == false) {
    redirect('perfil.php');
}

$users = dbConnect();

if(isset($_GET['id'])){
    $userId = $_GET['id'];
    deleteUser($userId);
}
    
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel - Panu</title>
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Lato" rel="stylesheet">
    <link href="https://unpkg.com/ionicons@4.4.2/dist/css/ionicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/backend.css">
</head>
<body>
    <?php include_once 'header.php'; ?>
    <div class="container">
        <h2>Eliminar usuarios. </h2>
        <h3>Hay un total de <?=count($users)?> usuarios.</h3>
        <ul class="userslist">
            <?php foreach($users as $user):?>
            <li><a href="?id=<?=$user['id'];?>"><i class="icon ion-md-trash"></i> <?=$user['email']?></a></li>
            <?php endforeach;?>
    </ul>
    </div>
    <?php include_once 'footer.php'; ?>
</body>
</html>