<!-- recoger por post los datos que llegan del formulario -->
<?php 

/* nota: para actualizar usuario, copiamos casi el mismo codigo para cuando hacemos el registro al usuario */




if(isset($_POST)){

    
    /* cargo la conexion de la base de datos */
    require_once "includes/conexion.php";

    
    //variables de los campos que me llegan por post
    /* con este operador ternario 
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : false ;
    
    reemplazo esta expresion:
    if(isset($_POST["nombre])){
        $nombre=$_POST["nombre];
    }else{
        $nombre= false;
    }

    nota: al correo le hacemos una funcion trim, para que lo guarde sin espacios
    */
    /* recoger los valores del formulario de actualizacion */
    $nombre = isset($_POST["nombre"]) ? mysqli_real_escape_string($db,$_POST["nombre"]) : false ;
    $apellidos= isset($_POST["apellidos"]) ?  mysqli_real_escape_string($db,$_POST["apellidos"]) : false ;
    $email=  isset($_POST["email"]) ?  mysqli_real_escape_string($db,trim($_POST["email"])) : false ;
    
     

    /* array de errores */
    $errores= array();
     
    /* validar los datos antes de guardarlos en base de datos
    si el nombre no esta vacio, si el nombre no es numerico, si no se cumple la expresion regular del preg_macht

    */
    /* validamos nombre */
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
       $nombre_validado= true;
    }else{
        $nombre_validado=false;
        $errores["nombre"]="el nombre no es valido";
    }


    /* validamos apellidos */
    if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)){
        $apellidos_validado= true;
     }else{
         $apellidos_validado=false;
         $errores["apellidos"]="el apellidos no es valido";
     }
    
     /* validamos email */
     if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) ){
        $email_validado= true;
     }else{
         $email_validado=false;
         $errores["email"]="el email no es valido";
     }


     /* cuando no haya ningun error, y todo este validado ok */
     $guardar_usuario= false;

     if(count($errores)== 0){
         $usuario= $_SESSION["usuario"];
         $guardar_usuario= true; 

         /* comprobar si el email que vamos a actualizar no existe en la base 
         de datos */
         $sql= "SELECT id,email FROM usuarios WHERE email='$email'";
         $isset_email= mysqli_query($db,$sql);
         $isset_user= mysqli_fetch_assoc($isset_email);
        

         if($isset_user['id']== $usuario["id"] || empty($isset_user)){

             /* recogemos el objeto usuario que esta en la sesion */
             $usuario= $_SESSION["usuario"]['id'];  
             
             //actualizar o editar usuario en la base de datos en su tabla correspondiente ( tabla usuarios)
             $sql = "UPDATE usuarios SET nombre='$nombre', apellidos='$apellidos', email='$email' WHERE id=$usuario;";        
             $guardar= mysqli_query($db,$sql);
      
             /* var_dump(mysqli_error($db));
             die(); */
      
             if($guardar){
                 
                  /* cuando me actualiza mis datos, los actualizo tambien en la session */
                  $_SESSION["usuario"]["nombre"]= $nombre;
                  $_SESSION["usuario"]["apellidos"]= $apellidos;
                  $_SESSION["usuario"]["email"]= $email;
      
                  
      
                 $_SESSION["completado"]="tus datos se han actualizado con éxito";
             }else{
              $_SESSION["errores"]["general"]= "fallo al actualizar tus datos!!";
             }
      
          }else{
            
             $_SESSION["errores"]["general"]= "el usuario ya existe!!";
             
           }

         }else{
             //si se poduce un error, abrimos sesion y redirecionamos con el header
             $_SESSION["errores"]= $errores;
         }

        
         
}
header("Location:mis-datos.php");




?>