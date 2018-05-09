<?php

require_once 'config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$nro = $_GET['nro'];
$link = mysqli_connect(HOST, USER, PASS, DBNAME);
$sql = "SELECT * FROM ravioles WHERE nro_lista = '" . $nro . "' and fecha_evento= '".FECHA."'";
$result = mysqli_query($link, $sql);
$verdura = 0;
$cobrarVerdura = 0;
$jyq = 0;
$cobrarJyq = 0;
$pollo = 0;
$cobrarPollo = 0;
$ryl = 0;
$cobrarRyl = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
        <script src="../js/jquery.js"></script>
        <script src="../js/funciones_edicion.js"></script>
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
          <link rel="stylesheet" href="../css/main.css">
        <script src="../js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body>
<header>
    <h2>Buscar una lista</h2>
</header>
<div class="container">
    <form class="form-inline" id="form">
            <input type="search" id="casilla" name="casilla" placeholder="Ingresar nro de lista" class="form-control" />
            <input type="submit" id="boton_busqueda" name="boton_busqueda" value="Buscar" class="btn btn-primary" />
        </form>
        <br>
        <a href="../index.php" class="btn btn-default">Volver</a>
        <div id="resultado"  style="color: #OOOOOO; width: 500px; font-size: 0.8em; margin-top: 10px;">
          <div class="col-md-12">
            <table class="table table-bordered table-condensed table-striped"><tr><th>Nombre</th><th>Verdura</th><th>JYQ</th><th>Pollo</th>
                     <th>RYL</th><th>Valor $</th><th>Pag&oacute;</th><th>Entregado</th></tr>

             <?php while($fila = mysqli_fetch_object($result)): ?>
                 <tr>
                     <td><a href="../edicion/<?php echo $fila->id_ingreso?>"><?php echo $fila->nombre ?></a></td>
                     <td><?php echo $fila->verdura ?></td><td><?php echo $fila->jyq ?></td>
                     <td><?php echo $fila->pollo ?></td><td><?php echo $fila->ryl ?></td>
                     <td><?php echo ($fila->verdura+$fila->jyq+$fila->pollo+$fila->ryl)*VALOR/100 ?></td>
                     <td><input type="checkbox" class='pagado' id='<?php echo "pag_".$fila->id_ingreso ?>' type='checkbox' <?php echo ($fila->pago==1)? 'checked': ''  ?> ></td>
                     <td><input class='entregado' id='<?php echo "ent_".$fila->id_ingreso?>' type="checkbox" <?php echo ($fila->entregado==1)? 'checked': ''  ?> ></td>
                </tr>
                 <?php
                 $verdura+= $fila->verdura;
                 $cobrarVerdura += ($fila->pago == 0)?$fila->verdura : 0;
                 $cobrarJyq += ($fila->pago == 0)?$fila->jyq : 0;
                 $cobrarPollo += ($fila->pago == 0)?$fila->pollo : 0;
                 $cobrarRyl += ($fila->pago == 0)?$fila->ryl : 0;
                 $jyq+= $fila->jyq;
                 $pollo+= $fila->pollo;
                 $ryl+= $fila->ryl;
                 ?>


              <?php endwhile; ?>
                <tr>
                 <td>Totales:</td>
                 <td><?php echo $verdura ?></td>
                 <td><?php echo $jyq ?></td>
                 <td><?php echo $pollo ?></td>
                 <td><?php echo $ryl ?></td>
                 <td></td>
             </tr>
             </table>
          </div>

    <?php $total = $verdura+$jyq+$pollo+$ryl; ?>
    <?php $cobrar = $cobrarJyq + $cobrarPollo + $cobrarRyl + $cobrarVerdura; ?>

    <div class="col-md-5">
      <p style='font-weight: bold;'>TOTAL LISTA: <?php echo $total ?></p>
      <p style='font-weight: bold;'>Por cobrar: <span id="por-cobrar"><?php echo (int)($cobrar * 1.2) ?></span></p>
    </div>

     </div>
     </div>
     <script>
       const form = document.getElementById('form')
       form.addEventListener('submit', evt => {
             evt.preventDefault()
             var nro = $('#casilla').val();
             var dato = '';
             dato = "opcion=listar&nro="+nro;
             var pathname = window.location.host;
             //console.log(pathname)
             $("#resultado").html('<p><img src="http://'+window.location.host+'/img/ajax.gif" /></p>');
                $.ajax({
                        type:'POST',
                        data: dato,
                        url: 'http://'+window.location.host+'/ajax/buscar.php',
                        success: res => {
                          $("#resultado").html(res)
                        }
                    });

         })
     </script>

</body>
</html>
