// JavaScript Document
$(document).ready(function(){
	cargarSecciones();
			
	$("#select_secciones").change(function(){
		//para habilitar o desabilitar el boton de crear subseccion
		if($("#select_secciones").children("option:selected").val()==""){
		   $("#btn_nuevaSubseccion").prop("disabled",true);
		}else{
			$("#btn_nuevaSubseccion").prop("disabled",false);
		}
		//
		cargarSubsecciones($("#select_secciones option:selected").val());
	})
	
	$("#btn_guardarSeccionesaMostrar").click(function(){
		var cont=0;
		var checks=[];
		$(".check-mostrar-seccion:checkbox:checked").each(function(){
			cont++;
			//console.log($(this).data("id"));
			checks.push($(this).data("id"))
		})

		if(cont>1 && cont<=4){
			updateMostrarSecciones(checks);
		}else{
			Swal.fire({
					title:'Error',
					type:'error',
					text:"Puede mostrar como minimo 1 seccion y como maximo 4 secciones",
					confirmButtonText: 'OK'
				})
			cargarSecciones();
		}
		
	})
	
	//PARA FORM CREAR SECCION-------------------------------------------------
	
	$("#btn_nuevaSeccion").click(function(){
		$("#modalCrearSeccion").modal("show");
		$("#mensaje_btnsgte").html("");
		$("#mensaje_inputSubsecc").html("");
	})
	
	$("#btn_siguiente").click(function(){
		var campo=$("#inputNombreSeccion");
		var nSecc =campo.val();
		if(nSecc==0){
			$("#mensaje_btnsgte").html("Porfavor ingrese un nombre para la sección");
		}else{
			$("#mensaje_btnsgte").html("");
			$(".inputSubsecc").prop("disabled",false);
		}
	})
	
	$("#inputNombreSeccion").keyup(function(){
		if($("#inputNombreSeccion").val()==0){
			$(".inputSubsecc").prop("disabled",true);
		}else if($("#inputNombreSeccion").val()!=0){
			$("#mensaje_btnsgte").html("");	 
		}
	})
	
	$(".inputSubsecc").keyup(function(){
		if($(this).val()!=0){
			$("#mensaje_inputSubsecc").html("");
		}
	})
	
	$("#formCrearSeccion").submit(function(e){
		e.preventDefault();
		var campo1=$("#txtSubsecc1").val();
		var campo2=$("#txtSubsecc2").val();
		var campo3=$("#txtSubsecc3").val();
		var campo4=$("#txtSubsecc4").val();
		if(campo1!=0 || campo2!=0 || campo3!=0 || campo4!=0 ){
			//alert("campos completados");
			creaSeccion($(this).serialize());
			$("#modalCrearSeccion").modal("hide");
		}else{
			//alert("llene algun campo");
			$("#mensaje_inputSubsecc").html("Porfavor ingrese al menos una subsección.");
		}
		
	})
	
	//------------------------------------------------------------------------
	//PARA EDITAR SECCION-------------------------------------------
	$("#modalEditarSeccion").on('show.bs.modal',function(event){
		$("#alertmsj_inputNombreSeccionEdit").html("");
		var button = $(event.relatedTarget);
		var id=button.data('id');
		var nombre= button.data('nombre');
		var modal= $(this);
		modal.find('.modal-body #inputIdSeccion').val(id);
		modal.find('.modal-body #inputNombreSeccionEdit').val(nombre);
	})
	
	$("#formEditarSeccion").submit(function(e){
		e.preventDefault();
		if($("#inputNombreSeccionEdit").val().trim().length > 0 ){
			$("#alertmsj_inputNombreSeccionEdit").html("");
			updateNombreSeccion($("#formEditarSeccion").serialize());
			$("#modalEditarSeccion").modal("hide");
		}else{
			$("#alertmsj_inputNombreSeccionEdit").html("Ingrese nombre para la sección");
		}
		
	})
	
	//PARA CREAR NUEVA SUBSECCION-------------------------------------------
	$("#btn_nuevaSubseccion").click(function(){
		$("#alertmsj_inputNombreNewSecc").html("");
		var idsecc = $("#select_secciones").children("option:selected").val();
		var titulo = $("#select_secciones").children("option:selected").text();
		$("#nomSeccionRTitulo").html(titulo);
		$("#idSeccionRelacionada").val(idsecc);
		$("#nomSeccionRTitulo").html();
		$("#modalCrearSubseccion").modal("show");
	})
	
	$("#formCrearSubseccion").submit(function(e){
		e.preventDefault();
		if($("#inputNombreNewSubseccion").val()==0){
			$("#alertmsj_inputNombreNewSecc").html("Ingrese un nombre para la subsección");
		}else{
			var idsecc = $("#select_secciones").children("option:selected").val();
			$("#alertmsj_inputNombreNewSecc").html("");
			crearSubseccion($("#formCrearSubseccion").serialize(),idsecc);
			$("#modalCrearSubseccion").modal("hide");
		}
	})
	
	//PARA EDITAR UNA SUBSECCION-----------------------------------
	$("#modalEditarSubseccion").on('show.bs.modal',function(event){
		var button = $(event.relatedTarget);
		var id=button.data('id');
		var nombre= button.data('nombre');
		var modal= $(this);
		modal.find('.modal-body #idSubseccion').val(id);
		modal.find('.modal-body #inputNombreSubseccionEdit').val(nombre);
	})
	
	$("#formEditarSubseccion").submit(function(e){
		e.preventDefault();
		if($("#inputNombreSubseccionEdit").val()==0){
			$("#alertmsj_inputNombreSubseccionEdit").html("Ingrese un nombre para la subsección");
		}else{
			$("#alertmsj_inputNombreSubseccionEdit").html("");
			var idsecc = $("#select_secciones").children("option:selected").val();
			editarSubseccion($("#formEditarSubseccion").serialize(),idsecc);
			$("#modalEditarSubseccion").modal("hide");
		}
	})
	//PARA ELIMINAR UNA SUBSECCION--------------------------------------
	$(document).on('click','.btn-eliminar-subsecc',function(){
		var idsubsecc=$(this).data("id");
		var idsecc = $("#select_secciones").val();
		$.ajax({
			type:"POST",
			url:"../../controler/crud_subsecciones.php",
			data:{accion:"consultaProdSubsecc",idsubsecc:idsubsecc},
			success: function(response){
				Swal.fire({
					title: '¿Seguro que quiere eliminar esta subsección código '+idsubsecc +' ?',
					html:'Tambien se eliminaran todos los productos relacionados a esta subseccion <br> Número de productos: '+ response ,
					type:'warning',
					showConfirmButton: true,
					confirmButtonText:"SI",
					confirmButtonColor: "#DD6B55",
					showCancelButton: true,
					cancelButtonText:"NO",
					cancelButtonColor: "#209dd8",
				}).then((result)=>{
					if(result.value){
						eliminarSubseccion(idsubsecc,idsecc);
					}
				})
				
			}
		})
		
		
	})
	
})

