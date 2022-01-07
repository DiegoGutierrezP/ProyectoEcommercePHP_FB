// JavaScript Document
$(document).ready(function(){
	consultaDash();
	consultaPedidosRecientes();
	consultaTopProductos();
	
})

function consultaDash(){
	$.ajax({
		type:"POST",
		url:"../../controler/dash_controller.php",
		data: {accion:"cardsDash"},
		dataType:"json",
		success: function(response){
				
			$("#c-pe .info .number").attr('data-count',response["entregados"]);
			$("#c-tp .info .number").attr('data-count',response["pendientes"]);
			$("#c-pro .info .number").attr('data-count',response["totalprod"]);
			$("#c-cli .info .number").attr('data-count',response["totalcli"]);
			
			$('.number').each(function() {
			  var $this = $(this),
				  countTo = $this.attr('data-count');

			  $({ countNum: $this.text()}).animate({
				countNum: countTo
			  },
			  {
				duration: 5000,
				easing:'linear',
				step: function() {
				  $this.text(Math.floor(this.countNum));
				},
				complete: function() {
				  $this.text(this.countNum).css("scale","1.5");
				 	setTimeout(function(){$this.css("scale","1")},300);
				}

			  });  

			});
			
		},error : function(xhr, status) {
				alert('Disculpe, existió un problema');
		}
	})
}

function consultaPedidosRecientes(){
	$.ajax({
		type:"POST",
		url:"../../controler/dash_controller.php",
		data: {accion:"getPedidosRecientes"},
		//dataType:"json",
		success: function(response){
				
		$("#table-pedidos-recientes tbody").html(response);
			//alert(response);
			
		},error : function(xhr, status) {
				alert('Disculpe, existió un problema');
		}
	})
}

function consultaTopProductos(){
	$.ajax({
		type:"POST",
		url:"../../controler/dash_controller.php",
		data: {accion:"getTopProductos"},
		//dataType:"json",
		success: function(response){
				
		$("#table-productos-top tbody").html(response);
			
		},error : function(xhr, status) {
				alert('Disculpe, existió un problema');
		}
	})
}