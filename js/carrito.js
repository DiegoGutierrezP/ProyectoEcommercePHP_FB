// JavaScript Document
$(document).ready(function(){
	$("#proceder_pago").click(function(){
		if($(this).attr("data-sesion")==""){
			Swal.fire({
				title: 'Logueo Necesario',
				text: 'Debe logearse al sistema para proceder al pago',
				type: 'warning',
				confirmButtonText: 'OK'
									
			})
		}else{//validacion de las cantidades del producto del carrito con nuestro stock y si el producto sigue disponible
			
			$.ajax({
				type:"POST",
				url:"../controler/gestion_carrito.php",
				data:{consulta:"consulta_ajax_carrito"},
				//dataType:"json",
				success: function(response){
					if(response.length==0){
						location.href="proceso_pago.php";
						//alert("no exceso");
					}else{
						/*var data =JSON.parse(JSON.stringify(response));
						var html="<div>Su carrito <strong>excede en cantidades</strong> a nuestro stock en los productos: ";
						for(var i=0;i<data.length;i++){
							html+="<p>"+data[i]+"</p>"
						}
						html+="</div>";*/
						Swal.fire({
							html: response,
							type: 'warning',
							confirmButtonText: 'OK',
							allowOutsideClick:false		
						}).then((result) => {
							if(result.value){
								location.href ="carrito_cliente.php";
							}
						})
						
					}
				},error : function(xhr, status) {
					alert('Disculpe, existió un problema');
				}
			})
			
		}/*else{
			location.href="proceso_pago.php";
		}*/
	})
})