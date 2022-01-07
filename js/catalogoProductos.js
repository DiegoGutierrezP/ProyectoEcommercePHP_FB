// JavaScript Document

var pageSelected=0;//para saber q page esta seleccionada

$(document).ready(function(){
		
	//ajaxLoadPorEstado(1);
	cargarSelect();//carga el select y el ajax load
	
	$("#selectporEstado").change(function(){
		$("#seccion-produc option[value='Todos']").prop("selected",true);//selecciona el selectsecciones en "todos"
		$(".txt-search-nom").val("");//limpiamos la caja de buscar por nombre
		ajaxLoad(1);
	})
	
	
	//PARA MODAL AGREGAR-----------------------------------------------------------------------------------------
	$("#btn_nuevoProducto").click(function(){
		$("#modalAgregarProducto").modal("show");//la funcion modal es parte deun script de bootstrap
		$("#msg_ajax_register").html("");
		$("#formAgregarProducto").trigger("reset");//limpiamos formulario
		$("#modalAgregarProducto").find(".modal-body #selectSubSeccion").html("");
	})
	
	$("#modalAgregarProducto").find(".modal-body #selectSeccion").change(function(){
		if($(this).find("option:selected").val()==""){
			$("#modalAgregarProducto").find(".modal-body #selectSubSeccion").html("");
		}else{
			cargarSelectSubseccionModal("modalAgregar",$(this).find("option:selected").val(),"");
		}
	})
	$("#inputPrecioProducto").on('input',function(){//solo permite numeros y remplaza la coma por punto
		this.value = this.value.replace(/[^0-9,.]/g, '').replace(/,/g, '.');
	})
	$("#formAgregarProducto").submit(function(e){
		e.preventDefault();
		//agregarProducto($(this).serialize());
		var formData= new FormData(this);
		agregarProducto(formData);
		/*const data = $(this).serializeArray();//Puedes utilizar serializeArray() para evitar una cadena preparada para GET ( Como dijo @Jonathan Orta ). Esto te regresará algo raro, por lo que debes parsearlo a un objeto más estructurado. Te dejo un ejemplo, espero te puedas guiar
    	var objData = {};
    	data.forEach( o => objData[ o.name ] = o.value );
		console.log(objData);*/
		//agregarProducto(objData);
	})
	//--------------------------------------------------------------------------------------------------
	//PARA EL MODAL EDITAR PRODUCTO-------------------------------------------------------------------------------

	$("#modalEditarProducto").on('show.bs.modal',function(event){
		var button = $(event.relatedTarget);
		var id=button.data('id');
		var nombre=button.data('nombre');
		var descrip=button.data('descrip');
		var precio=button.data('precio');
		var cantidad=button.data('cantidad');
		var img=button.data('img');
		var secc=button.data('secc');
		var subsecc=button.data('subsecc');
		var estado=button.data('estado');
		
		var modal= $(this)
		modal.find('.modal-title').text('Actualizar producto. Código: ' + id );
		modal.find('.modal-body #inputIdProducto').val(id);
		modal.find('.modal-body #inputNombreProducto').val(nombre);
		modal.find('.modal-body #inputDescripProducto').val(descrip);
		modal.find('.modal-body #inputPrecioProducto').val(precio);
		modal.find('.modal-body #inputCantidadProducto').val(cantidad);
		//modal.find('.modal-body #inputImgProducto').val(img);
		modal.find('.modal-body #label_img_editar').html("Imagen: <br> Su imagen actual es <strong>"+img+"</strong>");
		modal.find(".modal-body #selectSeccion option:contains("+secc+")").prop("selected",true);
		cargarSelectSubseccionModal("modalEditar",modal.find(".modal-body #selectSeccion option:selected").val(),subsecc);
		//
		modal.find(".modal-body #selectEstadoProducto option[value="+estado+"]").prop("selected",true);
	})
	
	$("#modalEditarProducto").find(".modal-body #selectSeccion").change(function(){
		cargarSelectSubseccionModal("modalEditar",$(this).find("option:selected").val(),"");
	})
	
	$("#formEditarProducto").submit(function(e){
		e.preventDefault();
		var formData= new FormData(this);
		editarProducto(formData);
		$("#modalEditarProducto").modal("hide");
	})
	//-----------------------------------------------------------------------------------------------------------
	//PARA ELIMINAR PRODUCTO------------------------------------------------------------------------------------
	$(document).on('click','.btn-delete',function(){
		Swal.fire({
			title: '¿Seguro que quiere eliminar este producto?',
			text: "Producto codigo : "+ $(this).data("id"),
			type:'warning',
			showConfirmButton: true,
			confirmButtonText:"SI",
			confirmButtonColor: "#DD6B55",
			showCancelButton: true,
			cancelButtonText:"NO",
			cancelButtonColor: "#209dd8",
		}).then((result)=>{
			if(result.value){
				eliminarProducto($(this).data("id"));
			}
		})
	})
	//-------------------------------------------------------------------------------------------------------
	$(document).on('click', '.paginacion li a', function(evt) {//se hace asi cuando el html no esta por defecto en este caso lo inserta el ajax
        evt.preventDefault();
		
		pageSelected=$(this).data('page');
		
		if($(".txt-search-nom").val()==""){
		   ajaxLoad($(this).data('page'));
		 }else{
			ajaxLoadporNombre($(this).data('page')); 
		 }
      });
	
	$("#seccion-produc").change(function(e){
		e.preventDefault;
		$(".txt-search-nom").val("");
		ajaxLoad(1);
	})
	
	$(".txt-search-nom").keyup(function(e){
		e.preventDefault;
		$("#seccion-produc option[value='Todos']").prop("selected",true);//selecciona el select en "todos"
		ajaxLoadporNombre(1);
	})
	
	$(document).on('dblclick','.table-crud tbody tr',function(e){//para ver la informacion de los productos
		e.preventDefault();
		mostrarInfoP($(this).attr("data-producto"));
	})
	
	
});

