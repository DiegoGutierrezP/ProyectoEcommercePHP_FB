<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>DashBoard - Fabercastel</title>
	<!--<link rel="stylesheet" href="../../css/styleadmin.css">-->
	<link rel="stylesheet" href="../../css/style_dashboard.css">
	<link rel="stylesheet" href="../../css/style_sidebar.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="../../js/sidebar.js"></script>
	<script src="../../js/dashboard.js"></script>
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
			<h1>Dashboard</h1>
			
				<div class="content-card">
					<div class="card" id="c-pe">
						<div class="info">
							<p>Pedidos Entregados</p>
							<p class="number" data-count="0">0</p>
						</div>
						<div class="icon" style="background:#93cf95;">
							<i class="fa-solid fa-truck" style="color:green"></i>
						</div>
					</div>
					<div  class="card" id="c-tp">
						<div class="info">
							<p>Pedidos Pendientes</p>
							<p class="number" data-count="0">0</p>
						</div>
						<div class="icon" style="background:#f5d997;">
							<i class="fa-solid fa-box-open" style="color:#e9ab18;"></i>
						</div>
					</div>
					<div  class="card" id="c-pro">
						<div class="info">
							<p>Productos</p>
							<p class="number" data-count="0">0</p>
						</div> 
						<div class="icon" style="background:#efb082;">
							<i class="fa-solid fa-pencil" style="color:#c36019"></i>
						</div>
					</div>
					<div  class="card" id="c-cli">
						<div class="info">
							<p>Clientes</p>
							<p class="number" data-count="0">0</p>
						</div>
						<div class="icon" style="background:#5e87c4;">
							<i class="fa-solid fa-user-group" style="color:#2c4b78"></i>
						</div>
					</div>
				</div>
				<div class="content-tables">
					<div class="table-ventas-content">
						<h3>Pedidos Recientes</h3>
						<table class="table-dash" id="table-pedidos-recientes">
							<thead>
								<tr>
									<td>Fecha</td>
									<td>Cliente</td>
									<td>Metodo Pago</td>
									<td>Total</td>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
						<div class="content-btn-ver">
							<a href="../gestion/gestion_pedidos_almacen.php"><button class="btn-ver-pedidos">Ver Todo</button></a>
						</div>
					</div>
					<div class="table-productos-content">
						<h3>Top Productos</h3>
						<table class="table-dash" id="table-productos-top">
							<tbody>
							</tbody>
						</table>
						
					</div>
				</div>
			
		</div>
	</main>
	
</body>
</html>