function eliminarSubseccion(idsub,idsecc){
	$.ajax({
		type:"POST",
		url:"../../controler/crud_subsecciones.php",
		data:{accion:"eliminarSubsecc",idsubsecc:idsub},
		dataType:"json",
		success: function(response){
			
			Swal.fire({
				text: response[0],	
				timer:3000,
				background:response[1],
				backdrop:false,
				padding:'1rem',
				position: 'top',
				showConfirmButton: false,
			})
			cargarSubsecciones(idsecc);
			
		},error : function(xhr, status) {
			alert('Disculpe, existió un problema');
		}
	})
}


function editarSubseccion(form,idsecc){
	$.ajax({
		type:"POST",
		url:"../../controler/crud_subsecciones.php",
		data:form + "&accion=editarSubseccion",
		dataType:"json",
		success: function(response){
			Swal.fire({
					title:response["titulo"],
					type:response["icon"],
					text:response["msg"],
					toast:true,
					position:'top-end',
					timer:1500,
					confirmButtonText: 'OK'
			})
			cargarSubsecciones(idsecc);
		}
	})
}

function crearSubseccion(form,idsecc){
	$.ajax({
		type:"POST",
		url:"../../controler/crud_subsecciones.php",
		data:form + "&accion=crearSubseccion",
		dataType:"json",
		success: function(response){
			Swal.fire({
					title:response["titulo"],
					type:response["icon"],
					text:response["msg"],
					timer:3000,
					confirmButtonText: 'OK'
			})
			cargarSubsecciones(idsecc);
		}
	})
}

