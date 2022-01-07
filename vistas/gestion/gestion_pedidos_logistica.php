<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Gestion Logística -  Fabercastel</title>
	<link rel="stylesheet" href="../../css/styleadmin.css">
	<link rel="stylesheet" href="../../css/style_sidebar.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script><!--Para modal boostrap-->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	<!--DATATABLE-->
	<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>-->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
	
	<script src="../../js/sidebar.js"></script>
	<script src="../../js/gestion_logistica.js"></script>
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
			<h1>Gestión Logistica</h1>
			<div class="table-logistica-content">
				<div class="table-responsive">
					<table id="table-logistica" class="table-logistica-pedidos table table-bordered display nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Código</th>
								<th>Usuario</th>
								<th>Fecha</th>
								<th>Acciones</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</main>
</body>

<form id="formAsignarTrans">
	<div class="modal" id="modalAsignarTrans" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title" id="exampleModalLongTitle">Asignar Transportista</h4>
			<button type="button" class="btn" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body mx-3">
			 <h4></h4>
			  <input type="hidden" id="inputIdPedido" name="inputIdPedido" value="">
			<div class="form-group mb-2 row">
				<label class="form-label">Direccion Envío:</label>
				<input type="text" class="form-control" id="campoDireccion" value="" readonly>
			</div>
			<div class="form-group mb-2 row">
				<label class="form-label">Escoger Transportista:</label>
				<select class="form-select" id="selectTransportista" name="TransportistaP" required></select>
			</div>
			 <div id="pedidos-transportista">
			  	<table class="table table-striped">
				 
				</table>
			 </div>
			<div class="form-group mb-2 my-3 row">
				<div class="form-check mx-3">
					<input class="form-check-input" type="checkbox" name="checkListoE" id="checkListoE">
					<label class="form-check-label" >
						¿El pedido ya esta Listo para Enviar?
					</label>
					<p><span id="msg_checkListoE" style="color:red;"></span></p>
				</div>
 			</div>
			  <input type="hidden" value="asignarTranportistaPedido" name="accion">
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