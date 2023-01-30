<?php
    session_start();
    error_reporting(0);
    if(isset($_SESSION['identificadorUsuario']))
    {
        //DAMOS INICIO DE LA CONEXION CON LA BASE DE DATOS
        include("conexion.php");
        $conexion = conectaDB();
        //guardamos el nombre del usuario en una variable
        $nombreUsuarioIngresado=$_SESSION['identificadorUsuario'];
        //GUARDAMOS EL VALOR DEL CREDITO DEL PAQUETE SELECCIONADO
        $creditoYMed = $_POST['credito'];
        $taller = $_POST['taller'];
        $mensajeError='';

        $sqlalumno = "SELECT * FROM alumno WHERE correo= '$nombreUsuarioIngresado'";//consulta para saber si el alumno con el correo de inicio de sesion tiene ya un paquete adquirido
        $resultado = mysqli_query($conexion,$sqlalumno); //resultado de la consulta tabla alumno
        if($resultado){
            /*recupera cada uno de los registros dependiendo el campo solicitado
            el registro se guarda en una variable*/
            while($row = $resultado->fetch_array()){ 
                $credito = $row['credito'];
                $numCon = $row['numControl'];
                $esperaAlumnoTrue=$row['filaEspera'];
            }
        }


        //OBTENEMOS LA HORA 
        date_default_timezone_set('America/Mexico_City');    
        $DateAndTime = date('m-d-Y h:i:s a', time());  

        $espera='En espera';
        $trueEspera=1;

        //query para comprobar que no se haya comprado un paquete antes
        $sqlpago = "SELECT * FROM pago WHERE aluNum= '$numCon'";
        $resultadoPago = mysqli_query($conexion,$sqlpago); //resultado de la consulta tabla alumno
        if($sqlpago){
            /*recupera cada uno de los registros dependiendo el campo solicitado
            el registro se guarda en una variable*/
            while($row = $resultadoPago->fetch_array()){ 
                $concepto = $row['concepto'];
                
            }
        }




        
        //SE HACE EL QUERY DE BUSQUEDA CON LA SENTENCIA COUNT PARA CONTAR EL NUMERO DE FILAS QUE CUMPLAN CON LA CONDICION 
        $cuenta = "SELECT count(tallCla) AS 'TOTAL' FROM asistenciatall WHERE tallCla='$taller'";
        $resultado2 = mysqli_query($conexion,$cuenta);
        //SE CUENTAN LAS FILAS PARA CONTAR LOS 20 ESPACIOS PARA EL TALLER DESEADO ENCONTRADAS DENTRO DEL WHILE Y SE ALMACENAN EN UNA VARIABLE PARA SER LLAMADA POSTERIORMENTE EN EL HTML
        while($filas=mysqli_fetch_assoc($resultado2)){
            $salidaCompleto=$filas['TOTAL'];
        }

        /*
        var_dump($concepto);
        var_dump($credito);

        $bool2=$concepto==true;
        $bool=$credito==true;

        var_dump($bool);
        var_dump($bool2);
        */
        if (empty($taller)){
            echo '<script>alert("SELECCIONA UN TALLER");
            window.history.go(-1);</script>';

        }else{

            //SI SE ENCONTRO UN REGISTRO
            if($concepto==true or $esperaAlumnoTrue==true)
            {
                //MANDAMOS UN MENSAJEN DE ERROR Y CERRAMOS LA CONEXION
                echo '<script>alert("YA CUENTAS CON UN PAQUETE, SI QUIERES CAMBIAR DE PAQUETE COMUNICATE AL CORREO eventos.sistemas@puebla.tecnm.mx");
                window.history.go(-3);</script>';
                //$mensajeError= '<div style="color:red;">YA CUENTAS CON UN PAQUETE, SI QUIERES CAMBIAR DE PAQUETE COMUNICATE AL CORREO DE JORNADAS.</div>';
                disconnectDB($conexion);

                
            }else{

                //SI SE ENCONTRO UN REGISTRO
                //EL 20 SIGNIFICA QUE 20 PERSONAS PUEDEN ENTRAR A ESE TALLER
                if($salidaCompleto>=20)
                {

                    //insert de espera en la tabla taller
                    $insert = "INSERT INTO asistenciaTall (aluNum, tallCla, espera, horaFila)
                    VALUES ('$numCon', '$taller', '$espera', '$DateAndTime')";
                    mysqli_query($conexion,$insert);


                    $update = "UPDATE alumno SET credito = '$creditoYMed', filaEspera='$trueEspera' WHERE correo = '$nombreUsuarioIngresado'";
                    mysqli_query($conexion,$update); 

                    echo '<script>alert("LO SENTIMOS SE ALCANZO EL CUPO MAXIMO PARA ESTE TALLER PERO ESTARAS EN LA FILA DE ESPERA PARA INGRESAR");
                    window.history.go(-3);</script>';
                    disconnectDB($conexion);
                    
                }else{

                    //SI NO HUBO NINGUN TIPO DE ERROR PORCEDEMOS A REALIZAR EL UPDATE DEL REGISTRO DEL CREDITO EL REGISTRO
                    $update = "UPDATE alumno SET credito = '$creditoYMed' WHERE correo = '$nombreUsuarioIngresado'";
                    mysqli_query($conexion,$update); //MANDAMOS A RELAIZAR EL UPDATE CON LA CONEXION EN LA BASE DE DATOS
                    //INGRESO DE INFORMACION PARA LA ASISTENCIA Y REGISTRO DEL TALLER ELEGIDO
                        
                    $insert = "INSERT INTO asistenciatall (aluNum, tallCla)
                    VALUES ('$numCon', '$taller')";
                    mysqli_query($conexion,$insert); //MANDAMOS A RELAIZAR EL INSERT CON LA CONEXION EN LA BASE DE DATOS
                        
                    //MANUALMENTE INGRESAMOS EL DATO DE LAS CONFERENCIAS PUES NUNCA CAMBIARÁ
                    //INGRESO DE INFORMACION PARA LA ASISTENCIA Y REGISTRO DE LAS CONFERENCIAS
                    $insert = "INSERT INTO asistenciaConf (aluNum, conCla)
                    VALUES ('$numCon', 'Conf1')";
                    mysqli_query($conexion,$insert); //MANDAMOS A RELAIZAR EL INSERT CON LA CONEXION EN LA BASE DE DATOS


                    $insert = "INSERT INTO asistenciaConf (aluNum, conCla)
                    VALUES ('$numCon', 'Conf2')";
                    mysqli_query($conexion,$insert);


                    $insert = "INSERT INTO asistenciaConf (aluNum, conCla)
                    VALUES ('$numCon', 'Conf3')";
                    mysqli_query($conexion,$insert);

                    $insert = "INSERT INTO asistenciaConf (aluNum, conCla)
                    VALUES ('$numCon', 'Conf4')";
                    mysqli_query($conexion,$insert);

                    $insert = "INSERT INTO asistenciaConf (aluNum, conCla)
                    VALUES ('$numCon', 'Conf5')";
                    mysqli_query($conexion,$insert);

                    $insert = "INSERT INTO asistenciaConf (aluNum, conCla)
                    VALUES ('$numCon', 'Conf6')";
                    mysqli_query($conexion,$insert);

                    $insert = "INSERT INTO asistenciaConf (aluNum, conCla)
                    VALUES ('$numCon', 'Conf7')";
                    mysqli_query($conexion,$insert);

                    $insert = "INSERT INTO asistenciaConf (aluNum, conCla)
                    VALUES ('$numCon', 'Conf8')";
                    mysqli_query($conexion,$insert);

                    $insert = "INSERT INTO asistenciaConf (aluNum, conCla)
                    VALUES ('$numCon', 'Conf9')";
                    mysqli_query($conexion,$insert);


                    $insert = "INSERT INTO asistenciaConf (aluNum, conCla)
                    VALUES ('$numCon', 'Conf10')";
                    mysqli_query($conexion,$insert);

                    $insert = "INSERT INTO asistenciaConf (aluNum, conCla)
                    VALUES ('$numCon', 'Conf11')";
                    mysqli_query($conexion,$insert);

                    $insert = "INSERT INTO asistenciaConf (aluNum, conCla)
                    VALUES ('$numCon', 'Conf12')";
                    mysqli_query($conexion,$insert);

                    $insert = "INSERT INTO asistenciaConf (aluNum, conCla)
                    VALUES ('$numCon', 'Conf13')";
                    mysqli_query($conexion,$insert);

                    $insert = "INSERT INTO asistenciaConf (aluNum, conCla)
                    VALUES ('$numCon', 'Conf14')";
                    mysqli_query($conexion,$insert);

                    $insert = "INSERT INTO asistenciaConf (aluNum, conCla)
                    VALUES ('$numCon', 'Conf15')";
                    mysqli_query($conexion,$insert);

                    header("location:/php/voucherComp.php");

                }

                

            } 

        }
        
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
