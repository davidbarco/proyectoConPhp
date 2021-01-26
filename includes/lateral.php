       
    
        <!-- sidebar o barra lateral -->
        <aside id="sidebar">

        <!--buscador  -->
        <div id="buscador" class="bloque">
                <h3>Buscar</h3>

                <form action="buscar.php" method="POST">
                    <input type="text" name="busqueda" id="">
                    <div class="entrar">
                        <input type="submit" value="Buscar">
                    </div>
                </form>
            </div>
            <!-- fin de buscador -->


         
        <?php if(isset($_SESSION["usuario"])): ?>
            <div id="usuario-logueado" class="bloque">
                <h3><?=$_SESSION["usuario"]["nombre"]." ".$_SESSION["usuario"]["apellidos"];?></h3>
                <!-- Botones para cerrar sesion -->
                <div class="cerrar">
                    <a href="crear-entradas.php" class="boton boton-verde">Crear entradas</a>
                </div>
                <div class="cerrar">
                    <a href="crear-categoria.php" class="boton boton-rojo">Crear categoria</a>
                </div>
                <div class="cerrar">
                    <a href="mis-datos.php" class="boton boton-naranja">Mis datos</a>
                </div>
                <div class="cerrar">
                    <a href="cerrar.php" class="boton">Cerrar sesion</a>
                </div>
            </div>
        <?php endif; ?>

            
            <?php if(!isset($_SESSION["usuario"])): ?>
            <div id="login" class="bloque">
                <h3>Identificate</h3>


                <?php if(isset($_SESSION["error_login"])): ?>
                <div class="alerta alerta-error">
                     <?=$_SESSION["error_login"];?>
                </div>
                <?php endif; ?>


                <form action="login.php" method="POST">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="">

                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="">

                    <div class="entrar">
                        <input type="submit" value="Entrar">
                    </div>
                </form>
            </div>
          


            <div id="register" class="bloque">
         
                
                <h3>Registrate</h3>

                <!-- mostrar errores -->
                <?php if(isset($_SESSION["completado"])):?>
                  <div class="alerta alerta-exito">
                       <?=$_SESSION["completado"]?>
                  </div>

                 <?php elseif(isset($_SESSION["errores"]["general"])): ?>
                    <div class="alerta alerta-error">
                       <?=$_SESSION["errores"]["general"]?>
                  </div>
                <?php endif; ?>


                <form action="registro.php" method="POST">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="">
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'nombre'): ''; ?>


                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" id="">
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'apellidos'): ''; ?>


                    <label for="email">Email</label>
                    <input type="email" name="email" id="">
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'email'): ''; ?>


                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="">
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'password'): ''; ?>


                    <div class="entrar">
                        <input type="submit" name="submit" value="Registrar">
                    </div>

                </form>

                <!-- borro los errores al final del formulario -->
                <?php borrarErrores(); ?>
              
            </div>
            <?php endif; ?>
        </aside>