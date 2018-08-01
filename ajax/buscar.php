<?php
require_once '../config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$opcion = $_POST['opcion'];
$nro = $_POST['nro'];
$link = mysqli_connect(HOST, USER, PASS, DBNAME);
switch($opcion) {
    case "listar":
        $sql = "SELECT * FROM ravioles WHERE nro_lista = '" . $nro . "' and fecha_evento= '".FECHA."'";
        $result = mysqli_query($link, $sql);
        echo "<div class='col-md-12'>";
        echo "<table class='table table-bordered table-condensed table-striped table-responsive'><tr><th>Nombre</th><th>Verdura</th><th>JYQ</th><th>Pollo</th>".
                "<th>RYL</th><th>Valor $</th><th>Pag&oacute;</th><th>Entregado</th></tr>";
        $verdura = 0;
        $cobrarVerdura = 0;
        $jyq = 0;
        $cobrarJyq = 0;
        $pollo = 0;
        $cobrarPollo = 0;
        $ryl = 0;
        $cobrarRyl = 0;
        

        while($fila = mysqli_fetch_object($result)) {
            echo "<tr>";
            echo "<td><a href='".BASE_URL."edicion/".$fila->id_ingreso."'>".
                  $fila->nombre. "</a></td><td>" . $fila->verdura . "</td><td>" . $fila->jyq . "</td>" .
                    "<td>".$fila->pollo."</td><td>".$fila->ryl."</td><td>".(($fila->verdura+$fila->jyq+$fila->pollo+$fila->ryl)*VALOR/100) ."</td><td><input class='pagado' id='pag_$fila->id_ingreso' type='checkbox'".(($fila->pago==1)?"checked":"")."></td>".
                    "<td><input class='entregado' id='ent_$fila->id_ingreso' type='checkbox'".(($fila->entregado==1)?"checked":"")."></td>";
            echo "</tr>";
            $verdura+= $fila->verdura;
            $jyq+= $fila->jyq;
            $pollo+= $fila->pollo;
            $ryl+= $fila->ryl;
            $cobrarVerdura += ($fila->pago == 0)?$fila->verdura : 0;
            $cobrarJyq += ($fila->pago == 0)?$fila->jyq : 0;
            $cobrarPollo += ($fila->pago == 0)?$fila->pollo : 0;
            $cobrarRyl += ($fila->pago == 0)?$fila->ryl : 0;
        }
        echo "<tr><td>Totales:</td><td>".$verdura."</td><td>".$jyq."</td>".
                "<td>".$pollo."</td><td>".$ryl."</td><td><td></td></td></tr>";

        $total = $verdura+$jyq+$pollo+$ryl;
        $cobrar = $cobrarJyq + $cobrarPollo + $cobrarRyl + $cobrarVerdura;
        echo "</table>";
        echo "</div>";
        echo "</div>";
        echo "<div class='col-md-5'>";
        echo "<p style='font-weight: bold;'>TOTAL LISTA: ".$total."</p>";
        echo "<p style='font-weight: bold;'>Por Cobrar: <span id='por-cobrar'>". (int)($cobrar*1.2) ."</span></p>";
        echo "</div>";
        break;
}
