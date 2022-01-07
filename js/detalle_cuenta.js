// JavaScript Document
$(document).ready(function(){	
	
	$(".op_micuenta").hover(function(){
		$(".detalle_cuenta").css("display","block");
	},function(){
		$(".detalle_cuenta").css("display","none");
	})
	
	
	$(document).on('mouseenter','.seccion',function(){
		$(this).find('.subseccion_lista').css("display","block");
		//$(this).css("background","red");
	})
	$(document).on('mouseleave','.seccion',function(){
		$(this).find('.subseccion_lista').css("display","none");
	})

	
});