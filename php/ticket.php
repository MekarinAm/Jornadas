<?php
    
    include ("../codigo_qr/qrGene.php");

    
  

        //CREAMOS DIRECCIONAMIENTOS PARA CADA BOTON EN EL INDEX
        if(isset ($_POST['cierra'])){
            session_destroy();
            header("location:/registro.html");
        }

        if(isset ($_POST['Paquetes'])){
            header("location:/php/paquetes.php");
        }
        if(isset ($_POST['inicio'])){
            header("location:/php/index.php");
        }
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
            
            <a>
                <form method="post"><input type="submit" value="<?php echo $numc;?>" name="inicio"/></form>
            </a>
            <a>
                <form method="post"><input type="submit" value="PAQUETES" name="Paquetes"/></form>
            </a>
            <a>
                <form method="post"><input type="submit" value="SALIR" name="cierra"/></form>
            </a>
        </nav>
    </div>


   
    <main class="contenedor sombra">
    <div class="contenidoSombra1">
        <h1>MUESTRA ESTE QR EN LA ENTRADA PARA ACCEDER</h1>
        <?php echo $qrfin;?>
    </div>    
        
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