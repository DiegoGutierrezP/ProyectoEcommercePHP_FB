// JavaScript Document
$(document).ready(function(){
	cargarMenuCatalogo();
	console.log("estas en catalogo.php");
})

function cargarMenuCatalogo(){
	$.ajax({
		type:"POST",
		url:"../controler/menu_catalogo_cliente.php",
		data:{accion:"cargar_menu_catalogo"},
		dataType:"json",
		success:function(response){
			var menuTotal="";
			for(var i=0;i<response.length;i++){
				var menu="";
				menu+="<li class='seccion'><a href=''>"+response[i]["seccion"]+"</a><ul class='subseccion_lista'>";
				for(var j=0;j<response[i]["subsecciones"].length;j++){
					menu+="<li><a href='../controler/cookie_catalogo.php?subsecc="+response[i]["subsecciones"][j]+"'>"+response[i]["subsecciones"][j]+"</a></li>";
				}
				menu+="</ul></li>"
				menuTotal+=menu;
			}
			$(".seccion_menu_catalogo .menu_catalogo").html(menuTotal);
			
		},error:function(xhr, status) {
			alert('Disculpe, existió un problema');
		}
	})
}
