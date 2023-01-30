<?php
    session_start();
    error_reporting(0);
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
        <title>Confirmacion</title>
        <link rel="preload" href="/css/styles.css" as="style">
        <link href="/css/styles.css" rel="stylesheet">
    </head>
    
        
   
    <body>
        <script src="js/funciones.js"></script>
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
            <div class="TyC4">
                <section class="tallconf">
                    <h2>Paquete de solo Conferencias</h2>
                    <p>Del Lunes 17 al Viernes 21 de octubre de 2022 asiste a las conferencias impartidas por ponentes de diferentes áreas de TIC'S,
                         quienes vendrán a 
                        compartir con nosotros un poco de su experiencia en un horario de 9:00 am a 13:30 pm.

                        
                    </p>
                
                </section>
                
                <section  class="f1">
                    <form action="/php/finPagoCo.php" method="post" class="formulario1" >
                        
                        
                        <div class="campo-switch">
                            <p>Deseo el credito complementario:</p>
                            <input type="checkbox" id="switch" value=".5" name="credito">
                            <label for="switch" class="lbl" value=".5" name="credito"></label>
                        </div>
                        
                    
                        <input type="submit" name="enviarRegistro" id="enviarReg" value="ENVIAR" class="botonConf">
                    </form>
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