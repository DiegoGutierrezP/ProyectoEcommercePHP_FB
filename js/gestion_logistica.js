// JavaScript Document
$(document).ready(function(){
	dataTableLogistica();
	
	
	$(document).on('change','#selectTransportista',function(){
		if($(this).val()!=""){
			consultarTrasnportista($(this).val());
		}else{
			$("#pedidos-transportista table").html("");
		}
		
	})
	
	$(document).on('click','.btn-detalleP',function(){
		mostrarDetallePedido($(this).data("idpedido"),$(this).data("idcliente"));
	})
	
	$(document).on('click','.btn-asignarT',function(){
		$("#formAsignarTrans").trigger("reset");//limpiamos formulario
		$("#msg_checkListoE").html("");
		llenarModalAsignarT($(this).data("idcliente"));
		//var infoEnvio=$(this).data("direc");
		$("#modalAsignarTrans").find(".modal-body h4").html("Pedido código "+$(this).data("idpedido"));
		$("#modalAsignarTrans").find(".modal-body #inputIdPedido").val($(this).data("idpedido"));
		//$("#modalAsignarTrans #campoDireccion").val(infoEnvio);
		$("#pedidos-transportista table").html("");
		$("#modalAsignarTrans").modal("show");
	})
	
	$("#formAsignarTrans").submit(function(e){
		e.preventDefault();
		var check = $("#checkListoE").is(":checked");
		if(!check){
			$("#msg_checkListoE").html("Seleccione esta opción");
		}else{
			asignarTranportistaPedido($("#formAsignarTrans").serialize());
			$("#modalAsignarTrans").modal("hide");
		}
	})
	
})

function consultarTrasnportista(idTrans){
	$.ajax({
		type:"POST",
		url:"../../controler/gestion_logistica_controller.php",
		data:{accion:"consultarPedidosTrans",idTrans:idTrans},
		dataType:"json",
		success: function(response){
		
			var tbody="<tr><td>Pedidos Asignados</td><td>"+response["nPedidos"]+"</td></tr>"+
					"<tr><td>Peso Total</td><td>"+response["pesoTotal"]+"</td></tr>";
			$("#pedidos-transportista table").html(tbody);
		}
	})
}

function asignarTranportistaPedido(form){
	$.ajax({
		type:"POST",
		url:"../../controler/gestion_logistica_controller.php",
		data:form,
		dataType:"json",
		success: function(response){
			Swal.fire({
				text: response[1],	
				timer:3000,
				background:response[0],
				backdrop:false,
				padding:'1rem',
				position: 'top',
				showConfirmButton: false,
			})
			dataTableLogistica();
		}
	})
}

function llenarModalAsignarT(idDcliente){
	$.ajax({
		type:"POST",
		url:"../../controler/gestion_logistica_controller.php",
		data:{accion:"llenarModalAsignarT",idDatoCli:idDcliente},
		dataType:"json",
		success:function(response){
			$("#modalAsignarTrans #campoDireccion").val(response[0]);
			$("#selectTransportista").html(response[1]);
		}
	})
}

function mostrarDetallePedido(idped,idcli){
	$.ajax({
		type:"POST",
		url:"../../controler/gestion_logistica_controller.php",
		data:{accion:"mostrarDetallePedido",idpedido:idped,idcliente:idcli},
		//dataType:"json",
		success: function(response){
			Swal.fire({
				title:"Detalles del Pedido "+idped,
				html: response
				
			})
		}
	})
}

function dataTableLogistica(){
	$("#table-logistica").DataTable({
		"language":	{
					"sProcessing":     "Procesando...",
					"sLengthMenu":     "Mostrar _MENU_ registros",
					"sZeroRecords":    "No se encontraron resultados",
					"sEmptyTable":     "Ningún dato disponible en esta tabla",
					"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
					"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
					"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
					"sInfoPostFix":    "",
					"sSearch":         "Buscar:",
					"sUrl":            "",
					"sInfoThousands":  ",",
					"sLoadingRecords": "Cargando...",
					"oPaginate": {
						"sFirst":    "Primero",
						"sLast":     "Último",
						"sNext":     "Siguiente",
						"sPrevious": "Anterior"
					},
					"oAria": {
						"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
						"sSortDescending": ": Activar para ordenar la columna de manera descendente"
					}
		},
		"stateSave": true,//para recargar el datatable
    	"bDestroy": true,//para recargar el datatable
 		"processing": true,
		"serverSide":true,
		"ajax":{
			url :"../../controler/gestion_logistica_controller.php", // json datasource
			type: "post",  // method  , by default get
			"data":{accion:"insertarTable"},
			error: function(){  // error handling
				//$(".lookup-error").html("");
				//$("#table-almacen").append('<tbody class=""><tr><th colspan="3">No data found in the server</th></tr></tbody>');
				$("#table-logistica_processing").css("display","none");
							
			}
		}
	});
}