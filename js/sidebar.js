// JavaScript Document
$(document).ready(function(){
	$('.sub-btn').click(function(){
		$(this).next('.sub-menu').slideToggle();
		$(this).find(".dropdown").toggleClass("rotate");
	});
	
	$(".menu-btn").click(function(){
		$(".side-bar").removeClass("active");
		$(".main").removeClass("active-body");
	})
	$(".close-btn").click(function(){
		
		$(".side-bar").addClass("active");
		$(".main").addClass("active-body");
	})
	
	$(".cerrar-sesion").click(function(){
		alert("cerrando sesisoon");
	})
});