//FUNCIONES-----------------------------------------------------------------------------------------------------------
	function agregarProducto(datosform){
		
		$.ajax({
			type:"POST",
			url:'../../controler/crud_catalogo.php',
			//data:datosform+"&accion=agregarProducto",
			data: datosform,
			cache:false,
	    	contentType:false,
	    	processData:false,
			success: function(response){
				$("#msg_ajax_register").html(response);
				$("#formAgregarProducto").trigger("reset");//limpiamos formulario
				$("#selectSubSeccion").html("");
				ajaxLoad(1);
			},error : function(xhr, status) {
				alert('Disculpe, existió un problema');
			}
		})
	}
	
	function editarProducto(datosform){
		$.ajax({
			type:"POST",
			url:'../../controler/crud_catalogo.php',
			data:datosform,
			cache:false,
	    	contentType:false,
	    	processData:false,
			dataType:"json",
			success: function(response){
				var icon="";
				if(response[0]=="Error"){
					icon="error";
				}else{
					icon="success";
				}
				Swal.fire({
					title: response[0],
					type:icon,
					text:response[1],
					toast:true,
					timer:1500,
					position:'top-end',
					confirmButtonText: 'OK',
				})
				ajaxLoad(1);
			},error : function(xhr, status) {
				alert('Disculpe, existió un problema');
			}
		})
	}
	function eliminarProducto(id){
		$.ajax({
			type:"POST",
			url:"../../controler/crud_catalogo.php",
			data:{accion:"eliminarProducto",id:id},
			success:function(response){
				Swal.fire({
					text: response,	
					timer:3000,
					background:'#93cf95',
					backdrop:false,
					padding:'1rem',
					position: 'top',
					showConfirmButton: false,
				})
				ajaxLoad(1);
			}
		})
	}

	function cargarSelectSubseccionModal(modal,idsecc,opSelected){
		$.ajax({
			type:"POST",
			url:'../../controler/crud_catalogo.php',
			data:{cargar:"cargar_subseccion",seccion:idsecc},
			dataType:"json",
			success:function(response){
				var optionSubSec="";
				for(var i=0;i<response.length; i++){
					if(opSelected==""){
						optionSubSec+="<option value='"+response[i]["id"]+"'>"+response[i]["nombre"]+"</option>";
					}else{
						if(response[i]["nombre"]==opSelected){
							optionSubSec+="<option value='"+response[i]["id"]+"' selected>"+response[i]["nombre"]+"</option>";
						}else{
							optionSubSec+="<option value='"+response[i]["id"]+"'>"+response[i]["nombre"]+"</option>";
						}
					}
				}
				if(modal=="modalAgregar"){
					$("#modalAgregarProducto").find(".modal-body #selectSubSeccion").html(optionSubSec);
				}else if(modal=="modalEditar"){
					$("#modalEditarProducto").find(".modal-body #selectSubSeccion").html(optionSubSec);
				}
			}
		})
	}
	
	function mostrarInfoP(id){
		$.ajax({
			type:"POST",
			url:'../../controler/crud_catalogo.php',
			data:{accion:"mostrarInfoProducto",id_producto:id},
			dataType:"json",
			success: function(response){
				var info_p =JSON.parse(JSON.stringify(response));
				var modal_info="<table class='info_producto_content table'><tr><td>Id:</td><td>"+info_p["id"]+"</td></tr><tr><td>Nombre:</td><td>"+info_p["nombre"]+"</td></tr><tr><td>Decripcion:</td><td>"+info_p["descrip"]+"</td></tr><tr><td>Precio:</td><td>"+info_p["precio"]+"</td></tr><tr><td>Cantidad:</td><td>"+info_p["cantidad"]+"</td></tr><tr><td>Imagen:</td><td><img src='../../imgs/catalogo/"+info_p["img"]+"'></td></tr><tr><td>Seccion:</td><td>"+info_p["seccion"]+"</td></tr><tr><td>SubSeccion:</td><td>"+info_p["subseccion"]+"</td></tr><tr><td>Estado:</td><td>"+info_p["estado"]+"</td></tr></table>";
				Swal.fire({
					title: 'Info Producto',
					html: modal_info,
					padding:'3rem',
					allowOutsideClick:false,
					confirmButtonText: 'OK',
					confirmButtonColor: '#1bad35'
				})
			}
		});
	}
	
	function cargarSelect(){//CARGA EL SELECT Y CREA LA TABLA POR PRIMERA VEZ
		$.ajax({
			type:"POST",
			url:'../../controler/crud_catalogo.php',
			data: {cargar:"cargar_select"},
			dataType:"json",
			success: function(response){
				var options="<option value='Todos' selected>Todos</option>";
				var options2="<option value='' selected></option>";
				var options3="";
				var options4="";
				for(var i=0;i<response.length;i++){
					options+="<option value='"+response[i]["id"]+"'>"+response[i]["nombre"]+"</option>";
					options2+="<option value='"+response[i]["id"]+"'>"+response[i]["nombre"]+"</option>";//select seccion del modal agregar
					options3+="<option value='"+response[i]["id"]+"'>"+response[i]["nombre"]+"</option>";
					options4+="<li>"+response[i]["nombre"]+"</li>"
				}
				$("#seccion-produc").html(options);//select de la tabla crud
				$("#modalAgregarProducto").find(".modal-body #selectSeccion").html(options2);//select seccion del modal agregar product
				$("#modalEditarProducto").find(".modal-body #selectSeccion").html(options3);//select seccion del modal editar product
				$("#modalCrearSeccion").find(".modal-body .secciones-content ul").html(options4);
				ajaxLoad(1);

			},error : function(xhr, status) {
				alert('Disculpe, existió un problema');
			}
		
		});
	}
	
	function ajaxLoadPorEstado(page){//para crear la tbla por estado(creo q lo cree por las puras)
		$.ajax({
			type:"POST",
			url:'../../controler/crud_catalogo.php',
			data:{accion:"mostrarxEstado",
				  pagina:page,
				  estado:$("#selectporEstado").val()},
			dataType:"json",
			beforeSend: function(obj){
				$(".table-crud tbody").html("<tr><td colspan='6'><center><img src='../../imgs/loading6.gif'></center></td></tr>");
			},
			success: function(response){
				mostrar(response);
			},error : function(xhr, status) {
				alert('Disculpe, existió un problema');
			}
		})
	}

	function ajaxLoad(page){//PARA CREAR LA TABLA por seccion y estado
		$.ajax({
			type:"POST",
			url:'../../controler/crud_catalogo.php',
			data: {accion:"mostrarSeccion",
				  pagina:page,
				  seccion:$("#seccion-produc").val(),
				  estado:$("#selectporEstado").val()
				  },
			dataType:"json",
			beforeSend: function(obj){
				$(".table-crud tbody").html("<tr><td colspan='6'><center><img src='../../imgs/loading6.gif'></center></td></tr>");
			},
			success: function(response){
				//alert(response);
				mostrar(response);
				pageSelected=0;

			},error : function(xhr, status) {
				alert('Disculpe, existió un problema');
			}
		
		});
	}
	
	function ajaxLoadporNombre(page){//PARA CREAR LA TABLA POR FILTRO DE NOMBRE DE LOS PRODUCTOS y estado
		$.ajax({
			type:"POST",
			url:'../../controler/crud_catalogo.php',
			data: {accion:"mostrarxNombre",
				  pagina:page,
				  nombre_produc:$(".txt-search-nom").val(),
				  estado: $("#selectporEstado").val()
				  },
			dataType:"json",
			beforeSend: function(obj){
				$(".table-crud tbody").html("<tr><td colspan='6'><center><img src='../../imgs/loading6.gif'></center></td></tr>");
			},
			success: function(response){
				mostrar(response);
				//alert(response);
				pageSelected=0;

			},error : function(xhr, status) {
				alert('Disculpe, existió un problema');
			}
		
		});
	}
	
	function mostrar(response){
		var data =JSON.parse(JSON.stringify(response));
		var tbody="";
		for(var i=0; i<data["productos"].length;i++){
			
			var estadoNombre ="";
			if(data["productos"][i]["estado"] == 1){
				estadoNombre = "<span class='badge bg-success'>Disponible</span>";
			}else{
				estadoNombre = "<span class='badge bg-danger'>No Disponible</span>";
			}
			
			tbody+="<tr data-producto='"+data["productos"][i]["id"]+"'><td>"+data["productos"][i]["id"]+"</td><td>"+data["productos"][i]["nombre"]+"</td><td>"+data["productos"][i]["cantidad"]+"</td><td>"+data["productos"][i]["precio"]+"</td><td>"+data["productos"][i]["subseccion"]+"</td><td>"+estadoNombre+"</td><td class='text-center'><button class='btn-editar btn  btn-info' data-toggle='modal' data-target='#modalEditarProducto' data-id='"+data["productos"][i]["id"]+"' data-nombre='"+data["productos"][i]["nombre"]+"' data-descrip='"+data["productos"][i]["descrip"]+"' data-precio='"+data["productos"][i]["precio"]+"' data-cantidad='"+data["productos"][i]["cantidad"]+"' data-img='"+data["productos"][i]["img"]+"' data-secc='"+data["productos"][i]["seccion"]+"' data-subsecc='"+data["productos"][i]["subseccion"]+"' data-estado='"+data["productos"][i]["estado"]+"'><i class='fa-solid fa-pen-to-square'></i></button><button class='btn-delete btn  btn-danger' data-id='"+data["productos"][i]["id"]+"'><i class='fa-solid fa-trash'></i></button></td></tr>";
		}
		$(".table-crud tbody").html(tbody);
		
		//paginacion------------------------------------------------------------------
		var pag ="<div class='paginacion my-3'><div><p>Total de Registros:"+data["total_registros"]+"</p><p>Mostrando la pagina "+data["num_pagina"]+" de "+data["total_paginas"]+"</p></div><ul class='pagination'>"
		for(var j=1; j<=data["total_paginas"];j++){
			
			if(data["total_paginas"]<=5){
				if(pageSelected==j){
					pag+="<li class='page-item'><a href='#' class='page-link' style='background:rgba(69,71,69,0.30);'  data-page='"+j+"'>"+j+"</a></li>";
				}else{
					pag+="<li class='page-item'><a href='#' class='page-link' data-page='"+j+"'>"+j+"</a></li>";
				}
			}else{
				if(j==1){
					pag+="<li class='page-item'><a href='#' class='page-link' data-page='"+j+"'>"+j+"</a></li>";
					if(pageSelected>=4){
						pag+="<li class='page-item'><span class='page-link'>. . .</span></li>";
					}
				}
				
				if(pageSelected==0 || pageSelected==1 || pageSelected==2){
					if(j>1 && j<4){
						pag+="<li class='page-item'><a href='#' class='page-link' data-page='"+j+"'>"+j+"</a></li>";
					}
				}else if(pageSelected>=3 && pageSelected<data["total_paginas"]-1){
					
					if(j==pageSelected-1 || j==pageSelected || j==pageSelected+1){
						pag+="<li class='page-item'><a href='#' class='page-link' data-page='"+j+"'>"+j+"</a></li>";
					}
					
				}else if(pageSelected==data["total_paginas"]-1){
					if(j==pageSelected-1 || j==pageSelected){
						pag+="<li class='page-item'><a href='#' class='page-link' data-page='"+j+"'>"+j+"</a></li>";
					}
				}else if(pageSelected==data["total_paginas"]){
					if(j==pageSelected-2 || j==pageSelected-1){
						pag+="<li class='page-item'><a href='#' class='page-link' data-page='"+j+"'>"+j+"</a></li>";
					}
				}
				
				if(j==data["total_paginas"]){
					if(pageSelected<=data["total_paginas"]-3){
						pag+="<li class='page-item'><span class='page-link'>. . .</span></li>";
					}
					pag+="<li class='page-item'><a href='#' class='page-link' data-page='"+j+"'>"+j+"</a></li>";
				}
			}
			
		}
		pag+="</ul></div>";
		$(".table-crud tfoot tr td").html(pag);
	}