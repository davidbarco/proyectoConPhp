<?php 



/* funcion para mostrar los errores en la vista cuando se hayan producido */
function mostrarError($errores,$campo){
    $alerta= "";
    if(isset($errores[$campo])&& !empty($campo)){
        $alerta="<div class='alerta alerta-error'>".$errores[$campo].'</div>';
    }

    return $alerta;
}


/* funcion para borrar errores */
function borrarErrores(){
    $borrado= false;
    
    if(isset($_SESSION["errores"])){
        $_SESSION['errrores']= null;
        $borrado= true;
        /* unset($_SESSION["errores"]); */
    } 

    /* para que borre errores de crear entradas cuando los haya y se recargue la pagina */
    if(isset($_SESSION["errores_entrada"])){
        $_SESSION['errrores_entrada']= null;
        $borrado= true;
        /* unset($_SESSION["errores_entrada"]); */
    } 
    
    if(isset($_SESSION["completado"])){
        $_SESSION['completado']= null;
        $borrado= true;
       /*  unset($_SESSION["completado"]); */
    }  
 
    return $borrado;

}

/* conseguir categorias */
function conseguirCategorias($conexion){
    /* consulta a mysql */
    $sql= "select * from categorias order by id asc;";
    /* el db es la base de datos del archivo de conexion.php el cual está importado en la cabecera que es donde vamos a hacer el llamado de esta funcion */
    $categorias= mysqli_query($conexion,$sql);
    $resultado=array();
    
    /* si categorias existe y el numero de filas es igual o mayor a uno, 
    entonces que resultado sea igual a las categorias */
    if($categorias && mysqli_num_rows($categorias)>=1){
        $resultado= $categorias;

    }

    return $resultado;

}

/* conseguir una sola categoria por el id, le paso como parametro el id de la categoria */
function conseguirCategoria($conexion,$id){
    /* consulta a mysql */
    $sql= "select * from categorias where id=$id;";
    /* el db es la base de datos del archivo de conexion.php el cual está importado en la cabecera que es donde vamos a hacer el llamado de esta funcion */
    $categorias= mysqli_query($conexion,$sql);
    $resultado=array();
    
    /* si categorias existe y el numero de filas es igual o mayor a uno, 
    entonces que resultado sea igual a las categorias */
    if($categorias && mysqli_num_rows($categorias)>=1){
        $resultado= mysqli_fetch_assoc($categorias);

    }

    return $resultado;

}

/* conseguir una sola categoria por el id, le paso como parametro el id de la entrada */



/* funcion para conseguir las entradas */
function conseguirEntradas($conexion, $limit=null, $categoria=null, $busqueda= null){
    /* consulta a mysql */
    $sql= "SELECT e.*, c.nombre AS 'categoria' FROM entradas e INNER JOIN categorias c ON e.categoria_id= c.id ";
     
    if(!empty($categoria)){
        /* concateno la primera consulta de la linea 86 con esta: */
        $sql .="WHERE e.categoria_id= $categoria ";

    }

    /* condicion para las busqueda */
    if(!empty($busqueda)){
        /* concateno la primera consulta de la linea 86 con esta: */
        $sql .="WHERE e.titulo LIKE '%$busqueda%' ";

    }

    
    $sql .="ORDER BY e.id DESC";
    /* en el caso de que nos llegue el parametro limit */
    if($limit){
       /* concatenamos el limit que llega por parametro: tambien se puede hacer asi
       sql= $sql." limit 4" */ 
       $sql .=" LIMIT 4";
    }

    /* el db es la base de datos del archivo de conexion.php el cual está importado en la cabecera que es donde vamos a hacer el llamado de esta funcion */
    $entradas= mysqli_query($conexion,$sql);
    $resultado=array();
    
    /* si categorias existe y el numero de filas es igual o mayor a uno, 
    entonces que resultado sea igual a las categorias */
    if($entradas && mysqli_num_rows($entradas)>=1){
        $resultado= $entradas;

    }

    return $resultado;

}





function conseguirEntrada($conexion, $id){
	$sql = "SELECT e.*, c.nombre AS 'categoria', CONCAT(u.nombre, ' ', u.apellidos) AS usuario"
		  . " FROM entradas e ".
		   "INNER JOIN categorias c ON e.categoria_id = c.id ".
		   "INNER JOIN usuarios u ON e.usuario_id = u.id ".
		   "WHERE e.id = $id";
	$entrada = mysqli_query($conexion, $sql);
	
	$resultado = array();
	if($entrada && mysqli_num_rows($entrada) >= 1){
		$resultado = mysqli_fetch_assoc($entrada);
	}
	
	return $resultado;
}



?>



