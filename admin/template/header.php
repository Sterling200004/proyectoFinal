<?php 
session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: ../index.php");
    }else{

        if ($_SESSION['usuario']=="ok") {
            $nombreUsuario=$_SESSION['nombreUsuario'];
        }
    }
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<?php $url="http://".$_SERVER['HTTP_HOST']."/ProyectoFinal" ?>

<nav class="navbar navbar-expand navbar-light bg-light">
    <div class="nav navbar-nav">
    <a class="navbar-brand" href="<?php echo $url;?>/admin/inicio.php">
      <img src="https://th.bing.com/th/id/R.a0342beab31d2d6ec9c5a683f4dc123d?rik=%2bUblFXg8c7237w&pid=ImgRaw&r=0" alt="" width="40" height="35">
    </a>
        <a class="nav-item nav-link" href="<?php echo $url;?>/admin/inicio.php">Home</a>
        <a class="nav-item nav-link" href="<?php echo $url;?>/admin/seccion/libros.php">Gestionar libros</a>
        <a class="nav-item nav-link" href="<?php echo $url;?>/admin/seccion/usuario.php">Agregar usuario</a>
        <a class="nav-item nav-link" href="<?php echo $url;?>/principal.php" target="_blank">Vista del sitio</a>
    </div>

    <div class="ml-auto">
        <div class="user-profile">
            <img src="https://i.pinimg.com/originals/70/84/b3/7084b398cc72d9bcf17427d60b83289c.png" alt="Foto de usuario" class="user-avatar">
            <div class="user-options">
                <a class="dropdown-item" href="<?php echo $url;?>/admin/seccion/cerrar.php">Cerrar sesión</a>
            </div>
        </div>
    </div>
</nav>

    <div class="container">
    <br/><br/>
        <div class="row">