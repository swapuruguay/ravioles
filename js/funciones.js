/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(carga);

function carga() {
    $("#boton").click(guarda);
    $("#consulta").click(consultar);
        

}

function guarda() {
    var datos='';
    var fechaf;
    var lista;
    var nombre;
    var verdura;
    var jyq;
    var pollo;
    var ryl;
    var pago=0;
    var entrega=0;
    nombre = $("#nombre").val();
    verdura = $("#verdura").val();
    jyq = $("#jyq").val();
    pollo = $("#pollo").val();
    ryl = $("#ryl").val();
    fechaf=$("#fechaf").val();
    lista=$("#lista").val();

    if($("#pago").is(':checked')){

        pago=1;
    }

    if($("#entrega").is(':checked')) {
        entrega=1;
    }
    datos = 'nombre='+nombre+'&verdura='+verdura+'&jyq='+jyq+
            '&pollo='+pollo+'&ryl='+ryl+'&fechaf='+fechaf+'&pago='+pago+
            '&entrega='+entrega+"&lista="+lista+"&operacion=ingresar";
    $("#resultado").html('<p><img src="img/ajax.gif" /></p>');
    $.ajax({
           url:'ingreso.php',
           data: datos,
           type:'POST',
           success: escribe
    });
}

function escribe(respuesta) {
    $("#resultado").html(respuesta);
}


function consultar() {
    //alert("ok");
    var fecha = $("#fecha").val();
    var dato="fecha="+fecha;
    $("#resultado").html('<p><img src="img/ajax.gif" /></p>');
    $.ajax({
           url:'consultas.php',
           data: dato,
           type:'POST',
           success: escribe
    });
}

function totales(alcance) {
    //alert("ok");
    var fecha = $("#fecha").val();
    var dato="fecha="+fecha+"alcance="+alcance;

    $("#resultado").html('<p><img src="img/ajax.gif" /></p>');
    $.ajax({
           url:'totales.php',
           data: dato,
           type:'POST',
           success: escribe
    });
}
