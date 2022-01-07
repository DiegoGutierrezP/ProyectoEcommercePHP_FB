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