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
	
	
	$(".produc_btn a input").click(function(){
		
		var data = $(this).attr("data");
		var id = parseInt(data);
		
		
		if(getCookie("carrito_cookie")==""){//si no hay cookie
		
			var produc = [{"id":id,"cantidad":1}];
			document.cookie="carrito_cookie="+JSON.stringify(produc)+"; max-age=2400; path=/;SameSite=None; Secure";//JSO.stringfy convertimos el array en un string
			$(".btncarrito a span").html("(1)");//notificacion carrito
			//alert("creamos cookie");
			console.log("creamos cookie");
		}else{
			
			let listacookie=JSON.parse(getCookie("carrito_cookie"));
			var produc2 = {"id":id,"cantidad":1};
			
			var encontro=false;
			var numero=0;
			
			for(let i=0;i<listacookie.length;i++){
				if(listacookie[i]["id"]==produc2["id"]){
					encontro=true;
					numero=i;
				}	
			}
			if(encontro==true){
				listacookie[numero]["cantidad"]=listacookie[numero]["cantidad"]+1;
				document.cookie="carrito_cookie="+JSON.stringify(listacookie)+"; max-age=2400; path=/;SameSite=None; Secure";
			}else{
				listacookie.push(produc2);
				document.cookie="carrito_cookie="+JSON.stringify(listacookie)+"; max-age=2400; path=/;SameSite=None; Secure";
			}
			
			$(".btncarrito a span").html("("+listacookie.length+")");//notificacion carrito
			
		}
		
	})
			
	
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
	
	/*function setCookie(cname, cvalue, exdays) {
		 const d = new Date();
		 d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
		 let expires = "expires="+d.toUTCString();
		 //let segundos = "max-age=120";//segundos
		 document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}*/
})