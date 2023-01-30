<?php
    //NOS ASEGURAMOS DE QUE SOLO SE PUEDA ACCEDER A ESTA PESTAÑA SI LA SESION ESTA INICIADA
    session_start();
    if(isset($_SESSION['identificadorUsuario']))
    {

        include("conexion.php");
        $conexion = conectaDB();
        //guardamos el nombre del usuario en una variable
        $nombreUsuarioIngresado=$_SESSION['identificadorUsuario'];


        //SE HACE EL QUERY DE BUSQUEDA CON LA SENTENCIA COUNT PARA CONTAR EL NUMERO DE FILAS QUE CUMPLAN CON LA CONDICION 
        $cuenta = "SELECT count(concepto) AS 'TOTAL' FROM pago WHERE concepto='Conferencia'";
        $resultado = mysqli_query($conexion,$cuenta);
        //SE CUENTAN LAS FILAS ENCONTRADAS DENTRO DEL WHILE Y SE ALMACENAN EN UNA VARIABLE PARA SER LLAMADA POSTERIORMENTE EN EL HTML
        while($filas=mysqli_fetch_assoc($resultado)){
            $salidaCompleto=$filas['TOTAL'];
        }


        //SE HACE EL QUERY DE BUSQUEDA CON LA SENTENCIA COUNT PARA CONTAR EL NUMERO DE FILAS QUE CUMPLAN CON LA CONDICION 
        $cuenta2 = "SELECT count(concepto) AS 'TOTAL2' FROM pago WHERE concepto='Completo'";
        $resultado2 = mysqli_query($conexion,$cuenta2);
        //SE CUENTAN LAS FILAS ENCONTRADAS DENTRO DEL WHILE Y SE ALMACENAN EN UNA VARIABLE PARA SER LLAMADA POSTERIORMENTE EN EL HTML
        while($filas2=mysqli_fetch_assoc($resultado2)){
            $salidaCompleto2=$filas2['TOTAL2'];
        }

        //SUMAMOS EL NUMERO DE PAQUETES DE CONFERENCIA MAS EL NUMERO DE PAQUETES COMPLETOS (QUE INCLUYEN CONFERENCIA) PARA CALCULAR SI SE 
        //ALCANZO EL CUPO ESTABLECIDO
        $suma= $salidaCompleto+$salidaCompleto2;

        //la suma debe de daro 150 pues es el total de cupos para conferencias


        if($suma>=170){
            echo '<script>alert("LO SENTIMOS SE ALCANZO EL CUPO MAXIMO TE RECOMENDAMOS COMPRAR OTRO PAQUETE");
            window.history.go(-1);</script>';
        }else{
            header("location:/php/confirPagoConf.php");
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