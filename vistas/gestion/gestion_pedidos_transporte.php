<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Gestion Transporte</title>
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
	<script src="../../js/gestion_transporte.js"></script>
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
			<h1>Gestión Transporte</h1>
			<div class="buscador-transportista">
				
				<select class="form-select my-3" id="transportistasConPedido"></select>
				<button class="btn btn-primary" id="btn-pedidosTransportista">Buscar</button>
			</div>
			<hr>
			<div class="table-trasnporte-content my-4">
				<h5>Sus Pedidos Asignados</h5>
				<div class="col-md-auto">
					<div class="table-responsive">
						<table class="table table-sm table-bordered bg-white" id="table-pedidosTrasnportista">
							<thead>
								<tr><th>Código</th><th>Código Cliente</th><th>Peso</th><th><input type="checkbox" class="check-general" disabled></th><th>Acciones</th></tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
				<div id="content-btn-marcarsalida">
					
				</div>
				
			</div>
			
		</div>
	</main>
</body>
</html>