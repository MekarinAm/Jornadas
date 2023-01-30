<?php
    //NOS ASEGURAMOS DE QUE SOLO SE PUEDA ACCEDER A ESTA PESTAÑA SI LA SESION ESTA INICIADA
    session_start();
    if(isset($_SESSION['identificadorUsuario']))
    {

        $pendiente='';
        //IMPORTAMOS LA CONEXION
        include("conexion.php");
        $conexion = conectaDB();
        $numc ='';
        $concepto='';
        $estatus='';
        $tallCla='';
        $ubicacion='';
        $inicio='';
        //guardamos el nombre del usuario en una variable
        $nombreUsuarioIngresado=$_SESSION['identificadorUsuario'];
        //BUSQUEDA PARA OBTENER LA INFORMACION DEL ALUMNO
        $sqlalumno = "SELECT * FROM alumno WHERE correo='$nombreUsuarioIngresado'";//CONSULTA LA TABLA ALUMNOS CON EL CORREO PARA OBTENER LOS DATOS
        $resultadoAlumno = mysqli_query($conexion,$sqlalumno); //SE ALMACENA EL RESULTADO DE LA CONSULTA
       //verificar si la consulta fue realizada 
        if($resultadoAlumno){
            /*recupera cada uno de los registros dependiendo el campo solicitado
            el registro se guarda en una variable*/
            while($row = $resultadoAlumno->fetch_array()){ 
                $nombre = $row['nombre'];
                $app = $row['apellidoPat'];
                $apm = $row['apellidoMat'];
                $sem = $row['semestre'];
                $carr = $row['carrera'];
                $credito = $row['credito'];
                $correo = $row['correo'];
                $numc = $row['numControl'];
                $esperaAlumnoTrue=$row['filaEspera'];
            }
        }

        //BUSQUEDA PARA OBTENER LA INFORMACION DEL ALUMNO
        $sqlpago = "SELECT * FROM pago WHERE alunum='$numc'";//CONSULTA LA TABLA PAGO CON EL NUMERO DE CONTROL PARA OBTENER LOS DATOS
        $resultadopago = mysqli_query($conexion,$sqlpago); //SE ALMACENA EL RESULTADO DE LA CONSULTA
        //verificar si la consulta fue realizada 
        if($resultadopago){
            /*recupera cada uno de los registros dependiendo el campo solicitado
            el registro se guarda en una variable*/
            while($row = $resultadopago->fetch_array()){ 
                $folio = $row['folio'];
                $monto = $row['monto'];
                $concepto = $row['concepto'];
                $fechaOrGen = $row['fechaOrdenGenerada'];
                $fecReRosa = $row['fechaReRosaRecibido'];
                $aluNum = $row['aluNum'];
                $estatus = $row['estatus'];
            }
        }
        //BUSQUEDA PARA OBTENER LA INFORMACION DEL ALUMNO
        $sqlasistencia = "SELECT * FROM asistenciatall WHERE aluNum='$numc'";//CONSULTA LA TABLA PAGO CON EL NUMERO DE CONTROL PARA OBTENER LOS DATOS
        $resultadoAsis = mysqli_query($conexion,$sqlasistencia); //SE ALMACENA EL RESULTADO DE LA CONSULTA
        //verificar si la consulta fue realizada 
        if($resultadoAsis){
            /*recupera cada uno de los registros dependiendo el campo solicitado
            el registro se guarda en una variable*/
            while($row = $resultadoAsis->fetch_array()){ 
                $tallCla = $row['tallCla'];
                $pendiente= $row['espera'];
            }
        }

        

        if($tallCla=='Tall1'){
            $tallCla='Programacion en Java';
        }else{
            if($tallCla=='Tall2'){
                $tallCla='Ciberseguridad';
            }
            else{
                if($tallCla=='Tall3'){
                    $tallCla='Deep Learning';
                }else{
                    if($tallCla=='Tall4'){
                        $tallCla='Fibra Optica';
                    }else{
                        if($tallCla=='Tall5'){
                            $tallCla='Kali Linux';
                        }else{
                            if($tallCla=='Tall6'){
                                $tallCla='Análisis de Datos y Analítica Predictiva';
                            }else{
                                if($tallCla=='Tall7'){
                                    $tallCla='La informática sus fundamentos, tecnologías y aplicaciones';
                                }
                            }
                        }
                    }
                }
            }
        }


        if($esperaAlumnoTrue==TRUE){
            $esperaAlumnoTrue='En fila de espera';
        }else{
            $esperaAlumnoTrue='Confirmado';
        }


         //BUSQUEDA PARA OBTENER LA INFORMACION DEL TALLER DEL ALUMNO
         $sqlasistenciaT = "SELECT * FROM taller WHERE clave='$tallCla'";//CONSULTA LA TABLA PAGO CON EL NUMERO DE CONTROL PARA OBTENER LOS DATOS
         $resultadoAsisT = mysqli_query($conexion, $sqlasistenciaT); //SE ALMACENA EL RESULTADO DE LA CONSULTA
         //verificar si la consulta fue realizada 
         if($resultadoAsisT){
             /*recupera cada uno de los registros dependiendo el campo solicitado
             el registro se guarda en una variable*/
             while($row = $resultadoAsisT->fetch_array()){ 
                $ubicacion = $row['ubicacion'];
                $inicio= $row['inicio'];
            }
         }



        
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
        header("location:/php/index.php");
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


    

    <div class="TyC">
        <section class="tallconf">
            
            <table>
                <thead>
                    <tr>
                        <th>INFORMACION DEL ALUMNO</th>
                        
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
                        <td>SEMESTRE</td>
                        <td><?php echo $sem; ?></td>
                    </tr>
                    <tr>
                        <td>CARRERA</td>
                        <td><?php echo $carr; ?></td>
                    </tr>
                    <tr>
                        <td>CREDITO A OBTENER</td>
                        <td><?php echo $credito;?></td>
                    </tr>
                    <tr>
                        <td>CORREO</td>
                        <td><?php echo $correo;?></td>
                    </tr>
                    <tr>
                        <td>NUMERO DE CONTROL</td>
                        <td><?php echo $numc; ?></td>
                    </tr>
                    
                </tbody>
            </table>
        </section>

        

        <section class="tallconf">
            
            <table>
                <thead>
                    <tr>
                        <th>INFORMACION COMPRA</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>PAQUETE COMPRADO</td>
                        <td><?php echo $concepto; ?></td>
                    </tr>
                    
                    <tr>
                        <td>Taller Elegido</td>
                        <td><?php echo $tallCla;?></td>
                    </tr>
                    
                    <tr>
                        <td>Estatus</td>
                        <td><?php echo $esperaAlumnoTrue;?></td>
                    </tr>
                    <tr>
                        <td>AVISO</td>
                        <td><h2 style="color: red;">LLEVA TU VOUCHER A LA OFICINA DEL EDIFICIO 36</td>
                    </tr>
                    <!--
                    <tr>
                        <td>FECHA</td>
                        <td><?php //echo $inicio;?></td>
                    </tr>
                    <tr>
                        <td>CALIFICACION</td>
                        <td><?php?></td>
                    </tr>
                    -->
                    <tr>
                        <td>ESTATUS DE PAGO</td>
                        <td><?php echo $estatus;?></td>
                    </tr>
                    
                    
                </tbody>
            </table>
        </section>

        <section class="tallconf">
            
            
        </section>
    </div> 

    <form method="post" class="formulario2">
        <form method="post">
            <input type="submit" value="Paquetes" name="Paquetes"/>
        
        <form  method="post" >
            <input type="submit" value="Consultar voucher" name="Voucher">
       
        <form action="qrEntrada.php" method="post" >
            <input type="submit" value="Tu boleto" name="Boleto">
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