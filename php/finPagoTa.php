<?php
    //NOS ASEGURAMOS DE QUE SOLO SE PUEDA ACCEDER A ESTA PESTAÑA SI LA SESION ESTA INICIADA
    session_start();
    error_reporting(0);
    if(isset($_SESSION['identificadorUsuario']))
    {

        include("conexion.php");
        $conexion = conectaDB();
        //guardamos el nombre del usuario en una variable
        $nombreUsuarioIngresado=$_SESSION['identificadorUsuario'];
        $sqlalumno = "SELECT * FROM alumno WHERE correo= '$nombreUsuarioIngresado'";//consulta para saber si el alumno con el correo de inicio de sesion tiene ya un paquete adquirido
        $resultado = mysqli_query($conexion,$sqlalumno); //resultado de la consulta tabla alumno
        if($resultado){
            /*recupera cada uno de los registros dependiendo el campo solicitado
            el registro se guarda en una variable*/
            while($row = $resultado->fetch_array()){ 
                $credito = $row['credito']; //si esta vacio devuelve un NULL 
                $numCon = $row['numControl']; //devuelve el numero de control del usuario
                $esperaAlumnoTrue=$row['filaEspera'];
            }
        }

        //GUARDAMOS EL VALOR DEL CREDITO DEL PAQUETE SELECCIONADO
        $credito1 = $_POST['credito']; //recibo el valor 1 indicando si el estudiante quiere el credito 
        $taller = $_POST['taller']; //recibo la clave del taller seleccionado

        //OBTENEMOS LA HORA 
        date_default_timezone_set('America/Mexico_City');    
        $DateAndTime = date('m-d-Y h:i:s a', time());  

        $espera='En espera';
        $trueEspera=1;

         
        if (empty($taller)){
            echo '<script>alert("SELECCIONA UN TALLER");
            window.history.go(-1);</script>';

        }else{

            //SE HACE EL QUERY DE BUSQUEDA CON LA SENTENCIA COUNT PARA CONTAR EL NUMERO DE FILAS QUE CUMPLAN CON LA CONDICION 
            $cuenta = "SELECT count(tallCla) AS 'TOTAL' FROM asistenciatall WHERE tallCla='$taller'";
            $resultado = mysqli_query($conexion,$cuenta);
            //SE CUENTAN LAS FILAS ENCONTRADAS DENTRO DEL WHILE Y SE ALMACENAN EN UNA VARIABLE PARA SER LLAMADA POSTERIORMENTE EN EL HTML
            while($filas=mysqli_fetch_assoc($resultado)){
                $salidaCompleto=$filas['TOTAL'];
            }

            //query para comprobar que no se haya comprado un paquete antes
            $sqlpago = "SELECT * FROM pago WHERE aluNum= '$numCon'";
            $resultadoPago = mysqli_query($conexion,$sqlpago); //resultado de la consulta tabla alumno
            if($sqlpago){
                //recupera cada uno de los registros dependiendo el campo solicitado
                //el registro se guarda en una variable
                while($row = $resultadoPago->fetch_array()){ 
                    $concepto = $row['concepto'];
                    
                }
            }


            
            
            if($concepto==true or $esperaAlumnoTrue==true){
                //MANDAMOS UN MENSAJEN DE ERROR Y CERRAMOS LA CONEXION
                echo '<script>alert("YA CUENTAS CON UN PAQUETE, SI QUIERES CAMBIAR DE PAQUETE COMUNICATE AL CORREO eventos.sistemas@puebla.tecnm.mx");
                window.history.go(-3);</script>';
                //$mensajeError= '<div style="color:red;">YA CUENTAS CON UN PAQUETE, SI QUIERES CAMBIAR DE PAQUETE COMUNICATE AL CORREO DE JORNADAS.</div>';
                disconnectDB($conexion);
                
            }else{

                //SI SE ENCONTRO UN REGISTRO 
                //AQUI SE CAMBIAN LOS CUPOS PARA CADA TALLER PONEMOS UN LIMITE DE 20 PERSONAS POR TALLER
                if($salidaCompleto>=20)
                {
                    
                    //insert de espera en la tabla taller
                    $insert = "INSERT INTO asistenciaTall (aluNum, tallCla, espera, horaFila)
                    VALUES ('$numCon', '$taller', '$espera', '$DateAndTime')";
                    mysqli_query($conexion,$insert);


                    $update = "UPDATE alumno SET credito = '$credito1', filaEspera='$trueEspera' WHERE correo = '$nombreUsuarioIngresado'";
                    mysqli_query($conexion,$update); 


                    echo '<script>alert("LO SENTIMOS SE ALCANZO EL CUPO MAXIMO PARA ESTE TALLER PERO ESTARAS EN LA FILA DE ESPERA PARA INGRESAR");
                    window.history.go(-3);</script>';
                    //mysqli_query($conexion,$insert); //MANDAMOS A RELAIZAR EL INSERT CON LA CONEXION EN LA BASE DE DATOS
                    //PERO ESTAS EN LINEA DE ESPERA, QUEDATE APENDIENTE A TU PANEL

                    



                    disconnectDB($conexion);
                    
                }else
                {
                    //SI NO HUBO NINGUN TIPO DE ERROR PORCEDEMOS A REALIZAR EL UPDATE DEL REGISTRO DEL CREDITO EL REGISTRO
                    $update = "UPDATE alumno SET credito = '$credito1' WHERE correo = '$nombreUsuarioIngresado'";
                    mysqli_query($conexion,$update); //MANDAMOS A RELAIZAR EL INSERT CON LA CONEXION EN LA BASE DE DATOS
                    //INGRESO DE INFORMACION PARA LA ASISTENCIA Y REGISTRO DEL TALLER ELEGIDO
                    
                    $insert = "INSERT INTO asistenciaTall (aluNum, tallCla)
                    VALUES ('$numCon', '$taller')";
                    mysqli_query($conexion,$insert); //MANDAMOS A RELAIZAR EL INSERT CON LA CONEXION EN LA BASE DE DATOS
                    header("location:/php/voucherTall.php");

                    
                }
                
            }

        }
        
        
    }else{
        header("location:/registro.html");
    }
?>