<?php 


/* si no existe una sesion, me la crea  */
if(!isset($_SESSION)){

    session_start();
}

/* condicion para cuando no encuentra ningun usuario logeado , me rediriga a la pagina index.php, 
esa es la pagina principal */

if(!isset($_SESSION["usuario"])){
    header("Location:index.php");
}




?>