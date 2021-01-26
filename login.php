<?php 

/* iniciar la sesion y la conexion a base de datos */
require_once "includes/conexion.php";



if(isset($_POST)){

    /* borrar error antiguo */
    if(isset($_SESSION["error_login"])){
        unset($_SESSION["error_login"]);
    }
    /* recoger datos del fomrulario. email y contraseña  */
    $email= trim($_POST["email"]);
    $password= $_POST["password"];

    /* consulta para comprobar las credenciales del usuario  */
    $sql= "select * from usuarios where email='$email'";
    $login= mysqli_query($db,$sql);

    if($login && mysqli_num_rows($login)==1){

        $usuario=mysqli_fetch_assoc($login);
        
        /* comprobar la contraseña cifrarla de nuevo */
        $verify= password_verify($password,$usuario["password"]);

        if($verify){
           /* utilizar una sesion para guardar los datos del usuario logueado */
           $_SESSION["usuario"]=$usuario;

           

        }else{
          /* si algo falla enviar una sesion con el fallo */
          $_SESSION["error_login"]="Login Incorrecto!!!";
        }
        
    
        }else{
            //mensaje de error
        }

    }

/* redirigir al index.php */
header('Location:index.php');


?>