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
        <div class="contenidoSombra1">


            
                <table>
                    <thead>
                        <tr>
                            <th>Conferencias</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Del Big Data a las Ciencias de Datos</td>
                            <td>Dr. José Luis Zechinelli Martin</td>
                        </tr>
                        <tr>
                            <td><br></td>
                            <td><br></td>
                        </tr>
                        <tr>
                            <td>Un mundo SMART</td>
                            <td>Dra. Zobeida Jazabel Guzmán Zavaleta</td>
                        </tr>
                        <tr>
                            <td><br></td>
                            <td><br></td>
                        </tr>
                        <tr>
                            <td>Detección automática de arritmias en señales <br> NI-FECG a partir de aprendizaje computacional</td>
                            <td>Ing. Sócrates Romero Reyes</td>
                        </tr>
                        <tr>
                            <td><br></td>
                            <td><br></td>
                        </tr>
                        <tr>
                            <td>Top Amenazas al ciberespacio 2022 según ENISA</td>
                            <td>M. G. C. Fernando Conislla Murgia</td>
                        </tr>
                        <tr>
                            <td><br></td>
                            <td><br></td>
                        </tr>
                        
                        <tr>
                            <td>Derecho Informático</td>
                            <td>Lic. Mónica Tépox Pérez</td>
                        </tr>
                        <tr>
                            <td><br></td>
                            <td><br></td>
                        </tr>
                        
                        <tr>
                            <td>Gestión  de procesos y esándares de desarrollo de software</td>
                            <td>Ing. Irelia Toro Hernández</td>
                        </tr>
                        <tr>
                            <td><br></td>
                            <td><br></td>
                        </tr>


                        <tr>
                            <td>Modelos de negocios basados en tecnología</td>
                            <td>M. A. P. Y M. E. Gerardo Sánchez Meneses</td>
                        </tr>
                        <tr>
                            <td><br></td>
                            <td><br></td>
                        </tr>



                        <tr>
                            <td>¿Qué sucede cuándo un ingeniero de Software se encarga de las operaciones?<br> SRE (Site Reliability Engineering) experiencia laboral en Alemania</td>
                            <td>Ing. Luis Enrique Méndez Cantero</td>
                        </tr>
                        <tr>
                            <td><br></td>
                            <td><br></td>
                        </tr>



                        <tr>
                            <td>Una triste vida sin DevOPs</td>
                            <td>Ing. Carlos Amin Espinoza</td>
                        </tr>
                        <tr>
                            <td><br></td>
                            <td><br></td>
                        </tr>

                        <tr>
                            <td>RE</td>
                            <td>M. D. C. Manuel Enrique Mauleón Yáñez</td>
                        </tr>
                        
                    </tbody>
                </table>
<!--
                <table>
                    <thead>
                        <tr>
                            <th>Talleres</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tall1</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>Tall2</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>Tall3</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>Tall 4</td>
                            <td>-</td>
                        </tr>
                        
                        <tr>
                            <td>Tall 4</td>
                            <td>-</td>
                        </tr>
                        
                        <tr>
                            <td>Tall 4</td>
                            <td>-</td>
                        </tr>


                        <tr>
                            <td>Tall 4</td>
                            <td>-</td>
                        </tr>



                        <tr>
                            <td>Tall 4</td>
                            <td>-</td>
                        </tr>



                        <tr>
                            <td>Tall 4</td>
                            <td>-</td>
                        </tr>

                        <tr>
                            <td>Tall 4</td>
                            <td>-</td>
                        </tr>
                        
                    </tbody>
                </table>-->
            </div> 


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