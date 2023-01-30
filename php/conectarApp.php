<?php
    //ESTE PHP ES LA CONEXION PUENTE ENTRE LA APP PARA CELULARES ANDROID Y LA BASE DE DATOS EN EL SERVIDOR DE JORNADAS
    error_reporting(0);
    include("conexion.php");
    $conexion = conectaDB();

    $entrada = $_POST["entrada"];
    $aluNum = $_POST["aluNum"];
    $clave = $_POST["clave"];
    $clavConf = "";

    if(!$conexion){
        echo "No se pudo conectar";
    }
    else{
        
        if($clave==""){
            echo "error";
        }
        else{
            if($clave=="Talleres"){
                $comprueba = "SELECT * FROM asistenciatall WHERE aluNum = '$aluNum'";
                $sql = mysqli_query($conexion, $comprueba);
                while($filas=mysqli_fetch_assoc($sql)){
                    $otro = $filas['entrada'];
                    $otro2 = $filas['salida'];
                    $otro3 = $filas['horasPresente'];
                    $otro4 = $filas['Dia4'];
                    $otro5 = $filas['Dia5'];
                }

                if($otro=="0000-00-00 00:00:00" or $otro==null){
                    $update = "UPDATE asistenciatall SET entrada = '$entrada' WHERE aluNum = '$aluNum'";
                    $resultado = mysqli_query($conexion, $update);

                    if($resultado){
                        echo "Registro correcto";
                    }
                }
                else{
                    if($otro2=="0000-00-00 00:00:00" or $otro2==null){
                        $update = "UPDATE asistenciatall SET salida = '$entrada' WHERE aluNum = '$aluNum'";
                        $resultado = mysqli_query($conexion, $update);
    
                        if($resultado){
                            echo "Registro correcto";
                        }
                    }
                    else{
                        if($otro3=="0000-00-00 00:00:00" or $otro3==null){
                            $update = "UPDATE asistenciatall SET horasPresente = '$entrada' WHERE aluNum = '$aluNum'";
                            $resultado = mysqli_query($conexion, $update);
        
                            if($resultado){
                                echo "Registro correcto";
                            }
                        }
                        else{
                            if($otr4=="0000-00-00 00:00:00" or $otro4==null){
                                $update = "UPDATE asistenciatall SET Dia4 = '$entrada' WHERE aluNum = '$aluNum'";
                                $resultado = mysqli_query($conexion, $update);
            
                                if($resultado){
                                    echo "Registro correcto";
                                }
                            }
                            else{
                                if($otro5=="0000-00-00 00:00:00" or $otro5==null){
                                    $update = "UPDATE asistenciatall SET Dia5 = '$entrada' WHERE aluNum = '$aluNum'";
                                    $resultado = mysqli_query($conexion, $update);
                
                                    if($resultado){
                                        echo "Registro correcto";
                                    }
                                }
                                else{
                                    echo "Dias completos";
                                }
                            }
                        }
                    }
                }
            }
            else{
                if($clave=="Conferencia 1"){
                    $clavConf = "Conf1";
                    $comprueba = "SELECT * FROM asistenciaconf WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                    $sql = mysqli_query($conexion, $comprueba);
                    while($filas=mysqli_fetch_assoc($sql)){
                        $otro = $filas['entrada'];
                    }
                    if($otro=="0000-00-00 00:00:00" or $otro==null){
                        $update = "UPDATE asistenciaconf SET entrada = '$entrada' WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                        $resultado = mysqli_query($conexion, $update);

                        if($resultado){
                            echo "Registro correcto";
                        }
                    }
                    else{
                        $clavConf = "Conf1";
                        $update = "UPDATE asistenciaconf SET salida = '$entrada' WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                        $resultado = mysqli_query($conexion, $update);

                        if($resultado){
                            echo "Registro correcto";
                        }
                    }
                }
                else{
                    if($clave=="Conferencia 2"){
                        $clavConf = "Conf2";
                        $comprueba = "SELECT * FROM asistenciaconf WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                        $sql = mysqli_query($conexion, $comprueba);
                        while($filas=mysqli_fetch_assoc($sql)){
                        $otro = $filas['entrada'];
                        }   
                        if($otro=="0000-00-00 00:00:00" or $otro==null){
                            $update = "UPDATE asistenciaconf SET entrada = '$entrada' WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                            $resultado = mysqli_query($conexion, $update);
    
                            if($resultado){
                                echo "Registro correcto";
                            }
                        }
                        else{
                            $clavConf = "Conf2";
                            $update = "UPDATE asistenciaconf SET salida = '$entrada' WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                            $resultado = mysqli_query($conexion, $update);
    
                            if($resultado){
                                echo "Registro correcto";
                            }
                        }
                    }
                    else
                    {
                        if($clave=="Conferencia 3"){
                            $clavConf = "Conf3";
                            $comprueba = "SELECT * FROM asistenciaconf WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                            $sql = mysqli_query($conexion, $comprueba);
                            while($filas=mysqli_fetch_assoc($sql)){
                            $otro = $filas['entrada'];
                            }
                            if($otro=="0000-00-00 00:00:00" or $otro==null){
                                $update = "UPDATE asistenciaconf SET entrada = '$entrada' WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                $resultado = mysqli_query($conexion, $update);
        
                                if($resultado){
                                    echo "Registro correcto";
                                }
                            }
                            else{
                                $clavConf = "Conf3";
                                $update = "UPDATE asistenciaconf SET salida = '$entrada' WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                $resultado = mysqli_query($conexion, $update);
        
                                if($resultado){
                                    echo "Registro correcto";
                                }
                            }
                        }
                        else
                        {
                            if($clave=="Conferencia 4"){
                                $clavConf = "Conf4";
                                $comprueba = "SELECT * FROM asistenciaconf WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                $sql = mysqli_query($conexion, $comprueba);
                                while($filas=mysqli_fetch_assoc($sql)){
                                    $otro = $filas['entrada'];
                                }
                                if($otro=="0000-00-00 00:00:00" or $otro==null){
                                    $update = "UPDATE asistenciaconf SET entrada = '$entrada' WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                    $resultado = mysqli_query($conexion, $update);
            
                                    if($resultado){
                                        echo "Registro correcto";
                                    }
                                }
                                else{
                                    $clavConf = "Conf4";
                                    $update = "UPDATE asistenciaconf SET salida = '$entrada' WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                    $resultado = mysqli_query($conexion, $update);
            
                                    if($resultado){
                                        echo "Registro correcto";
                                    }
                                }
                            }
                            else
                            {
                                if($clave=="Conferencia 5"){
                                    $clavConf = "Conf5";
                                    $comprueba = "SELECT * FROM asistenciaconf WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                    $sql = mysqli_query($conexion, $comprueba);
                                    while($filas=mysqli_fetch_assoc($sql)){
                                        $otro = $filas['entrada'];
                                    }
                                    if($otro=="0000-00-00 00:00:00" or $otro==null){
                                        $update = "UPDATE asistenciaconf SET entrada = '$entrada' WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                        $resultado = mysqli_query($conexion, $update);
                
                                        if($resultado){
                                            echo "Registro correcto";
                                        }
                                    }
                                    else{
                                        $clavConf = "Conf5";
                                        $update = "UPDATE asistenciaconf SET salida = '$entrada' WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                        $resultado = mysqli_query($conexion, $update);
                
                                        if($resultado){
                                            echo "Registro correcto";
                                        }
                                    }
                                }
                                else
                                {
                                    if($clave=="Conferencia 6"){
                                        $clavConf = "Conf6";
                                        $comprueba = "SELECT * FROM asistenciaconf WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                        $sql = mysqli_query($conexion, $comprueba);
                                        while($filas=mysqli_fetch_assoc($sql)){
                                            $otro = $filas['entrada'];
                                        }
                                        if($otro=="0000-00-00 00:00:00" or $otro==null){
                                            $update = "UPDATE asistenciaconf SET entrada = '$entrada' WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                            $resultado = mysqli_query($conexion, $update);
                    
                                            if($resultado){
                                                echo "Registro correcto";
                                            }
                                        }
                                        else{
                                            $clavConf = "Conf6";
                                            $update = "UPDATE asistenciaconf SET salida = '$entrada' WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                            $resultado = mysqli_query($conexion, $update);
                    
                                            if($resultado){
                                                echo "Registro correcto";
                                            }
                                        }
                                    }
                                    else
                                    {
                                        if($clave=="Conferencia 7"){
                                            $clavConf = "Conf7";
                                            $comprueba = "SELECT * FROM asistenciaconf WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                            $sql = mysqli_query($conexion, $comprueba);
                                            while($filas=mysqli_fetch_assoc($sql)){
                                                $otro = $filas['entrada'];
                                            }
                                            if($otro=="0000-00-00 00:00:00" or $otro==null){
                                                $update = "UPDATE asistenciaconf SET entrada = '$entrada' WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                                $resultado = mysqli_query($conexion, $update);
                        
                                                if($resultado){
                                                    echo "Registro correcto";
                                                }
                                            }
                                            else{
                                                $clavConf = "Conf7";
                                                $update = "UPDATE asistenciaconf SET salida = '$entrada' WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                                $resultado = mysqli_query($conexion, $update);
                        
                                                if($resultado){
                                                    echo "Registro correcto";
                                                }
                                            }
                                        }
                                        else
                                        {
                                            if($clave=="Conferencia 8"){
                                                $clavConf = "Conf8";
                                                $comprueba = "SELECT * FROM asistenciaconf WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                                $sql = mysqli_query($conexion, $comprueba);
                                                while($filas=mysqli_fetch_assoc($sql)){
                                                    $otro = $filas['entrada'];
                                                }
                                                if($otro=="0000-00-00 00:00:00" or $otro==null){
                                                    $update = "UPDATE asistenciaconf SET entrada = '$entrada' WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                                    $resultado = mysqli_query($conexion, $update);
                            
                                                    if($resultado){
                                                        echo "Registro correcto";
                                                    }
                                                }
                                                else{
                                                    $clavConf = "Conf8";
                                                    $update = "UPDATE asistenciaconf SET salida = '$entrada' WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                                    $resultado = mysqli_query($conexion, $update);
                            
                                                    if($resultado){
                                                        echo "Registro correcto";
                                                    }
                                                }
                                            }
                                            else
                                            {
                                                if($clave=="Conferencia 9"){
                                                    $clavConf = "Conf9";
                                                    $comprueba = "SELECT * FROM asistenciaconf WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                                    $sql = mysqli_query($conexion, $comprueba);
                                                    while($filas=mysqli_fetch_assoc($sql)){
                                                        $otro = $filas['entrada'];
                                                    }
                                                    if($otro=="0000-00-00 00:00:00" or $otro==null){
                                                        $update = "UPDATE asistenciaconf SET entrada = '$entrada' WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                                        $resultado = mysqli_query($conexion, $update);
                                
                                                        if($resultado){
                                                            echo "Registro correcto";
                                                        }
                                                    }
                                                    else{
                                                        $clavConf = "Conf9";
                                                        $update = "UPDATE asistenciaconf SET salida = '$entrada' WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                                        $resultado = mysqli_query($conexion, $update);
                                
                                                        if($resultado){
                                                            echo "Registro correcto";
                                                        }
                                                    }
                                                }
                                                else
                                                {
                                                    if($clave=="Conferencia 10"){
                                                        $clavConf = "Conf10";
                                                        $comprueba = "SELECT * FROM asistenciaconf WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                                        $sql = mysqli_query($conexion, $comprueba);
                                                        while($filas=mysqli_fetch_assoc($sql)){
                                                            $otro = $filas['entrada'];
                                                        }
                                                        if($otro=="0000-00-00 00:00:00" or $otro==null){
                                                            $update = "UPDATE asistenciaconf SET entrada = '$entrada' WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                                            $resultado = mysqli_query($conexion, $update);
                                    
                                                            if($resultado){
                                                                echo "Registro correcto";
                                                            }
                                                        }
                                                        else{
                                                            $clavConf = "Conf10";
                                                            $update = "UPDATE asistenciaconf SET salida = '$entrada' WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                                            $resultado = mysqli_query($conexion, $update);
                                    
                                                            if($resultado){
                                                                echo "Registro correcto";
                                                            }
                                                        }
                                                    }
                                                    else
                                                    {
                                                        if($clave=="Conferencia 11"){
                                                            $clavConf = "Conf11";
                                                            $comprueba = "SELECT * FROM asistenciaconf WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                                            $sql = mysqli_query($conexion, $comprueba);
                                                            while($filas=mysqli_fetch_assoc($sql)){
                                                                $otro = $filas['entrada'];
                                                            }
                                                            if($otro=="0000-00-00 00:00:00" or $otro==null){
                                                                $update = "UPDATE asistenciaconf SET entrada = '$entrada' WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                                                $resultado = mysqli_query($conexion, $update);
                                        
                                                                if($resultado){
                                                                    echo "Registro correcto";
                                                                }
                                                            }
                                                            else{
                                                                $clavConf = "Conf11";
                                                                $update = "UPDATE asistenciaconf SET salida = '$entrada' WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                                                $resultado = mysqli_query($conexion, $update);
                                        
                                                                if($resultado){
                                                                    echo "Registro correcto";
                                                                }
                                                            }
                                                        }
                                                        else
                                                        {
                                                            if($clave=="Conferencia 12"){
                                                                $clavConf = "Conf12";
                                                                $comprueba = "SELECT * FROM asistenciaconf WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                                                $sql = mysqli_query($conexion, $comprueba);
                                                                while($filas=mysqli_fetch_assoc($sql)){
                                                                    $otro = $filas['entrada'];
                                                                }
                                                                if($otro=="0000-00-00 00:00:00" or $otro==null){
                                                                    $update = "UPDATE asistenciaconf SET entrada = '$entrada' WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                                                    $resultado = mysqli_query($conexion, $update);
                                            
                                                                    if($resultado){
                                                                        echo "Registro correcto";
                                                                    }
                                                                }
                                                                else{
                                                                    $clavConf = "Conf12";
                                                                    $update = "UPDATE asistenciaconf SET salida = '$entrada' WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                                                    $resultado = mysqli_query($conexion, $update);
                                            
                                                                    if($resultado){
                                                                        echo "Registro correcto";
                                                                    }
                                                                }
                                                            }
                                                            else
                                                            {
                                                                if($clave=="Conferencia 13"){
                                                                    $clavConf = "Conf13";
                                                                    $comprueba = "SELECT * FROM asistenciaconf WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                                                    $sql = mysqli_query($conexion, $comprueba);
                                                                    while($filas=mysqli_fetch_assoc($sql)){
                                                                        $otro = $filas['entrada'];
                                                                    }
                                                                    if($otro=="0000-00-00 00:00:00" or $otro==null){
                                                                        $update = "UPDATE asistenciaconf SET entrada = '$entrada' WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                                                        $resultado = mysqli_query($conexion, $update);
                                                
                                                                        if($resultado){
                                                                            echo "Registro correcto";
                                                                        }
                                                                    }
                                                                    else{
                                                                        $clavConf = "Conf13";
                                                                        $update = "UPDATE asistenciaconf SET salida = '$entrada' WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                                                        $resultado = mysqli_query($conexion, $update);
                                                
                                                                        if($resultado){
                                                                            echo "Registro correcto";
                                                                        }
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                    if($clave=="Conferencia 14"){
                                                                        $clavConf = "Conf14";
                                                                        $comprueba = "SELECT * FROM asistenciaconf WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                                                        $sql = mysqli_query($conexion, $comprueba);
                                                                        while($filas=mysqli_fetch_assoc($sql)){
                                                                            $otro = $filas['entrada'];
                                                                        }
                                                                        if($otro=="0000-00-00 00:00:00" or $otro==null){
                                                                            $update = "UPDATE asistenciaconf SET entrada = '$entrada' WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                                                            $resultado = mysqli_query($conexion, $update);
                                                    
                                                                            if($resultado){
                                                                                echo "Registro correcto";
                                                                            }
                                                                        }
                                                                        else{
                                                                            $clavConf = "Conf14";
                                                                            $update = "UPDATE asistenciaconf SET salida = '$entrada' WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                                                            $resultado = mysqli_query($conexion, $update);
                                                    
                                                                            if($resultado){
                                                                                echo "Registro correcto";
                                                                            }
                                                                        }
                                                                    }
                                                                    else
                                                                    if($clave=="Conferencia 15"){
                                                                        $clavConf = "Conf15";
                                                                        $comprueba = "SELECT * FROM asistenciaconf WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                                                        $sql = mysqli_query($conexion, $comprueba);
                                                                        while($filas=mysqli_fetch_assoc($sql)){
                                                                            $otro = $filas['entrada'];
                                                                        }
                                                                        if($otro=="0000-00-00 00:00:00" or $otro==null){
                                                                            $update = "UPDATE asistenciaconf SET entrada = '$entrada' WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                                                            $resultado = mysqli_query($conexion, $update);
                                                    
                                                                            if($resultado){
                                                                                echo "Registro correcto";
                                                                            }
                                                                        }
                                                                        else{
                                                                            $clavConf = "Conf15";
                                                                            $update = "UPDATE asistenciaconf SET salida = '$entrada' WHERE aluNum = '$aluNum' AND conCla = '$clavConf'";
                                                                            $resultado = mysqli_query($conexion, $update);
                                                    
                                                                            if($resultado){
                                                                                echo "Registro correcto";
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }  
    }
?>