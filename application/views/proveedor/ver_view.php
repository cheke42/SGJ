<?php 
	$datos = $this->proveedor_model->obtener_datos($id);
	$datos_fiscales = $this->proveedor_model->obtener_datos_fiscales($id);
 ?>

<div class="container">
	<div class="row">
		<div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
		<div id="contenedor" class="col-xs-12 col-sm-12 col-md-10 col-lg-8">
			<br><br>
			<form id="formulario" action="<?php echo base_url('index.php/proveedor/actualizar'); ?>" method="post" class="form-horizontal">
			<fieldset>
				
				<br>
				
				<legend class="text-right">Datos del Proveedor</legend>
				<div class="form-group" id="form-cuit">
				  <label for="id_proveedor" class="col-lg-2 control-label">Identificador</label>
				  <div class="col-lg-10">
				    <input type="number" class="form-control" id="id_proveedor" name="id_proveedor" placeholder="" value="<?php echo $datos->id; ?>" disabled>
				  </div>
				</div>
				<div class="form-group" id="form-cuit">
				  <label for="nombre_referencia" class="col-lg-2 control-label">Nombre</label>
				  <div class="col-lg-10">
				    <input type="text" class="form-control" id="nombre_referencia" name="nombre_referencia" placeholder="" value="<?php echo $datos->nombre; ?>">
				  </div>
				</div>
				<div class="form-group">
				  <label for="estado" class="col-lg-2 control-label"></label>
				  <div class="col-lg-10">
				    
				    <div class="checkbox">
				      <label>
				        <input  name="estado" id="estado" type="checkbox"> Esatado del proveedor
				      </label>
				    </div>
				  </div>
				</div>

				<div class="form-group">
				  <label for="descripcion_proveedor" class="col-lg-2 control-label">Descripción</label>
				  <div class="col-lg-10">
				    <textarea class="form-control" name="descripcion_proveedor" id="descripcion_proveedor" row="3"><?php echo $datos->descripcion; ?></textarea>
				  </div>
				</div>
				
				<?php if ($datos->datos_fiscales == '1') { ?>
					<br>
					<legend class="text-right"> Datos Fiscales</legend>
					<div class="form-group" id="form-cuit" >
					  <label for="cuit" class="col-lg-2 control-label">CUIT</label>
					  <div class="col-lg-10">
					    <input type="text" class="form-control" id="cuit" name="cuit" placeholder=""  disabled value="<?php echo $datos_fiscales->cuit; ?>">
					  </div>
					</div>
					<div class="form-group" id="form-cuit" >
					  <label for="nombre" class="col-lg-2 control-label">Nombre Fiscal</label>
					  <div class="col-lg-10">
					    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="" value="<?php echo $datos_fiscales->nombre; ?>" disabled>
					  </div>
					</div>
					<div class="form-group" id="form-cuit" >
					  <label for="tipo_persona" class="col-lg-2 control-label">Tipo Persona</label>
					  <div class="col-lg-10">
					    <input type="text" class="form-control" id="tipo_persona" name="tipo_persona" placeholder="" value="<?php echo $datos_fiscales->tipo_persona; ?>" disabled>
					  </div>
					</div>
					<?php if ($datos_fiscales->tipo_persona == 'FISICA') { ?>
						<div class="form-group" id="form-cuit" >
						  <label for="tipo_dni" class="col-lg-2 control-label">Tipo DNI</label>
						  <div class="col-lg-10">
						    <input type="text" class="form-control" id="tipo_dni" name="tipo_dni" placeholder="" value="<?php echo $datos_fiscales->tipo_dni; ?>" disabled>
						  </div>
						</div>

						<div class="form-group" id="form-cuit" >
						  <label for="numero_documento" class="col-lg-2 control-label">N° DNI</label>
						  <div class="col-lg-10">
						    <input type="text" class="form-control" id="numero_documento" name="numero_documento" placeholder="" value="<?php echo $datos_fiscales->numero_documento; ?>" disabled>
						  </div>
						</div>
					<?php } ?>
					<div class="form-group" id="form-cuit" >
					  <label for="estado_afip" class="col-lg-2 control-label">Estado</label>
					  <div class="col-lg-10">
					    <input type="text" class="form-control" id="estado_afip" name="estado_afip" placeholder="" value="<?php echo $datos_fiscales->estado; ?>" disabled>
					  </div>
					</div>
					<div class="form-group" id="form-cuit" >
					  <label for="localidad" class="col-lg-2 control-label">Localidad</label>
					  <div class="col-lg-10">
					    <input type="text" class="form-control" id="localidad" name="localidad" placeholder="" value="<?php echo $datos_fiscales->localidad; ?>">
					  </div>
					</div>
					<div class="form-group" id="form-cuit" >
					  <label for="direccion" class="col-lg-2 control-label">Dirección</label>
					  <div class="col-lg-10">
					    <input type="text" class="form-control" id="direccion" name="direccion" placeholder="" value="<?php echo $datos_fiscales->direccion; ?>">
					  </div>
					</div>
					<div class="form-group" id="form-cuit" >
					  <label for="codigo_postal" class="col-lg-2 control-label">Cód. Postal</label>
					  <div class="col-lg-10">
					    <input type="number" class="form-control" id="codigo_postal" name="codigo_postal" placeholder="" value="<?php echo $datos_fiscales->codigo_postal; ?>">
					  </div>
					</div>
				<?php } ?>
				<div class="text-right"><a id="send" type="button" class="btn btn-success" title="">Actualizar</a></div><br><br>
			</fieldset>
			<br>
			
		</div>

		</form>

		<div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
		
	</div>
</div>
<script>
	$(document).ready(function() {
		nombreActual = $('#nombre_referencia').val();
		estado = "<?php echo $datos->estado ?>";
		if (estado == '1'){
			$('#estado').prop('checked', true);
		}else{
			$('#estado').prop('checked', false);	
		}
		id = "<?php echo $datos->id; ?>"
		var input = $("<input>").attr('type', 'hidden').attr('name' , 'id').val(id);
		$('form').append($(input));
		$('#send').hide();
		var botonAgregado = false;
		$('input').keypress(function(event) {
			agregarBotonGuardar();
		});
		$('textarea').keydown(function(event) {
			agregarBotonGuardar();
		});
		$('input').change(function(event) {
			agregarBotonGuardar();
		});

		function agregarBotonGuardar(){
			if(!botonAgregado){
				botonAgregado = true;
				$('#send').show();
			}
		}
		$('#nombre_referencia').focusin(function(event) {
			$('#mensaje_input').remove();
		});
		$('#send').unbind().click(function(event) {
			$('#mensaje_input').remove();
			if(nombreActual != $('#nombre_referencia').val()){
				$.ajax({
					type: "post",
					url: "<?php echo base_url('index.php/proveedor/ajax_chequear_existe_proveedor'); ?>",
					cache: false,
					data: 'nombre_proveedor=' + $('#nombre_referencia').val(),
					success: function(resp){
						if(resp == "existe"){
							$('#nombre_referencia').after('<span id="mensaje_input" class="text-danger">El proveedor ya existe</span>');
						}else{
							$('form').submit();
						}
					},
					error: function(){
						console.log("Se produjo un error de comunicación con el servidor");
					}
				});	
			}else{
				$('form').submit();
			}
		});
	});




</script>