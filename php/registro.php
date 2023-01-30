<?php
    //Incluimos la funcion de conexion a la base de datos 
    include("conexion.php");
    $conexion = conectaDB();
    error_reporting(0);
    //Indicamos los parametros que obtendremos del formulario
    $nControl = $_POST['nControl'];
    $nombre = $_POST['nombre'];
    $apellidoPat = $_POST['aPat'];
    $apellidoMat = $_POST['aMat'];
    $semestre = $_POST['semestreCur'];
    $carrera = $_POST['carrera'];
    $correoIns = $_POST['correoIns'];
    $contrasenia = $_POST['contrasenia'];

    
    
    //BUSQUEDA PARA SABER SI EL CORREO YA ESTA REGISTRADO
    $sqlCorreo = "SELECT * FROM alumno WHERE correo='$correoIns'";//CONSULTA LA TABLA ALUMNOS CON EL CORREO PARA OBTENER LOS DATOS
    $resultadoCorreo = mysqli_query($conexion,$sqlCorreo); //SE ALMACENA EL RESULTADO DE LA CONSULTA
    $nm_filasCorreo = mysqli_num_rows($resultadoCorreo);
    //VERIFICAMOS QUE LA CONTRASEÑA NO SEA IGUAL AL NUMERO DE CONTROL
    if($contrasenia==$nControl){

        //EN CASO DE SER IGUAL LO DECIMOS CON UN MENSAJE DE ERROR (DENTRO DEL CODIGO AGRAGAMOS ESTILO HACIENDO QUE LA LETRA SEA ROJA)
        $mensajeError= '<div style="color:red;">TU CONTRASEÑA NO DEBE SER IGUAL A TU NUMERO DE CONTROL.</div>';
        //CERRAMOS LA CONEXION A LA BASE DE DATOS
        disconnectDB($conexion);
    }else{
        //SI LA CONTRASEÑA ERA DIFERENTE AL NUMERO DE CONTROL AHORA VERIFICAMOS QUE LA PERSONA NO SE ENCUENTRE REGISTRADA PREVIAMENTE
        $sqlalumno = "SELECT * FROM alumno WHERE numControl=$nControl";//consulta para saber si el numero de control ya esta registrado
        $resultado = mysqli_query($conexion,$sqlalumno); //resultado de la consulta tabla alumno
        $nm_filas = mysqli_num_rows($resultado);//cuenta el num de filas encontradas
        //SI SE ENCONTRO UN REGISTRO
        if($nm_filas>0){
            //MANDAMOS UN MENSAJEN DE ERROR Y CERRAMOS LA CONEXION
            $mensajeError= '<div style="color:red;">ESTE NUMERO DE CONTROL YA HA SIDO REGISTRADO ANTERIORMENTE</div>';
            disconnectDB($conexion);
        }else{
            if($nm_filasCorreo>0){
                $mensajeError= '<div style="color:red;">ESTE CORREO YA HA SIDO REGISTRADO ANTERIORMENTE</div>';
                disconnectDB($conexion);
            }else{
                //SI NO HUBO NINGUN TIPO DE ERROR PORCEDEMOS A GUARDAR EL REGISTRO
                //CIFRAMOS LA CONTRASEÑA POR SEGURIDAD
                $contraHash = password_hash($contrasenia, PASSWORD_BCRYPT);
                //Una vez obtenidos los datos Y la contraseña cifrada los insertamos en nuestra tabla 
                $insert = "INSERT INTO alumno (numControl, nombre, apellidoPat, apellidoMat, semestre, carrera, correo, contrasenia) 
                VALUES ('$nControl', '$nombre','$apellidoPat', '$apellidoMat','$semestre', '$carrera', '$correoIns', '$contraHash')";
        
                //Si en el insert hay algun problema no pensado entonces mostramos el error
                if (!mysqli_query($conexion, $insert)){
                    $mensajeError= '<div style="color:red;">HA OCURRIDO UN ERROR INESPERADO VUELVE A LLENAR EL FORMULARIO</div>';
                    //CERRAMOS LA CONEXION
                    disconnectDB($conexion);
                }else{
                    //Agregamos un tiempo de espera de 5 segundos y redireccionamos a la pagina de login
                    disconnectDB($conexion);
                    sleep (1);
                    header("location:/registro.html");
                    
                }

            }
            
        }
    }
    
