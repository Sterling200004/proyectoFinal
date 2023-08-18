<?php include("template/header.php"); ?>

    <div class="jumbotron bg-light">
        <h1 class="display-3">Bienvenido a BookEasy, <?php echo $nombre; ?>!</h1>
        <p class="lead">¡Aquí puedes consultar libros de programación!</p>
        <hr class="my-2">
        <p>Tu matrícula es: <?php echo $matriculaUsuario; ?></p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="libros.php" role="button">Ver libros disponibles</a>
        </p>
        </div>
        
<?php include("template/footer.php"); ?>
