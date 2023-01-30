<?php

function conectaDB(){

    $server = "localhost";
    $user = "jornadas";
    $pass = "Ev2022.Jor";
    $bd = "jornadas";


    $conecta = mysqli_connect($server, $user, $pass,$bd) 
        or die("Ha sucedido un error inexperado en la conexion de la base de datos");

    return $conecta;
} 




function disconnectDB($conecta){

    $close = mysqli_close($conecta) 
        or die("Ha sucedido un error inexperado en la desconexion de la base de datos");

    return $close;
}

?>