$(document).ready(function(){
	
	var btnpaso1=false;
	var btnpaso2=false;
	var btnpaso3=false;
	
	$("#paso2").prop("disabled",true);
	$("#paso3").prop("disabled",true);
	
	$("#paso1").click(function(){
		$(".table_paso1").slideToggle(300);
		$(".table_paso2").css("display","none");
		$("#paso2").prop("disabled",true);
		$(".table_paso3").css("display","none");
		$("#paso3").prop("disabled",true);
	})
	
	$("#paso2").click(function(){
		$(".table_paso2").slideToggle(300);
		$(".table_paso3").css("display","none");
		$("#paso2").prop("disabled",false);
		$(".table_paso3").css("display","none");
		$("#paso3").prop("disabled",true);
	})
	
	$("#selectDatosEnvio").change(function(){
		if($(this).val()==""){
			$(".paso1 .table_paso1 #formulario").html("");
		}else if($(this).val()=="newDatos"){
			var idcli = $("#selectDatosEnvio").find(':selected').attr("data-idCli")
			consultarDatosCliente1(idcli);
		}else if($(this).val()!="newDatos" && $(this).val()!=""){
			consultarDatosCli($(this).val());
		}
		
	})
	//VALIDAR PASO 1---------------------------------------------------------
	$(".btn_paso1").click(function(){
		if($("#selectDatosEnvio").val()!="newDatos" && $("#selectDatosEnvio").val()!=""){
			$(".table_paso1").css("display","none");
			$(".table_paso2").css("display","block");
			$("#paso2").prop("disabled",false);
		}
		if($("#selectDatosEnvio").val()=="newDatos"){
			if($("#txt_nombres").val().length==0 || $("#txt_apellidos").val().length==0 || $("#txt_dni").val().length==0 || $("#txt_ciudad").val().length==0 || $("#txt_distrito").val().length==0 || $("#txt_domi").val().length==0){
				$("#msg_error_form").html("Todos los campos son requeridos");
			}else{
				$(".table_paso1").css("display","none");
				$(".table_paso2").css("display","block");
				$("#paso2").prop("disabled",false);
				$("#msg_error_form").html("");
			}
		}
	})
	
	//-------------------------------------------------------------------------------------
	$(".btn_paso2").click(function(){
		//btnpaso1=true;
		var pre = $("input[name=metodo_envio]:checked").data("precio");
		var precioEnvio = parseFloat(pre);
		$("#precio_envio").html(precioEnvio);
		var precioPedido=parseFloat($("input[name=total_pedido]").val());
		var totalPagar = precioEnvio + precioPedido;
		$("#total_a_pagar").html(totalPagar);
		
		$(".table_paso1").css("display","none");
		$(".table_paso2").css("display","none");
		$(".table_paso3").css("display","block");
		$("#paso3").prop("disabled",false);
	})
	
	
	
	

	$(".btn_finalizar_pedido").click(function(){
			$(".btn_finalizar_pedido").prop("disabled",true);
			$(".gif_procepago").css("display","block");
			setTimeout(function(){
				$(".gif_procepago").css("display","none");
				$.ajax({
					type:"POST",
					url:"../controler/efectua_orden_pedido.php",
					data: $("#form_proceso_pago").serialize(),
					dataType:"json",
					success:function(response){
						var icon="";
						var titulo="";
						var content="";
						if(response[0]=="success"){
						   icon="success";
							titulo='Exito';
							content=response[1];
						}else{
							icon="error";
							titulo='Error';
							content=response;
						}
						Swal.fire({
							title: titulo,
							text: content,
							type: icon,
							confirmButtonText: 'OK'		
						}).then((result) => {
							if(result.value){
								window.location.href = "../vistas/mispedidos_cliente.php";
							}
						})
					}
				})
			},4000);
	})

	
})

function consultarDatosCliente1(idCliente){
	$.ajax({
		type:"POST",
		url:"../controler/proceso_pago_controller.php",
		data:{accion:"consultarCliente",idc:idCliente},
		//dataType:"json",
		success: function(response){
			//alert(response);
			$(".paso1 .table_paso1 #formulario").html(response);
			
		},error : function(xhr, status) {
				alert('Disculpe, existió un problema');
		}
	})
}

function consultarDatosCli(id){
	$.ajax({
		type:"POST",
		url:"../controler/proceso_pago_controller.php",
		data:{accion:"consultarClienteDatos",idce:id},
		//dataType:"json",
		success: function(response){
			//alert(response);
			$(".paso1 .table_paso1 #formulario").html(response);
			
		},error : function(xhr, status) {
				alert('Disculpe, existió un problema');
		}
	})
}
