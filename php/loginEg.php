<?php
    //detectamos si existe una sesion iniciada y en caso de que si lo direccionamos al index.php
    session_start();
    if(isset($_SESSION['identificadorUsuario']))
    {
        header("location:/php/indexEg.php");
    }


    //Incluimos la funcion de conexion a la base de datos 

    
    include("conexion.php");
    $conexion = conectaDB();
    $ncontrol = $_POST['numControl'];
    //SI NO HAY CAMPOS VACIOS
    
    $sqlalumno = "SELECT * FROM egresado WHERE numControl='$ncontrol'";//consulta para saber si el correo existe en la base de datos
    $resultado = mysqli_query($conexion,$sqlalumno); //resultado de la consulta tabla alumno
    $nm_filas = mysqli_num_rows($resultado);//cuenta el num de filas encontradas
    //SI SE ENCONTRO UN REGISTRO
    if($nm_filas>0){
        
        $_SESSION['identificadorUsuario']=$ncontrol;
        sleep(1);
        header("location:/php/indexEg.php");

    }else{
        //SI NO SE ENCONTRO NINGUNA FILA
        if($nm_filas==0){
            //EL CORREO NO ESTA REGISTRADO EN LA BASE DE DATOS Y CERRAMOS CONEXION
            $mensajeError='<div style="color:red;">ÉSTE NÚMERO DE CONTROL NO ESTÁ REGISTRADO O ES INCORRECTO INTENTA DE NUEVO O CREA UNA CUENTA</div>';
            disconnectDB($conexion);
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
            <!--<a href="index.html">Inicio</a>-->
            <!--<a href="paquetes.html">Paquetes</a>-->
            <!--<a href="registro.html">Registro</a>-->
        </nav>
    </div>

   

    <main class="contenedor sombra">
        <section>
           

            <form action="/php/loginEg.php" method="post" class="formulario">
                <fieldset>
                    <!--<legend>Jornadas TIC's</legend>-->
                    <p>INICIAR SESION</p>
                    
                        
                    <?php echo $mensajeError; ?>
                            
        

                    <div class="contenedor-campos">
                        <div class="campo">
                            <input class="input-text" name="numControl" type="text" placeholder="Ingresa Tu Numero de Control">
                        </div>
                    </div> <!-- .contenedor-campos -->
                

                    <input type="submit" value="INICIAR SESIÓN">
                    
                    <a class="botonRegistro" href="../egresados.html">crear cuenta</a>
                    <div class="olvidar">
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

