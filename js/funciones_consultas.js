
$(document).ready(carga);

function carga() {
    $("#search").keyup(consultar);
    $(":input:first").focus();
    $("#resultado").on("click", ".entregado", function(){
	var nombre = ($(this).attr('id'))
        var id = nombre.split("_")
        id= id[1];
        var check = $(this).prop('checked')
        $.post('ajax/listas.php','id='+id+'&op=entrega&chk='+check,
            function(respuesta){console.log(respuesta)},'json');
        //console.log($(this).prop('checked'))
    });

    $("#resultado").on("click", ".pagado", function(){
	var nombre = ($(this).attr('id'))
        var id = nombre.split("_")
        id= id[1];
        var check = $(this).prop('checked')

        $.post('ajax/listas.php','id='+id+'&op=pago&chk='+check,
        function(respuesta){
          var pc = $('#por-cobrar')
          let valor = pc.html()
          if(check) {
            valor = parseInt(valor)- parseInt(respuesta.importe * respuesta.precio)
          } else {
            valor = parseInt(valor) + parseInt(respuesta.importe * respuesta.precio)
          }
          console.log(respuesta)
            pc.html(valor)
        },'json');

        //console.log($(this).prop('checked'))
    });
}


function escribe(respuesta) {
    $("#busqueda").html(respuesta);
}

function consultar() {
    var texto = $("#search").val();
    var dato;
    if(texto !== "") {
        dato="dato="+texto;
       $("#busqueda").css('display','block');
       $("#resultado").html('<p><img src="img/ajax.gif" /></p>');
       $.ajax({
               type:'POST',
               data: dato,
               url: 'ventas.php',
               success: escribe
           });

   }
    else {
        $("#busqueda").css('display','none');
        $("#busqueda").html('');
    }

}

function buscaLista() {

    var nro = $('#casilla').val();
    var dato = '';
    dato = "opcion=listar&nro="+nro;
    var pathname = window.location.host;
    console.log(pathname)
    $("#resultado").html('<p><img src="img/ajax.gif" /></p>');
       $.ajax({
               type:'POST',
               data: dato,
               url: 'ajax/buscar.php',
               success: escriber
           });

}

function escriber(respuesta) {
    $("#resultado").html(respuesta);
}
