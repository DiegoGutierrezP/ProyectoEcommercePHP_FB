// JavaScript Document
$(document).ready(function(){
	
	$("#selectSolucion").change(function(){
		if($(this).val()=="pedido cancelado"){
			$("#inputPesoPedido").prop("disabled","true");
			$("#checkEmpaquetado").prop("checked",false);//desmarcamos el check empaquetado
			$("#checkEmpaquetado").prop("disabled","true");
			
			
		}else{
			$("#inputPesoPedido").removeAttr("disabled");
			$("#checkEmpaquetado").removeAttr("disabled");
		}
	})
	
	
	$("#formSolucionReporte").submit(function(e){
		e.preventDefault();
		var selecSolucion=$("#selectSolucion option:selected").val();
		var checkEmpaquetado = $("#checkEmpaquetado").is(":checked");
		var inputpeso= $("#inputPesoPedido").val();
		
		var formData= new FormData(this);
		
		if(selecSolucion!="pedido cancelado"){
			if(selecSolucion==""){
				$("#msg_selectSolucion").html("Seleccione alguna opcion")
			} 
			if(!checkEmpaquetado){
				$("#msg_checkEmpaquetado").html("Debe empaquetar el pedido para resolverlo.");	 
			}
			if(inputpeso.length == 0){
				$("#msg_pesoPedido").html("Ingrese el peso del pedido");
			}
			if(!checkEmpaquetado){
				$("#msg_checkEmpaquetado").html("Debe empaquetar el pedido para resolverlo.");	 
			}
			if(selecSolucion!="" && checkEmpaquetado && inputpeso.length !=0){
				enviarformSolucionReporte(formData);
			}
		}else{
			enviarformSolucionReporte(formData);
		}
		
		
		
	})
	
})

function enviarformSolucionReporte(form){
	$.ajax({
		type:"POST",
		url:"../../controler/solucion_reporte_controller.php",
		data:form,
		cache:false,
	    contentType:false,
	    processData:false,
		dataType:"json",
		success: function(response){
			Swal.fire({
				type:response[0],
				text: response[1],	
				confirmButtonText: 'OK',
				allowOutsideClick:false
			}).then((result) => {
				if(result.value){
					location.href ="../../vistas/gestion/gestion_pedidos_almacen.php"; 
				}
			})
			
		},error : function(xhr, status) {
			alert('Disculpe, existió un problema');
		}
	})
}