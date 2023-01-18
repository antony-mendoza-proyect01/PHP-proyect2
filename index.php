<?php include("header.php");?>
<?php include("bd.php");?>
<?php
$objbd = new bd();
$resultado = $objbd->consultar("SELECT * FROM proyectos ");
?>

<div class="p-5 bg-light">
    <div class="col-md-6">
        <div class="container">
            <h1 class="display-3">Bienvenido</h1>
            <p class="lead">Este es un portafolio</p>
            <hr class="my-2">
            <p>Mas informacion</p>
       <br/>
</div>
    <div class="row row-cols-1 row-cols-md-3 g-4">

    <?php foreach($resultado as $proyecto){  ?>

  <div class="col">
    
    <div class="card">
      <img src="imagenes/<?php echo $proyecto['imagen']; ?>" class="card-img-top" >
      <div class="card-body">
        <h5 class="card-title"><?php echo $proyecto['nombre']; ?></h5>
        <p class="card-text"><?php echo $proyecto['descripcion']; ?></p>
      </div>
    </div>
    <?php } ?>
  </div>

 


<?php include("footer.php");?>