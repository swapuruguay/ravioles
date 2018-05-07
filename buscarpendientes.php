<?php
require_once 'config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$link = mysqli_connect('localhost', 'walter','ws7', 'ravioles');
$sql = "SELECT id_ingreso,ravioles.nombre, ravioles.nro_lista as lista, (verdura+jyq+pollo+ryl) as tot, CONCAT(vendedores.nombre, ' ', vendedores.apellido) AS vendedor
         FROM ravioles JOIN vendedores ON vendedores.nro_lista = ravioles.nro_lista
         WHERE entregado = 0 and ravioles.nro_lista  NOT LIKE 'P%' AND fecha_evento='" .FECHA."' order by ravioles.nro_lista, ravioles.nombre";
//$sql = "SELECT * FROM ravioles where fecha_evento='" . $fecha . "'";
$totalPendiente = 0;
$result = mysqli_query($link, $sql);

?>
<!Doctype html>
<html>
    <head>
        <title>Consultar</title>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/funciones_consultas.js"></script>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/bootstrap.min.css">
          <link rel="stylesheet" href="css/main.css">
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
    <header>
        <h2>Ravioles entregados pendientes de pago</h2>
    </header>
    <div class="container">

        <table class="table table-condensed table-striped">
            <th>Nombre</th>
            <th>Nro de Lista</th>
            <th>Vendido por</th>
            <th>Importe</th>
            <?php while($row= mysqli_fetch_object($result)): ?>
            <tr>
                <td><a href="edicion/<?php echo $row->id_ingreso ?>"><?php echo $row->nombre; ?></a></td>
                <td><?php echo $row->lista ?></td>
                <td><?php echo $row->vendedor ?></td>
                <td><?php echo ($row->tot * VALOR /100) ?></td>
                <?php
                    $totalPendiente+= ($row->tot * VALOR /100);
                ?>
            </tr>
            <?php endwhile ?>
            <tr>
                <td colspan="3">Total:</td>
                <td><?php echo $totalPendiente ?></td>
            </tr>
        </table>
        <a href="index.php" class="btn btn-default">Volver</a>
        </div>
    </body>
</html>
