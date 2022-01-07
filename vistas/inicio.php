<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Fabercastell</title>
	<link rel="stylesheet" href="../css/style_inicio.css">
	<link rel="stylesheet" href="../css/style-footer-cliente.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="../js/detalle_cuenta.js"></script>
	<script src="../js/inicio.js"></script>
	
	
</head>
	<?php
		session_set_cookie_params(["SameSite" => "None"]); //none, lax, strict
		session_set_cookie_params(["Secure" => "true"]); //false, true
		session_set_cookie_params(["HttpOnly" => "true"]); //false, true
		session_start();
	?>
<body>
	<?php  include_once("header_cliente.php") ?>
	<!--<div class="hero_banner">
				
	</div>-->
	<div class="container-slider-hero">
		<div class="slider-hero" id="slider-hero">
			<div class="slider-section-hero" style="background-image: url('../imgs/ecologia-fabercastel.jpg')">
				<div class="texto-hero">
					<h1>Ecología</h1>
					<p>Cada año se plantan alrededor de 300,00 futuros árboles en los bosques de la empresa.</p>
					<a href="#seccion-ecologia">Conoce mas.</a>
				</div>
			</div>
			<div class="slider-section-hero" style="background-image: url('../imgs/produccion-fabercastel.jpg')">
				<div class="texto-hero">
					<h1>Producción</h1>
					<p>Sabemos que los lápices se han estado produciendo desde el siglo XVI. Los viejos métodos de producción manual han sido constantemente mejorados.</p>
					<a href="#seccion-produccion">Conoce mas.</a>
				</div>
			</div>
			<div class="slider-section-hero" style="background-image: url('../imgs/teinda-catlaogo-fabercastel2.jpg')">
				<div class="texto-hero">
					<h1>Visita nuestro Cátalogo Online</h1>
					<p></p>
					<a href="catalogo.php">Ir a Cátalogo.</a>
				</div>
			</div>
			<div class="slider-section-hero" style="background-image: url('../imgs/Stein_Faber-Castell.jpg')">
				<div class="texto-hero">
					<h1>Conócenos</h1>
					<p>Faber-Castell es una fábrica de útiles escolares y una de las empresas alemanas más antiguas, al haber sido fundada en 1761.</p>
					<a href="#seccion-historia">Saber mas.</a>
				</div>
			</div>
		</div>
		<div class="slider-btn btn-slider-hero-rigth" id="btn-right-hero">&#62;</div>
		<div class="slider-btn btn-slider-hero-left" id="btn-left-hero">&#60;</div>
	</div>
	<main>
		<section class="seccion-info info-historia" id="seccion-historia" >
			<div class="contenedor">
				<div class="info-historia1">
					<div class="img-historia">
						<img src="../imgs/historia-fabercastel.jpg">
					</div>
					<div class="contenido-historia">
						<h2 class="titulo-historia">Historia</h2>
						<p>Los fabricantes de lápices fueron registrados por primera vez en la ciudad imperial de Nuremberg alrededor del año 1660. Muchos artesanos establecieron sus talleres en las villas cercanas, pero especialmente en Stein, justo dentro del Marquesado de Ansbach. En este lugar, los artesanos no tenían controles tan estrictos como en Nuremberg, así que contaban con una ventaja competitiva.
						Uno de ellos fue el fabricante de gabinetes Kaspar Faber. Al principio el trabajó para comerciantes locales, pero en su tiempo libre producía lápices por su cuenta. En poco tiempo fue tan exitoso que pudo establecer su propio negocio. A partir de este humilde inicio se convertiría en una compañía reconocida en todo el mundo.</p>
					</div>
				</div>
				<div class="info-historia2">
					<h2>Las primeras sucursales internacionales</h2>
					<div class="sucursales-content">
						<div>
							<img src="../imgs/img-sucursal1.jpg">
							<p><strong>La sede en Nueva York 1849</strong></p>
							<p>Lothar von Faber cede la gestión de la sucursal a su hermano Eberhard (sentado, tercero desde la derecha). "Eberhard Faber" se convertirá más tarde en una marca separada.</p>
						</div>
						<div>
							<img src="../imgs/img-sucursal2.jpg">
							<p><strong>La sede en París 1845</strong></p>
							<p>Con la sucursal en París fundada en 1855, A.W. Faber tiene una sede en el centro del "mundo elegante".</p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="seccion-info info-ecologia" id="seccion-ecologia">
			<h2>Ecología</h2>
			<div class="contenedor">
				
				<div class="card">
					<img src="../imgs/ecologia1.jpg">
					<p>Una tercera parte de los bosques de la empresa permanecen vírgenes y son el hábitat de alrededor de 660 especies autóctonas de animales y plantas.</p>
				</div>
				<div class="card">
					<img src="../imgs/ecologia2.jpg">
					<p>Gestionamos sosteniblemente 10.000 hectáreas de nuestros propios bosques de pinos, que nos aportan la materia prima para nuestros lápices y cubren alrededor del 86% de nuestra necesidad de madera mundial.</p>
				</div>
				<div class="card">
					<img src="../imgs/ecologia3.jpg">
					<p>Cada año, se plantan alrededor de 300,000 futuros árboles en los bosques de la empresa. Estamos cultivando un camión de madera por hora.</p>
				</div>
				<div class="card">
					<img src="../imgs/ecologia4.jpg">
					<p>Nuestros propios bosques absorben más de 900.000 toneladas de CO2 y neutralizan las emisiones de nuestros centros de producción.</p>
				</div>
			</div>
		</section>
		<section class="seccion-info info-produccion" id="seccion-produccion">
			<div class="contenedor">
				<h2>La producción de lápices a los largo del tiempo</h2>
				<div class="produccion1-content">
					<div class="img-content">
						<img src="../imgs/produccion1.jpg">
					</div>
					<div class="contenido-content">
						<p>Sabemos que los lápices se han estado produciendo desde el siglo XVI. Los viejos métodos de producción manual han sido constantemente mejorados, mecanizados y finalmente automatizados. Sin embargo, el principio básico ha permanecido igual.</p>
					</div>
				</div>
				<div class="produccion2-content">
					<div class="contenido-content">
						<h3>Fábrica de pizarra en Geroldsgrün</h3>
						<p>Lothar von Faber funda una fábrica de pizarra en la pequeña ciudad de Geroldsgrün en la Alta Franconia. Esto marca una nueva adición a la gama, que en ese momento se usaba principalmente en los colegios. Más adelante, la fábrica también servía para la producción de reglas de madera, seguidas de reglas de cálculo.</p>
					</div>
					<div class="img-content"><img src="../imgs/produccion2.jpg"></div>
				</div>
				<div class="produccion3-content">
					<div class="img-content"><img src="../imgs/produccion3.jpg"></div>
					<div class="contenido-content">
						<h3>La construcción de un moderno edificio de producción en Stein, hacia 1925</h3>
						<p>En 1925, el conde Alexander von Faber-Castell comienza a construir un moderno complejo de producción. Esto hace que los procesos de fabricación sean más eficientes y se pueda aumentar la producción. El edificio con su enorme diseño en forma de U todavía se usa hoy para la producción de lápices.</p>
					</div>
				</div>
			</div>
		</section>
		
		<div class="sabiasque-content">
			<div class="titulo"><h2>¿Sabías que..?</h2></div>
			<div class="slide-sabias-que">
				<ul>
					<li><div style="background-image: url('../imgs/img4-slide-inicio.jpg');background-repeat:no-repeat; background-size: cover;"><p>Faber-Castell fabrica más de 2,3 mil millones de lápices de madera al año.</p></div></li>
					<li><div style="background-image: url('../imgs/img1-slide-incio.jpg');background-repeat:no-repeat; background-size: cover;"><p>Faber-Castell produce cerca de 20 metros cúbicos de madera por hora, suficiente para cargar un camión.</p></div></li>
					<li><div style="background-image: url('../imgs/img2-slide-incio.jpg');background-repeat:no-repeat; background-size: cover;"><p>La forma de los lápices de madera se ha cambiado de redondo a hexagonal/triangular porque rodaban constantemente de la mesa.</p></div></li>
					<li><div style="background-image: url('../imgs/img3-slide-inicio.jpg');background-repeat:no-repeat; background-size: cover;"><p>Para su propia producción de lápices, Faber-Castell solo emplea madera de bosques gestionados de forma sostenible.</p></div></li>
				</ul>
			</div>
		</div>
	</main>
	<?php include_once("footer_cliente.php") ?>
	<script src="../js/dinamismo_inicio.js"></script>
</body>
</html>
