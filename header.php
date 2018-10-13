<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Lato" rel="stylesheet">
    <link rel="stylesheet" href="css/header-footer.css">
    <link href="https://unpkg.com/ionicons@4.4.2/dist/css/ionicons.min.css" rel="stylesheet">
</head>
<body>
<header>
    <div class="header-container">
        <a href="index.php" class="header-content">
            <img class="header-logo" src="images/logo.png" alt="Logo">
            <div class="header-title">
                <h1>Panu</h1>
                <h2>Tu portal de adopción</h2>
            </div>
        </a>
        </div>
        <img class="header-background" src="images/pets.png" alt="">
        <nav class="navigation">
            <a href="index.php">Inicio</a>
            <?php if(Auth::guest()):?>
                <a href="login.php">Iniciar sesion</a>
                <a href="formulario.php">Registro</a>
            <?php endif;?>
            <a href="faq.php">F.A.Q.</a>
            <?php if(Auth::check()):?>
                <a href="perfil.php">Perfil</a>
            <?php endif; ?>
        </nav>
        <?php if(Auth::check()):?>
            <div class="session">
                <h3>Sesión iniciada como <?=$_SESSION['username'];?>, <a href="logout.php">cerrar sesión</a></h3>
            </div>
        <?php endif;?>
    </div>
</header>
</body>
</html>