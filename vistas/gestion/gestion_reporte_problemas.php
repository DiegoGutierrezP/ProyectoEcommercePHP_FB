<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
	<link rel="stylesheet" href="../../css/styleadmin.css">
	<link rel="stylesheet" href="../../css/style_sidebar.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script><!--Para modal boostrap-->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	<script src="../../js/sidebar.js"></script>
	<script src="../../js/solucionReporte.js"></script>
</head>

<body>
	<?php
		include_once("../../modelo/conexion.php");
		include_once("../../modelo/Manejo_ReporteProblema.php");
		$con=Conexion::conexione();
		$mrp = new Manejo_ReporteProblema($con);
		$con=null;
	?>
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
			<h1>Gestionar Reporte</h1>
			
			<div class="reporte-content">
				<h5><b>Para el pedido <?php echo $_GET["idpedido"] ?></b></h5>
				<?php $report=$mrp->getReporte($_GET["idpedido"]); ?>
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td>Fecha del Reporte:</td>
							<td><?php echo $report->getFechaReporte() ?></td>
						</tr>
						<tr>
							<td>Area:</td>
							<td><?php echo $report->getArea() ?></td>
						</tr>
						<tr>
							<td>Motivo:</td>
							<td><?php echo $report->getMotivo() ?></td>
						</tr>
						<tr>
							<td>Reporte:</td>
							<td><?php echo $report->getReporte() ?></td>
						</tr>
						<tr>
							<td>Imagen:</td>
							<td><img src="../../imgs/reportes/problemas/<?php echo $report->getImg() ?>"></td>
						</tr>
						<tr>
							<td>Estado:</td>
							<td><?php echo $report->getEstado() ?></td>
						</tr>
					</tbody>
				</table>
				<div class="btn-volver-content my-2">
					<a class="btn btn-secondary" href="gestion_pedidos_almacen.php">Volver</a>
				</div>
			</div>
			<hr class="my-3">
			<div class="solucion-reporte-content">
				<div class="form-solucionario">
				<h3>Solucionar</h3>
				<form id="formSolucionReporte">
					<input type="hidden" name="idPedido" value="<?php echo $report->getIdPedido() ?>">
					<input type="hidden" name="idReporte" value="<?php echo $report->getId() ?>">
					<div class="form-group mb-2 row">
						<label class="form-label" >Reporte de Solucion:</label>
						<textarea rows="10" type="text" class="form-control" name="reportSolucion" required></textarea>
					</div>
					<div class="form-group mb-2 row">
						<div class="form-group col-6">
							<label class="form-label" >Imagen:(opcional)</label>
							<input type="file" class="form-control" name="imgSolucion" > 
						</div>
						<div class="form-group col-6">
							<label class="form-label" >Solucion:</label>
							<select class="form-select" name="selectSolucion" id="selectSolucion">
								<option value="" selected>Seleccione una opcion..</option>
								<option value="solucionado">Solucionado</option>
								<option value="pedido cancelado">Pedido Cancelado</option>
							</select>
							<span id="msg_selectSolucion" style="color:red;"></span>
						</div>
					</div>
					 <div class="form-group mb-2 my-3 col-6">
						<label class="form-label" >Ingrese el Peso del Pedido : </label>
						 <div class="row">
							 <div class="col-6">
								 <input type="text" class="form-control" name="pesoPedido" id="inputPesoPedido">
								 <p><span id="msg_pesoPedido" style="color:red;"></span></p>
							 </div>
							 <div class="col-6">
								 <select class="form-select" name="selectUnidad">
									<option value="Kg.">Kilogramos</option>
									 <option value="gr.">Gramos</option>
								 </select>
							 </div>					 
						 </div>
			 		</div>
					 <div class="form-group">
						<div class="form-check">
						  <input class="form-check-input" type="checkbox" name="checkEmpaquetado" id="checkEmpaquetado">
						  <label class="form-check-label" >
							¿El pedido ya esta empaquetado?
						  </label>
						<p><span id="msg_checkEmpaquetado" style="color:red;"></span></p>
						</div>
 					</div>
					<div class="my-3">
					<input type="submit" class="btn btn-primary" value="Resolver">
					</div>
				</form>
				</div>
			</div>
		</div>
		
	</main>
</body>
</html>