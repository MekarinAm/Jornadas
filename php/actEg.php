<?php
    //Incluimos la funcion de conexion a la base de datos 
    include("conexion.php");
    $conexion = conectaDB();
    //error_reporting(0);
    //Indicamos los parametros que obtendremos del formulario
    
    $nombre = $_POST['nombre'];
    $apellidoPat = $_POST['aPat'];
    $apellidoMat = $_POST['aMat'];
    $numCon = $_POST['numControl'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telCe'];
    
    $aingreso = $_POST['aIngreso'];
    $aegreso = $_POST['aEgreso'];
    $titulacion = $_POST['titulacion'];
    $empresa = $_POST['empresa'];
    $puesto = $_POST['puesto'];
   
    $claNo=substr($nombre, 0,2);
    $claAP=substr($apellidoPat, 0,2);
    $claAM=substr($apellidoMat, 0,2);
    $ncfin=substr($numCon, -4);
    $clave=$claNo . $claAP . $claAM.$ncfin;


    //SI NO HUBO NINGUN TIPO DE ERROR PORCEDEMOS A GUARDAR EL REGISTRO
  

    //Una vez obtenidos los datos Y la contraseña cifrada los insertamos en nuestra tabla 
    $insert = "UPDATE egresado SET clave ='$clave',nombre ='$nombre',apellidoPat ='$apellidoPat',apellidoMat ='$apellidoMat',correo ='$correo',numcel ='$telefono',
    anioIngreso ='$aingreso', anioEgreso ='$aegreso', empresa ='$empresa', puesto ='$puesto', anioTitulo ='$titulacion' WHERE numControl = '$numCon'";
    mysqli_query($conexion, $insert);
        
    
    header("location:/php/indexEg.php");
    
            
    
    
?>