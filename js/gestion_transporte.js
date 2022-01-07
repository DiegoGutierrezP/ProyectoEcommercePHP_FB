// JavaScript Document
$(document).ready(function(){
	cargaSelectTrans();
	
	$(".check-general").click(function(){
		if($(".check-general").is(":checked")){
			$('.check-salida').each(function() {
    			$(this).prop("checked", true);
			});
		}else if(!$(".check-general").is(":checked")){
			$('.check-salida').each(function() {
    			$(this).prop("checked", false);
			});
		}
	})
	
	
	$("#btn-pedidosTransportista").click(function(){
		var option =$("#transportistasConPedido").val();
		if(option!=""){
			cargarPedidosTrans(option);
			
		}else{
			$("#table-pedidosTrasnportista tbody").html("");
			$("#content-btn-marcarsalida").html("");
			$(".check-general").prop("disabled",true);
		}
	})
	
	$(document).on('click','.btn-verDatos',function(){
		var id=$(this).attr("data-idDatos");
		datosEnvioCliente(id);
	})
	
	$(document).on('click','.btn-marcar-salida',function(){
		var array=[];
		$('.check-salida:checked').each(function() {
    		array.push($(this).data("pedido"));
		});
		
		if(array.length>2){
			marcarSalidaPedido(array);
		}else{
			Swal.fire({
				type:'warning',
				text:"Seleccione al menos 3 pedidos.",
			})
		}
	})
	
})

function marcarSalidaPedido(array){
	var ids = JSON.stringify(array);
	$.ajax({
		type:"POST",
		url:"../../controler/gestion_transporte_controller.php",
		data:{accion:"marcarSalida",idspedidos:ids},
		//dataType:"json",
		success: function(response){
			Swal.fire({
				type:'info',
				text:response,
				allowOutsideClick:false
			}).then((result)=>{
				if(result.value){
					location.href ="pedidos_enviados.php";
				}
			})
			
		},error : function(xhr, status) {
				alert('Disculpe, existió un problema');
			}
	})
}

function cargarPedidosTrans(idTrans){
	$.ajax({
		type:"POST",
		url:"../../controler/gestion_transporte_controller.php",
		data:{accion:"cargarPedidosTransportista",idTrans:idTrans},
		dataType:"json",
		success: function(response){
			$("#table-pedidosTrasnportista tbody").html(response[0]);
			$("#content-btn-marcarsalida").html("<button class='btn-marcar-salida btn btn-success' "+response[1]+" >Marcar salida de pedidos</button>");
			$(".check-general").prop("checked",false);
			$(".check-general").prop("disabled",false);
			
		},error : function(xhr, status) {
				alert('Disculpe, existió un problema');
			}
	})
}

function cargaSelectTrans(){
	$.ajax({
		type:"POST",
		url:"../../controler/gestion_transporte_controller.php",
		data:{accion:"cargarSelectTrans"},
		dataType:"json",
		success: function(response){
			//console.log(response[0]["idtrans"]+" "+response[0]["nombres"]);
			var options="<option value='' selected>Escoja un transportista..</option>";
			for(var i=0; i<response.length; i++){
				options+="<option value='"+response[i]["idtrans"]+"'>"+response[i]["nombres"]+"</option>";
			}
			
			$("#transportistasConPedido").html(options);
			
		},error : function(xhr, status) {
				alert('Disculpe, existió un problema');
			}
	})
}

function datosEnvioCliente(idDatos){
	$.ajax({
		type:"POST",
		url:"../../controler/gestion_transporte_controller.php",
		data:{accion:"cargarDatosEnvio",idDatos:idDatos},
		success: function(response){
			Swal.fire({
				title:"Datos de Envio ",
				html: response
				
			})
			
		},error : function(xhr, status) {
				alert('Disculpe, existió un problema');
			}
	})
}