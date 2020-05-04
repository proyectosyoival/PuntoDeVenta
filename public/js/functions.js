// A $( document ).ready() block.
$( document ).ready(function() {
    $('#menu_on').click(function(){
    	$('body').toggleClass('visible_menu');
    })
});

function ShowModal(id){
$('.modal#masInformacionProd')
  .modal('show')
;
$('#modalContainer').load('http://localhost/PuntoDeVenta/producto/verProducto/'+id);
}

//Buscador dinámico en Index

$(buscar_datos());

function buscar_datos(consulta){
	$.ajax({
		url: 'producto/searchProducts',
		type: 'POST',
		dataType: 'html',
		data: {consulta: consulta},
	})
	.done(function(respuesta) {
		$("#datos").html(respuesta);
	})
	.fail(function() {
		console.log("error");
	})
}

$(document).on('keyup', '#caja_busqueda', function(){
	var valor = $(this).val();
	if (valor != ""){
		buscar_datos(valor);
	}else{
		buscar_datos();
	}
});