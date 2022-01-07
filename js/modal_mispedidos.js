// JavaScript Document
$(document).ready(function(){
	$(".btn_detalle").click(function(){
		var id=$(this).attr("data-pedido");
		$.ajax({
			type: "POST",
			url: '../controler/acciones_mispedidos.php',
			data: {id:id},
			//dataType: 'json',
			success: function(response)
			{
				Swal.fire({
					title: 'Detalle del Pedido',
					html: response,
					padding:'3rem',
					width:'auto',
					allowOutsideClick:false,
					confirmButtonText: 'OK',
					confirmButtonColor: '#1bad35',
					position:'top'
				})

			},
			error: function(xhr,status){
				alert('Disculpe, existió un problema');
			}
		})
	
	})
	
	$(".close").click(function(){
			$(".modalDetalle").css("display","none");
	})
	
	$(".btn_estado").click(function(){
		var id=$(this).attr("data-pedido");
		$.ajax({
			type: "POST",
			url: '../controler/acciones_mispedidos.php',
			data: {id_estado:id},
			dataType: 'json',
			success: function(response)
			{
				$("#step1").removeClass("step-active");
				$("#step2").removeClass("step-active");
				$("#step3").removeClass("step-active");
				$("#step4").removeClass("step-active");
				$("#step5").removeClass("step-active");
				$("#step1").find(".fecha").html("");
				$("#step2").find(".fecha").html("");
				$("#step3").find(".fecha").html("");
				$("#step4").find(".fecha").html("");
				$("#step5").find(".fecha").html("");
				
				var data_e =JSON.parse(JSON.stringify(response));
				
				if(data_e["pago_recibido"]!=null){
					$("#step1").addClass("step-active");
					$("#step1").find(".fecha").html(data_e["pago_recibido"]);
				}
				if(data_e["empaquetado"]!=null){
					$("#step2").addClass("step-active");
					$("#step2").find(".fecha").html(data_e["empaquetado"]);
				}
				if(data_e["listo"]!=null){
					$("#step3").addClass("step-active");
					$("#step3").find(".fecha").html(data_e["listo"]);
				}
				if(data_e["encamino"]!=null){
					$("#step4").addClass("step-active");
					$("#step4").find(".fecha").html(data_e["encamino"]);
				}
				if(data_e["entregado"]!=null){
					$("#step5").addClass("step-active");
					$("#step5").find(".fecha").html(data_e["entregado"]);
				}
				 
				var track_html=$(".contenedor_tracking").html();
				Swal.fire({
					title:"Tracking",
					html: track_html,
					allowOutsideClick:false,
					confirmButtonText: 'OK',
					confirmButtonColor: '#1bad35',
					position:'top'
				})
				
			},
			error: function(xhr,status){
				alert('Disculpe, existió un problema ' + status);
			}
		})
	})
	 
})