?>





<!--AGREGAMOS HTML PARA COMUNICAR EL ERROR Y QUE SE VUELVA A LLENAR EL FORMULARIO-->

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="css/styles.css">
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
        <title>Nuevo Usuario</title>
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
            <a href="/index.html">Inicio</a>
            <a href="/paquetes.html">Paquetes</a>
            <a href="/registro.html">Registro</a>
        </nav>
    </div>

   

    <main class="contenedor sombra">
        <section>
            

            <form name="form" action="/php/registro.php" method="post" class="formulario" >
                <fieldset>
                    <legend>Jornadas TIC's</legend>
                    <p>REGISTRATE</p>
                    <p>Llena los siguientes campos para registrarte</p>

                    <div class="contenedor-campos2">

                        <div class="campo">
                            
                            <input class="input-text" type="text" name="nControl" placeholder="Numero de Control" id="ncontrol" required>
                        </div>

                        <div class="campo">
                            
                            <input class="input-text" type="text" name="nombre" placeholder="Nombre" required>
                        </div>
                        <div class="campo">
                            
                            <input class="input-text" type="text" name="aPat" placeholder="Apellido Paterno" required>
                        </div>
                        <div class="campo">
                            
                            <input class="input-text" type="text" name="aMat" placeholder="Apellido Materno" required>
                        </div>
                        <div class="campo">
                            
                            <input class="input-text" type="email" name="correoIns" placeholder="Correo Institucional (si eres externo ingresa tu correo personal)" required>
                        </div>

                        <div class="campo">
                            
                            <input class="input-text" type="password" name="contrasenia" placeholder="Contraseña" id="contra" required>
                        </div>
                        <!--AGREGAMOS CODIGO PHP PARA COMUNICAR EL ERROR-->
                        <?php
                            echo $mensajeError;
                        ?>
                       
                        <div class="campo">
                            <label for="semestreCur">Semestre actual</label>
                            <select class="input-text" name="semestreCur">
                            
                                <option value="1">1°</option>
                                <option value="2">2°</option>
                                <option value="3">3°</option>
                                <option value="4">4°</option>
                                <option value="5">5°</option>
                                <option value="6">6°</option>
                                <option value="7">7°</option>
                                <option value="8">8°</option>
                                <option value="9">9°</option>
                                <option value="10">10°</option>
                                <option value="11">11°</option>
                                <option value="12">12°</option>
                                <option value="13">13°</option>
                                <option value="14">14°</option>
                                <option value="15">15°</option>
                            </select>  
                        </div>

                        <div class="campo">
                            <label for="carrera">Carrera</label>
                            <select class="input-text" name="carrera">
                            
                                <option value="TICs">Ing. Tecnologias de la Informacion y Comunicaciones</option>
                                <option value="Gestion Empresarial">Ing. Gestion Empresarial</option>
                                <option value="Industrial">Ing. Industrial</option>
                                <option value="Logistica">Ing. Logistica</option>
                                <option value="Administracion">Lic. Administracion</option>
                                <option value="Electrica">Ing. Electrica</option>
                                <option value="Electronica">Ing. Electronica</option>
                                <option value="Mecanica">Ing. Mecanica</option>
                                
                            </select> 
                            
                        </div>
   
                    </div> <!-- .contenedor-campos -->

                    <input type="submit" name="enviarRegistro" id="enviarReg" value="ENVIAR">
                </fieldset>    
    
               
                
            </form>
        </section>
        
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