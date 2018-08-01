<?php
 if(isset($_GET['nro'])) {
     $lista = $_GET['nro'];

 }
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
        <h2>Buscar una lista</h2>
    </header>
    <div class="container">
        <form id="form" class="form-inline">
            <input type="search" id="casilla" name="casilla" placeholder="Ingresar nro de lista" class="form-control" />
            <input type="submit" id="boton_busqueda" name="boton_busqueda" value="Buscar" class="btn btn-primary" />
            <input type="button" name="borrar" value="Borrar Calculadora" onclick=ce()>
            <input type="text" id="calculadora" name="calculadora">
            <input class="btn btn-info" type="button"  id="marcarP" name="marcarP" value="Marcar Todos Pagados" onclick="pagarTodos()">
            <input class="btn btn-success" type="button" id="marcarE" name="marcarE" value="Marcar Todos Entregados" onclick="entregarTodos()">
        </form>
        <br>
        <a href="index.php" class="btn btn-default">Volver</a>
        <div id="resultado"  style="color: #OOOOOO; width: 500px; font-size: 0.8em; margin-top: 10px;"></div>

        </div>
        <script>
          const form = document.getElementById('form')
          form.addEventListener('submit', evt => {
                evt.preventDefault()
                listar()

            })
            function ce() {
              document.getElementById('calculadora').value = 0
            }

            function pagarTodos() {
              let lista = document.getElementById('casilla').value
              let estado = 0
              if(document.getElementById('marcarP').value == 'Marcar Todos Pagados') {
                estado = 1
                document.getElementById('marcarP').value = 'Marcar Todos Impagos'
              } else {
                estado = 0
                document.getElementById('marcarP').value = 'Marcar Todos Pagados'
              }

              let datos = `op=todosP&lista=${lista}&val=${estado}`
              //$("#resultado").html('<p><img src="img/ajax.gif" /></p>');
                 $.ajax({
                         type:'POST',
                         data: datos,
                         url: 'ajax/listas.php',
                         success: res => {
                           console.log(res)
                           listar()

                         }
                     });


            }

            function listar() {
              var nro = $('#casilla').val();
              var dato = '';
              dato = "opcion=listar&nro="+nro;
              var pathname = window.location.host;
              //console.log(pathname)
              $("#resultado").html('<p><img src="img/ajax.gif" /></p>');
                 $.ajax({
                         type:'POST',
                         data: dato,
                         url: 'ajax/buscar.php',
                         success: res => {
                           $("#resultado").html(res)
                         }
                     });
            }

            function entregarTodos() {
              let lista = document.getElementById('casilla').value
              let estado = 0
              if(document.getElementById('marcarE').value == 'Marcar Todos Entregados') {
                estado = 1
                document.getElementById('marcarE').value = 'Marcar Todos Sin Entregar'
              } else {
                estado = 0
                document.getElementById('marcarE').value = 'Marcar Todos Entregados'
              }

              let datos = `op=todosE&lista=${lista}&val=${estado}`
              //$("#resultado").html('<p><img src="img/ajax.gif" /></p>');
                 $.ajax({
                         type:'POST',
                         data: datos,
                         url: 'ajax/listas.php',
                         success: res => {
                           console.log(res)
                           listar()

                         }
                     });
            }
        </script>
    </body>
</html>
