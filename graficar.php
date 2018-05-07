<?php

  require_once 'config.php';

  $fecha1 = strtotime($_POST['fecha']);
  $fecha = date('Y-m-d',$fecha1);
  $mysqli = new mysqli(HOST, USER, PASS, DBNAME);
  $sql = "SELECT MONTH(fecha_evento) AS fecha, SUM(verdura) AS verdura, SUM(jyq) as jyq, SUM(pollo) AS pollo, SUM(ryl) AS ryl FROM ravioles WHERE
          fecha_evento ='" . $fecha . "'  GROUP BY MONTH(fecha_evento)";
  $result = $mysqli->query($sql);
  $retorno = [];
  $dataPoint = [];
  $meses = [];
  $meses[0] = 'Enero';
  $meses[1] = 'Febrero';
  $meses[2] = 'Marzo';
  $meses[3] = 'Abril';
  $meses[4] = 'Mayo';
  $meses[5] = 'Junio';
  $meses[6] = 'Julio';
  $meses[7] = 'Agosto';
  $meses[8] = 'Setiembre';
  $meses[9] = 'Octubre';
  $meses[10] = 'Noviembre';
  $meses[11] = 'Diciembre';
  while($fila = $result->fetch_object()){
    $dataPoint[0] = array(
        'label' => 'verdura',
        'y' => (int) $fila->verdura
    );
    $dataPoint[1] = array(
        'label' => 'jyq',
        'y' => (int) $fila->jyq
    );
    $dataPoint[2] = array(
      'label' => 'pollo',
      'y' => (int) $fila->pollo
    );
    $dataPoint[3] = array(
      'label' => 'ryl',
      'y' => (int) $fila->ryl
    );
    $retorno[] = array(
      'type' => "pie",
      'name' => $meses[$fila->fecha-1],
      'showInLegend' => true,
      'toolTipContent' => "{y} - #percent %",
      'yValueFormatString' => '#,##0.# Unidades',
      'dataPoints' => $dataPoint
    );
  }

  echo json_encode($retorno);

?>
