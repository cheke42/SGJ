<br><br>
<div class="container">
	<h2 class="text-center">Agregar Nuevo Proveedor</h2>
	<div class="row">
		<div class="hidden-xs col-sm-1 col-md-2 col-lg-3"></div>
		<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
			<form class="form-horizontal" method="post" action="<?php echo base_url('index.php/proveedor/recibir_datos'); ?>">
			  <fieldset>
			    <legend></legend>
			    <div class="form-group">
			      <label for="nombre_proveedor" class="col-lg-2 control-label">Nombre</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" id="nombre_proveedor" name="nombre_proveedor" placeholder="Nombre de la categoría">
			      </div>
			    </div>
			    <div class="form-group">
			      <label for="descripcion_proveedor" class="col-lg-2 control-label">Descripción</label>
			      <div class="col-lg-10">
			        <textarea class="form-control" name="descripcion_proveedor" maxlength="800" id="descripcion_proveedor" row="3"></textarea>
			      </div>
			    </div>
			    <div class="form-group">
			      <label for="inputPassword" class="col-lg-2 control-label"></label>
			      <div class="col-lg-10">
			        
			        <div class="checkbox">
			          <label>
			            <input  name="datos_fiscales" type="checkbox"> Posee datos fiscales
			          </label>
			        </div>
			      </div>
			    </div>
			    
			    <div class="form-group text-right">
			      <div class="col-lg-10 col-lg-offset-2">
			       
			        <button id="send" type="button" class="btn btn-default">Guardar >></button>
			      </div>
			    </div>
			  </fieldset>
			</form>
		</div>
		<div class="hidden-xs col-sm-1 col-md-2 col-lg-3"></div>
	</div>
</div>

<script>
	$(document).ready(function() {
		nombre = '#nombre_proveedor';
		$('#send').submit(function(event) {
			event.preventDefault();
		});
		$(nombre).focusin(function(event) {
			$('#mensaje_input').remove();
		});

		$('#send').unbind().click(function(event) {
			$('#mensaje_input').remove();
			if($(nombre).val().length > 0){
				$.ajax({
					type: "post",
					url: "<?php echo base_url('index.php/proveedor/ajax_chequear_existe_proveedor'); ?>",
					cache: false,
					data: 'nombre_proveedor=' + $(nombre).val(),
					success: function(resp){
						if(resp == "existe"){
							$(nombre).after('<span id="mensaje_input" class="text-danger">El proveedor ya existe</span>');
						}else{
							$('form').submit();
						}
					},
					error: function(){
						console.log("Se produjo un error de comunicación con el servidor");
					}
				});	
			}else{
				$(nombre).after('<span id="mensaje_input" class="text-danger">Debe ingresar un nombre</span>');
			}	
			
		});
	});
</script>