<?php include("template/header.php"); ?>

<?php include("admin/config/bd.php"); 

$sentencia= $conexion->prepare("SELECT * FROM libros");
$sentencia->execute();
$listalibros=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>
<?php foreach ($listalibros as $libros) { ?>
<div class="col-md-3">
<div class="card">
    <img class="card-img-top" src="./imagenes/<?php echo $libros['portada']; ?>" alt="" width="920" height="400">
    <div class="card-body">
        <h4 class="card-title">Título: <?php echo $libros['titulo']; ?></h4>
        <h4 class="card-title">Precio: <?php echo $libros['precio']; ?></h4>
        <a name="" id="" class="btn btn-primary" href="#" role="button"> Ver más </a>
    </div> 
</div>
<br>
</div>

<?php } ?>
        
<?php include("template/footer.php"); ?>