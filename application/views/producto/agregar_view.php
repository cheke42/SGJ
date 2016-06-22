<?php $categorias = $this->categoria_model->obtener_categorias()->result(); ?>
<br>
<br>
<div class="container">
	<h2 class="text-center">Agregar Producto</h2>
	<div class="row">
		<div class="hidden-xs col-sm-1 col-md-2 col-lg-3"></div>
		<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
			<form class="form-horizontal" method="post" action="<?php echo base_url('index.php/producto/recibir_datos'); ?>">
			  <fieldset>
			    <legend></legend>
			    <div class="form-group">
			      <label for="codigo" class="col-lg-2 control-label">Código</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código del producto">
			      </div>
			    </div>
			    <div class="form-group">
			      <label for="nombre" class="col-lg-2 control-label">Nombre</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del producto">
			      </div>
			    </div>
			    <div class="form-group">
			      <label for="categorias" class="col-lg-2 control-label">Categorías</label>
			      <div class="col-lg-10">
			        <select style="width: 100%;" class="categorias" multiple="multiple" name="categorias[]" id="categorias">
			        <?php foreach ($categorias as $row) {  ?>
			        	<option value="<?php echo $row->id; ?>"><?php echo $row->nombre; ?></option>
			        <?php } ?>
			        </select>
			      </div>
			    </div>
			    <div class="form-group">
			      <label for="precio" class="col-lg-2 control-label">Precio</label>
			      <div class="col-lg-10">
			        <input type="number" class="form-control" id="precio" name="precio" placeholder="Precio del producto (decimal con coma)" step="0.01">
			      </div>
			    </div>
			    <div class="form-group">
			      <label for="cantidad" class="col-lg-2 control-label">Cantidad</label>
			      <div class="col-lg-10">
			        <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad del producto">
			      </div>
			    </div>
			    <div class="form-group">
			      <label for="descripcion" class="col-lg-2 control-label">Descripción</label>
			      <div class="col-lg-10">
			        <textarea class="form-control" name="descripcion" maxlength="600" id="descripcion" row="3"></textarea>
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

		$('.categorias').select2({
			language: "es"
		});

		$('#send').unbind().click(function(event) {
			$('form').submit();
		});
		codigo = '#codigo';
		$('#send').submit(function(event) {
			event.preventDefault();
		});
		$(codigo).focusin(function(event) {
			$('#mensaje_input').remove();
		});

		$('#send').unbind().click(function(event) {
			console.log('clic en enviar');
			$('#mensaje_input').remove();
			if($(codigo).val().length > 0){
				$.ajax({
					type: "post",
					url: "<?php echo base_url('index.php/producto/ajax_chequear_existe_producto'); ?>",
					cache: false,
					data: 'nombre_producto=' + $(codigo).val(),
					success: function(resp){
						if(resp == "existe"){
							console.log("Todo ok");
							$(codigo).after('<span id="mensaje_input" class="text-danger">El código ya existe en la sucursal</span>');
						}else{
							console.log($(codigo).val());
							$('form').submit();
						}
					},
					error: function(){
						console.log("Se produjo un error de comunicación con el servidor");
					}
				});	
			}else{
				$(codigo).after('<span id="mensaje_input" class="text-danger">Debe ingresar un código</span>');
			}	
			
		});

	});

</script>