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

        if(isset ($_POST['inicio'])){
        
            header("location:/php/indexEg.php");
        }
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
        <title>Editar Informacion</title>
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
            
            
        </nav>
    </div>

   
    
    <main class="contenedor sombra">
        
    <h2>ESCRIBE TU INFORMACION CORRECTAMENTE</h2>
            
    
        <form name="form" action="/php/actEg.php" method="post" class="formulario" >
            
        
            <table>
                    <thead>
                        <tr>
                            <th></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="hidden" name="numControl" value="<?php echo $ncontrol; ?>"></td>
                        </tr>
                        <tr>
                            <td>NOMBRE</td>
                            <td><input type="text" name="nombre" value="<?php echo $nombre; ?>"></td>
                        </tr>
                        <tr>
                            <td>APELLIDO PATERNO</td>
                            <td><input type="text" name="aPat" value="<?php echo $app; ?>"></td>
                        </tr>
                        <tr>
                            <td>APELLIDO MATERNO</td>
                            <td><input type="text" name="aMat" value="<?php echo $apm; ?>"></td>
                        </tr>
                       
                        <tr>
                            <td>TELEFONO</td>
                            <td><input type="text" name="telCe" value="<?php echo $numcel; ?>"></td>
                        </tr>
                        <tr>
                            <td>CORREO</td>
                            <td><input type="text" name="correo" value="<?php echo $correo; ?>"></td>
                        </tr>
                        <tr>
                            <td>Año de Ingreso</td>
                            <td><input type="text" name="aIngreso" value="<?php echo $ingreso; ?>"></td>
                        </tr>

                        <tr>
                            <td>Año de Egreso</td>
                            <td><input type="text" name="aEgreso" value="<?php echo $egreso; ?>"></td>
                        </tr>

                        <tr>
                            <td>Empresa</td>
                            <td><input type="text" name="empresa" value="<?php echo $empresa; ?>"></td>
                        </tr>


                        <tr>
                            <td>Puesto</td>
                            <td><input type="text" name="puesto" value="<?php echo $puesto; ?>"></td>
                        </tr>


                        <tr>
                            <td>Año En que te titulaste</td>
                            <td><input type="text" name="titulacion" value="<?php echo $titulo; ?>"></td>
                        </tr>
                    </tbody>
            </table>
                            
           

            
        

                            <br><input type="submit" name="enviarRegistro" id="enviarReg" value="ENVIAR">
                

            
            
        </form>
        
    


    </div>

    

        
        
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