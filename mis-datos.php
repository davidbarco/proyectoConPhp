<!-- importo mi redirecion, esto significa que si no hay un usuario logueado,
me redireccione al index, asi protejo mis vistas  -->
<?php require_once "includes/redireccion.php" ?>

<!-- importo mi cabecera  -->
<?php require_once "includes/cabecera.php" ?>


<!-- hago el include de la barra lateral -->
<?php require_once "includes/lateral.php"; ?>

                <!-- contenido principal o caja -->
                <div id="principal">
                <h1>Mis datos</h1>
                <!-- formulario para actualizar solo el nombre y el apellido -->

<?php if(isset($_SESSION["completado"])):?>
                  <div class="alerta alerta-exito">
                       <?=$_SESSION["completado"]?>
                  </div>

                 <?php elseif(isset($_SESSION["errores"]["general"])): ?>
                    <div class="alerta alerta-error">
                       <?=$_SESSION["errores"]["general"]?>
                  </div>
                <?php endif; ?>


                <form action="actualizar-usuario.php" method="POST">
                    <label for="nombre">Nombre</label>
                    <!-- en el value de cada input, coloco el nombre, apellidos, email de cada usuario que este en la sesion -->
                    <input type="text" name="nombre" id="" value="<?=$_SESSION["usuario"]['nombre'];?>">
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'nombre'): ''; ?>


                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" id="" value="<?=$_SESSION["usuario"]['apellidos'];?>">
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'apellidos'): ''; ?>


                    <label for="email">Email</label>
                    <input type="email" name="email" id="" value="<?=$_SESSION["usuario"]['email'];?>">
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'email'): ''; ?>




                    <div class="entrar">
                        <input type="submit" name="submit" value="Actualizar">
                    </div>

                </form>

                <!-- borro los errores al final del formulario -->
                <?php borrarErrores(); ?>



</div> <!-- fin principal -->






<?php require_once "includes/pie.php"; ?>   