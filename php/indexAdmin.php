<?php
    //NOS ASEGURAMOS DE QUE SOLO SE PUEDA ACCEDER A ESTA PESTAÑA SI LA SESION ESTA INICIADA
    session_start();
    if(isset($_SESSION['identificadorUsuario']))
    {

        $pendiente='';
        //IMPORTAMOS LA CONEXION
        include("conexion.php");
        $conexion = conectaDB();
        
        //BUSQUEDA PARA OBTENER LA INFORMACION DE TALLERES
        $sqlalumno = "SELECT * FROM asistenciatall WHERE tallCla='Tall1'";//CONSULTA LA TABLA ASISTECNIATALL PARA SABER CUANTOS REGISTROS HAY EN EL TALLER 1
        $resul = mysqli_query($conexion,$sqlalumno); //SE REALIZA LA CUNSULTA
        $row_cnt1 = mysqli_num_rows($resul);//SE GUARDA EL CONTEO

        //BUSQUEDA PARA OBTENER LA INFORMACION DE TALLERES
        $sqlalumno = "SELECT * FROM asistenciatall WHERE tallCla='Tall2'";//CONSULTA LA TABLA ASISTECNIATALL PARA SABER CUANTOS REGISTROS HAY EN EL TALLER 2
        $resul = mysqli_query($conexion,$sqlalumno); //SE REALIZA LA CUNSULTA
        $row_cnt2 = mysqli_num_rows($resul);//SE GUARDA EL CONTEO

        //BUSQUEDA PARA OBTENER LA INFORMACION DE TALLERES
        $sqlalumno = "SELECT * FROM asistenciatall WHERE tallCla='Tall3'";//CONSULTA LA TABLA ASISTECNIATALL PARA SABER CUANTOS REGISTROS HAY EN EL TALLER 3
        $resul = mysqli_query($conexion,$sqlalumno); //SE REALIZA LA CUNSULTA
        $row_cnt3 = mysqli_num_rows($resul);//SE GUARDA EL CONTEO

        //BUSQUEDA PARA OBTENER LA INFORMACION DE TALLERES
        $sqlalumno = "SELECT * FROM asistenciatall WHERE tallCla='Tall4'";//CONSULTA LA TABLA ASISTECNIATALL PARA SABER CUANTOS REGISTROS HAY EN EL TALLER 4
        $resul = mysqli_query($conexion,$sqlalumno); //SE REALIZA LA CUNSULTA
        $row_cnt4 = mysqli_num_rows($resul);//SE GUARDA EL CONTEO

        //BUSQUEDA PARA OBTENER LA INFORMACION DE TALLERES
        $sqlalumno = "SELECT * FROM asistenciatall WHERE tallCla='Tall5'";//CONSULTA LA TABLA ASISTECNIATALL PARA SABER CUANTOS REGISTROS HAY EN EL TALLER 5
        $resul = mysqli_query($conexion,$sqlalumno); //SE REALIZA LA CUNSULTA
        $row_cnt5 = mysqli_num_rows($resul);//SE GUARDA EL CONTEO

        //BUSQUEDA PARA OBTENER LA INFORMACION DE TALLERES
        $sqlalumno = "SELECT * FROM asistenciatall WHERE tallCla='Tall6'";//CONSULTA LA TABLA ASISTECNIATALL PARA SABER CUANTOS REGISTROS HAY EN EL TALLER 6
        $resul = mysqli_query($conexion,$sqlalumno); //SE REALIZA LA CUNSULTA
        $row_cnt6 = mysqli_num_rows($resul);//SE GUARDA EL CONTEO

        //BUSQUEDA PARA OBTENER LA INFORMACION DE TALLERES
        $sqlalumno = "SELECT * FROM asistenciatall WHERE tallCla='Tall7'";//CONSULTA LA TABLA ASISTECNIATALL PARA SABER CUANTOS REGISTROS HAY EN EL TALLER 7
        $resul = mysqli_query($conexion,$sqlalumno); //SE REALIZA LA CUNSULTA
        $row_cnt7 = mysqli_num_rows($resul);//SE GUARDA EL CONTEO

        //BUSQUEDA PARA OBTENER LA INFORMACION DE CONFERENCIAS
        $sqlalumno = "SELECT * FROM pago WHERE concepto='Conferencia'";//CONSULTA EL PAQUETE DE CONFERENCIAS
        $resul = mysqli_query($conexion,$sqlalumno); //SE REALIZA LA CUNSULTA
        $con = mysqli_num_rows($resul);//SE GUARDA EL CONTEO
        $sqlalumno = "SELECT * FROM pago WHERE concepto='Completo'";//CONSULTA EL PAQUETE DE COMPLETO
        $resul = mysqli_query($conexion,$sqlalumno); //SE REALIZA LA CUNSULTA
        $com = mysqli_num_rows($resul);//SE GUARDA EL CONTEO
        $row_cnt8 = $con+$com;//SE SUMA EL CONTEO DE AMBOS PAQUETES

        //BUSQUEDA PARA OBTENER LA INFORMACION DE CUANTOS ESTAN EN ESPERA
        $sqlalumno = "SELECT * FROM alumno WHERE filaEspera = 1";//CONSULTA LA TABLA ALUMNO
        $resul = mysqli_query($conexion,$sqlalumno); //SE REALIZA LA CUNSULTA
        $row_cnt9 = mysqli_num_rows($resul);//SE GUARDA EL CONTEO


        
    }else{
        //SI LA SESION NO ESTA INICIADA REDIRIGIMOS AL USUARIO A LA PAGINA DE LOGIN
        header("location:/registro.html");
    }


    
    //CREAMOS DIRECCIONAMIENTOS PARA CADA BOTON EN EL INDEX
    if(isset ($_POST['cierra'])){
        session_destroy();
        header("location:/registro.html");
    }

    if(isset ($_POST['Paquetes'])){
        header("location:/php/paquetes.php");
    }
    if(isset ($_POST['inicio'])){
        header("location:/php/indexAdmin.php");
    }

    if(isset ($_POST['Voucher'])){
        header("location:/php/vista_voucher.php");
    }

    if(isset ($_POST['Boleto'])){
        header("location:/php/qrEntrada.php");
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
                <form method="post"><input type="submit" value="ADMINISTRADOR" name="inicio"/></form>
            </a>
            <a>
                <form method="post"><input type="submit" value="SALIR" name="cierra"/></form>
            </a>
        </nav>
    </div>

   
    <main class="contenedor sombra">


    

        
            <section class="tallconf">
                
                <table>
                    <thead>
                        <tr>
                            <th>CORTE DE JORNADAS</th>
                            
                        </tr>
                    </thead>
                    <tbody >
                        <tr>
                            <td >PROGRAMACION EN JAVA:</td>
                            <td>El taller tiene <?php echo $row_cnt1; ?> de 20 lugares ocupados</td>
                        </tr>
                        <tr>
                            <td ></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>CIBERSEGURIDAD:</td>
                            <td>El taller tiene <?php echo $row_cnt2; ?> de 20 lugares ocupados</td>
                        </tr>
                        <tr>
                            <td ></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>DEEP LEARNING:</td>
                            <td>El taller tiene <?php echo $row_cnt3; ?> de 20 lugares ocupados</td>
                        </tr>
                        <tr>
                            <td ></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>FIBRA OPTICA:</td>
                            <td>El taller tiene <?php echo $row_cnt4; ?> de 20 lugares ocupados</td>
                        </tr>
                        <tr>
                            <td ></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>KALI LINUX:</td>
                            <td>El taller tiene <?php echo $row_cnt5; ?> de 20 lugares ocupados</td>
                        </tr>
                        <tr>
                            <td ></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>ANALISIS DE DATOS:</td>
                            <td>El taller tiene <?php echo $row_cnt6; ?> de 20 lugares ocupados</td>
                        </tr>
                        <tr>
                            <td ></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td >LA INFORMACION, FUNDAMENTOS... :    </td>
                            <td>El taller tiene <?php echo $row_cnt7; ?> de 20 lugares ocupados</td>
                        </tr>
                        <tr>
                            <td ></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>CONFERENCIAS:</td>
                            <td>Hay <?php echo $row_cnt8; ?> lugares ocupados de 170</td>
                        </tr>
                        <tr>
                            <td ></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>EN ESPERA:</td>
                            <td>Hay <?php echo $row_cnt9; ?> personas en fila de espera</td>
                        </tr>
                    </tbody>
                </table>
            </section>

            

        

        
        <!--
        <form method="post" class="formulario2">
            <form method="post">
                <input type="submit" value="Paquetes" name="Paquetes"/>
            
            <form  method="post" >
                <input type="submit" value="Consultar voucher" name="Voucher">
        
            <form action="qrEntrada.php" method="post" >
                <input type="submit" value="Tu boleto" name="Boleto">
        </form>
        -->
        
        
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