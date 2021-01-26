<!-- separamos los componentes e incluimos la conexion -->
<?php require_once "conexion.php"; ?>

<?php require_once "includes/helpers.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog De Videojuegos</title>
    <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/PHP-logo.svg/1200px-PHP-logo.svg.png" type="image/x-icon">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <!-- cabecera -->

    <header id="cabecera">
        <!-- logo -->
        <div id="logo">
            <a href="index.php">Blog de Videojuegos</a>
        </div>
        


        <!-- menu -->
        <nav id="menu">
        

            <ul>
                <li><a href="index.php">inicio</a></li>

                <!-- bucle para listar todas las cabeceras, el parametro db que le paso a la
                funcion conseguirCategorias, viene del archivo conexion.php, el cual esta importado  al principio de esta hoja --> 
                <?php  $categorias= conseguirCategorias($db); 
                       /* if para comprobar que no este vacio ese array */
                       if(!empty($categorias)):
                       while($categoria= mysqli_fetch_assoc($categorias)):
                ?>                 <!-- como parametro le paso en la ruta href, el id de la categoria. -->
                       <li><a href="categoria.php?id=<?=$categoria["id"]?>"><?=$categoria["nombre"]?></a></li>
                <?php endwhile;
                       endif; 
                ?>

                <li><a href="index.php">Sobre mi</a></li>
                <li><a href="index.php">Contacto</a></li>
            </ul>

        </nav>
        <div class="clearfix"></div>

    </header>

    <div id="contenedor"></div>