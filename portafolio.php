<?php include("header.php");?>
<?php include("bd.php");?>

<?php 


if($_POST){
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];

//con el tiempo poner un nuevo nombre

$fecha = new DateTime();
//gettimetamp el tiempo
    $imagen = $fecha->getTimestamp()."_".$_FILES['imagen']['name'];

    $imagen_temporal = $_FILES['imagen']['tmp_name'];

    move_uploaded_file($imagen_temporal,"imagenes/".$imagen);

$objbd = new bd();
//inserta datos
$sql = "INSERT INTO `proyectos` (`id`, `nombre`, `imagen`, `descripcion`) 
VALUES (NULL,'$nombre', '$imagen', '$descripcion');";
$objbd->ejecutar($sql);
    header("location:portafolio.php");

}

if($_GET){

    $id=$_GET['borrar'];
    $objbd = new bd();
    //consulta para eliminar imagen

    $imagen = $objbd->consultar("SELECT imagen FROM `proyectos`
    WHERE id=".$id);
    unlink("imagenes/".$imagen[0]['imagen']);

    $sql = "DELETE FROM proyectos WHERE `proyectos`.`id` = ".$id;
    $objbd->ejecutar($sql);
    header("location:portafolio.php");
}

//consulta los datos
$objbd = new bd();
$resultado = $objbd->consultar("SELECT * FROM proyectos ");


?>
<br/>

<div class="container">
    <div class="row">
        <div class="col-md-6">
        <div class="card">
    <div class="card-header">
        Datos del proyecto
    </div>
    <div class="card-body">
    <form action="portafolio.php" method="post"  enctype="multipart/form-data" > <!-- enctype multipart recepciona los datos -->

  <div class="mb-3">
    <label for="nombre" class="form-label">Nombre del proyecto : </label>
    <input required type="text"
      class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre del proyecto">
  </div>

  <div class="mb-3">
    <label for="imagen" class="form-label">Imagen del proyecto : </label>
    <input required type="file"
      class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="insertar imagen">
  </div>


    <label for="descripcion" class="form-label">Descripcion :</label>
    <textarea  class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion">
  </textarea>
  <br/>


  <button type="submit" class="btn btn-success">Enviar Archivo</button>


</form>
    </div>
    
</div>
        </div>
        <div class="col-6">
        <div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Imagen</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($resultado as $proyecto){  ?>
            <tr class="">
                <td> <?php echo $proyecto['id']; ?></td>
                <td><?php echo $proyecto['nombre']; ?></td>
                <td>
                    <img width="40" src="imagenes/<?php echo $proyecto['imagen']; ?>" alt="">
                    
                </td>
                <td><?php echo $proyecto['descripcion']; ?></td>
                <td><a class="btn btn-danger" href="?borrar=<?php echo $proyecto['id']; ?>" >Eliminar</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

        </div>
        
    </div>
</div>






<?php include("footer.php");?>
