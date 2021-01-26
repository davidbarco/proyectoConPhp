<?php 
/* requiero el archivo conexion */
require_once 'includes/conexion.php';



/* si existe un usuario y ademas existe un parametro por url en get id, entonces 
hagame la consulta sql */
if(isset($_SESSION["usuario"]) && isset($_GET["id"])){
   
    
    /* en esta variable guardo el id que me llega por url  */
    $entrada_id = $_GET["id"];
    /* en esta variable guardo el id del usuario que está logueado */
    $usuario_id= $_SESSION["usuario"]["id"];

    /* consulta sql para la base de datos */
    $sql= "DELETE FROM entradas WHERE usuario_id = $usuario_id AND id = $entrada_id";
    $borrar= mysqli_query($db,$sql);
    
    /* para ver que error puede tener la consulta */
   /*  echo mysqli_error($db);
    die(); */

}

/* si todo esta bien, que me rediriga al index.php */
header("Location: index.php");






?>