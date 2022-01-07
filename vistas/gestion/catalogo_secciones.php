<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Gestion Secciones - Fabercastel</title>
	<link rel="stylesheet" href="../../css/styleadmin.css">
	<link rel="stylesheet" href="../../css/style_sidebar.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script><!--Para modal boostrap-->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	<script src="../../js/sidebar.js"></script>
	<script src="../../js/catalogoSeccion.js"></script>
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
	<?php include_once("menuadmin.php") ?>
	<main class="main m-catalogo-secciones">
		<div class="content-principal">
		
			<h1>Gestionar Secciones y Subsecciones</h1>
		
		
			<div class="btn-crearSeccion-content">
				<button class="btn btn-primary" id="btn_nuevaSeccion"><i class="fa-solid fa-circle-plus"></i> Crear Seccion</button>
			</div>
			<div class="tables-content">
				<div class="seccion-table-content">
					<!--<div class="col-md-auto">-->
						<div class="table-responsive">
							<table class="table-crud-secciones table table-striped table-bordered table-hover bg-white">
								<thead>
									<tr><th colspan="4">Secciones</th></tr>
									<tr ><th>Id</th><th>Nombre</th><th>Mostrar</th><th>Accion</th></tr>
								</thead>
								<tbody>

								</tbody>
								<tfoot>
									<tr>
										<td colspan="4">
											<p>Seleccione al menos 2 secciones para mostrar en el catalogo</p> <button class="btn btn-outline-primary" id="btn_guardarSeccionesaMostrar">Guardar</button>
										</td>
									</tr>
								</tfoot>
							</table>
                       </div>
					<!--</div>-->
				</div>
				<hr class="my-4">
				<div class="subseccion-table-content">
					<!--<div class="col-md-auto">-->
						<div class="table-responsive">
							<table class="table-crud-subsecciones table table-striped table-bordered table-hover bg-white">
								<thead>
									<tr><th colspan="3"><label>Seleccione una Sección:</label><select class="form-select" id="select_secciones"></select></th></tr>
									<tr><th colspan="2">Subsecciones</th><th><button class="btn btn-secondary" id="btn_nuevaSubseccion" disabled><i class="fa-solid fa-plus"></i> Añadir Subsección</button></th></tr>
									<tr><th>Id</th><th>Nombre</th><th>Accion</th></tr>
								</thead>
								<tbody>
									
								</tbody>
								<tfoot>
									<tr>
										<td colspan="3">
										</td>
									</tr>
								</tfoot>
							</table>
						</div>
					<!--</div>-->
				</div>
			</div>
		</div>
	
	</main>
</body>
	<!--MODALS-->
	<!---->
	<form id="formCrearSeccion">
	<div class="modal" id="modalCrearSeccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title" id="exampleModalLongTitle">Crear Sección</h4>
			<button type="button" class="btn" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body mx-3">
			<div class="form-group mb-2 row">
				<label class="form-label">Ingrese Nombre de la nueva Sección:</label>
				<div class="row">
					<div class="col-8">
						<input type="text" class="form-control" id="inputNombreSeccion" name="nombreSecc"  placeholder="Ingrese nombre de la sección" required>
						<span id="mensaje_btnsgte" style="color:red"></span>
					</div>
					<div class="col-4">
						<input type="button" class="btn btn-outline-secondary btn-sm" id="btn_siguiente" value="Siguiente">
					</div>
				</div>
			</div>
			<div class="form-group mb-2 row">
				  <label class="form-label" id="subtitulo">Ingrese al menos una subseccion para crear la sección:</label>
				<div class="row">
					<div class="col-8">
					<input type="text" class="inputSubsecc form-control mb-2" id="txtSubsecc1" name="nombreSubsecc1" disabled>
					<input type="text" class="inputSubsecc form-control mb-2" id="txtSubsecc2" name="nombreSubsecc2" disabled>
					<input type="text" class="inputSubsecc form-control mb-2" id="txtSubsecc3" name="nombreSubsecc3" disabled>
					<input type="text" class="inputSubsecc form-control mb-2" id="txtSubsecc4" name="nombreSubsecc4" disabled>
						<span id='mensaje_inputSubsecc' style="color:red"></span>
					</div>
				</div>
		 	</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
			<button type="submit" class="btn btn-primary">Crear</button>
		  </div>
		</div>
	  </div>
	</div>
	</form>
	<!---->
	<form id="formEditarSeccion">
		<div class="modal" id="modalEditarSeccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title" id="exampleModalLongTitle">Actualizar Sección</h4>
			<button type="button" class="btn" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body mx-3">
			  <input type="text" id="inputIdSeccion" name="idSecc" hidden>
			<div class="form-group mb-2 row">
				<label class="form-label" >Nombre de la Sección:</label>
				<input type="text" class="form-control" id="inputNombreSeccionEdit" name="nombreSecc">
				<span id="alertmsj_inputNombreSeccionEdit" style="color:red;"></span>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
			<button type="submit" class="btn btn-primary">Guardar</button>
		  </div>
		</div>
	  </div>
	</div>
	</form>
	<!---->
	<form id="formCrearSubseccion">
		<div class="modal" id="modalCrearSubseccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h4 class="modal-title" id="exampleModalLongTitle">Crear Subsección para <span id="nomSeccionRTitulo"></span></h4>
				<button type="button" class="btn" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body mx-3">
				  <input type="hidden" id="idSeccionRelacionada" name="idSeccRelacionada">
				<div class="form-group mb-2 row">
					<label class="form-label" >Nombre de la Subsección:</label>
					<input type="text" class="form-control" id="inputNombreNewSubseccion" name="nombreNewSubsecc">
					<span id="alertmsj_inputNombreNewSecc" style="color:red"></span>
				</div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-primary">Guardar</button>
			  </div>
			</div>
		  </div>
		</div>
	</form>
	<!---->
	<form id="formEditarSubseccion">
		<div class="modal" id="modalEditarSubseccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h4 class="modal-title" id="exampleModalLongTitle">Actualizar Subsección</h4>
				<button type="button" class="btn" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body mx-3">
				  <input type="hidden" id="idSubseccion" name="idSubseccion">
				<div class="form-group mb-2 row">
					<label class="form-label" >Nombre de la Subsección:</label>
					<input type="text" class="form-control" id="inputNombreSubseccionEdit" name="nombreSubseccionEdit">
					<span id="alertmsj_inputNombreSubseccionEdit" style="color:red"></span>
				</div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-primary">Actualizar</button>
			  </div>
			</div>
		  </div>
		</div>
	</form>
</html>