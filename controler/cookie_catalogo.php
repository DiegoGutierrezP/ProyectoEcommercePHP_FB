<?php
	$cookie_options= array (
                'expires' => time()+60*5,
                'path' => '/',
                'secure' => true,     // or false
                'httponly' => true,    // or false
                'samesite' => 'None' // None || Lax  || Strict
                );
	
	//setcookie("subsecc",$_GET["subsecc"],time()+60*5,"/");
	setcookie("subsecc",$_GET["subsecc"],$cookie_options);
	header("Location:../vistas/catalogo.php")
?>