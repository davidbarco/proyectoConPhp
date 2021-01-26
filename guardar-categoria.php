<?php 


   if(isset($_POST)){

       /* cargo la conexion de la base de datos */
       require_once "includes/conexion.php";

       /* comprobar si me llega el nombre de la categorias */
       $nombre= isset($_POST["nombre"])? mysqli_real_escape_string($db,$_POST["nombre"]): false;
       $nombre_sin_espacios= trim($nombre);
       

       /* array de errores */
       $errores= array();
     
        /* validar los datos antes de guardarlos en base de datos
        si el nombre no esta vacio, si el nombre no es numerico, si no se cumple la expresion regular del preg_macht

        */
        /* validamos nombre */
        if(!empty($nombre_sin_espacios) && !is_numeric($nombre_sin_espacios) && !preg_match("/[0-9]/", $nombre_sin_espacios)){
        $nombre_validado= true;
        }else{
            $nombre_validado=false;
            $errores["nombre"]="el nombre no es valido";
        }

        /* cuando no haya ningun error, y todo este validado ok */
        if(count($errores)==0){
            //inserto mi nombre de entrada a la base de datos
            $sql= "insert into categorias values(NULL,'$nombre_sin_espacios');";

            $guardar= mysqli_query($db,$sql);
           
        }

   }
   header("Location:index.php");










?>