<?php $producto = $this->producto_model->obtener_productos()->result(); 
	  $sucursal = $this->session->userdata('numero_sucursal');
?>
<div class="container">
	<h2 class="text-center">Agregar stock</h2>
	<div class="row">
		<div class="hidden-xs col-sm-1 col-md-2 col-lg-3"></div>
		<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
			<form class="form-horizontal" method="post" action="<?php echo base_url('index.php/operacion/recibir_datos'); ?>">
			  <fieldset>
			    <legend></legend>
			    <div class="form-group">
			      <label for="codigo" class="col-lg-2 control-label">Producto</label>
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
		$('.producto').select2({
			language: "es"
		});
		var input = $("<input>").attr('type', 'hidden').attr('name' , 'operacion').val('agregar');
		$('form').append($(input));

		$('#send').click(function(event) {
			$('#mensaje').remove();
			if(!$('#cantidad').val()){
				$('#cantidad').after('<span id="mensaje" class="text-danger">Debe especificar una cantidad</span>')	;
			}else{
				if(parseInt($('#cantidad').val()) > 0 ){
					$('form').submit();
				}else{
					$('#cantidad').after('<span id="mensaje" class="text-danger">La cantidad debe ser mayor a 1</span>')	;
				}
			}
		});
	});
</script>