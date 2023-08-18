<title>BookEasy! - Gestionar usuario</title>
<link rel="stylesheet" href="../css/style.css">

<?php include("../template/header.php") ?>

<?php 

$txtIDUser=(isset($_POST['txtIDUser']))?$_POST['txtIDUser']:"";
$txtTNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtApellido=(isset($_POST['txtApellido']))?$_POST['txtApellido']:"";
$txtTelefono=(isset($_POST['txtTelefono']))?$_POST['txtTelefono']:"";
$txtMatricula=(isset($_POST['txtMatricula']))?$_POST['txtMatricula']:"";
$txtContra=(isset($_POST['txtContra']))?$_POST['txtContra']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("../config/bd.php");

switch($accion){

        case "Anadir":

            $sentencia= $conexion->prepare("INSERT INTO usuarios (nombre,apellido,telefono,matricula,contrasena) VALUES (:nombre,:apellido,:telefono,:matricula,:contrasena);");
            $sentencia->bindParam(':nombre',$txtTNombre);
            $sentencia->bindParam(':apellido',$txtApellido);
            $sentencia->bindParam(':telefono',$txtTelefono);
            $sentencia->bindParam(':matricula',$txtMatricula);
            $sentencia->bindParam(':contrasena',$txtContra);
            $sentencia->execute();

            header("Location: usuario.php");
            break;
        
        case "Actualizar":
            $sentencia= $conexion->prepare("UPDATE usuarios SET nombre=:nombre WHERE id=:id");
            $sentencia->bindParam(':nombre',$txtTNombre);
            $sentencia->bindParam(':id',$txtIDUser);
            $sentencia->execute();

            $sentencia= $conexion->prepare("UPDATE usuarios SET apellido=:apellido WHERE id=:id");
            $sentencia->bindParam(':apellido',$txtApellido);
            $sentencia->bindParam(':id',$txtIDUser);
            $sentencia->execute();

            $sentencia= $conexion->prepare("UPDATE usuarios SET telefono=:telefono WHERE id=:id");
            $sentencia->bindParam(':telefono',$txtTelefono);
            $sentencia->bindParam(':id',$txtIDUser);
            $sentencia->execute();

            $sentencia= $conexion->prepare("UPDATE usuarios SET matricula=:matricula WHERE id=:id");
            $sentencia->bindParam(':matricula',$txtMatricula);
            $sentencia->bindParam(':id',$txtIDUser);
            $sentencia->execute();

            $sentencia= $conexion->prepare("UPDATE usuarios SET contrasena=:contrasena WHERE id=:id");
            $sentencia->bindParam(':contrasena',$txtContra);
            $sentencia->bindParam(':id',$txtIDUser);
            $sentencia->execute();

            header("Location: usuario.php");
            break;
        
        case "Cancelar":
            header("Location: usuario.php");
            break;

        case "Editar":
            $sentencia= $conexion->prepare("SELECT * FROM usuarios WHERE id=:id");
            $sentencia->bindParam(':id',$txtIDUser);
            $sentencia->execute();
            $usuarios=$sentencia->fetch(PDO::FETCH_LAZY);

            $txtTNombre=$usuarios['nombre'];
            $txtApellido=$usuarios['apellido'];
            $txtTelefono=$usuarios['telefono'];
            $txtMatricula=$usuarios['matricula'];
            $txtContra=$usuarios['contrasena'];

            break;

        case "Borrar":
            $sentencia= $conexion->prepare("DELETE FROM usuarios WHERE id=:id");
            $sentencia->bindParam(':id',$txtIDUser);
            $sentencia->execute();

            header("Location: usuario.php");
            break;
}

$sentencia= $conexion->prepare("SELECT * FROM usuarios");
$sentencia->execute();
$listausuarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="col-md-3">

<div class="card">
    <div class="card-header">
       <b><h5><center>Acciones de usuarios</center></b></h5>
    </div>

<div class="card-body">
    <form method="POST" enctype="multipart/form-data">

    <div class = "form-group">
    <label for="txtIDUser">ID del usuario: </label>
    <input type="text" class="form-control" value="<?php echo $txtIDUser ?>" id="txtIDUser" name="txtIDUser" placeholder="ID usuario" readonly required>
    </div>

    <div class = "form-group">
    <label for="txtNombre">Nombre: </label>
    <input type="text" class="form-control" value="<?php echo $txtTNombre ?>" id="txtNombre" name="txtNombre" placeholder="Nombre del usuario" required>
    </div>

    <div class = "form-group">
    <label for="txtApellido">Apellido: </label>
    <input type="text" class="form-control" value="<?php echo $txtApellido ?>" id="txtApellido" name="txtApellido" placeholder="Apellido del usuario" required>
    </div>

    <div class = "form-group">
    <label for="txtTelefono">Teléfono: </label>
    <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" class="form-control" value="<?php echo $txtTelefono ?>" id="txtTelefono" name="txtTelefono" placeholder="Ej: 000-000-0000" required>
    </div>

    <div class = "form-group">
    <label for="txtMatricula">Matrícula: </label>
    <input type="number" class="form-control" value="<?php echo $txtMatricula ?>" id="txtMatricula" name="txtMatricula" placeholder="Matrícula del usuario" required>
    </div>

    <div class = "form-group">
    <label for="txtContra">Contraseña: </label>
    <input type="password" class="form-control" value="<?php echo $txtContra ?>" id="txtContra" name="txtContra" placeholder="Mín: 5, Máx: 20" maxlength="20" minlength="5" required>
    </div>

    <div class = "form-group">
    </div>

    <div class="btn-group" role="group" aria-label="">
        <center>
        <button type="submit" name="accion" <?php echo ($accion=="Editar")?"disabled":""; ?> value="Anadir" class="btn btn-success">Añade</button>
        <button type="submit" name="accion" <?php echo ($accion!="Editar")?"disabled":""; ?> value="Actualizar" class="btn btn-primary">Modif.</button>
        <button type="submit" name="accion" <?php echo ($accion!="Editar")?"disabled":""; ?> value="Cancelar" class="btn btn-danger">Atrás</button>
        </center>
    </div>
</form>
</div>
    </div>
</div>

<div class="col-md-9 shadow p-3 bg-white rounded">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Telefono</th>
                <th>Matrícula</th>
                <th>Contraseña</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($listausuarios as $usuarios) { ?>
            <tr>
                <td><?php echo $usuarios['id']?></td>
                <td><?php echo $usuarios['nombre']?></td>
                <td><?php echo $usuarios['apellido']?></td>
                <td><?php echo $usuarios['telefono']?></td>
                <td><?php echo $usuarios['matricula']?></td>
                <td><?php echo $usuarios['contrasena']?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="txtIDUser" id="txtIDUser" value="<?php echo $usuarios['id'];?>"/>
                        <input type="submit" name="accion" value="Editar" class="btn btn-primary"/>
                        <input type="submit" name="accion" value="Borrar" class="btn btn-danger"/>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php include("../template/footer.php") ?>