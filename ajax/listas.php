<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../config.php';
$operacion = $_POST['op'];
$id = $_POST['id'];
$chk = $_POST['chk'];
$link = mysqli_connect(HOST, USER, PASS, DBNAME);
switch($operacion) {
    case 'entrega':
         $val = 0;
        if($chk == 'true') {
            $val = 1;
        } else {
            $val = 0;
        }
        $sql = "UPDATE ravioles SET entregado=$val WHERE id_ingreso = '" . $id . "'";
        $result = mysqli_query($link, $sql);
        $valor = array('entregado' => 'ok');
         break;

    case 'pago':
        $val = 0;
        if($chk == 'true') {
            $val = 1;
        } else {
            $val = 0;
        }
        $sql = "UPDATE ravioles SET pago=$val WHERE id_ingreso = '" . $id . "'";
        $result = mysqli_query($link, $sql);
        $sql = "SELECT verdura+jyq+pollo+ryl as tot FROM ravioles WHERE id_ingreso = " .$id;
        $importe = 0;
        $consul = mysqli_query($link, $sql);
        $result = $consul->fetch_object();
        $valor = array('pagado' => 'ok',
          'importe' => $result->tot,
          'precio' => VALOR/100
        );
        echo json_encode($valor);
        break;
}
?>
