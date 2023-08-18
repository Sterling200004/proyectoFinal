<title>BookEasy! - Agregar libros</title>
<link rel="stylesheet" href="../css/style.css">

<?php include("../template/header.php") ?>

<?php 

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtTitulo=(isset($_POST['txtTitulo']))?$_POST['txtTitulo']:"";
$txtPrecio=(isset($_POST['txtPrecio']))?$_POST['txtPrecio']:"";
$txtPortada=(isset($_FILES['txtPortada']['name']))?$_FILES['txtPortada']['name']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("../config/bd.php");

switch($accion){

        case "Anadir":

            $sentencia= $conexion->prepare("INSERT INTO libros (titulo,precio,portada) VALUES (:titulo,:precio,:portada);");
            $sentencia->bindParam(':titulo',$txtTitulo);
            $sentencia->bindParam(':precio',$txtPrecio);

            $fecha= new DateTime();
            $nombrearchivo=($txtPortada!="")?$fecha->getTimestamp()."_".$_FILES["txtPortada"]["name"]:"imagen.jpg";

            $tmpImagen=$_FILES["txtPortada"]["tmp_name"];

            if ($tmpImagen!="") {
                move_uploaded_file($tmpImagen,"../../imagenes/".$nombrearchivo);
            }

            $sentencia->bindParam(':portada',$nombrearchivo);
            $sentencia->execute();

            header("Location: libros.php");
            break;
        
        case "Actualizar":
            $sentencia= $conexion->prepare("UPDATE libros SET titulo=:titulo WHERE id=:id");
            $sentencia->bindParam(':titulo',$txtTitulo);
            $sentencia->bindParam(':id',$txtID);
            $sentencia->execute();

            if ($txtPortada!=""){

                $fecha= new DateTime();
                $nombrearchivo=($txtPortada!="")?$fecha->getTimestamp()."_".$_FILES["txtPortada"]["name"]:"imagen.jpg";
                $tmpImagen=$_FILES["txtPortada"]["tmp_name"];

                move_uploaded_file($tmpImagen,"../../imagenes/".$nombrearchivo);

                $sentencia= $conexion->prepare("SELECT portada FROM libros WHERE id=:id");
                $sentencia->bindParam(':id',$txtID);
                $sentencia->execute();
                $libros=$sentencia->fetch(PDO::FETCH_LAZY);

                if (isset($libros['portada']) && ($libros['portada']!="imagen.jpg") ) {
                
                    if (file_exists("../../imagenes/".$libros["portada"])) {
                    unlink("../../imagenes/".$libros["portada"]);
                    }
                }

                $sentencia= $conexion->prepare("UPDATE libros SET portada=:portada WHERE id=:id");
                $sentencia->bindParam(':portada',$nombrearchivo);
                $sentencia->bindParam(':id',$txtID);
                $sentencia->execute();
            }
            header("Location: libros.php");
            break;
        
        case "Cancelar":
            header("Location: libros.php");
            break;

        case "Seleccionar":
            $sentencia= $conexion->prepare("SELECT * FROM libros WHERE id=:id");
            $sentencia->bindParam(':id',$txtID);
            $sentencia->execute();
            $libros=$sentencia->fetch(PDO::FETCH_LAZY);

            $txtTitulo=$libros['titulo'];
            $txtPrecio=$libros['precio'];
            $txtPortada=$libros['portada'];

            break;

        case "Eliminar":

            $sentencia= $conexion->prepare("SELECT portada FROM libros WHERE id=:id");
            $sentencia->bindParam(':id',$txtID);
            $sentencia->execute();
            $libros=$sentencia->fetch(PDO::FETCH_LAZY);

            if (isset($libros['portada']) && ($libros['portada']!="imagen.jpg") ) {
                
                if (file_exists("../../imagenes/".$libros["portada"])) {
                    unlink("../../imagenes/".$libros["portada"]);
                }
            }

            $sentencia= $conexion->prepare("DELETE FROM libros WHERE id=:id");
            $sentencia->bindParam(':id',$txtID);
            $sentencia->execute();

            header("Location: libros.php");
            break;
}

$sentencia= $conexion->prepare("SELECT * FROM libros");
$sentencia->execute();
$listalibros=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="col-md-4">

<div class="card">
    <div class="card-header">
       <b><h5><center>Datos de los libros</center></b></h5>
    </div>

<div class="card-body">
    <form method="POST" enctype="multipart/form-data">

    <div class = "form-group">
    <label for="txtID">ID del libro: </label>
    <input type="text" class="form-control" value="<?php echo $txtID ?>" id="txtID" name="txtID" placeholder="ID Libro" readonly required>
    </div>

    <div class = "form-group">
    <label for="txtTitulo">Título: </label>
    <input type="text" class="form-control" value="<?php echo $txtTitulo ?>" id="txtTitulo" name="txtTitulo" placeholder="Escribe el título del libro" required>
    </div>

    <div class = "form-group">
    <label for="txtPrecio">Precio: </label>
    <input type="number" class="form-control" value="<?php echo $txtPrecio ?>" id="txtPrecio" name="txtPrecio" placeholder="Escribe el precio del libro" required>
    </div>

    <div class = "form-group">
    <label for="txtPortada">Portada del libro: </label>

    <br>

    <?php  if ($txtPortada!="") {  ?>

        <img class="img-thumbnail rounded" src="../../imagenes/<?php echo $txtPortada;?>" width="50" alt=""/>

    <?php } ?>

    <input type="file" class="form-control" id="txtPortada" name="txtPortada" placeholder="Portada del libro">
    </div>

    <div class="btn-group" role="group" aria-label="">
        <center>
        <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""; ?> value="Anadir" class="btn btn-success">Añadir</button>
        <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Actualizar" class="btn btn-primary">Actualizar</button>
        <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Cancelar" class="btn btn-danger">Cancelar</button>
    </center>
    </div>
</form>
</div>
    </div>
</div>

<div class="col-md-8 shadow p-3 bg-white rounded">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Precio</th>
                <th>Portada</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($listalibros as $libros) { ?>
            <tr>
                <td><?php echo $libros['id']?></td>
                <td><?php echo $libros['titulo']?></td>
                <td><?php echo $libros['precio']?></td>
                <td>
                    
                <img class="img-thumbnail rounded" src="../../imagenes/<?php echo $libros['portada']; ?>" width="50" alt=""/>
            
                </td>

                <td>
                    <form method="post">
                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $libros['id'];?>"/>

                        <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary"/>

                        <input type="submit" name="accion" value="Eliminar" class="btn btn-danger"/>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include("../template/footer.php") ?>