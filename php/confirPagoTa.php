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
    <script src="/js/funciones.js"></script>
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
        <div class="TyC5">
            <section class="tallconf">
                <h2>Paquete de solo Talleres</h2>
                <p>Elige uno de los 7 talleres disponibles con un valor de UN (1) credito complementario el cual sera otorgado al finalizar las jornadas
                    Deberas aprobar el taller elegido para tener derecho al credito.  
                </p>
                <br>
                <br>
                <p>
                
                    <div style="color:red;">SELECCIONA BIEN EL TALLER QUE QUIERES TOMAR, YA QUE NO HABRA CAMBIOS DESPUES</div>
                    
                </p>
            
            </section>
        </div> 

       
            
            
            <section  class="f1">
                <form action="/php/finPagoTa.php" method="post" class="formulario1" >
                    <div class="TyC4">
                        <section class="tallconf">
                            <h2>PROGRAMACION EN JAVA</h2>
                            <p>
                                Impartido por M.S,C. JOSE OMAR RAMIREZ MARTHA<br>
                                Aprender y practicar los conceptos básicos de la programación en Java, empleando Apache
                                NetBeans.<br>
                                Introducción a Java.                                                                
                                Conceptos Básicos java.                                                      
                                Operadores Java.                                                   
                                Sentencias de control.                                      
                                Clase String.                                                   
                                Arreglos en Java.


                            </p>
                        </section>
                        
                        <!--
                        

                        <div class="tallconf">
                            <h2 style="color:red;">CUPO COMPLETO</h2>
                        </div>
                        -->
                        <div class="campo-switch">
                            <input type="checkbox" id="switch1" value="Tall1" class="switch1" name="taller" onclick="c1();">
                            <label for="switch1" class="lbl" value="1" name="taller"></label>
                        </div>
                        
                        
                        

                        <section class="tallconf">
                            <h2>CIBERSEGURIDAD</h2>
                            <p>
                                Impartido por M.C JOSE PABLO DE JESUS CARMONA VENTURA <br>
                                Los asistentes al taller aprenderán a reconocer los activos que puedes ser vulnerados a 
                                través de una red de comunicaciones, los medios (redes informáticas) a través de las cuales 
                                esos activos (datos) pueden ser atacados, las consecuencias de un ataque y en general como 
                                incrementar la protección de dichos activos.
                            
                            </p>
                        
                        </section>
                        <!--

                        <div class="tallconf">
                            <h2 style="color:red;">CUPO COMPLETO</h2>
                        </div>
                        
                        -->
                        

                        <div class="campo-switch">
                            <input type="checkbox" id="switch2" value="Tall2" class="switch2" name="taller" onclick="c2();">
                            <label for="switch2" class="lbl" value="1" name="taller"></label>
                        </div>
                        


                        <section class="tallconf">
                            <h2>Deep Learning</h2>
                            <p>Impartido por  Ing. JOSÉ ANDRÉS ALCÁNTARA ALONSO <br>
                            A lo largo de este taller sobre Inteligencia Artificial y Deep Learning presentaré, 
                            desde un nivel muy básico y al alcance de todo tipo de perfiles, los fundamentos teóricos 
                            y matemáticos que se necesitan para comprender en detalle el funcionamiento de los algoritmos 
                            de Deep Learning y las librerías con un enfoque que mejores resultados me ha proporcionado al 
                            impartir este tipo de clases en diferentes universidades, un enfoque práctico
                            
                            </p>
                        
                        </section>
                        <!--
                            <div class="tallconf">
                            <h2 style="color:red;">CUPO COMPLETO</h2>
                            </div>
                        
                        -->
                        

                        <div class="campo-switch">
                            <input type="checkbox" id="switch3" value="Tall3" class="switch3" name="taller" onclick="c3();">
                            <label for="switch3" class="lbl" value="1" name="taller"></label>
                        </div>
                        

                        <section class="tallconf">
                            <h2>Fibra Óptica</h2>
                            <p>Impartido por  Ing. JORGE CARLOS TORRES MARTÍNEZ <br>
                            Al finalizar el curso el alumno y/o participante aprender el principio de funcionamiento de la luz 
                            a través del hilo de fibra óptica, aprender a elegir y diferenciar los tipos de fibra óptica y cables 
                            para el interior acorde a los requerimientos técnicos de su instalación. Conocerá los diferentes 
                            elementos y espacios de telecomunicaciones que forman una red de fibra óptica. Se realizará la terminación 
                            de los hilos de fibra óptica con un método de conectorizacion por fusión de fibra óptica, aplicando las 
                            técnicas adecuadas y buenas prácticas de instalación apegado a lo descrito en estándares nacionales e 
                            internacionales, se realizará la comprobación del desempeño del enlace punto a punto de fibra óptica con 
                            medición de primer nivel utilizando fuente de luz y probador fluke link runner
                            
                            </p>
                        
                        </section>
                        <!--

                        <div class="tallconf">
                            <h2 style="color:red;">CUPO COMPLETO</h2>
                        </div>
                        -->

                        <div class="campo-switch">
                            <input type="checkbox" id="switch4" value="Tall4" class="switch4" name="taller" onclick="c4();">
                            <label for="switch4" class="lbl" value="1" name="taller"></label>
                        </div>
                        
                        
                        
                        
                        <section class="tallconf">
                            <h2>Kali Linux</h2>
                            <p>Impartido por  Ing. NICOLÁS SÁNCHEZ SÁNCHEZ<br>
                            Este taller esta diseñado para cualquier persona que quiera iniciarse en el mundo del Hacking
                             y la Ciberseguridad comenzando desde un nivel muy básico, y avanzando a medida que se realiza 
                             en el taller hasta niveles avanzados, en los que se muestran técnicas como la manipulación de 
                             tráfico de red en tiempo real o técnicas de Machine Learning aplicadas a Hacking, los conocimientos 
                             necesarios para realizar una Auditoría de seguridad o Hacking Ético a una organización y descubrir 
                             diferentes fallos de seguridad.
                            
                            </p>
                        
                        </section>
                        
                        <!--
                            <div class="campo-switch">
                            <input type="checkbox" id="switch5" value="Tall5" class="switch5" name="taller" onclick="c5();">
                            <label for="switch5" class="lbl" value="1" name="taller"></label>
                            <div class="tallconf">
                            <h2 style="color:red;">CUPO COMPLETO</h2>
                        </div>
                        </div>-->
                        <div class="campo-switch">
                            <input type="checkbox" id="switch5" value="Tall5" class="switch5" name="taller" onclick="c5();">
                            <label for="switch5" class="lbl" value="1" name="taller"></label>
                        </div>
                        

                        <section class="tallconf">
                            <h2>Análisis de Datos y Analítica Predictiva</h2>
                            <p>Impartido por  Lic. ALBA JOSELIN MORALES CARRASCO <br>
                                Aprender el lenguaje de programación Phyton usando Notebooks de Google Colab,
                                asi como las librerias como Numpy y Pandas.<br>
                                Comprender técnicas de análisis exploratorio de datos para procesar
                                información, analizarla y presentarla usando las herramientas de visualización.<br>
                                Aprender cómo construir modelos de analitica predictiva aplicada a problemas de regresión.<br>
                                Introducción a Google Colab. Fundamentos de Phyton. Numpy y Pandas. Procesamiento de datos. herramientas
                                de visualización. Métricas de un modelo de regresión. Modelos de regresión.
                            </p>
                            </p>
                        
                        </section>
                        <!--
                            

                            <div class="tallconf">
                            <h2 style="color:red;">CUPO COMPLETO</h2>
                            </div>
                        </div> -->

                            <div class="campo-switch">
                            <input type="checkbox" id="switch6" value="Tall6" class="switch6" name="taller" onclick="c6();">
                            <label for="switch6" class="lbl" value="1" name="taller"></label>
                            </div>
                        
                        
                        

                        <section class="tallconf">
                            <h2>La informática sus fundamentos, tecnologías y aplicaciones.</h2>
                            <p>
                                Impartido por  Ing. CRISTIAN ROJAS SALINAS<br>
                                Virtualización de servidores, máquinas en la nube e hipervisores.              
                                Expectativa y realidad. Desarrollo mobile, APIS, desarrollo web.            
                                Alta dirección. Investigadores e industriales, fundamentales para el desarrollo.          
                                Informática. Sus fundamentos, tecnologías y aplicaciones.      
                                Fronteras de la IA. Sistemas evolutivos, afectivos y consientes.

                            
                            </p>
                        
                        </section>
                        <!--
                         <div class="tallconf">
                            <h2 style="color:red;">CUPO COMPLETO</h2>
                        </div>
                        -->
                        
                        <div class="campo-switch">
                            <input type="checkbox" id="switch7" value="Tall7" class="switch7" name="taller" onclick="c7();">
                            <label for="switch7" class="lbl" value="1" name="taller"></label>
                        </div>
                        
                        
                    </div>  
                    
                    <div class="campo-switch2">
                        <p>Deseo el credito (1) complementario:</p>
                        <input type="checkbox" id="switch" value="1" name="credito">
                        <label for="switch" class="lbl" value="1" name="credito"></label>
                    </div>
                    <div style="color:red;">PARA OBTENER EL CREDITO DE ESTE PAQUETE DEBERAS APROBAR EL TALLER CON LA CALIFICACION MINIMA DE 70</div>
                    <input type="submit" name="enviarRegistro" id="enviarReg" value="ENVIAR" class="botonConf">
                </form>
            </section>
         

    </main>
                

    <footer>
        <p>Instituto Tecnológico de Puebla<br> &copy Todos los Derechos Reservados<br>
            Av. Tecnológico 420 Col. Maravillas. Puebla, Pue. C.P. 72220<br>
            Tels. 222 2298868 y 57
        </p>
    </footer>
</body>


</html>