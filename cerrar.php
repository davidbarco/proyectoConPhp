<!-- para cerrar sesion -->
<?php 

session_start();

/* si hay una sesion activa, me la destruye con el sesion destroy */
if($_SESSION["usuario"]){
    session_destroy();
}

/* y cuando me cierre sesion me redirige */
header("Location:index.php");



?>