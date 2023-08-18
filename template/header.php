<?php 
session_start();
    if (!isset($_SESSION['matricula'])) {
        header("Location: index.php");
    }else{

        if ($_SESSION['matricula']=="ok") {
            $nombre=$_SESSION['nombre'];
            $matriculaUsuario=$_SESSION['matriculaUsuario'];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página inicio</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand navbar-light bg-light">
    <div class="nav navbar-nav">
    <a class="navbar-brand" href="principal.php">
      <img src="https://th.bing.com/th/id/R.a0342beab31d2d6ec9c5a683f4dc123d?rik=%2bUblFXg8c7237w&pid=ImgRaw&r=0" alt="" width="40" height="35">
    </a>
        <a class="nav-item nav-link" href="principal.php">Home</a>
        <a class="nav-item nav-link" href="libros.php">Libros disponibles</a>
    </div>

    <div class="ml-auto">
        <div class="user-profile">
            <img src="https://th.bing.com/th/id/R.d5deb92f3d282a327f9fb804a2e69891?rik=5OGgsnZca4dY5g&pid=ImgRaw&r=0" alt="Foto de usuario" class="user-avatar">
            <div class="user-options">
                <a class="dropdown-item" href="cerrar.php">Cerrar sesión</a>
            </div>
        </div>
    </div>
</nav> 
<div class="container">
</br></br>
    <div class="row">