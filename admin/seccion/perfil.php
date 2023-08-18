<title>BookEasy! - Perfil (Administrador) </title>
<link rel="stylesheet" href="../css/style.css">

<?php include("../template/header.php") ?>
<?php include("../config/bd.php") ?>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <img src="https://i.pinimg.com/originals/70/84/b3/7084b398cc72d9bcf17427d60b83289c.png" alt="Imagen de perfil" class="rounded-circle mb-4" width="150">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="file" class="btn btn-primary" id="txtPortada" name="txtPortada" placeholder="Portada del libro">
                        </div>
                        <button type="submit" class="btn btn-info">Actualizar imagen</button>
                        <button type="submit" class="btn btn-danger">Borrar imagen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("../template/footer.php") ?>

