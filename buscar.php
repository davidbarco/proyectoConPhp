



<?php

if(!isset($_POST["busqueda"])){
    header("Location:index.php");
}

?>



<!-- importo mi cabecera  -->
<?php require_once "includes/cabecera.php" ?>


<!-- hago el include de la barra lateral -->
<?php require_once "includes/lateral.php"; ?>



<!-- contenido principal o caja -->
<div id="principal">

    
    <h1>Busqueda: <?=$_POST["busqueda"]?></h1>

    <!-- bucle para listar las entradas -->
    <?php
     $entradas= conseguirEntradas($db,null,null,$_POST["busqueda"]);
    if (!empty($entradas) && mysqli_num_rows($entradas)>=1) :
        while ($entrada = mysqli_fetch_assoc($entradas)) :
    ?>
            <article class="entrada">
           
                <a href="entrada.php?id=<?=$entrada["id"]?>">
                    <h2><?=$entrada["titulo"]?></h2>
                    <span class="fecha"><?=$entrada['categoria'].' | '.$entrada['fecha']?></span>
                    <!-- si quiero limitar a que la descripcion se muestre con 
                    menos letras, puedo sustituro todo el parrafo por esto:
                     <p><?=substr($entrada["descripcion"],0, 200)?></p>
                     -->
                    <p><?=substr($entrada["descripcion"],0, 200)."..."?></p>
                </a>

            </article>

    <?php
        endwhile;
    else:
    ?>
    <div class="alerta">
       No hay entradas en esta categoria
    </div>
    <?php endif ?>
    <!-- fin bucle para listar las ultimas entradas -->

  

</div> <!-- fin principal -->



<?php require_once "includes/pie.php"; ?>