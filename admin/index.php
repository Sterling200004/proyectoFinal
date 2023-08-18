<?php 

session_start();
if ($_POST) {
    if (($_POST['usuario']=="Administrador") && ($_POST['contrasena']=="Admin1212")) {
        
        $_SESSION['usuario']="ok";
        $_SESSION['nombreUsuario']="Administrador";
        header('Location: inicio.php');
    }else{
        $msg="Error: Usuario o contraseña están incorrectos.";
    }
}


?>


<!doctype html>
<html lang="en">
  <head> 
    <title>BookEasy! | Login Administrador </title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  <div class="container">
        <div class="row">
            <div class="col-md-4">
                
            </div>
            <div class="col-md-4">
            <br/><br/><br/><br/>
                <div class="card">
                    <div class="card-header">
                    <center><b>Login administrador</center></b>
                    </div>
                    <div class="card-body">
                    
                    <?php if (isset($msg)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $msg; ?>
                        </div>
                    <?php } ?>


                        <form method="POST">

                        <div class = "form-group">
                        <label for="user">Usuario: </label>
                        <input type="text" class="form-control" name="usuario" placeholder="Introduzca su usuario" Required>
                        </div>

                        <div class="form-group">
                        <label for="contra">Contraseña: </label>
                        <input type="password" class="form-control" name="contrasena" placeholder="Contraseña" minlength="5" maxlength="20" required>
                        </div>
                        <center><button type="submit" class="btn btn-primary">Iniciar sesión</button></center>
                        </form>
                    </div>
                    <div class="card-footer text-muted">
                        <center><a  class="btn btn-danger" href="../index.php" role="button"> Soy un usuario común </a></center>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
  </body>
</html> 