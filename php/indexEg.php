<?php
    
        //IMPORTAMOS LA CONEXION
        include ("../codigo_qr/qrGenEg.php");
        $conexion = conectaDB();
        $numc ='';
        $concepto='';
        $estatus='';
        $tallCla='';
        $ubicacion='';
        $inicio='';
        //guardamos el nombre del usuario en una variable
        $nombreUsuarioIngresado=$_SESSION['identificadorUsuario'];
        


        



    


    
    //CREAMOS DIRECCIONAMIENTOS PARA CADA BOTON EN EL INDEX
    if(isset ($_POST['cierra'])){
        session_destroy();
        header("location:/indexEg.html");
    }

    if(isset ($_POST['boleto'])){
        header("location:/php/ticketEg.php");
    }

    if(isset ($_POST['incorrecta'])){
        header("location:/php/editEg.php");
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
            
            
        </nav>
    </div>

   
    <main class="contenedor sombra">
    <div class="contenidoSombra1">
    <h1>VERIFICA TU INFORMACIÓN</h1><br>
    <!--
        <h1>MUESTRA EL QR PARA VERIFICAR TU ASISTENCIA</h1><br>
        <?php //echo $qrfin; ?><br>
        <?php //echo $clave; ?>
-->

        <section class="tallconf">
            
            <table>
                <thead>
                    <tr>
                        <th></th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>NOMBRE</td>
                        <td><?php echo $nombre; ?></td>
                    </tr>
                    <tr>
                        <td>APELLIDO PATERNO</td>
                        <td><?php echo $app; ?></td>
                    </tr>
                    <tr>
                        <td>APELLIDO MATERNO</td>
                        <td><?php echo $apm; ?></td>
                    </tr>
                    <tr>
                        <td>NÚMERO DE CONTROL</td>
                        <td><?php echo $numControl; ?></td>
                    </tr>
                    
                    <tr>
                        <td>NÚMERO DE TELÉFONO</td>
                        <td><?php echo $numcel;?></td>
                    </tr>
                    
                    <tr>
                        <td>AÑO DE INGRESO</td>
                        <td><?php echo $ingreso; ?></td>
                    </tr>

                    <tr>
                        <td>AÑO DE EGRESO</td>
                        <td><?php echo $egreso; ?></td>
                    </tr>

                    <tr>
                        <td>EMPRESA</td>
                        <td><?php echo $empresa; ?></td>
                    </tr>

                    <tr>
                        <td>PUESTO</td>
                        <td><?php echo $puesto; ?></td>
                    </tr>
                    <tr>
                        <td>AÑO DE TITULACION</td>
                        <td><?php echo $titulo; ?></td>
                    </tr>
                    
                </tbody>
            </table>
            CORREO <?php echo $correo; ?>
        </section>



    </div>
    

    <!--<div class="TyC">
        <section class="tallconf">
            <h1>MUESTRA TU QR Y CLAVE PARA VERIFICAR TU ASISTENCIA</h1>
            <table align="center">
                <tbody>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td> <h2>CLAVE: </h2></td>
                    </tr>
                </tbody>
            </table>
        
           
        </section>
    </div> -->

    <form method="post" class="formulario2">
        
            
        <form method="post">
            <input type="submit" value="Mi boleto" name="boleto"/>


        <form method="post">
            <input type="submit" value=" Mi información es incorrecta o incompleta" name="incorrecta"/>

        <form method="post">
            <input type="submit" value="Cerrar sesión" name="cierra"/>
        
    </form>

        
        
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