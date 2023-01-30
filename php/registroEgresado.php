<?php
    //Incluimos la funcion de conexion a la base de datos 
    include("conexion.php");
    $conexion = conectaDB();
    //error_reporting(0);
    //Indicamos los parametros que obtendremos del formulario
    
    $nombre = $_POST['nombre'];
    $apellidoPat = $_POST['aPat'];
    $apellidoMat = $_POST['aMat'];
    $numCon = $_POST['numcon'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telCe'];
    $aingreso = $_POST['aIngreso'];
    $aegreso = $_POST['aEgreso'];
    $titulacion = $_POST['titulacion'];
    $empresa = $_POST['empresa'];
    $puesto = $_POST['puesto'];
    
    
    $r1= rand(1,10);
    $claNo=substr($nombre, 0,2);
    $claAP=substr($apellidoPat, 0,2);
    $claAM=substr($apellidoMat, 0,2);
    $ncfin=substr($numCon, -4);
    $clave=$claNo . $claAP . $claAM.$ncfin;

    //SI NO HUBO NINGUN TIPO DE ERROR PORCEDEMOS A GUARDAR EL REGISTRO
  
    //Una vez obtenidos los datos Y la contraseña cifrada los insertamos en nuestra tabla 
    $insert = "INSERT INTO egresado (clave, nombre, apellidoPat, apellidoMat, numControl, correo, numCel, anioIngreso, anioEgreso, empresa, puesto, anioTitulo) 
    VALUES ( '$clave', '$nombre','$apellidoPat', '$apellidoMat', '$numCon', '$correo', '$telefono', '$aingreso', '$aegreso',  '$empresa', '$puesto', '$titulacion')";
        
    //Si en el insert hay algun problema no pensado entonces mostramos el error
    if (!mysqli_query($conexion, $insert)){
    $mensajeError= '<div style="color:red;">HA OCURRIDO UN ERROR INESPERADO VUELVE A LLENAR EL FORMULARIO</div>';
    //CERRAMOS LA CONEXION
    disconnectDB($conexion);
    }else{
        //Agregamos un tiempo de espera de 5 segundos y redireccionamos a la pagina de login
        disconnectDB($conexion);
        sleep (1);
        header("location:/indexEg.html");
                    
    }
    
    
            
    
    
?>