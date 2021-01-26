<?php 


   if(isset($_POST)){

       /* cargo la conexion de la base de datos */
       require_once "includes/conexion.php";

       /* comprobar si me llega el nombre de la categorias */
       $titulo= isset($_POST["titulo"])? mysqli_real_escape_string($db,$_POST["titulo"]): false;
       $descripcion= isset($_POST["descripcion"])? mysqli_real_escape_string($db,$_POST["descripcion"]): false;
       /* categoria lo voy a dejar sin el mysqli_escape_string, debido a que la informacion me llega enduro por el option del formulario */
       /* casteo el dato a un entero porque la categoria en un numero lo casteo con el (int) */
       $categoria= isset($_POST["categoria"])? (int)$_POST["categoria"]: false;
       /* recogo el id usuario logueado */
       $usuario= $_SESSION["usuario"]["id"];
      
       


       /* array de errores */
       $errores= array();
     
        /* validar los datos antes de guardarlos en base de datos
        si el nombre no esta vacio, si el nombre no es numerico, si no se cumple la expresion regular del preg_macht

        */
        /* validamos titulo */
        if(empty($titulo)){

            $errores["titulo"]="el titulo no es valido";
        
        }
        
        /* validamos descripcion */
        if(empty($descripcion)){

            $errores["descripcion"]="la descripcion no es valida";
        
        }

        /* validamos las opciones categoria */
        if(empty($categoria) && !is_numeric($categoria)){

            $errores["categoria"]="la categoria no es valida";
    
        }


        /* cuando no haya ningun error, y todo este validado ok */
        if(count($errores)==0){
             
            /* condicion para editar la entrada */
            if(isset($_GET["editar"])){
                /* la siguiente linea aplica colo cuando voy a editar la entrada.*/
                $entrada_id= $_GET["editar"];
                $usuario_id= $_SESSION["usuario"]["id"];
                $sql= "UPDATE entradas SET titulo='$titulo', descripcion='$descripcion', categoria_id='$categoria' WHERE id = $entrada_id AND usuario_id = $usuario_id ";
            }else{
                
                //inserto mi entradas a la base de datos
                $sql= "insert into entradas values(NULL,'$usuario','$categoria','$titulo','$descripcion',curdate());";
            }
            

            $guardar= mysqli_query($db,$sql);
            header("Location:index.php");
           
        }else{
            //si se poduce un error, abrimos sesion y redirecionamos con el header
            $_SESSION["errores_entrada"]= $errores;
           
            /* condicion cuando se está editando */
           if(isset($_GET["editar"])){
               
            header("Location:editar-entrada.php?id=".$_GET["editar"]);
           }else{
               
               header("Location:crear-entradas.php");
           }

            
          }

   }
   
