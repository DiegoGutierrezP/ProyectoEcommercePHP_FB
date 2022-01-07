// JavaScript Document
$(document).ready(function(){
	cargarSelectTransConEnvios();
	
	$(document).on('click','#btn-pedidosSalidaTransportista',function(){
		var option =$("#transportistasConPedidoSalida").val();
		if(option!=""){
			cargarPedidosEnviados(option);
		}else{
			$("#table-pedidosEnEnvio tbody").html("");
		}
	})
	
	$(document).on('click','.btn-verDatos',function(){
		var id=$(this).attr("data-idDatos");
		datosEnvioCliente(id);
	})
	
	$("#modalPedidoEntregado").on('show.bs.modal',function(event){
		$("#formPedidoEntregado").trigger("reset");
		var button = $(event.relatedTarget);
		var id=button.attr('data-idPedido');
		var trans = button.attr('data-Trans');
		var modal= $(this);
		modal.find('.modal-body .titulo').html("Para el pedido código "+id);
		$("#codigoPedido").val(id);
		$("#codigoTrans").val(trans);
	})
	
	$("#formPedidoEntregado").submit(function(e){
		e.preventDefault();
		var codT = $("#codigoTrans").val();
		var form= new FormData(this);
		registrarConstanciaEntrega(form,codT);
		$("#modalPedidoEntregado").modal("hide");
	})
	
})

function registrarConstanciaEntrega(form , codT){
	$.ajax({
		type:"POST",
		url:"../../controler/gestion_transporte_controller.php",
		data:form,
		cache:false,
	    contentType:false,
	    processData:false,
		dataType:"json",
		success: function(response){
			Swal.fire({
				type:response[0],
				text:response[1],
				confirmButtonText: 'OK'
			})
			cargarPedidosEnviados(codT);
		},error : function(xhr, status) {
			alert('Disculpe, existió un problema');
		}
	})
}

function cargarSelectTransConEnvios(){
	$.ajax({
		type:"POST",
		url:"../../controler/gestion_transporte_controller.php",
		data:{accion:"cargarSelectTransConEnvios"},
		dataType:"json",
		success: function(response){
			//console.log(response[0]["idtrans"]+" "+response[0]["nombres"]);
			var options="<option value='' selected>Escoja un transportista..</option>";
			for(var i=0; i<response.length; i++){
				options+="<option value='"+response[i]["idtrans"]+"'>"+response[i]["nombres"]+"</option>";
			}
			
			$("#transportistasConPedidoSalida").html(options);
			
		},error : function(xhr, status) {
				alert('Disculpe, existió un problema');
			}
	})
}

function cargarPedidosEnviados(idtrans){
	$.ajax({
		type:"POST",
		url:"../../controler/gestion_transporte_controller.php",
		data:{accion:"cargarPedidosEnEnvio",idTrans:idtrans},
		
		success: function(response){
			
			$("#table-pedidosEnEnvio tbody").html(response);
			
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