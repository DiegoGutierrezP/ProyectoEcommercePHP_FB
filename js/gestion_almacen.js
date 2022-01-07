// JavaScript Document
$(document).ready(function(){
	
	dataTableEmpaquetado();
	dataTableReporte();
	
	//---------------------------------------------------------------------------------
	
	$("#mostrar-tabla-reporte").click(function(){
		$("#mostrar-tabla-empaquetado").removeClass("active-gestion-almacen-op");
		$(this).addClass("active-gestion-almacen-op");
		dataTableReporte();
		$(".table-empaquetado-content").addClass("esconder-table-content");
		$(".table-reporte-problemas-content").removeClass("esconder-table-content");
		
	})
	
	$("#mostrar-tabla-empaquetado").click(function(){
		$("#mostrar-tabla-reporte").removeClass("active-gestion-almacen-op");
		$(this).addClass("active-gestion-almacen-op");
		dataTableEmpaquetado();
		$(".table-reporte-problemas-content").addClass("esconder-table-content");
		$(".table-empaquetado-content").removeClass("esconder-table-content");
		
	})
	
	//PARA MARCAR COMO EMPAQUETADO--------------------------------------------------------------------------------
	$(document).on('click','.btn-empaquetado',function(){
		$("#formPesoPedido").trigger("reset");//limpiamos formulario
		$("#msg_checkEmpaquetado").html("");
		$("#modalPesoPedido").find(".modal-body h5 span").html($(this).data("idpedido"));
		$("#modalPesoPedido").find("#idPedidoPeso").val($(this).data("idpedido"));
		$("#modalPesoPedido").modal("show");
	})
	
	$("#formPesoPedido").submit(function(e){
		e.preventDefault();
		var checkEmpaquetado = $("#checkEmpaquetado").is(":checked");
		if(!checkEmpaquetado){
			$("#msg_checkEmpaquetado").html("Es necesario Empaquetar el Pedido.");	 
		}
		if(checkEmpaquetado){
			marcarEmpaquetado($("#formPesoPedido").serialize());
			$("#modalPesoPedido").modal("hide");
		}
	})
	
	//PARA GENERAR EL REPORTE DE PROBLEMA PEDIDO-------------------------------------------------------
	$(document).on('click','.btn-reporte-problema',function(){
		$("#formRepoteProblema").trigger("reset");//limpiamos formulario
		$("#modalReporteProblema").find(".modal-body h4").html("Pedido código: "+$(this).data("idpedido"));
		$("#inputIdPedido").val($(this).data("idpedido"));
		$("#modalReporteProblema").modal("show");
	})
	
	$("#formRepoteProblema").submit(function(e){
		e.preventDefault();
		var formData= new FormData(this);//para enviar imagenes
		generarReporteProblemaPedido(formData);
		$("#modalReporteProblema").modal("hide");
	})
	
	//----------------------------------------------------------------------------------------------------
	$(document).on('click','.btn-detalle-pedido',function(){
		//alert("detalle" + $(this).data("idpedido"));
		mostrarItemsPedido($(this).data("idpedido"),$(this).data("idcliente"));
	})
})

function generarReporteProblemaPedido(form){
	$.ajax({
		type:"POST",
		url:"../../controler/gestion_almacen_controller.php",
		data: form,
		cache:false,
	    contentType:false,
	    processData:false,
		dataType:"json",
		success: function(response){
			Swal.fire({
				type:response[0],
				text: response[1],	
				timer:3000

			})
			dataTableEmpaquetado();
		},error : function(xhr, status) {
				alert('Disculpe, existió un problema');
			}
	})
}

function mostrarItemsPedido(idped,idcli){
	$.ajax({
		type:"POST",
		url:"../../controler/gestion_almacen_controller.php",
		data:{accion:"mostrarItemsPedido",idpedido:idped,idcliente:idcli},
		//dataType:"json",
		success: function(response){
			Swal.fire({
				title:"Detalles del Pedido "+idped,
				html: response
				
			})
		}
	})
}

function marcarEmpaquetado(form){
	$.ajax({
		type:"POST",
		url:"../../controler/gestion_almacen_controller.php",
		data:form,
		dataType:"json",
		success: function(response){
			Swal.fire({
				text: response[0],	
				timer:3000,
				background:response[1],
				backdrop:false,
				padding:'1rem',
				position: 'top-end',
				showConfirmButton: false,
			})
			dataTableEmpaquetado();
		},error : function(xhr, status) {
				alert('Disculpe, existió un problema');
			}
	})
}

function dataTableEmpaquetado(){
	$("#table-almacen-empaquetado").DataTable({
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
			url :"../../controler/gestion_almacen_controller.php", // json datasource
			type: "post",  // method  , by default get
			"data":{accion:"insertarTable",para:"empaquetar"},
			error: function(){  // error handling
				//$(".lookup-error").html("");
				//$("#table-almacen").append('<tbody class=""><tr><th colspan="3">No data found in the server</th></tr></tbody>');
				$("#table-almacen-empaquetado_processing").css("display","none");
							
			}
		}
		
		/*"ajax":{
			"url":"../../controler/gestion_almacen_controller.php",
			"type":"POST",
			"data":{accion:"insertarTable"}
			
		},
		"columns":[
			{"data":"id"},
			{"data":"usuario"},
			{"data":"direccion"},
			{"data":"fecha"},
			{"data":"total"},
			{"data":"mPago"}
		]*/

	});
}

function dataTableReporte(){
	$("#table-almacen-problemas").DataTable({
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
			url :"../../controler/gestion_almacen_controller.php", // json datasource
			type: "post",  // method  , by default get
			"data":{accion:"insertarTable",para:"reporte"},
			error: function(){  // error handling
				//$(".lookup-error").html("");
				//$("#table-almacen").append('<tbody class=""><tr><th colspan="3">No data found in the server</th></tr></tbody>');
				$("#table-almacen-problemas_processing").css("display","none");
							
			}
		}
	});
}

