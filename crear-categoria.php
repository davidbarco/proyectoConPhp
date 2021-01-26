<!-- importo mi redirecion, esto significa que si no hay un usuario logueado,
me redireccione al index, asi protejo mis vistas  -->
<?php require_once "includes/redireccion.php" ?>

<!-- importo mi cabecera  -->
<?php require_once "includes/cabecera.php" ?>


<!-- hago el include de la barra lateral -->
<?php require_once "includes/lateral.php"; ?>

<!-- contenido principal o caja -->
<div id="principal">
    <h1>Crear Categorias</h1>
    <p>
        Añade Nuevas categorias al blog para que los usuarios puedan usarlas
        al crear sus entradas
    </p>
    <br>
    <!-- formulario para crear categorias -->
    <form action="guardar-categoria.php" method="POST">

    <label for="nombre">Nombre de la categoria</label>
    <input type="text" name="nombre" id="">


    <input type="submit" value="Guardar">


    </form>




    </div> <!-- fin principal -->



<?php require_once "includes/pie.php"; ?>   