<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Gestion Almacén -  Fabercastel</title>
	<link rel="stylesheet" href="../../css/styleadmin.css">
	<link rel="stylesheet" href="../../css/style_sidebar.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script><!--Para modal boostrap-->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	<!--DATATABLE-->

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
	
	<script src="../../js/sidebar.js"></script>
	<script src="../../js/gestion_almacen.js"></script>
	
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
	<main class="main">
		<div class="content-principal">
			<h1>Gestión Almacen</h1>
			<div class="gestion-almacen-ops ">
				<ul>
					<li class="active-gestion-almacen-op" id="mostrar-tabla-empaquetado">Pedidos por Empaquetar</li>
					<li id="mostrar-tabla-reporte">Pedidos con problemas</li>
				</ul>
			</div>
			<div  class="tablePedidosAlmacen-content">
				<div class="table-empaquetado-content">
					<div class=" table-responsive">
						<table id="table-almacen-empaquetado" class="table-almacen-pedidos table table-bordered display nowrap" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Código</th>
									
									<th>Cliente</th>

									<th>Fecha</th>

									<th>Total</th>

									<th>Metodo Pago</th>
									<th>Acciones</th>
								</tr>
							</thead>


						</table>
					</div>
				</div>
				<!---->
				<div class="table-reporte-problemas-content esconder-table-content">
					<div class="table-responsive">
						<table id="table-almacen-problemas" class="table-almacen-pedidos table table-bordered display nowrap" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Código</th>
									
									<th>Cliente</th>

									<th>Fecha</th>

									<th>Total</th>

									<th>Metodo Pago</th>
									<th>Acciones</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</main>
	
</body>
<form id="formRepoteProblema">
	<div class="modal" id="modalReporteProblema" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title" id="exampleModalLongTitle">Generar Reporte</h4>
			<button type="button" class="btn" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body mx-3">
			 <h4></h4>
			  <input type="hidden" id="inputIdPedido" name="idPedido" value="">
			  <div class="form-group mb-2 row">
				<label class="form-label" >Motivo:</label>
				<input type="text" class="form-control" id="inputMotivoReporte" name="motivoReporte" required>
				
			</div>
			<div class="form-group mb-2 row">
				<label class="form-label" >Escriba las observaciones:</label>
				<textarea rows="8" type="text" class="form-control" id="textObservacionesReporte" name="observacionReporte" required></textarea>
				<span id="alertmsj_textObservacionesReporte" style="color:red;"></span>
			</div>
			  <div class="form-group mb-2 row">
				<label class="form-label" >Imagen: (opcional)</label>
				<input type="file" class="form-control" id="inputImgReporte" accept="image/*" name="imgObservacionReporte" > 
			</div>
			  <input type="text" name="accion" hidden value="generarReporte"><!--ACCION PARA EL CONTROLADOR-->
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
			<button type="submit" class="btn btn-primary">Generar</button>
		  </div>
		</div>
	  </div>
	</div>
</form>
	<!---->
<form id="formPesoPedido">
	<div class="modal" id="modalPesoPedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title" id="exampleModalLongTitle">Marcar como Empaquetado</h4>
			<button type="button" class="btn" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body mx-3">
			  <h5>Pedido código : <span></span></h5>
			  <input type="hidden" id="idPedidoPeso" name="idPedidoPeso" value="">
			 <div class="form-group mb-2 my-3 row">
				<label class="form-label" >Ingrese el Peso del Pedido : *</label>
				 <div class="row">
					 <div class="col-6">
						 <input type="text" class="form-control" name="pesoPedido" id="inputPesoPedido" required>
					 </div>
					 <div class="col-6">
						 <select class="form-select" name="selectUnidad">
							<option value="Kg.">Kilogramos</option>
							 <option value="gr.">Gramos</option>
						 </select>
					 </div>					 
				 </div>
			 </div>
			 <div class="form-group mb-2 my-3 row">
				<div class="form-check mx-3">
					<input class="form-check-input" type="checkbox" name="checkEmpaquetado" id="checkEmpaquetado">
					<label class="form-check-label" >
						¿El pedido ya esta empaquetado?
					</label>
					<p><span id="msg_checkEmpaquetado" style="color:red;"></span></p>
				</div>
 			</div>
			  <input type="text" name="accion" hidden value="marcarEmpaquetado"><!--ACCION PARA EL CONTROLADOR-->
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
			<button type="submit" class="btn btn-primary">Listo</button>
		  </div>
		</div>
	  </div>
	</div>
</form>
</html>