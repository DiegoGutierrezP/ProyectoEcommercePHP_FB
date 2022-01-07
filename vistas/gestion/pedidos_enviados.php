<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Pedidos Enviados</title>
	<link rel="stylesheet" href="../../css/styleadmin.css">
	<link rel="stylesheet" href="../../css/style_sidebar.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script><!--Para modal boostrap-->
	 
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	<!--DATATABLE-->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>
	
	<script src="../../js/sidebar.js"></script>
	<script src="../../js/pedidos_enviados.js"></script>
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
			<h1>Pedidos en Envio</h1>
			<div class="buscador-transportista">
				
				<select class="form-select my-3" id="transportistasConPedidoSalida"></select>
				<button class="btn btn-primary" id="btn-pedidosSalidaTransportista">Buscar</button>
			</div>
			<hr>
			<div class="table-trasnporte-content my-4">
				<h5>Sus Pedidos en Envio</h5>
				<div class="col-md-auto">
					<div class="table-responsive">
						<table class="table table-sm table-bordered bg-white" id="table-pedidosEnEnvio">
							<thead>
								<tr><th>Código</th><th>Código Cliente</th><th>Peso</th><th>Acciones</th></tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
		</div>
	</main>
</body>
<!--MODALS-->	
<form id="formPedidoEntregado">
	<div class="modal" id="modalPedidoEntregado" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title" id="exampleModalLongTitle">Registrar Constancia</h4>
			<button type="button" class="btn" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body mx-3">
			<h4 class="titulo"></h4>
			  <input type="hidden" id="codigoPedido" name="codPedido" value="">
			  <input type="hidden" id="codigoTrans" name="codTrans" value="">
			  <input type="hidden" name="accion" value="registrarConstanciaEntrega">
			<div class="form-group mb-2 row">
				<label class="form-label" >Descripción breve:</label>
				<textarea rows="2" type="text" class="form-control" name="descripConstancia" required></textarea>
			</div>
			 <div class="form-group mb-2 row">
				<label class="form-label" >Imagen Constancia:</label>
				<input type="file" class="form-control" accept="image/*" name="imgConstancia"> 
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
	
</html>