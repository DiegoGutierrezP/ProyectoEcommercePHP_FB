// JavaScript Document
$(document).ready(function(){
	
	if(getCookie("carrito_cookie")==""){
		$(".btncarrito a span").ready(function(){
			$(".btncarrito a span").html("(0)");//notificacion carrito
		})
	}else{
		$(".btncarrito a span").ready(function(){
			let lc=JSON.parse(getCookie("carrito_cookie"));
			$(".btncarrito a span").html("("+lc.length+")");//notificacion carrito
		})
	}
	//PARA SUMAR  Y RESTAR CANTIDADES---------
	$("#restar").click(function(){
		if($(".inputCant").val()==1){
			console.log("es uno");
		}else{
			var cant=parseInt($(".inputCant").val());
			var cantidad=cant-1;
			$(".inputCant").val(cantidad);
		}
		
	});
	$("#sumar").click(function(){
		var cant=parseInt($(".inputCant").val());
		var cantidad=cant+1;
		$(".inputCant").val(cantidad);
	});
	//------------------------------------------
	
	$("#btn-agregar-carrito").click(function(){
		
		//alert($(this).attr("data-idP")+" "+$(".inputCant").val());
		
		var data = $(this).attr("data-idP");
		var id = parseInt(data);
		var cant = parseInt($(".inputCant").val());
		 
		//alert(id +" "+cant);
		
		if(getCookie("carrito_cookie")==""){//si no hay cookie
		
			var produc = [{"id":id,"cantidad":cant}];
			document.cookie="carrito_cookie="+JSON.stringify(produc)+"; max-age=2400; path=/;SameSite=None; Secure";//JSO.stringfy convertimos el array en un string
			$(".btncarrito a span").html("(1)");//notificacion carrito
			//alert("creamos cookie");
			console.log("creamos cookie");
		}else{
			
			let listacookie=JSON.parse(getCookie("carrito_cookie"));
			var produc2 = {"id":id,"cantidad":cant};
			
			var encontro=false;
			var numero=0;
			
			for(let i=0;i<listacookie.length;i++){
				if(listacookie[i]["id"]==produc2["id"]){
					encontro=true;
					numero=i;
				}	
			}
			if(encontro==true){
				listacookie[numero]["cantidad"]=listacookie[numero]["cantidad"]+cant;
				document.cookie="carrito_cookie="+JSON.stringify(listacookie)+"; max-age=2400; path=/;SameSite=None; Secure";
			}else{
				listacookie.push(produc2);
				document.cookie="carrito_cookie="+JSON.stringify(listacookie)+"; max-age=2400; path=/;SameSite=None; Secure";
			}
			
			$(".btncarrito a span").html("("+listacookie.length+")");//notificacion carrito
			
		}
		setTimeout( function() { window.location.href = "../vistas/carrito_cliente.php"; }, 500 );
	})
});

function getCookie(cname) {
	let name = cname + "=";
	let decodedCookie = decodeURIComponent(document.cookie);
	let ca = decodedCookie.split(';');
	for(let i = 0; i <ca.length; i++) {
		let c = ca[i];
		while (c.charAt(0) == ' ') {
		  c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
		  return c.substring(name.length, c.length);
		}
	}
	return "";
}