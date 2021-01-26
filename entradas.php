<!-- importo mi cabecera  -->
<?php require_once "includes/cabecera.php" ?>


<!-- hago el include de la barra lateral -->
<?php require_once "includes/lateral.php"; ?>



<!-- contenido principal o caja -->
<div id="principal">
    <h1>todas las entradas</h1>

    <!-- bucle para listar las entradas -->
    <?php
    $entradas = conseguirEntradas($db);
   
    if (!empty($entradas)) :
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
    endif;
    ?>
    <!-- fin bucle para listar las ultimas entradas -->

  

</div> <!-- fin principal -->



<?php require_once "includes/pie.php"; ?>