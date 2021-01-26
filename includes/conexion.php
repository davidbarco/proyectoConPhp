<!-- conexion a la base de datos -->
<?php 

$servidor= "localhost";
$usuario= "root";
$password= "";
$basededatos= "blog_master";

$db = mysqli_connect($servidor,$usuario,$password,$basededatos);


/* despues de conectarnos,
hacemos consulta para configurar la codificacion de caracteres
*/
mysqli_query($db,"SET NAMES 'utf8'");


/* iniciar la sesion */
/* si no existe una sesion, me la crea  */
if(!isset($_SESSION)){

    session_start();
}








?>