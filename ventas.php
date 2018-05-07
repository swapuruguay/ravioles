<?php

require_once 'config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$texto = $_POST['dato'];
$link = mysqli_connect(HOST, USER, PASS, DBNAME);
$sql = "SELECT id_ingreso,ravioles.nombre,ravioles.nro_lista as nro_lista, vendedores.nombre as vnombre, vendedores.apellido as vapellido FROM ravioles"
        . " JOIN vendedores ON vendedores.nro_lista = ravioles.nro_lista WHERE ravioles.nombre like '%".utf8_encode($texto)."%' AND fecha_evento ='".FECHA."' ORDER BY nombre";
//echo $sql;
$result = mysqli_query($link, $sql);
if($result) {
  while($row = mysqli_fetch_object($result)) {
    echo "<p>".$row->nombre."  =>". $row->nro_lista ." => <span style='color:red;'>Vendedor: " . $row->vnombre . ' ' . $row->vapellido. " </span><a href='edicion/".$row->id_ingreso."' class='enlace'>Ver</a></p>";
  }

}
