<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 require_once 'config.php';
$fecha1 = strtotime($_POST['fecha']);
$fecha = date('Y-m-d',$fecha1);
// $condicion = '';
// $alcance =  $_POST['alcance'];
//
// if($alcance == 'p') {
//   $condicion = " AND nro_lista LIKE 'P%' ";
// } elseif ($alcance == 'c') {
//   $condicion = " AND nro_lista NOT LIKE 'P%' ";
// }

$link = mysqli_connect(HOST,USER,PASS, DBNAME);

$sql = "SELECT v.nombre, v.apellido, r.nro_lista, (SUM(verdura) + sum(jyq) + sum(pollo) + sum(ryl)) as total from ravioles r join vendedores v on v.nro_lista = r.nro_lista"
      ." where fecha_evento = '". $fecha ."' AND r.nro_lista not like 'P%'  group by nro_lista order by total desc limit 3";
$result = mysqli_query($link, $sql);
$contador = 1;
echo "<div class='container'>";
echo "<table class='table table-condensed table-striped'>";
echo "<tr><th>Vendedor</th><th>Total</th><th>Puesto</th></tr>";
while($row = mysqli_fetch_object($result)) {
  echo '<tr id="'.$row->nro_lista.'"><td>'. $row->nombre . ' ' . $row->apellido . '</td><td>' . $row->total . '</td><td><img src="img/medalla'.$contador. '.png"></td></tr>';
  $contador++;
}
echo "</table";
echo "</div>";

//echo $sql;
