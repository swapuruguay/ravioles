<?php
require_once'config.php';
$mysqli = new mysqli('localhost', 'root','ws7', 'ravioles');
$sql = "SELECT * FROM ravioles WHERE fecha_evento = '" . FECHA . "' AND nro_lista = 'S'";
$result = $mysqli->query($sql);
$row = $result->fetch_object();

?>
<!Doctype html>
<html>
    <head>
        <title>Asignar de sobrantes</title>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/funciones_consultas.js"></script>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/bootstrap.min.css">
          <link rel="stylesheet" href="css/main.css">
        <script src="js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script>
        $(document).ready(function() {

          $('#formulario').submit(subir)

        })


        </script>
    </head>
    <body>
      <header>
        <div class="container">

          <h2>Asignar ravioles de sobrantes</h2>
        </div>
      </header>
      <div class="container">
        <p>&nbsp;</p>
        <div class="row">
          <div class="col col-sm-12 col-md-6">
            <form>
              <div class="form-group">
                <label for="verduras">Verdura</label>
                <input type="text" id="verduras" name="verduras" class="form-control" value="<?php echo $row->verdura ?>" disabled />
              </div>
              <div class="form-group">
                <label for="jyqs">Jamón y Queso</label>
                <input type="text" id="jyqs" name="jyqs" class="form-control" value="<?php echo $row->jyq ?>" disabled />
              </div>
              <div class="form-group">
                <label for="pollos">Pollo</label>
                <input type="text" id="pollos" name="pollos" class="form-control" value="<?php echo $row->pollo ?>" disabled />
              </div>
              <div class="form-group">
                <label for="ryls">Ricota y lomito</label>
                <input type="text" id="ryls" name="ryls" class="form-control" value="<?php echo $row->ryl ?>" disabled />
              </div>
              <a href="index.php" class="btn btn-primary">Volver</a>
            </form>
          </div>
          <div class="col col-sm-12 col-md-6">
            <form id="formulario">
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control" />
              </div>
              <div class="form-group">
                <label for="verdura">Verdura</label>
                <input type="text" id="verdura" name="verdura" class="form-control calculador" />
              </div>
              <div class="form-group">
                <label for="jyq">Jamón y Queso</label>
                <input type="text" id="jyq" name="jyq" class="form-control calculador" />
              </div>
              <div class="form-group">
                <label for="pollo">Pollo</label>
                <input type="text" id="pollo" name="pollo" class="form-control calculador" />
              </div>
              <div class="form-group">
                <label for="ryl">Ricota y lomito</label>
                <input type="text" id="ryl" name="ryl" class="form-control calculador" />
              </div>
              <div class="form-group">
                  <div class="col-sm-11">
                      <div class="checkbox">
                          <label>
                              <input type="checkbox" name="pago" id="pago"> Pag&oacute;
                          </label>
                      </div>
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-sm-11">
                      <div class="checkbox">
                          <label>
                              <input type="checkbox" name="entrega" id="entrega"> Entregado
                          </label>
                      </div>
                  </div>
              </div>
              <button class="btn btn-success" id="btn" type="submit">Guardar</button>
            </form>
          </div>
        </div>
        <div id="resultado"></div>
      </div>

      <script type="text/javascript">
        var escucha = $('.calculador')
        var cantidad = escucha.val()
        escucha.change(restar)
        function restar() {
         var objSobrante = $('#'+this.id+'s')
         var valor1 = $(this).val()
         var valor2 = objSobrante.val()
         objSobrante.val(valor2-valor1)

        }
        function subir(ev){
          ev.preventDefault()
          /*
          var verdura = $('#verdura').val()
          var jyq = $('#jyq').val()
          var ryl = $('#ryl').val()
          var pollo = $('#pollo').val()
          var nombre = $('#nombre').val()
          var data = 'nombre='+nombre+'&verdura='+verdura+'&jyq='+jyq+'&pollo='+pollo+'&ryl='+ryl
          */
          var formulario = document.getElementById('formulario')
          var postData = new FormData(formulario)
/*
          $.post('asignacion.php', data, function(res) {
            console.log(res.nombre)
          })*/

          $.ajax({
            url : "asignacion.php",
            type: "POST",
            data : postData,
            processData: false,
            contentType: false,
            success:function(data){
                  console.log(data)
            },
            error: function(jqXHR, textStatus, errorThrown){
              //if fails
          }
        })
      }

      </script>
    </body>
</html>
