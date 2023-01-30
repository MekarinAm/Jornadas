<?php

    include("conexion.php");
    $conexion = conectaDB();
    error_reporting(0);
    $sqlRIFA = "SELECT * FROM egresado where ganador=0 AND asistencia!=false ORDER BY RAND() LIMIT 1";
    $resultadoRIFA = mysqli_query($conexion,$sqlRIFA);
    while($filas=mysqli_fetch_assoc($resultadoRIFA)){
        $ganador=$filas['clave'];
        $nombre=$filas['nombre'];
        $apellidop=$filas['apellidoPat'];
        $apellidom=$filas['apellidoMat'];
        $correo=$filas['correo'];
        $nc=$filas['numControl'];
    }



    


   
    $claveGan=$ganador;
    $gana=1;
    $sql = "UPDATE egresado SET ganador='$gana' WHERE clave='$ganador'";
    $resultado = mysqli_query($conexion, $sql);



  

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="/css/styles.css">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--PARTE JOSE-->
        <!--Cargamos fuente y hoja de estilos junto con normalize-->
        <link rel="preload" href="/css/normalize.css" as="style">
        <link rel="stylesheet" href="/css/normalize.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Play&display=swap');
        </style>
        <!--Logo ITP en pestaña-->
        <link rel="icon" href="/media/itplogo.png">
        <title>Inicio</title>
        <link rel="preload" href="/css/styles.css" as="style">
        <link href="/css/styles.css" rel="stylesheet">
    </head>
    
        
    <div class="nav-bg"> 
    <div class="logos">
            <div class="TyC8">
            <img src="../media/TecNM-logo.png" alt="tecnm" class="logos_img">
            <img src="../media/itplogo.png" alt="itp" class="logos_img">
            <img src="../media/50aniv.png" alt="itp_50" class="logos_img">
            </div>
        </div>
        <nav class="navegacion-principal contenedor">
            
            
        </nav>
    </div>


   
    <main class="contenedor sombra">
    <div class="contenidoSombra1">
        <h1>GANADOR</h1>
        <?php echo $claveGan." ";?><br><?php
            echo $nombre." ";
            echo $apellidop." ";
            echo $apellidom;
            ?>
    </div>    

        <h2>REFRESCA LA PAGINA PARA <br> OBTENER UN NUEVO GANADOR</h2>
        
    </main>

    
    <footer>
        <p>Instituto Tecnológico de Puebla<br> &copy Todos los Derechos Reservados<br>
            Av. Tecnológico 420 Col. Maravillas. Puebla, Pue. C.P. 72220<br>
            Tels. 222 2298868 y 57
        </p>
    </footer>
<body>
</body>
</html>

