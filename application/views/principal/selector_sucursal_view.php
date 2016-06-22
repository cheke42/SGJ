<style>
	.sucursal:hover{
		background-color: #EEE;
		cursor: pointer;
	}
	.sucursal-seleccionada{
		background-color: #DDD;
	}
</style>
<div class="container">
	<div class="row">
		<h2 class="text-center">Selecciones su sucursal</h2>
		<br>
		<div  class="col-lg-2 col-md-1 hidden-sm hidden-xs"></div>
		<div  class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
			<p class="text-center">Recuerde que el número de sucursal que usted selecciones será utilizado para registrar los eventos en el sistema durante su session. Seleccione la opcion adecuada</p>
		</div>
		<div  class="col-lg-2 col-md-1 col-sm-12 hidden-xs"></div>
	</div>
	<div id="selector-sucursales" class="row">

	<br>

		<div class="col-lg-2 col-md-1 hidden-sm hidden-xs"></div>
		<div id="sucursal1" class="col-lg-4 col-md-5 col-sm-6 col-xs-6 sucursal">
			<div class="row text-center">
				<h4>Sucursal España</h4>
				<img style="width: 60%;" src="<?php echo base_url('assets/images/sucursal.png'); ?>" alt="" class="class-responsive">
				<div class="radio text-center">
					<label><input id="opcion1" type="radio" name="sucursal"> </label>
				</div>
			</div>
		</div>
		<div id="sucursal2" class="col-lg-4 col-md-5 col-sm-6 col-xs-6 sucursal">
			<div class="row text-center">
				<h4>Sucursal Kennedy</h4>
				<img style="width: 60%;" src="<?php echo base_url('assets/images/sucursal.png'); ?>" alt="" class="class-responsive">
				<div class="radio text-center">
					<label><input id="opcion2" type="radio" name="sucursal"> </label>
				</div>
			</div>
		</div>
		<div class="col-lg-2 col-md-1 hidden-sm hidden-xs"></div>
	</div>
	<div class="row">
		<br>
		<div class="text-center">
			<a class="btn btn-default" href="<?php echo base_url('index.php/proveedor/listar'); ?>" type="button" id="btn_guardar_sucursal" >Guardar </a>
		</div>
		
		
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#btn_guardar_sucursal').hide();
		var buttonSave = false;
		var numeroSucursal;
		$('#sucursal1').unbind().click(function(event) {
			$('#opcion1').prop('checked', true);
			$('#sucursal1').addClass('sucursal-seleccionada');
			$('#sucursal2').removeClass('sucursal-seleccionada');
			agregarBoton();
			numeroSucursal = 1;
		});
		$('#sucursal2').unbind().click(function(event) {
			$('#opcion2').prop('checked', true);
			$('#sucursal2').addClass('sucursal-seleccionada');
			$('#sucursal1').removeClass('sucursal-seleccionada');
			agregarBoton();
			numeroSucursal = 2;
		});

		function agregarBoton(){
			if (!buttonSave){
				$('#btn_guardar_sucursal').show();
				buttonSave = true;	
			}
		}

		$('#btn_guardar_sucursal').unbind().click(function(event) {
			$.ajax({
					type: "post",
					url: "<?php echo base_url('index.php/log/ajaxGuardarSucursal'); ?>",
					cache: false,
					data: 'numero_sucursal=' + numeroSucursal,
					success: function(resp){
					},
					error: function(){
						console.log("Se produjo un error de comunicación con el servidor");
					}
				});	
		});

		
	});
</script>