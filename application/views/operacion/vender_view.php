<?php $producto = $this->producto_model->obtener_productos()->result(); 
	  $sucursal = $this->session->userdata('numero_sucursal');
	  $vendedores = $this->usuario_model->obtener_usuarios()->result();
?>
<div class="container">
	<h2 class="text-center">Vender Producto</h2>
	<div class="row">
		<div class="hidden-xs col-sm-1 col-md-2 col-lg-3"></div>
		<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
			<form class="form-horizontal" method="post" action="<?php echo base_url('index.php/operacion/recibir_datos'); ?>">
			  <fieldset>
			    <legend></legend>
			    <div class="form-group">
			      <label for="producto" class="col-lg-2 control-label">Producto</label>
			      <div class="col-lg-10">
			        <select style="width: 100%;" class="producto" name="producto" id="producto">
			        <?php foreach ($producto as $row) {  
			        	if($row->id_sucursal == $sucursal){
			        	?>
			        	<option value="<?php echo $row->codigo; ?>"><?php echo $row->codigo; ?></option>
			        <?php }} ?>
			        </select>
			      </div>
			    </div>
			    <div class="form-group">
			      <label for="vendedor" class="col-lg-2 control-label">Vendedor</label>
			      <div class="col-lg-10">
			        <select style="width: 100%;" class="producto" name="vendedor" id="vendedor">
			        <?php foreach ($vendedores as $row) {  
			        	?>
			        	<option value="<?php echo $row->id; ?>"><?php echo ucwords($row->nombre); ?></option>
			        <?php } ?>
			        </select>
			      </div>
			    </div>
			    <div class="form-group">
			      <label for="cantidad" class="col-lg-2 control-label">Cantidad</label>
			      <div class="col-lg-10">
			        <input type="number" min="1"  class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad del producto">
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
		$('.producto').select2({
			language: "es"
		});
		$('#send').submit(function(event) {
			event.preventDefault();
		});
		var input = $("<input>").attr('type', 'hidden').attr('name' , 'operacion').val('vender');
		$('form').append($(input));
		$('#cantidad').focusin(function(event) {
			$('#mensaje').remove();
		});
		// si es menor a la cantidad que tenemos VENDER!
		codigo = '#producto';
		var total;
		$('#send').unbind().click(function(event) {
			console.log('clic en enviar');
			$('#mensaje').remove();
			if(!$('#cantidad').val()){
				$('#cantidad').after('<span id="mensaje" class="text-danger">Debe especificar una cantidad</span>')	;
			}else{
				if(parseInt($('#cantidad').val()) > 0 ){
					$.ajax({
						type: "post",
						url: "<?php echo base_url('index.php/operacion/ajaxCantidadProducto'); ?>",
						cache: false,
						data: 'codigo_producto=' + $('#producto option:selected').text(),
						success: function(resp){
							total = parseInt(resp);
							if (total < parseInt($('#cantidad').val())){
								$('#cantidad').after('<span id="mensaje" class="text-danger">La cantidad especificada supera el total en stock</span>');
							}else{
								$('form').submit();
							}
						},
						error: function(){
							console.log("Se produjo un error de comunicación con el servidor");
						}
					});
				}else{
					$('#cantidad').after('<span id="mensaje" class="text-danger">La cantidad debe ser mayor a 1</span>')	;
				}
			}
				
				
			
		});
	});
</script>