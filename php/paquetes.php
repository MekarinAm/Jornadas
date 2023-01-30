<?php
    //NOS ASEGURAMOS DE QUE SOLO SE PUEDA ACCEDER A ESTA PESTAÑA SI LA SESION ESTA INICIADA
    session_start();
    if(isset($_SESSION['identificadorUsuario']))
    {

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
                $numc = $row['numControl'];
            }
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





        
    }else{
        header("location:/registro.html");
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

            <h2><span class="color-acento">Nuestros paquetes</span></h2>
            <div class="TyC2">
                <section id="paquetes">
                    <div class="container">
                        
                        
                            <div class="carta">
                                <h3>Solo conferencias</h3>
                                <h3>Costo: $150</h3>
                                <p>Con este paquete podrá entrar a todas las conferencias impartidas
                                por los ponentes y tener derecho a obtener un medio crédito
                                complementario para su liberación de créditos en caso de que lo 
                                requiera.

                                </p>
                                <h2 href="#" style="color:red;">CUPO COMPLETO</h2>
                                <!--<a class="boton" href="/php/verificaConferencias.php">Seleccionar</a>-->
                            </div>
                        
                    </div>
                </section>

                <section id="paquetes">
                    <div class="container">
                            <div class="carta">
                                <h3>Solo talleres</h3>
                                <h3>Costo: $200</h3>
                                <p>
                                Con este paquete podrá tomar uno de los talleres que se imparten 
                                    después de las conferencias y tener derecho a un crédito complementario
                                    para la liberación de créditos complementarios en caso de ser requerido

                                </p>
                                <h2 href="#" style="color:red;">CUPO COMPLETO</h2>
                                <!--<a class="boton" href="/php/confirPagoTa.php">Seleccionar</a>-->
                            </div>
                    </div>
                </section>

                <section id="paquetes">
                    <div class="container">
                            <div class="carta">
                                <h3>Paquete completo</h3>
                                <h3>Costo: $300</h3>
                                <p>
                                Con este paquete podrá tener el acceso completo a todas las conferencias 
                                    expuestas, así como el acceso a tomar uno de los talleres
                                    a elección de los que serán impartidos y tener derecho a un crédito y medio
                                    complementario <!--para la liberación de créditos complementarios en caso de ser
                                    requerido-->

                                </p>
                                <h2 href="#" style="color:red;">CUPO COMPLETO</h2>
                                <!--<a class="boton" href="/php/verificaCompleto.php">Seleccionar</a>-->
                            </div>
                        
                    </div>
                </section>

            </div>
        </main>
        <footer>
            <p>Instituto Tecnológico de Puebla<br> &copy Todos los Derechos Reservados<br>
                Av. Tecnológico 420 Col. Maravillas. Puebla, Pue. C.P. 72220<br>
                Tels. 222 2298868 y 57
            </p>
        </footer>


    
    </body>
</html>