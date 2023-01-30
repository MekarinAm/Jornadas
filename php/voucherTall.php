<?php
    session_start();
    if(isset($_SESSION['identificadorUsuario']))
    {
        //DAMOS INICIO DE LA CONEXION CON LA BASE DE DATOS
        include("conexion.php");
        $conexion = conectaDB();
        //guardamos el nombre del usuario en una variable
        $nombreUsuarioIngresado=$_SESSION['identificadorUsuario'];
        
        $sqlalumno = "SELECT * FROM alumno WHERE correo='$nombreUsuarioIngresado'"; //consulta tabla alumno
        $alumno = mysqli_query($conexion,$sqlalumno); //resultado de la consulta tabla alumno
        $sqlpago = "SELECT * FROM pago WHERE correo='$nombreUsuarioIngresado'";
        $pago = mysqli_query($conexion,$sqlpago);
        //verificar si la consulta fue realizada 
        if($alumno){
            /*recupera cada uno de los registros dependiendo el campo solicitado
            el registro se guarda en una variable*/
            while($row = $alumno->fetch_array()){ 
                $nombre = $row['nombre'];
                $app = $row['apellidoPat'];
                $apm = $row['apellidoMat'];
                $numc = $row['numControl'];
                $carr = $row['carrera'];
                $sem = $row['semestre'];
                $cred = $row['credito'];
            }
        }
        

       
        /**Sección para recuperar los datos del voucher */
        $sqlfolio = "SELECT folio FROM pago ORDER BY folio DESC";// consulta tabla pago del campo folio
        $consulta = mysqli_query($conexion,$sqlfolio);    //resultado de la consulta tabla pago del campo folio
        $row = mysqli_fetch_array($consulta);//recuperación de registros del campo folio de la tabla pago
        $sql = "SELECT folio FROM pago WHERE folio LIKE 'P%'"; /**consulta de folios de conferencia */
        $res = mysqli_query($conexion,$sql);/**resultado de la consulta */
        $row = mysqli_fetch_array($res);
        $numpag = mysqli_num_rows($res);//número de registros de folio de conferencia
        $monto = 200.00;
        $concepto = 'Taller'; //nombre del paquete
        date_default_timezone_set("America/Mexico_City");
        $fechaOrdenGenerada = date('Y-m-d'); //recupera la fecha actual 
        $valido=date("Y-m-d",strtotime($fechaOrdenGenerada."+ 1 days")); //caducidad del voucher
        $fechaReRosaRecibido = NULL;
        $folioRosa = NULL;
        $estatus = "No pagado";
        $cred = 1;
        if($numpag<120){/**verificará si el número de registros del paquete es menor a 150 */
            /**asignará el folio correspondiente*/
            $idd = str_replace("T","",$numc);/*continuará con la numeración automática del folio*/
            $id = str_pad($numc,8,STR_PAD_LEFT);/**agregará 6 digitos más a la derecha para el folio (número de control) */
            $folio = 'T'.$id;/**guardará el folio en la variable */
            //insertamos el registro del pago
            $insert = "INSERT INTO pago (folio,monto,concepto,fechaOrdenGenerada,expira,fechaReRosaRecibido,folioRosa,estatus,aluNum) VALUES ('$folio','$monto','$concepto','$fechaOrdenGenerada','$valido','$fechaReRosaRecibido','$folioRosa','$estatus','$numc')";
            //$update = "UPDATE alumno SET credito = '$cred' WHERE alumno.numControl = numc";
            $resul = mysqli_query($conexion,$insert);
            //$upresul = mysqli_query($conexion,$update);
            //@$credito = mysqli_fetch_array($upresul);
            
            
            
            if($resul){
                if($pago){
                    while($row = $pago->fetch_array()){
                        $folio = ['folio'];
                        $monto = ['monto'];
                        $fechaOrdenGenerada = ['fechaOrdenGenerada'];
                        $valido = ['expira'];
                        $concepto = ['concepto'];
                        $folRosa = ['folioRosa'];
                    }
                }
            }
            /**si el registro no se insertó correctament mostrará un mensaje al usuario y no se generará otro voucher */
            if(!$resul){
                echo '<script> alert("El voucher ya fue creado");
                location.replace("http://eventos.itpuebla.edu.mx/php/index.php");</script>';
            }
            //si el registro no se inserto correctamente se mostrará un mensaje al usuario y no se generará otro voucher 
            else{
                echo '<script> alert("Generación de voucher exitoso.");</script>';  
            }
                
        }
        //si el número de vouchers llega a su límite 
        else{
            echo '<script> alert("Cupo Completo Paquete Cerrado.");
            location.replace("http://eventos.itpuebla.edu.mx/index.php")</script>';
        }
            
    
       mysqli_free_result($alumno); //libera memoria
       //mysqli_free_result($pago);  //libera memoria
       mysqli_close($conexion);
        
    }else
    {
        header("location:/registro.html");
    }
 
 
    if(isset ($_POST['cierra']))
    {
        session_destroy();
        header("location:/registro.html");
    }
