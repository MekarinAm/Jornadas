<?php
    //detectamos si existe una sesion iniciada y en caso de que si lo direccionamos al index.php
    error_reporting(0);
    session_start();
    if(isset($_SESSION['identificadorUsuario']))
    {
        header("location:/php/index.php");
    }

    //VARIABLE QUE TEDNRA EL CORREO DEL ADMINISTRADOR
    $Admin='eventos.sistemas@puebla.tecnm.mx';

    //Incluimos la funcion de conexion a la base de datos 
    include("conexion.php");
    $conexion = conectaDB();
    $errores=[];
    //Indicamos los parametros que obtendremos del formulario para validar que existan
    $correo = mysqli_real_escape_string($conexion, filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL)); 
    $contrasenia = mysqli_real_escape_string($conexion, $_POST['contrasenia']);
    $mensajeError='';
    //Validar para que no se envie el formulario con campos vacios 
    if(!$correo){
        //MANDAMOS UN MENSAJE DE ERROR SI ESTA VACIO
        $errores[]= '<div style="color:red;">Email obligatorio</div>';        
    }
    if(!$contrasenia){
        //MANDAMOS UN MENSAJE DE ERROR SI ESTA VACIO
        $errores[]= '<div style="color:red;">Contraseña obligatoria</div>';   
    }
    
    //SI NO HAY CAMPOS VACIOS
    if(empty($errores)){
        $sqlalumno = "SELECT * FROM alumno WHERE correo='$correo'";//consulta para saber si el correo existe en la base de datos
        $resultado = mysqli_query($conexion,$sqlalumno); //resultado de la consulta tabla alumno
        $nm_filas = mysqli_num_rows($resultado);//cuenta el num de filas encontradas

        
        //SI SE ENCONTRO UN REGISTRO
        if($nm_filas>0){
            //COMPROBAMOS SI INTENTA ENTRAR EL ADMINISTRADOR
            //SE HACE UNA DIVISION PARA VOLVER A COMPROBAR EL CORREO Y LUEGO LA CONTRASELÑA Y DE AHI MANDARLO A OTRO INICIO DE SESION UNICO
            if($correo == $Admin)
            {
                //SI EL CORREO SI ES DEL ADMIN ENTRARA AQUI
                if($resultado->num_rows){
                    $usuario=mysqli_fetch_assoc($resultado);
                    //VERIFICAMOS QUE LA CONTRASEÑA QUE SE INGRESO EN EL LOGIN SEA IGUAL AL HASH QUE SE GENERO EN EL FORMULARIO DE REGISTRO USANDO PASSWORD_VERIFY
                    $auth=password_verify($contrasenia, $usuario['contrasenia']);
                    //SI LAS CONTRASEÑAS NO COINCIDEN
                    if(!$auth){
                        //MANDAMOS MENSAJE DE QUE LA CONTRASEÑA ES INCORRECTA Y DESCONECTAMOS
                        $mensajeError='<div style="color:red;">ADMIN:CONTRASEÑA INCORRECTA</div>';
                        disconnectDB($conexion);
                    }else{
                        //SI LA CONTRASEÑA COINCIDE PROCEDEMOS A INICIAR SESION Y MANDARA A OTRO INDEX UNICO PARA EL ADMIN
                        $_SESSION['identificadorUsuario']=$correo;
                        sleep(1);
                        header("location:/php/indexAdmin.php");
                    }
                }
            }
            else 
            {
                 //RECORREMOS LAS FILAS DEL RESULTADO PARA VERIFICAR LA CONTRASEÑA
                if($resultado->num_rows){
                    $usuario=mysqli_fetch_assoc($resultado);
                    //VERIFICAMOS QUE LA CONTRASEÑA QUE SE INGRESO EN EL LOGIN SEA IGUAL AL HASH QUE SE GENERO EN EL FORMULARIO DE REGISTRO USANDO PASSWORD_VERIFY
                    $auth=password_verify($contrasenia, $usuario['contrasenia']);
                    //SI LAS CONTRASEÑAS NO COINCIDEN
                    if(!$auth){
                        //MANDAMOS MENSAJE DE QUE LA CONTRASEÑA ES INCORRECTA Y DESCONECTAMOS
                        $mensajeError='<div style="color:red;">CONTRASEÑA INCORRECTA</div>';
                        disconnectDB($conexion);
                    }else{
                        //SI LA CONTRASEÑA COINCIDE PROCEDEMOS A INICIAR SESION
                        $_SESSION['identificadorUsuario']=$correo;
                        sleep(1);
                        header("location:/php/index.php");
                    }
                }
            }
           
        }else{
            //SI NO SE ENCONTRO NINGUNA FILA
            if($nm_filas==0){
                //EL CORREO NO ESTA REGISTRADO EN LA BASE DE DATOS Y CERRAMOS CONEXION
                $mensajeError='<div style="color:red;">ESTE NO ES UN CORREO VALIDO INTENTA DE NUEVO</div>';
                disconnectDB($conexion);
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
        <title>Registro</title>
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
           

            <form action="/php/login.php" method="post" class="formulario" >
                <fieldset>
                    <legend>Jornadas TIC's</legend>
                    <p>INICIAR SESIÓN</p>
                   <!--AGREGAMOS SECCION PHP PARA COMUNICAR ERRORES CAMPOS VACIOS-->
                    <?php foreach($errores as $error): ?>
                        
                    <?php echo $error; ?>
                        
                    <?php endforeach; ?>

                    <div class="contenedor-campos">
                        <div class="campo">
                            <input class="input-text" name="correo" type="email" placeholder="Ingresa Tu Correo Institucional">
                        </div>
                        <div class="campo">
                            <input class="input-text" name="contrasenia" type="password" placeholder="Ingresa Tu Contraseña">
                        </div>
                    </div> <!-- .contenedor-campos -->
                    <!--AGREGAMOS SECCION PHP PARA COMUNICAR ERRORES DE CORREO INCORRECTO O CONTRASEÑA INCORRECTA-->
                        <?php
                         echo $mensajeError;
                        ?>
                    <input type="submit" value="INICIAR SESIÓN">
                    
                    <a class="botonRegistro" href="/formularioNU.html">crear cuenta</a>
                    <div class="olvidar">
                        <br><a href="registroExterno.html"><p></p></a>
                        <!--<br><a href="registroExterno.html"><p>SOY EXTERNO AL ITP</p></a>-->
                        <!--<a href="egresados.html"><p>SOY EGRESADO DEL ITP</p></a>  -->
                    </div>
                    
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
