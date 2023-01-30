<?php
    //NOS ASEGURAMOS DE QUE SOLO SE PUEDA ACCEDER A ESTA PESTAÑA SI LA SESION ESTA INICIADA
    session_start();
    if(isset($_SESSION['identificadorUsuario']))
    {
        //IMPORTAMOS LA CONEXION
        include("conexion.php");
        $conexion = conectaDB();
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
                $numc = $row['numControl'];
                $carr = $row['carrera'];
                $sem = $row['semestre'];
                $cred = $row['credito'];
            }
        }
    
        $sqlpago = "SELECT * FROM pago WHERE aluNum='$numc'";//CONSULTA LA TABLA ALUMNOS CON EL CORREO PARA OBTENER LOS DATOS
        $resultadopago = mysqli_query($conexion,$sqlpago);

        if($resultadopago){
            while($row = $resultadopago->fetch_array()){
                $folio = $row['folio'];
                $monto = $row['monto'];
                $concepto = $row['concepto'];
                $fechaOrdenGenerada = $row['fechaOrdenGenerada'];
                $fechaReRosaRecibido = $row['fechaReRosaRecibido'];
                $folioRosa = $row['folioRosa'];
                $estatus = $row['estatus'];
            }

        }
        

    }else{
        //SI LA SESION NO ESTA INICIADA REDIRIGIMOS AL USUARIO A LA PAGINA DE LOGIN
        header("location:/registro.html");
    }
?>