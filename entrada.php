<!-- importo la conexion  -->
<?php require_once "includes/conexion.php" ?>
<!-- importo mi helpers, es donde está el metodo de conseguirCategoria  -->
<?php require_once "includes/helpers.php" ?>



<?php   /* consigo el id por medio de la url  */
      $entrada_actual= conseguirEntrada($db, $_GET["id"]);
      
      if(!isset($entrada_actual["id"])){
          header("Location:index.php");
      }

    ?>



<!-- importo mi cabecera  -->
<?php require_once "includes/cabecera.php" ?>


<!-- hago el include de la barra lateral -->
<?php require_once "includes/lateral.php"; ?>



<!-- contenido principal o caja -->
<div id="principal">

    
    <h1><?=$entrada_actual['titulo']?></h1>
    <a href="categoria.php?id=<?=$entrada_actual['categoria_id']?>"><h1><?=$entrada_actual["categoria"]?></h1></a>
    <h4><?=$entrada_actual["fecha"]?> | <?=$entrada_actual["usuario"]?></h4>
    
    <p><?=$entrada_actual["descripcion"]?></p>
    
    <!-- botones cuando el usuario este logueado y cuando el id del usuario sea igual al id de la entrada -->

    <?php if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]["id"]== $entrada_actual["usuario_id"]) : ?>
        <a href="editar-entrada.php?id=<?=$entrada_actual["id"]?>" class="boton ">Editar entrada</a>

        <!-- al boton de borrar le paso como parametro el id para poder recogerlo por get en la url -->
        <a href="borrar-entrada.php?id=<?=$entrada_actual["id"]?>" class="boton boton-verde">Borrar entrada</a>
    <?php endif; ?>
     

</div> <!-- fin principal -->



<?php require_once "includes/pie.php"; ?>