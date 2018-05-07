<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 require_once 'config.php';
$fecha1 = strtotime($_POST['fecha']);
$fecha = date('Y-m-d',$fecha1);
$condicion = '';
$alcance =  $_POST['alcance'];

if($alcance == 'p') {
  $condicion = " AND nro_lista LIKE 'P%' ";
} elseif ($alcance == 'c') {
  $condicion = " AND nro_lista NOT LIKE 'P%' ";
}

$link = mysqli_connect(HOST,USER,PASS, DBNAME);
$sql = "SELECT sum(jyq) as jamon, sum(verdura) as verdura, sum(pollo) as pollo,".
        " SUM(ryl) as ricota FROM ravioles WHERE fecha_evento='". $fecha."'".$condicion;

$result = mysqli_query($link, $sql);
if($row = mysqli_fetch_object($result)) {
    echo "Total Verdura: ".$row->verdura."<br>";
    echo "Total Jam&oacute;n y queso: ".$row->jamon."<br>";
    echo "Total Pollo: ".$row->pollo."<br>";
    echo "Total Ricota y lomito: ".$row->ricota."<br>";
    $total = $row->verdura+$row->jamon+$row->pollo+$row->ricota;
    echo "Total General == " . $total . "<br>";
    $costoTotal = (int) ($row->verdura * COSTOS['verdura'] + $row->jamon * COSTOS['jyq']  + $row->pollo * COSTOS['pollo'] + $row->ricota * COSTOS['ryl'])/100;
    $bruto = $total * VALOR/100;
    $ganancia = $bruto - $costoTotal;
    echo " Costo total == " . $costoTotal ."<br>";
    echo "Total Ganancia == " . $ganancia."<br>";

}
$sql = "SELECT (sum(jyq) + sum(verdura) + sum(pollo) + SUM(ryl)) as total FROM ravioles WHERE fecha_evento='". $fecha."' and pago=1";

$result = mysqli_query($link, $sql);
if($row = mysqli_fetch_object($result)) {
    echo "Total Cobrado: ".(int)($row->total * VALOR/100)."<br>";

}
//echo $sql;
