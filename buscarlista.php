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

        </form>
        <br>
        <a href="index.php" class="btn btn-default">Volver</a>
        <div id="resultado"  style="color: #OOOOOO; width: 500px; font-size: 0.8em; margin-top: 10px;"></div>
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
                $("#resultado").html('<p><img src="img/ajax.gif" /></p>');
                   $.ajax({
                           type:'POST',
                           data: dato,
                           url: 'ajax/buscar.php',
                           success: res => {
                             $("#resultado").html(res)
                           }
                       });

            })
        </script>
    </body>
</html>
