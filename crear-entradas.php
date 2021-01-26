<!-- importo mi redirecion, esto significa que si no hay un usuario logueado,
me redireccione al index, asi protejo mis vistas  -->
<?php require_once "includes/redireccion.php" ?>

<!-- importo mi cabecera  -->
<?php require_once "includes/cabecera.php" ?>


<!-- hago el include de la barra lateral -->
<?php require_once "includes/lateral.php"; ?>

<!-- contenido principal o caja -->
<div id="principal">
    <h1>Crear Entradas</h1>
    <p>
        Añade Nuevas entradas al blog para que los usuarios puedan leerlas.
    </p>
    <br>
    <!-- formulario para crear categorias -->
    <form action="guardar-entrada.php" method="POST">

    <label for="titulo">titulo</label>
    <input type="text" name="titulo" id="">
    <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'],'titulo'): ''; ?>

    <label for="descripcion">Descripcion</label>
    <textarea name="descripcion" id="" cols="30" rows="10"></textarea>
    <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'],'descripcion'): ''; ?>

    <label for="categoria">Categoria</label>
    <select name="categoria" id="">
        <?php
            $categorias= conseguirCategorias($db);
            if(!empty($categorias)):
            while($categoria= mysqli_fetch_assoc($categorias)):         
        ?>    
            <option value="<?=$categoria["id"]?>"><?=$categoria["nombre"]?></option>
            
        <?php 
            endwhile;
            endif;
        ?>


    </select>
    <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'],'categoria'): ''; ?>


    <input type="submit" value="Guardar">


    </form>

    <!-- borro los errores al final del formulario, esta funcion esta en el helpers, y sirve para que cuando recarge la pantalla, se me borren los errores de avisos del formulario -->
    <?php borrarErrores(); ?>




    </div> <!-- fin principal -->



<?php require_once "includes/pie.php"; ?>   