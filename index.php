<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>

        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/funciones.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/bootstrap.min.css">
          <link rel="stylesheet" href="css/main.css">
        <script src="js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    </head>
    <body>
      <header>
        <center><h1 class="success">Venta de Ravioles <small>Colegio Mar&iacute;a Auxiliadora</small></h1></center>
      </header>
      <br>
        <div class="container">
            <section class="row">

              <aside class="col-md-2">
                <div class="btn-toolbar">
                  <div class="btn-group-vertical">
                    <a href="find.php" class="btn btn-primary">Consultar compras</a>
                    <a href="buscarlista.php" class="btn btn-success">Consultar una lista</a>
                    <a href="buscarpendientes.php" class="btn btn-primary">Consultar pendientes</a>
                    <a href="buscarimpagos.php" class="btn btn-warning">Consultar impagos</a>
                    <a href="asignar.php" class="btn <btn-danger></btn-danger>">Asignar de Sobrantes</a>
                    <a href="#" id="consulta" name="consulta" class="btn btn-success">Consultar paquetes 200</a>
                    <a href="#" id="total-cole" class="btn btn-primary" onclick="totales('c')">Total Colegio</a>
                    <a href="#" id="total-parroquia" class="btn btn-success" onclick="totales('p')">Total Parroquia</a>
                    <a id="totales" href="#" class="btn btn-primary" onclick="totales('t')">Total Gral.</a>
                    <a href="#" class="btn btn-success" onclick="ranking()">Ranking Vendedores</a>
                    <a href="#" class="btn btn-info" onclick="generar()">Ver Gráficas</a>

                  </div>

                </div>
                <br><br>

              </aside>
            <article class="col-md-10">
            <form id="form1" class="form-horizontal">
                <div class="form-group">
                    <label for="fechaf" class="control-label col-sm-1">Fecha</label>
                    <div class="col-sm-4">
                        <input type="date" id="fechaf" name="fechaf" class="form-control" placeholder="dd-mm-aaaa" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="lista" class="control-label col-sm-1">Lista</label>
                    <div class="col-sm-4">
                        <input type="text" id="lista" name="lista" class="form-control" />
                    </div>
                </div>
                 <div class="form-group">
                    <label for="nombre" class="control-label col-sm-1">Nombre</label>
                    <div class="col-sm-6">
                        <input type="text" id="nombre" name="nombre" class="form-control" />
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-sm-1" for="verdura">Verdura</label>
                    <div class="col-sm-2">
                        <input type="text" id="verdura" name="verdura" class="form-control"/>
                    </div>
                    <label class="control-label col-sm-1" for="jyq">Jam&oacute;n y queso</label>
                    <div class="col-sm-2">
                        <input type="text" id="jyq" name="jyq" class="form-control"/>
                    </div>
                    <label class="control-label col-sm-1" for="pollo">Pollo</label>
                    <div class="col-sm-2">
                        <input type="text" id="pollo" name="pollo" class="form-control"/>
                    </div>
                    <label class="control-label col-sm-1" for="ryl">Ricota y lomito</label>
                    <div class="col-sm-2">
                        <input type="text" id="ryl" name="ryl" class="form-control"/>
                    </div>
                 </div>
                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-11">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="pago" id="pago"> Pag&oacute;
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-11">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="entrega" id="entrega"> Entregado
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" value="Ingresar" id="boton" name="boton" class="btn btn-primary"/>
                </div>
                <div class="form-group">
                    <input type="reset" value="limpiar" class="btn btn-default" />
                </div>
            </form>

                <label>Fecha de venta: </label><input type="date" id="fecha" name="fecha" placeholder="dd-mm-aaaa" />
            </article>
              </section>
        </div>


        <div id="resultado" style="margin:10px;"></div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

        <script>
          let formulario = document.getElementById('form1')
          form1.addEventListener('submit', evt => {
            evt.preventDefault()
            $("#resultado").html('<p><img src="img/ajax.gif" /></p>');
            let formData = new FormData(formulario)
            formData.append('operacion', 'ingreso')
            formData.append('pago', (formulario.pago.value) ? 1 : 0)
            $.ajax({
              url:'ingreso.php',
              data: formData,
              contentType: false,
              processData: false,
              type:'POST',
              success: (res) => {
                document.getElementById('resultado').innerHTML = res
                form1.nombre.value = ''
                form1.verdura.value = ''
                form1.jyq.value = ''
                form1.pollo.value = ''
                form1.ryl.value = ''
                form1.nombre.focus()
              }
            })
          })

          async function generar() {
            let formData = new FormData()
            let fecha = document.getElementById('fecha').value
            formData.append('fecha', fecha)
            let respuesta = await fetch('graficar.php', {
                method: 'post',
                // headers: {
                //     'Accept': 'application/json',
                //     'Content-Type': 'application/json'
                // },
                body: formData
              })
              let response = await respuesta.json()
              graficar(response)
          }

          function graficar(data) {
            //   let obj = {
            //     exportEnabled: true,
            //     animationEnabled: true,
            //     title:{
            //         text: "Venta de Ravioles"
            //     },
            //     axisX: {
            //         title: "Fechas"
            //     },
            //     axisY: {
            //         title: "Cantidad de ravioles",
            //         titleFontColor: "#4F81BC",
            //         lineColor: "#4F81BC",
            //         labelFontColor: "#4F81BC",
            //         tickColor: "#4F81BC"
            //     },
            //     toolTip: {
            //         shared: true
            //     },
            //     legend: {
            //         cursor: "pointer"
            //         //itemclick: toggleDataSeries
            //     },
            //     data
            // }
            // const chart = new CanvasJS.Chart("resultado", obj);
            // console.log(obj)
            // chart.render();
            var chart = new CanvasJS.Chart("resultado",
            	{
            		theme: "theme2",
            		title:{
            			text: "Venta de ravioles"
            		},
                data
            		// data: [
            		// {
            		// 	type: "pie",
            		// 	showInLegend: true,
            		// 	toolTipContent: "{y} - #percent %",
            		// 	yValueFormatString: "#,##0,,.## Million",
            		// 	legendText: "{indexLabel}",
                //   data
            		// 	dataPoints: [
            		// 		{  y: 4181563, indexLabel: "Verdura" },
            		// 		{  y: 2175498, indexLabel: "JYQ" },
            		// 		{  y: 3125844, indexLabel: "Pollo" },
            		// 		{  y: 1176121, indexLabel: "RYL"}
                //
            		// 	]
            		// }
            		// ]
            	});
            	chart.render();

          }

          function totales(alcance) {
            var fecha = $("#fecha").val();
            var dato="fecha="+fecha+"&alcance="+alcance;

            $("#resultado").html('<p><img src="img/ajax.gif" /></p>');
            $.ajax({
              url:'totales.php',
              data: dato,
              type:'POST',
              success: escribe
            });
          }

          function ranking() {
            var fecha = $("#fecha").val();
            var dato="fecha="+fecha
            $("#resultado").html('<p><img src="img/ajax.gif" /></p>');
            $.ajax({
              url:'ranking.php',
              data: dato,
              type:'POST',
              success: (res) => {
                console.log(res)
                $('#resultado').html(res);
              }
            });
          }

        </script>
    </body>
</html>
