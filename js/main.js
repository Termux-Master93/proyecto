$(document).ready(function() {
//operacion para mostrar y ocultar agregando clases predifinidas
	var mostrar=0;
	$('.mostrar').on('click', function(){
		if (mostrar==1) {
			$('.contenedor').addClass("contenedor-menu2");
			mostrar=0;
		}else{
			$('.contenedor').removeClass("contenedor-menu2");
			mostrar=1;
		}
		
	})
})

