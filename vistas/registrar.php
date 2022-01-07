<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	<style>
		body{
			font-family: "Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, "sans-serif";
			margin: 0;
			padding: 0;
			background: url("../imgs/naranjaverde.jpg");
			background-position: center center;
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size: cover;
		}
		.registrar{
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			width: 400px;
			/*padding: 20px;*/
			background: rgba(0,0,0,.5);
			box-sizing: border-box;
			box-shadow: 0 15px 25px rgba(0,0,0,.5);
			border-radius: 10px;
			color: white;
			
		}
		.registrar form{
			margin-left: 30px;
			
		}
		.registrar img{
			width: 400px;
		}
		h1{
			text-align: center;
			margin-bottom: 40px;
		}
		.inputtxt{
			width: 90%;
			border: 0;
			border-bottom: 1px solid white;
			outline: 0;
			background: transparent;
			color: white;
			font-size: 15px
		}
		.btn_registrar{
			width: 130px;
			height: 30px;
			margin-left: 50%;
			transform: translateX(-50%);
			margin-top: 20px;
			background:#279B3C;
			font-size: 15px;
			color: white;
		}
		.label{
			font-size: 20px;
		}
		.campos{
			margin-top:20px;
		}
		.selectSexo{
			width: 100px;
			background:transparent;
			margin-left: 20px;
			color: white;
			font-size: 15px;
		}
	</style>
</head>

<body>

	<div class="registrar">
		<img src="../imgs/fabercastel.png">
		<h1>Registrate</h1>
		<form id="form_registroCliente"  method="post">
			
			<p class="campos"><label class="label" for="user">Nombre de Usuario: </label><br><br>
				<input type="text" class="inputtxt" name="user" required>
			</p>
			<!---->
			<p class="campos"><label class="label" >Nombres: </label><br><br>
				<input type="text" class="inputtxt" name="nombres" required>
			</p>
			<p class="campos"><label class="label" >Apellidos: </label><br><br>
				<input type="text" class="inputtxt" name="apellidos" required>
			</p>
			<p class="campos"><label class="label">Sexo:</label>
				<select class="selectSexo" name="selectSexo" required>
					<option value="Hombre">Hombre</option>
					<option value="Mujer">Mujer</option>
				</select>
			</p>
			<!---->
			<p class="campos"><label class="label" for="mail">Email: </label><br><br>
				<input type="text" class="inputtxt" name="mail" required>
			</p>
		  	<p class="campos"><label class="label" for="pass">Contraseña: </label><br><br>
				<input type="password" class="inputtxt" name="pass" required>
			</p>
			<p><input type="submit" value="Registrarse" class="btn_registrar" name="registrar"></p>
		</form>
	</div>
	<script>
		$(document).ready(function(){
			$("#form_registroCliente").submit(function(e){
				e.preventDefault();
				$.ajax({
					type: "POST",
					url: '../controler/registrarCliente.php',
					data: $(this).serialize(),
					success: function(response){
						var titulo="";
						var text="";
						if(response=="success"){
							title="Exito";
							text="Usted se ha registrado correctamente";
						}else{
							title="Error";
							text="No pudimos registrarte";
						}
						Swal.fire({
							title: titulo,
							text: text,
							type: response,
							confirmButtonText: 'OK',
							grow:"row",
							allowOutsideClick:false
						}).then((result) => {
							if(result.value){
								if(response=="success"){
									location.href ="../vistas/login.html"; 
								}else{
									location.href ="../vistas/registrar.php"; 
								}		
							}
						})
					}
				})
			})
		})
	</script>
</body>
</html>