<?php
    error_reporting(0);
    include ("../codigo_qr/qrGene.php");

    if($estatus!='Pagado')
    {
        echo '<script>alert("UNA VEZ ACREDITADO TU PAGO PODRAS VER TU BOLETO");
            window.history.go(-1);</script>';
    }elseif($estatus=='Pagado'){
        header("location:/php/ticket.php");
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
?>
