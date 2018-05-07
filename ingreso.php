<?php

require_once 'config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$link = mysqli_connect(HOST, USER, PASS, DBNAME);
$opcion = $_POST['operacion'];
switch ($opcion) {
    case "ingresar":
        $nombre = $_POST['nombre'];
        $verdura = $_POST['verdura'];
        $jyq = $_POST['jyq'];
        $pollo = $_POST['pollo'];
        $ryl = $_POST['ryl'];
        $fecha1 = strtotime($_POST['fechaf']);
        $fecha = date('Y-m-d',$fecha1);
        $pago = $_POST['pago'];
        $entrega = $_POST['entrega'];
        $lista = $_POST['lista'];



        $sql = "INSERT INTO ravioles (nombre, verdura, jyq, pollo, ryl,fecha_evento,pago, entregado,nro_lista) VALUES('".
                $nombre . "','".$verdura ."','".$jyq."','".$pollo."','".$ryl."','".$fecha.
                "','".$pago."','".$entrega."','".$lista."')";
        //echo $sql;

        if(mysqli_query($link, $sql)){
            echo "Ingreso correcto<br>";
            $sql= "SELECT * FROM ravioles WHERE fecha_evento = '".FECHA."' order by id_ingreso DESC limit 0,5";
            $result = mysqli_query($link, $sql);

            echo "&Uacute;ltimos ingresos:<br>";
            while($fila = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                echo "nombre:<a href='edicion/".$fila['id_ingreso']."'>".$fila['nombre']. "</a> => " .($fila['verdura']?" Verdura:".$fila['verdura']:"").
                        ($fila['jyq']?"===J Y Q:" .$fila['jyq']:"").
                        ($fila['pollo']?"===Pollo:" .$fila['pollo']:"").
                        ($fila['ryl']?"===R y L:" .$fila['ryl']:"")."<br>";
            }

        }

        break;
    case "eliminar":
        $id = $_POST['id'];
        $sql = "DELETE FROM ravioles WHERE id_ingreso=".$id;
        //echo $sql;
        if(mysqli_query($link,$sql)) {
            echo "Registro eliminado";
        }
        break;
    case "editar":
        $id = $_POST['id'];
        $verdura = $_POST['verdura'];
        $jyq = $_POST['jyq'];
        $pollo = $_POST['pollo'];
        $ryl = $_POST['ryl'];
        $fecha1 = strtotime($_POST['fechaf']);
        $fecha = date('Y-m-d',$fecha1);
        $pago = $_POST['pago'];
        $entrega = $_POST['entrega'];
        $lista = $_POST['lista'];
        $nombre = $_POST['nombre'];
        $sql = "UPDATE ravioles SET nombre = '$nombre', verdura=".$verdura.",jyq=".$jyq.",pollo=".$pollo.
                ",ryl=".$ryl.",pago=".$pago.",entregado=".$entrega." WHERE ".
               "id_ingreso=".$id;
        //echo $sql;
        if(mysqli_query($link, $sql)) {
            echo "Registro modificado";
        }
        break;
}