function updateNombreSeccion(form){
	$.ajax({
		type:"POST",
		url:"../../controler/crud_secciones.php",
		data:form+"&accion=updateNombreSeccion",
		success:function(response){
			if(response){
				Swal.fire({
					title:'Exito',
					type:'success',
					text:'La seccion se actualizo correctamente!',
					toast:true,
					position:'top-end',
					timer:1500,
					confirmButtonText: 'OK'
				})
			}else{
				Swal.fire({
					title:'Error',
					type:'error',
					text:'La seccion no se pudo actualizar!',
					toast:true,
					position:'top-end',
					timer:1500,
					confirmButtonText: 'OK',
				})
			}
			cargarSecciones();
		}
	})
}

function updateMostrarSecciones(arraymostrar){
	$.ajax({
		type:"POST",
		url:"../../controler/crud_secciones.php",
		data: {accion:"updateMostrar",arrayMostrar:JSON.stringify(arraymostrar)},
		success:function(response){
			Swal.fire({
					title:'Exito',
					type:'success',
					text:response,
					confirmButtonText: 'OK'
				})
			cargarSecciones();
		}
	})
}

function creaSeccion(form){
	$.ajax({
		type:"POST",
		url:"../../controler/crud_secciones.php",
		data: form+"&accion=crearSeccion",
		dataType:"json",
		success: function(response){
			Swal.fire({
					title: response["titulo"],
					type:response["icon"],
					text:response["msg"],
					timer:3000,
					confirmButtonText: 'OK',
			})
			
			cargarSecciones();
		},error : function(xhr, status) {
			alert('Disculpe, existió un problema');
		}
	})
}

function cargarSecciones(){
	$.ajax({
		type:"POST",
		url:"../../controler/crud_catalogo.php",
		data:{cargar:"cargar_select"},
		dataType:"json",
		beforeSend: function(){
			$(".table-crud-secciones tbody").html("<tr><td colspan='4'><center><img src='../../imgs/loading6.gif'></center></td></tr>");
		},
		success: function(response){ 
			var contenido="";
			var opciones="<option value='' selected></option>";
			for(var i=0;i<response.length;i++){
				contenido+="<tr><td>"+response[i]["id"]+"</td><td>"+response[i]["nombre"]+"</td><td><input type='checkbox' class='check-mostrar-seccion form-check-input' data-id='"+response[i]["id"]+"' "+response[i]["mostrar"]+"></td><td><button class='btn btn-info' data-toggle='modal' data-target='#modalEditarSeccion' data-id='"+response[i]["id"]+"' data-nombre='"+response[i]["nombre"]+"'><i class='fa-solid fa-pen-to-square'></i></button></td></tr>";
				opciones+="<option value='"+response[i]["id"]+"'>"+response[i]["nombre"]+"</option>";
			}
			$(".table-crud-secciones tbody").html(contenido);//carga la tabla secciones
			$(".table-crud-subsecciones thead").find("#select_secciones").html(opciones);//carga el select de subsecciones
		}
	})
}

function cargarSubsecciones(secc){
	$.ajax({
		type:"POST",
		url:"../../controler/crud_catalogo.php",
		data:{cargar:"cargar_subseccion",seccion:secc},
		dataType:"json",
		beforeSend: function(){
			$(".table-crud-subsecciones tbody").html("<tr><td colspan='3'><center><img src='../../imgs/loading6.gif'></center></td></tr>");
		},
		success:function(response){
			var content="";
			for(var i=0;i<response.length;i++){
				content+="<tr><td>"+response[i]["id"]+"</td><td>"+response[i]["nombre"]+"</td><td><button class='btn btn-info' data-toggle='modal' data-target='#modalEditarSubseccion' data-id='"+response[i]["id"]+"' data-nombre='"+response[i]["nombre"]+"' ><i class='fa-solid fa-pen-to-square'></i></button><button class='btn-eliminar-subsecc btn btn-danger' data-id='"+response[i]["id"]+"' ><i class='fa-solid fa-trash'></i></button></button></td></tr>"
			}
			$(".table-crud-subsecciones tbody").html(content);
			
		}
	})
}