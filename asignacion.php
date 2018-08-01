<?php
    require_once'config.php';
    $mysqli = new mysqli(HOST, USER,PASS, DBNAME);
    $sql = "INSERT INTO ravioles (nombre, verdura, jyq, pollo, ryl, pago, entregado, fecha_evento, nro_lista) VALUES(";
    $pago = 0;
    if(isset($_POST['pago'])) {
      $pago = 1;
    }
    $entregado = 0;
    if(isset($_POST['entrega'])) {
      $entregado = 1;
    }
    $verdura = 0;
    $jyq = 0;
    $ryl = 0;
    $pollo = 0;
    if($_POST['verdura'] != "")
      $verdura = $_POST['verdura'];

    if($_POST['jyq'] != "")
      $jyq = $_POST['jyq'];

    if($_POST['pollo'] != "")
      $pollo = $_POST['pollo'];

    if($_POST['ryl'] != "")
      $ryl = $_POST['ryl'];

    $sql .= "'".$_POST['nombre']. "',".$verdura.",".$jyq.",".$pollo.",".$ryl.",".$pago.",".$entregado.",'". FECHA . "','SA')";

    $result = $mysqli->query($sql);

    $sql = "UPDATE ravioles SET verdura = verdura - ".$verdura.", jyq = jyq - ".$jyq.", pollo = pollo - ".$pollo.", ryl = ryl - ".$ryl." WHERE nro_lista = 'S' AND fecha_evento = '".FECHA."'";
    $result =  $mysqli->query($sql);
    //$row = $result->fetch_object();

    echo $sql;

  ?>
