<br><br>
<div class="container">
	<h2 class="text-center">Agregar Nueva Categoría</h2>
	<div class="row">
		<div class="hidden-xs col-sm-1 col-md-2 col-lg-3"></div>
		<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
			<form class="form-horizontal" method="post" action="<?php echo base_url('index.php/categoria/recibir_datos'); ?>">
			  <fieldset>
			    <legend></legend>
			    <div class="form-group">
			      <label for="nombre_categoria" class="col-lg-2 control-label">Nombre</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" placeholder="Nombre del proveedor">
			      </div>
			    </div>
			    <div class="form-group">
			      <label for="descripcion_categoria" class="col-lg-2 control-label">Descripción</label>
			      <div class="col-lg-10">
			        <textarea class="form-control" name="descripcion_categoria" maxlength="800" id="descripcion_categoria" row="3"></textarea>
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
		nombre = '#nombre_categoria';
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
					url: "<?php echo base_url('index.php/categoria/ajax_chequear_existe_categoria'); ?>",
					cache: false,
					data: 'nombre_categoria=' + $(nombre).val(),
					success: function(resp){
						if(resp == "existe"){
							$(nombre).after('<span id="mensaje_input" class="text-danger">La categoría ya existe</span>');
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