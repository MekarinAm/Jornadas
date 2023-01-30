<?php

    
   
    require 'qr/qrlib.php';
    include ("../php/extrInfoEg.php");

    //en el caso de guardar en un carpeta localmente
    $dir = 'temp/';

    

    //en el caso de no existior la carpeta local, este if la creara
    if(!file_exists($dir)){
        mkdir($dir);
    }

    //nombre del archivo png con el qr
    $filename = $dir.'test.png';
    //tamaño del png que se creara
    $tamanio = 8;
    //tipo de precision del codigo qr
    $level = 'H';
    //el borde que tendra el qr en blanco
    $frameSize = 3;
    //lo que contendra el qr
    $contenido = $clave;

    QRcode::png($contenido, $filename, $level ,$tamanio, $frameSize);
    //GUARDAMOS EL QR DENTRO DE UNA VARIABLE PARA LLAMARLA POSTERIORMENTE
    $qrfin ='<img src="'.$filename.'"/>';

    
    
    
    
?>

