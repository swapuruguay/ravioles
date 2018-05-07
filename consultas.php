<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 require_once 'config.php';


$link = mysqli_connect(HOST, USER, PASS, DBNAME);
$fecha='';

$fecha1 = strtotime($_POST['fecha']);
$fecha = date('Y-m-d',$fecha1);
$sql = "SELECT * FROM ravioles where fecha_evento='" . $fecha . "'";
//$sql = "SELECT SUM(verdura) as verdura, SUM(jyq) as jyq, SUM(pollo) as pollo, SUM(ryl) as ryl FROM ravioles WHERE fecha_evento = '" . $fecha . "'";
$verdura=[
  0 => 0,
  1=> 0
];
$jyq=[
  0 => 0,
  1=> 0
];
$pollo=[
  0 => 0,
  1=> 0
];
$ryl=[
  0 => 0,
  1=> 0
];


$result = mysqli_query($link, $sql);
while($row = mysqli_fetch_object($result)) {
    $verdura[0]+=floor($row->verdura/200);
    $verdura[1]+= ($row->verdura - floor($row->verdura /200 ) * 200) / 100;
    $jyq[0]+=floor($row->jyq/200);
    $jyq[1]+= ($row->jyq - floor($row->jyq /200 ) * 200) / 100;
    $pollo[0]+=floor($row->pollo/200);
    $pollo[1]+= ($row->pollo - floor($row->pollo /200 ) * 200) / 100;
    $ryl[0]+=floor($row->ryl/200);
    $ryl[1]+= ($row->ryl - floor($row->ryl /200 ) * 200) / 100;
}



echo "Verdura 200 x ".$verdura[0]." <==> 100 x " . $verdura[1] ."<br>";
echo "Jam&oacute;n y queso 200 x ".$jyq[0]." <==> 100 x " . $jyq[1] ."<br>";
echo "Pollo 200 x ". $pollo[0]." <==> 100 x " . $pollo[1] ."<br>";
echo "Ricota y lomito 200 x ". $ryl[0]." <==> 100 x " . $ryl[1] ."<br>";
