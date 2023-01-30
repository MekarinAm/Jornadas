<?php
    //NOS ASEGURAMOS DE QUE SOLO SE PUEDA ACCEDER A ESTA PESTAÑA SI LA SESION ESTA INICIADA
    session_start();
    if(isset($_SESSION['identificadorUsuario']))
    {
        //IMPORTAMOS LA CONEXION
        include("conexion.php");
        $conexion = conectaDB();
        //guardamos el nombre del usuario en una variable
        $ncontrol=$_SESSION['identificadorUsuario'];
        //BUSQUEDA PARA OBTENER LA INFORMACION DEL ALUMNO
        $sqlalumno = "SELECT * FROM egresado WHERE numControl='$ncontrol'";//CONSULTA LA TABLA ALUMNOS CON EL CORREO PARA OBTENER LOS DATOS
        $resultadoAlumno = mysqli_query($conexion,$sqlalumno); //SE ALMACENA EL RESULTADO DE LA CONSULTA

        //verificar si la consulta fue realizada 
        if($resultadoAlumno){
            /*recupera cada uno de los registros dependiendo el campo solicitado
            el registro se guarda en una variable*/
            while($row = $resultadoAlumno->fetch_array()){ 
                $clave = $row['clave'];
                $nombre = $row['nombre'];
                $app = $row['apellidoPat'];
                $apm = $row['apellidoMat'];
                $numControl= $row['numControl'];
                $correo= $row['correo'];
                $numcel= $row['numcel'];
                $ingreso= $row['anioIngreso'];
                $egreso= $row['anioEgreso'];
                $empresa= $row['empresa'];
                $puesto= $row['puesto'];
                $titulo= $row['anioTitulo'];
            }
        }
    
        
        

    }else{
        //SI LA SESION NO ESTA INICIADA REDIRIGIMOS AL USUARIO A LA PAGINA DE LOGIN
        header("location:/indexEg.html");
    }
?>