?>


<!DOCTYPE html>
<html lang="es">
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
        <title>Sistema de Control de Pagos</title>
        <link rel="preload" href="/css/styles.css" as="style">
        <link href="/css/styles.css" rel="stylesheet">
</head>
<div class="logos">
            <div class="TyC8">
            <img src="../media/TecNM-logo.png" alt="tecnm" class="logos_img">
            <img src="../media/itplogo.png" alt="itp" class="logos_img">
            <img src="../media/50aniv.png" alt="itp_50" class="logos_img">
            </div>
        </div>
    <!--Titulo
    <div id="titulo">
        <h1>Jornadas Internacionales de Tecnologías de la Información 2022 </h1>
        <h2>Voucher de Pago</h2>
    </div>-->
    <main class="contenedor sombra">
        <!--Creación de contenedor de tabla-->
        <div class="container_table"> 
            <div class="table_title">Datos del Alumno</div>
        <!--Enlace para consultar tabla alumno y pago -->
        <!--Creación de tabla datos del alumno-->
            <table class="table_datos">
            <tr>
              <th>nombre</th>
              <td><?php echo $nombre //consulta de dato?></td>
            </tr>
             <tr>
             <th>apellido paterno</th>
             <td><?php echo $app; ?></td>
            </tr>
            <tr>
             <th>apellido materno</th>
             <td><?php echo $apm; ?></td>
            </tr>
             <th>no. control</th>
             <td><?php echo $numc; ?></td>
            </tr>
            <tr>
             <th>carrera</th>
             <td><?php echo $carr ?></td>
            </tr>
            <tr>
             <th>semestre</th>
             <td><?php echo $sem; ?>°</td>
            </tr>
            <tr>
                 <th>paquete</th>
                 <td><?php echo $concepto; //consulta de dato?></td>
             </tr>
             <tr>
                 <th>importe</th>
                 <td>$<?php echo $monto; ?></td>
             </tr>
             <tr>
                 <th>solicitado</th>
                 <td><?php echo $fechaOrdenGenerada; ?></td>
             </tr>
         </table>
         <!--Creación de tabla datos del pago-->
        
            <div id="nota"><!--Nota importante-->
            <h2>¡IMPORTANTE!</h2>
                    <p>Recuerda que el paquete elegido es <?php echo $concepto;?><br>
                    <br>**No habrá devoluciones por ningún motivo**
                    <br>RECUERDA CONSULTAR EL SIE PARA  OBTENER TU LINEA DE PAGO Y REALIZARLO</p>
            </div>
            <div id="imprimir"><!--Botón de imprimir, llamando método-->
                <button onclick="window.print();">Imprimir</button>
                <a href="index.php"><button>Salir</button></a>
            </div>
        </div>
    </main>
    <footer>
        <p>Instituto Tecnológico de Puebla<br> &copy Todos los Derechos Reservados<br>
            Av. Tecnológico 420 Col. Maravillas. Puebla, Pue. C.P. 72220<br>
            Tels. 222 229 88 10, 11, 12, 89 y 69
        </p>
    </footer>
    
<body></body>

</html>