<?php

function mostrarError($errores, $campo){
    $alerta ='';
    if(isset($errores[$campo]) && !empty($campo)){
        $alerta = "<div class='alerta alerta-error'>".$errores[$campo].'</div>';
    }
    return $alerta;
}

function borrarErrores(){
    $borrado = false;

    if(isset($_SESSION['errores'])){;
        $_SESSION['errores'] = null;            //si falla el códgio quitar está linea
        $borrado = true;
    }
    if(isset($_SESSION['completado'])){;
        $_SESSION['completado'] = null;         //si falla el códgio quitar está linea
        $borrado = true;
    }
    if(isset($_SESSION['errores_entrada'])){;
        $_SESSION['errores_entrada'] = null;       //si falla el códgio quitar está linea
        $borrado = true;
    }
    return $borrado;
}

function getCategorias($conexion){
    $sql = "SELECT * FROM categorias ORDER BY id ASC;";
    $categorias = mysqli_query($conexion, $sql);
    $result = array();

    if($categorias && mysqli_num_rows($categorias) >= 1){
        $result = $categorias;
    }
    return $result;
}

function getEntradas($conexion, $limit ){
    $sql = "SELECT e.*, c.nombre as 'categoria' FROM entradas AS e ".
           "INNER JOIN categorias AS c ON e.categoria_id = c.id ". 
           "ORDER BY e.id DESC ";
    // Concateno el límite de 4 entradas para el index si recibimos true en la variable limit.
    if($limit){
        $sql .= "LIMIT 4";
    }
    $entradas = mysqli_query($conexion, $sql);
    $result = array();

    if($entradas && mysqli_num_rows($entradas) >= 1){
        $result = $entradas;
    }
    return $result;
}

?>