<!-- recoger por post los datos que llegan del formulario -->
<?php 


if(isset($_POST)){

    
    /* cargo la conexion de la base de datos */
    require_once "includes/conexion.php";

    /* iniciar sesion */
    if(!isset($_SESSION)){
        session_start();
    }

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
    $nombre = isset($_POST["nombre"]) ? mysqli_real_escape_string($db,$_POST["nombre"]) : false ;
    $apellidos= isset($_POST["apellidos"]) ?  mysqli_real_escape_string($db,$_POST["apellidos"]) : false ;
    $email=  isset($_POST["email"]) ?  mysqli_real_escape_string($db,trim($_POST["email"])) : false ;
    $password=  isset($_POST["password"]) ?  mysqli_real_escape_string($db,$_POST["password"]) : false ;
     

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

     /* validamos la password comprobamos solo que no este vacia */
     if(!empty($password)){
        $password_validado= true;
     }else{
         $password_validado=false;
         $errores["password"]="el password esta vacia.";
     }

     /* cuando no haya ningun error, y todo este validado ok */
     $guardar_usuario= false;
     if(count($errores)== 0){
         $guardar_usuario= true; 

       /* cifrar contraseña, con el metodo password_hash  */
       $password_segura= password_hash($password,PASSWORD_BCRYPT,["cost"=>4]);
      

       //insertar usuarios en la base de datos en su tabla correspondiente ( tabla usuarios)
       $sql = "insert into usuarios values(null,'$nombre','$apellidos','$email','$password_segura',curdate());";        
       $guardar= mysqli_query($db,$sql);

       /* var_dump(mysqli_error($db));
       die(); */

       if($guardar){
           $_SESSION["completado"]="el registo se ha completado con éxito";
       }else{
        $_SESSION["errores"]["general"]= "fallo al guardar el usuario!!";
       }

    }else{
       //si se poduce un error, abrimos sesion y redirecionamos con el header
       $_SESSION["errores"]= $errores;
       
     }
}
header("Location:index.php");




?>