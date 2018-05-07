<?php
  require_once 'config.php';

// function detect()
// {
// 	$browser=array("IE","OPERA","MOZILLA","NETSCAPE","FIREFOX","SAFARI","CHROME");
// 	$os=array("WIN","MAC","LINUX");
//
// 	# definimos unos valores por defecto para el navegador y el sistema operativo
// 	$info['browser'] = "OTHER";
// 	$info['os'] = "OTHER";
//
// 	# buscamos el navegador con su sistema operativo
// 	foreach($browser as $parent)
// 	{
// 		$s = strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $parent);
// 		$f = $s + strlen($parent);
// 		$version = substr($_SERVER['HTTP_USER_AGENT'], $f, 15);
// 		$version = preg_replace('/[^0-9,.]/','',$version);
// 		if ($s)
// 		{
// 			$info['browser'] = $parent;
// 			$info['version'] = $version;
// 		}
// 	}
//
// 	# obtenemos el sistema operativo
// 	foreach($os as $val)
// 	{
// 		if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']),$val)!==false)
// 			$info['os'] = $val;
// 	}
//
// 	# devolvemos el array de valores
// 	return $info;
// }
$id= $_GET['id'];
$link = mysqli_connect(HOST, USER, PASS, DBNAME);
$sql = "SELECT * FROM ravioles WHERE id_ingreso=".$id;
//echo $sql;
$result = mysqli_query($link, $sql);
$nombre='';
$jyq=0;
$verdura=0;
$ryl=0;
$pollo=0;
$lista='';
$pago=false;
$entrega=false;
$row = mysqli_fetch_object($result);
$nombre = $row->nombre;
$verdura= $row->verdura;
$jyq= $row->jyq;
$pollo= $row->pollo;
$ryl= $row->ryl;
$lista=$row->nro_lista;
$fecha = $row->fecha_evento;
$pago =($row->pago==1)?true:false;
$entrega = ($row->entregado==1)?true:false;
//$info = detect();

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

        <?php
            // if($info['browser']=="FIREFOX") {
            //     $fecha = date('d-m-Y',  strtotime($fecha));
            // }
        ?>
        <div class="container">
        <br>
            <form id="form1" class="form-horizontal">
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>"/>
                <div class="form-group">
                    <label for="fecha" class="conrol-label col-sm-1">Fecha Venta</label>
                    <div class="col-sm-2">
                        <input id="fecha" name="fecha" type="date" value="<?php  echo $fecha; ?>" class="form-control" />
                    </div>
                </div>
                 <div class="form-group">
                    <label for="nombre" class="conrol-label col-sm-1">Nombre</label>
                    <div class="col-sm-3">
                        <input id="nombre" name="nombre" type="text" value="<?php echo $nombre; ?>" class="form-control" />
                    </div>
                 </div>
                 <div class="form-group">
                    <label for="lista" class="conrol-label col-sm-1">Nro.Lista</label>
                    <div class="col-sm-1">
                        <input id="lista" name="lista" type="text" value="<?php echo $lista; ?>" class="form-control" />
                    </div>
                 </div>
                <div class="form-group">
                    <label class="control-label col-sm-1">Verdura</label>
                    <div class="col-sm-1">
                        <input id="verdura" name="verdura" type="text" value="<?php echo $verdura; ?>" class="form-control" />
                    </div>
                    <label class="control-label col-sm-1">Jam&oacute;n y queso</label>
                    <div class="col-sm-1">
                        <input id="jyq" name="jyq" type="text" value="<?php echo $jyq; ?>" class=form-control />
                    </div>
                    <label class="control-label col-sm-1">Pollo</label>
                    <div class="col-sm-1">
                        <input id="pollo" name="pollo" type="text" value="<?php echo $pollo; ?>" class=form-control />
                    </div>
                    <label class="control-label col-sm-1">Ricota y lomito</label>
                    <div class="col-sm-1">
                        <input id="ryl" name="ryl" type="text" value="<?php echo $ryl; ?>" class=form-control />
                    </div>
                </div>

                <label>Pag&oacute;?</label> <input id="pago" name="pago" type="checkbox" <?php echo ($pago)? 'CHECKED':''; ?> />
                <label>Entregado?</label><input id="entrega" name="entrega" type="checkbox" <?php echo ($entrega)?'CHECKED':''; ?> /><br><br>
                <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-2">
                <a class="btn btn-success btn-block" id="guardar" href="#">Guardar</a>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-2">
                    <a href="#" class="btn btn-danger btn-block" id="eliminar">Eliminar</a>

                </div>
                <div class="col-sm-12 col-md-6 col-lg-2">
                    <a href="../find.php" class="btn btn-default btn-block">Volver</a>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-2">
                    <a href="../buscar/<?php echo $lista; ?>" class="btn btn-default btn-block">Volver a buscar lista</a>
                </div>

                </div>
            </form>
        </div>
        <div id="resultado" ></div>
    </body>
</html>
