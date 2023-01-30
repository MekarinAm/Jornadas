<?php
    //Incluimos la funcion de conexion a la base de datos 
    include("conexion.php");
    $conexion = conectaDB();
    //error_reporting(0);
    //Indicamos los parametros que obtendremos del formulario
    
    $nombre = $_POST['nombre'];
    $apellidoPat = $_POST['aPat'];
    $apellidoMat = $_POST['aMat'];
    $correo = $_POST['correo'];
    $contrasenia = $_POST['contrasenia'];
    $visita = $_POST['visita'];
    
    $claNo=substr($nombre, 0,2);
    $claAP=substr($apellidoPat, 0,2);
    $claAM=substr($apellidoMat, 0,2);
    $clave=$claNo . $claAP . $claAM;

    //SI NO HUBO NINGUN TIPO DE ERROR PORCEDEMOS A GUARDAR EL REGISTRO
    //CIFRAMOS LA CONTRASEÑA POR SEGURIDAD
    $contraHash = password_hash($contrasenia, PASSWORD_BCRYPT);
    //Una vez obtenidos los datos Y la contraseña cifrada los insertamos en nuestra tabla 
    $insert = "INSERT INTO alumno (numControl, nombre, apellidoPat, apellidoMat, correo, contrasenia, visita) 
    VALUES ( '$clave', '$nombre','$apellidoPat', '$apellidoMat','$correo', '$contraHash', '$visita')";
        
    //Si en el insert hay algun problema no pensado entonces mostramos el error
    if (!mysqli_query($conexion, $insert)){
    $mensajeError= '<div style="color:red;">HA OCURRIDO UN ERROR INESPERADO VUELVE A LLENAR EL FORMULARIO</div>';
    //CERRAMOS LA CONEXION
    disconnectDB($conexion);
    }else{
        //Agregamos un tiempo de espera de 5 segundos y redireccionamos a la pagina de login
        disconnectDB($conexion);
        sleep (1);
        header("location:/registro.html");
                    
    }
    
    
            
    
    
?>