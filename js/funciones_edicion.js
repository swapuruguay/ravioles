/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(carga);

function carga() {
    $("#guardar").click(guarda);
    $("#eliminar").click(elimina);
    $("#boton_busqueda").click(buscaLista);
    $("#resultado").on("click", ".entregado", function(){
    var nombre = ($(this).attr('id'))
        var id = nombre.split("_")
        id= id[1];
        var check = $(this).prop('checked')
        $.post('../ajax/listas.php','id='+id+'&op=entrega&chk='+check,
            function(respuesta){console.log(respuesta)},'json');
        //console.log($(this).prop('checked'))
    });

    $("#resultado").on("click", ".pagado", function(){
    var nombre = ($(this).attr('id'))
        var id = nombre.split("_")
        id= id[1];
        var check = $(this).prop('checked')

        $.post('../ajax/listas.php','id='+id+'&op=pago&chk='+check,
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

function guarda(){

    var id= $("#id").val();
    var fechaf;
    var lista;
    var verdura;
    var jyq;
    var pollo;
    var ryl;
    var nombre;
    var pago=0;
    var entrega=0;
   var datos='';
    verdura = $("#verdura").val();
    jyq = $("#jyq").val();
    pollo = $("#pollo").val();
    ryl = $("#ryl").val();
    fechaf=$("#fecha").val();
    lista=$("#lista").val();
    nombre=$('#nombre').val();

    if($("#pago").is(':checked')){

        pago=1;
    }

    if($("#entrega").is(':checked')) {

        entrega=1;
    }
    datos = 'nombre='+nombre+'&verdura='+verdura+'&jyq='+jyq+
            '&pollo='+pollo+'&ryl='+ryl+'&fechaf='+fechaf+'&pago='+pago+
            '&entrega='+entrega+"&lista="+lista+"&id="+id+"&operacion=editar";

    $.ajax({
           url:'../ingreso.php',
           data: datos,
           type:'POST',
           success: escribe
    });


}

function elimina() {
    var id= $("#id").val();
    var datos='';
    $("#resultado").html('<p><img src="../img/ajax.gif" /></p>');
    datos = "id="+id+"&operacion=eliminar";

    $.ajax({
           url:'../ingreso.php',
           data: datos,
           type:'POST',
           success: escribe
    });

}

function escribe(respuesta) {
    $("#resultado").html(respuesta);
    /*$('input:text').val('');
    $('input:checkbox').attr('CHECKED',false);*/
}

function buscaLista() {

    var nro = $('#casilla').val();
    console.log(nro);
    var dato = '';
    var path ='http://'+window.location.host+'/ajax/buscar.php'
    dato = "opcion=listar&nro="+nro;
    $("#resultado").html('<p><../img src="img/ajax.gif" /></p>');
       $.ajax({
               type:'POST',
               data: dato,
               url: path,
               success: function(resp) {
                $("#resultado").html(resp);
               }
           });

}
