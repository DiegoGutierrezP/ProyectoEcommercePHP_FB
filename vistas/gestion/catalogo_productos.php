<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Gestion productos - Fabercastel</title>
	<link rel="stylesheet" href="../../css/styleadmin.css">
	<link rel="stylesheet" href="../../css/style_sidebar.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
	<!--<link rel="stylesheet" href=" https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script><!--Para modal boostrap-->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	<script src="../../js/sidebar.js"></script>
	<script src="../../js/catalogoProductos.js"></script>
</head>
<body>
	<header>
		<div class="perfil-content">
			<div class="perfil">
				<div>Diego Gutierrez</div>
				<img src="../../imgs/usuario_cliente.png" alt="">
			</div>
		</div>
	</header>
	<?php  include_once("menuadmin.php") ?>
	<main class="main m-catalogo-productos">
	<div class="content-principal">
		<h1>Gestión Productos</h1>
		<div class="crud-content">
			<div class="btn-nuevoP-content">
					<button class="btn btn-primary" id="btn_nuevoProducto"><i class="fa-solid fa-circle-plus"></i> Nuevo Producto</button>
			</div>
			<div class="buscadores-content">
				<div class="buscador-padre">
					<label>Productos en Estado:</label>
					<select class="form-select" id="selectporEstado">
						<option value="todos" selected>Todos</option>
						<option value="1">Disponible</option>
						<option value="0">No Disponible</option>
					</select>
				</div>
				<div class="buscador-hijo">
					<div class="buscador-porNombre"><label >Buscar:</label><input type="text" class="txt-search-nom form-control" placeholder="Nombre del Producto"></div>
					<div class="buscador-porSeccion"><label>Seccion:</label>
						<select id="seccion-produc" class="form-select" name="seccion-produc">
						</select>
					</div>
				</div>
			</div>
			<div class="table-content ">
				<div class="col-md-auto">
					<div class="table-responsive">
						<table class="table-crud table table-striped table-bordered table-hover bg-white">
							<thead>
								<tr ><th>Id</th><th>Nombre</th><th>Cantidad</th><th>Precio S/.</th><th>Subsección</th><th>Estado</th><th>Accion</th></tr>
							</thead>
							<tbody>

							</tbody>
							<tfoot>
								<tr>
									<td colspan="7">
									</td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	</main>
	<!--Modal agregar Producto-->
	<form id="formAgregarProducto">
	<div class="modal" id="modalAgregarProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title" id="exampleModalLongTitle">Agregar Nuevo Producto</h4>
			<button type="button" class="btn" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body mx-3">
			 <div id="msg_ajax_register"></div>
			<div class="form-group mb-2 row">
				<label class="form-label" for="inputNombreProducto">Nombre:</label>
				<input type="text" class="form-control" id="inputNombreProducto" name="nombreP" placeholder="Ingrese nombre del Producto" required>
			</div>
 			<div class="form-group mb-2 row">
				<label class="form-label" for="inputDescripProducto">Descripcion:</label>
				<textarea type="text" class="form-control" id="inputDescripProducto" name="descripP" ></textarea>
			</div>
			<div class="row mb-2">
				<div class="form-group col-6">
					<label class="form-label">Precio:</label>
					<input type="text" id="inputPrecioProducto" class="form-control" name="precioP" required>
				</div>
				<div class="form-group col-6">
					<label class="form-label">Cantidad:</label>
					<input type="number" id="inputCantidadProducto" class="form-control" name="cantidadP" min="1" pattern="^[0-9]+" required>
				</div>
			</div>
			<div class="row mb-2">
				<div class="form-group col-8">
					<label class="form-label">Imagen:</label>
					<input type="file" class="form-control" id="inputImgProducto" accept="image/*" name="imgP" required> 
				</div>
				<div class="form-group col-4">
					<label class="form-label">Estado:</label>
					<select class="form-select" id="selectEstadoProducto" name="estadoP">
						<option value="1">Disponible</option>
						<option value="0">No Disponible</option>
					</select>
				</div>
			</div>
			
			<div class="row mb-2">
				<div class="form-group col-6">
					<label class="form-label">Seccion:</label>
					<select class="form-select" id="selectSeccion" name="seccionP" required></select>
				</div>
				<div class="form-group col-6">
					<label class="form-label">SubSeccion:</label>
					<select class="form-select" id="selectSubSeccion" name="subseccionP" required></select>
				</div>
			</div>
			  <input type="text" name="accion" hidden value="agregarProducto"><!--ACCION PARA EL CONTROLADOR-->
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary">Guardar datos</button>
		  </div>
		</div>
	  </div>
	</div>
	</form>
	<!--Modal modificar/editar producto-->
	<form id="formEditarProducto">
	<div class="modal" id="modalEditarProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title" id="exampleModalLongTitle">Actualizar Producto</h4>
			<button type="button" class="btn" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body mx-3">
			 <div id="msg_ajax_update"></div>
			  <input type="text" id="inputIdProducto" name="idP" hidden>
			<div class="form-group mb-2 row">
				<label class="form-label" for="inputNombreProducto">Nombre:</label>
				<input type="text" class="form-control" id="inputNombreProducto" name="nombreP" placeholder="Ingrese nombre del Producto" required>
			</div>
 			<div class="form-group mb-2 row">
				<label class="form-label" for="inputDescripProducto">Descripcion:</label>
				<textarea type="text" class="form-control" id="inputDescripProducto" name="descripP" ></textarea>
			</div>
			<div class="row mb-2">
				<div class="form-group col-6">
					<label class="form-label">Precio:</label>
					<input type="text" id="inputPrecioProducto" class="form-control" name="precioP" required>
				</div>
				<div class="form-group col-6">
					<label class="form-label">Cantidad:</label>
					<input type="number" id="inputCantidadProducto" class="form-control" name="cantidadP" min="1" pattern="^[0-9]+" required>
				</div>
			</div>
			<div class="row mb-2">
			  	<div class="form-group col-8">
					<label class="form-label" id="label_img_editar">Imagen:</label>
					<input type="file" class="form-control" id="inputImgProducto" accept="image/*" name="imgP"> 
				</div>
				<div class="form-group col-4">
					<label class="form-label">Estado:</label>
					<select class="form-select" id="selectEstadoProducto" name="estadoP">
						<option value="1">Disponible</option>
						<option value="0">No Disponible</option>
					</select>
				</div>
			</div>
			
			<div class="row mb-2">
				<div class="form-group col-6">
					<label class="form-label">Seccion:</label>
					<select class="form-select" id="selectSeccion" name="seccionP" required></select>
				</div>
				<div class="form-group col-6">
					<label class="form-label">SubSeccion:</label>
					<select class="form-select" id="selectSubSeccion" name="subseccionP" required></select>
				</div>
			</div>
			  <input type="text" name="accion" hidden value="editarProducto"><!--ACCION PARA EL CONTROLADOR-->
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
			<button type="submit" class="btn btn-primary">Actualizar datos</button>
		  </div>
		</div>
	  </div>
	</div>
	</form>
</body>
</html>