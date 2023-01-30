<?php
    //ESTE PHP ES LA CONEXION PUENTE ENTRE LA APP PARA CELULARES ANDROID PARA ASISTENCIA DE EGRESADOS Y LA BASE DE DATOS 
    //EN EL SERVIDOR DE JORNADAS CON LA TABLA DE EGRESADOS EN ESPECIFICO
    error_reporting(0);
    include("conexion.php");
    $conexion = conectaDB();

    $entrada = $_POST["asistencia"];
    $claEgr = $_POST["clave"];

    if(!$conexion){
        echo "No se pudo conectar";
    }
    else{
        
        if($claEgr==""){
            echo "error";
        }
        else{
            
            $comprueba = "SELECT * FROM egresado WHERE clave = '$claEgr'";
            $sql = mysqli_query($conexion, $comprueba);
            while($filas=mysqli_fetch_assoc($sql)){
                $otro = $filas['asistencia'];
            }
            if($otro=="0000-00-00 00:00:00" or $otro==null){
                $update = "UPDATE egresado SET asistencia = '$entrada' WHERE clave = '$claEgr'";
                $resultado = mysqli_query($conexion, $update);

                if($resultado){
                    echo "Registro correcto";
                }
            }
            else{
                echo "Ya ha sido registrado";
            }
        }  
    }
?>