// JavaScript Document
//SLIDE SHOW----------------------------------------------
		const slider = document.querySelector("#slider-hero");
		let sliderseccion =  document.querySelectorAll(".slider-section-hero");
		let sliderSectionLast = sliderseccion[sliderseccion.length - 1];
		
		const btnleft = document.querySelector("#btn-left-hero");
		const btnright = document.querySelector("#btn-right-hero");
		
		slider.insertAdjacentElement("afterbegin",sliderSectionLast);
		
		function next(){
			let sliderSectionFirst = document.querySelectorAll(".slider-section-hero")[0];
			slider.style.marginLeft ="-100%";
			slider.style.transition = "all 0.5s";
			setTimeout(function(){
				slider.style.transition = "none";
				slider.insertAdjacentElement("beforeend",sliderSectionFirst);
				slider.style.marginLeft = "0%";
			},500);
				
		}
		
		function prev(){
			let sliderSection = document.querySelectorAll(".slider-section-hero");
			let sliderSectionLast= sliderSection[sliderSection.length-1];
			slider.style.marginLeft ="0";
			slider.style.transition = "all 0.5s";
			setTimeout(function(){
				slider.style.transition = "none";
				slider.insertAdjacentElement("afterbegin",sliderSectionLast);
				slider.style.marginLeft = "-100%";
			},500);
				
		}
		
		btnright.addEventListener("click",function(){ 
			next();
		});
		btnleft.addEventListener("click",function(){
			prev();
		})

setInterval(function(){
	next();
},6000);

//SCROLL EVENT-------------------------------------------------------------------
window.addEventListener("scroll",function(){
	calculscroll();
})

function calculscroll(){
	let scroll = document.documentElement.scrollTop;//cuando scroleamos

	let altopag = document.documentElement.scrollHeight;//es el alto que tiene toda la pagina
	let altocliente = document.documentElement.clientHeight;//es el alto lo que ve el usuario en su pantalla
	let alto = altopag - altocliente;
	
	let progre = (scroll/alto)*100;
	
	if(progre >0){
		document.getElementsByClassName("header")[0].style.backgroundColor="#05301a";
	}else{
		document.getElementsByClassName("header")[0].style.backgroundColor="";
	}
}