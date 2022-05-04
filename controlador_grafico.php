<?php
    require 'modelograf.php';
    $MG = new modelo_graf();
    $consulta = $MG -> TraerDatos();
    echo json_encode($consulta);
?>