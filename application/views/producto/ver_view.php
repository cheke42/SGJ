<?php 
	$datos = $this->producto_model->obtener_datos($codigo);
	$todas_categorias = $this->categoria_model->obtener_categorias()->result();
	$categorias_anteriores = $this->producto_model->obtener_categorias($codigo)->result();
	function seleccionado($categorias_anteriores, $id_categoria){
		foreach ($categorias_anteriores as $row) {
			if ($row->id_categoria == $id_categoria){
				echo 'selected="selected"';	
			}
		}
	} 
 ?>

 <div class="container">
 	<div class="row">
		<div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
		<div id="contenedor" class="col-xs-12 col-sm-12 col-md-10 col-lg-8">
			
		</div>
		<div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>

 		
 	</div>
	<div class="row">
		<div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
		<div id="contenedor" class="col-xs-12 col-sm-12 col-md-10 col-lg-8">
			<br><br>
			<form id="formulario" action="<?php echo base_url('index.php/producto/actualizar'); ?>" method="post" class="form-horizontal">
			<fieldset>
				
				<br>
				
				<legend class="text-right">Producto </legend>
				<ul class="nav nav-tabs">
			  <li class="active"><a data-toggle="tab" href="#home">Descripción Producto</a></li>
			  <li><a data-toggle="tab" href="#menu1">Código de barra</a></li>
			</ul>

			<div class="tab-content">
			  <div id="home" class="tab-pane fade in active">
			  <br><br>
			    <div class="form-group">
			      <label for="codigo" class="col-lg-2 control-label">Código</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo $datos->codigo; ?>" disabled>
			      </div>
			    </div>
			    <div class="form-group">
			      <label for="nombre" class="col-lg-2 control-label">Nombre</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $datos->nombre ?>">
			      </div>
			    </div>
			    <div class="form-group">
			      <label for="categorias" class="col-lg-2 control-label">Categorías</label>
			      <div class="col-lg-10">
			        <select style="width: 100%;" class="categorias" multiple="multiple" name="categorias[]" id="categorias">
			        	<?php foreach ($todas_categorias as $row) {  ?>
			        		<option value="<?php echo $row->id; ?>" <?php seleccionado($categorias_anteriores, $row->id); ?>>
			        			<?php echo $row->nombre; ?>
			        		</option>
			        	<?php } ?>				    
			        </select>
			      </div>
			    </div>
			    <div class="form-group">
			      <label for="precio" class="col-lg-2 control-label">Precio</label>
			      <div class="col-lg-10">
			        <input type="number" class="form-control" id="precio" name="precio" value="<?php echo $datos->precio ?>" step="0.01">
			      </div>
			    </div>
			    <div class="form-group">
			      <label for="cantidad" class="col-lg-2 control-label">Cantidad</label>
			      <div class="col-lg-10">
			        <input type="number" class="form-control" id="cantidad" name="cantidad" value="<?php echo $datos->cantidad ?>">
			      </div>
			    </div>
			    <div class="form-group">
			      <label for="descripcion" class="col-lg-2 control-label">Descripción</label>
			      <div class="col-lg-10">
			        <textarea class="form-control" name="descripcion" maxlength="600" id="descripcion" row="3"><?php echo $datos->descripcion ?></textarea>
			      </div>
			    </div>
			    <div class="text-right"><a id="send" type="button" class="btn btn-success" title="">Actualizar</a></div><br><br>
			  </div>
			  <div id="menu1" class="tab-pane fade">
			    <br>
			    <br>
			    <div class="text-center">
			    	<img src="/assets/lib/barcode.php?text=<?php echo $datos->codigo ?>&print=true&size=70" alt="<?php echo $datos->codigo ?>"><br>
			    	<a href="<?php echo (base_url('index.php/producto/barcode?codigo=') . $datos->codigo); ?>" target="_blank" class="btn btn-default">Imprimir Código</a>
			    </div>
			  </div>
			  
			</div>
			</fieldset>
			<br>
			
		</div>

		</form>

		<div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
		
	</div>
</div>

<script>
	$(document).ready(function() {
		id = "<?php echo $datos->codigo; ?>"
		var input = $("<input>").attr('type', 'hidden').attr('name' , 'codigo').val(id);
		$('form').append($(input));
		$('.categorias').select2({
			language: "es"
		}).on("change", function(e){
			agregarBotonGuardar();
		});

		$('#send').hide();
		var botonAgregado = false;
		function agregarBotonGuardar(){
			if(!botonAgregado){
				botonAgregado = true;
				$('#send').show();
			}
		}
		$('input').keypress(function(event) {
			agregarBotonGuardar();
		});
		$('textarea').keydown(function(event) {
			agregarBotonGuardar();
		});
		$('input').change(function(event) {
			agregarBotonGuardar();
		});
		$('#send').unbind().click(function(event) {
			$('form').submit();
		});



	});
</script>