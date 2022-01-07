<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
	<link rel="stylesheet" href="../css/stylepedidoscarrito_cliente.css">
	<link rel="stylesheet" href="../css/style-footer-cliente.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	<script src="../js/detalle_cuenta.js"></script>
	<script src="../js/proceso_pago.js"></script>
</head>

<body>
	<?php
		session_start();
		if(!isset($_SESSION["codusuario"])){
			header("Location:inicio.php");
		}
		include_once("../modelo/conexion.php");
		include_once("../modelo/Manejo_Productos.php");
		include_once("../modelo/Manejo_Usuario.php");
		include_once("../modelo/Manejo_Cliente.php");
		include_once("../modelo/Manejo_DatoClienteEnvio.php");
		$con=Conexion::conexione();
		$manejo_produc= new Manejo_Productos($con);
		$mc= new Manejo_Cliente($con);
		$c=$mc->getInfoCliente($_SESSION["codusuario"]);
		$mdce =  new Manejo_DatoClienteEnvio($con);
	?>
	
	<?php include_once("header_cliente.php") ?>
	
	<main class="main_proceso_pago">
		<div class="contenedor">
			<div class="header_pagos">
				<h2>Proceso de Pago en 3 pasos</h2><h2><img src="../imgs/pagos.PNG"></h2>
			</div>
			<form  id="form_proceso_pago" method="post" >
				<div class="contenedor2">
					<section class="proceso_pago">
						<div class="paso1"><input class="btn_procesos_pagos" id="paso1" type="button" value=" 1.-Direccion y Datos de Envio">
							<input type="hidden" name="idCliente" value="<?php echo $c->getId() ?>">
							<table class="table_paso1">
								<thead>
									<tr>
										<td colspan="2">
											<select id="selectDatosEnvio" name="selectDatosEnvio">
												<option value="" selected>Elija un opción</option>
												<?php
													$datosEn=$mdce->getNumeroDatosCliente($c->getId());
													if(count($datosEn)):
														$cont=1;
														foreach($datosEn as $d): ?>

															<option value="<?php echo $d->getId() ?>">Datos de Envio <?php echo $cont++ ?></option>	

													<?php endforeach; ?>

												<?php endif; ?>

												<option value="newDatos" data-idCli="<?php echo $c->getId() ?>">Ingresar Nueva Dirección</option>
											</select>
										</td>
									</tr>
								</thead>
								<tbody id="formulario">
								</tbody>
								<tfoot>
									<tr><td><input class="btn_paso1" id="btn_paso1" type="button" value="Continuar"></td></tr>
								</tfoot>
							</table>
						</div>
						<div class="paso2"><input class="btn_procesos_pagos" id="paso2" type="button" value=" 2.- Metodo de Envío">
							<table class="table_paso2">
								<tr><td>Selecciona tus metodos de envío</td></tr>
								<tr><td><input id="radio_menvio" name="metodo_envio" checked type="radio" data-precio="25" value="transporte">Envio por nuestro personal de transporte - s/.25</td></tr>
								<tr><td><input id="radio_menvio" name="metodo_envio" type="radio" data-precio="0" value="tienda">Recojo en tienda</td></tr>
								<tr><td><input class="btn_paso2" type="button" value="Continuar"></td></tr>
							</table>
						</div>
						<div class="paso3"><input class="btn_procesos_pagos" id="paso3" type="button" value=" 3.- Metodo de Pago">
							<table  class="table_paso3">
								<tr><td>Selecciona un medio de pago</td></tr>
								<tr><td><input name="medio_pago" checked type="radio" value="tarjeta">Tarjeta Credito o Debito</td><td class="col_imagen" rowspan="4"><div class="gif_procepago"><img  src="../imgs/loading2.gif"><p>Procesando Pago...</p></div></td></tr>
								<tr><td><input name="medio_pago" type="radio" value="paypal">Paypal</td></tr>
								<tr><td><input name="medio_pago" type="radio" value="transferencia">Transferencia bancaria</td></tr>
								<tr><td ><input  class="btn_finalizar_pedido" type="button"  name="finalizar_pedido" value="Finalizar Pedido"  ></td></tr>
							</table>
						</div>
					
					</section>
					<section class="resumen_pedido">
						<table  class="tabla_resumen">
							<tr><td colspan="2" ><b>Resumen del Pedido</b></td></tr>
							<?php $items=json_decode($_COOKIE["carrito_cookie"],true); $totalcarrito=0;?>
							<?php for($i=0;$i<count($items);$i++): ?>
								<?php $p=$manejo_produc->getProductosPorId($items[$i]["id"]); $totalitem=$p->getPrecio()*$items[$i]["cantidad"]; $totalcarrito+=$totalitem;?>
								<tr><td><?php echo $p->getNombre() ?></td><td><?php echo $totalitem ?></td></tr>
							<?php endfor?>
							<tr><td><b>Total Pedido:</b></td><td><input type="text" name="total_pedido" hidden value="<?php echo $totalcarrito ?>"><?php echo $totalcarrito ?></td></tr>
							<tr><td><b>Envio:</b></td><td id="precio_envio">0</td></tr>
							<tr><td><b>Total a Pagar:</b></td><td id="total_a_pagar"><?php echo $totalcarrito ?></td></tr>
						</table>
					</section>
				
				</div>
			</form>
		</div>
	</main>
	<?php include_once("footer_cliente.php") ?>
	
</body>
</html>