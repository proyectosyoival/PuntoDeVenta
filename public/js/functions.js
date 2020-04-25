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