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
        $creditoRe = $_POST['credito'];
        $mensajeError='';

        $sqlalumno = "SELECT * FROM alumno WHERE correo = '$nombreUsuarioIngresado'";//consulta para saber si el alumno con el correo de inicio de sesion tiene ya un paquete adquirido
        $resultado = mysqli_query($conexion,$sqlalumno); //resultado de la consulta tabla alumno

        if($resultado){
            /*recupera cada uno de los registros dependiendo el campo solicitado
            el registro se guarda en una variable*/
            while($row = $resultado->fetch_array()){ 
                $credito = $row['credito'];
                $numCon = $row['numControl'];
            }
        }



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



        //SI SE ENCONTRO UN REGISTRO
        if($concepto==true)
        {
            //MANDAMOS UN MENSAJEN DE ERROR Y CERRAMOS LA CONEXION
            echo '<script>alert("YA CUENTAS CON UN PAQUETE, SI QUIERES CAMBIAR DE PAQUETE COMUNICATE AL CORREO eventos.sistemas@puebla.tecnm.mx");
            window.history.go(-3);</script>';
            //$mensajeError= '<div style="color:red;">YA CUENTAS CON UN PAQUETE, SI QUIERES CAMBIAR DE PAQUETE COMUNICATE AL CORREO DE JORNADAS.</div>';
            disconnectDB($conexion);

        }else
        {
             
            //SI NO HUBO NINGUN TIPO DE ERROR PORCEDEMOS A REALIZAR EL UPDATE DEL REGISTRO DEL CREDITO EL REGISTRO
            $update = "UPDATE alumno SET credito = '$creditoRe' WHERE correo = '$nombreUsuarioIngresado'";
            mysqli_query($conexion,$update); //MANDAMOS A RELAIZAR EL UPDATE CON LA CONEXION EN LA BASE DE DATOS



            //MANUALMENTE INGRESAMOS EL DATO DE LAS CONFERENCIAS PUES NUNCA CAMBIARÁ
            //INGRESO DE INFORMACION PARA LA ASISTENCIA Y REGISTRO DE LAS CONFERENCIAS
            $insert = "INSERT INTO asistenciaConf (aluNum, conCla)
            VALUES ('$numCon', 'Conf1')";
            mysqli_query($conexion,$insert); //MANDAMOS A RELAIZAR EL INSERT CON LA CONEXION EN LA BASE DE DATOS
            //header("location:/php/index.php");


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

            header("location:/php/voucherConf.php");

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
