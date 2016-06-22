<?php $productos = $this->producto_model->obtener_productos()->result(); ?>
<div class="container">
	<h2 class="text-center">Lista de Productos <?php echo empty($nombre_sucursal) ? '' : 'de ' . $nombre_sucursal;  ?></h2>
	

		<div class="row">
			<div class="hidden-xs hidden-sm col-md-1 col-lg-1"></div>
			<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
			<br><br>	
				<div class="table-responsive">
				<table id="tablaPersonalizada" class="table">
				  <thead>
				    <tr class="info text-center">
				      <th class="text-center">Código</th>
				      <th class="text-center">Nombre</th>
				      <th class="text-center">Cantidad</th>
				      <th class="text-center">Precio</th>
				      <th class="text-center">Mas información</th>
				    </tr>
				  </thead>
				  <tbody>
					<?php foreach ($productos as $row){ 
							if($row->id_sucursal == $this->session->userdata('numero_sucursal')){
						?>

						<tr>
							<td class="text-center"><?php echo $row->codigo; ?></td>
							<td class="text-center"><?php echo $row->nombre; ?></td>
							<td class="text-center"><?php echo $row->cantidad; ?></td>
							<td class="text-center"><?php echo $row->precio; ?></td>
							<td class="text-center"><a href="<?php echo base_url('index.php/producto/ver/?codigo=') . $row->codigo; ?>" title="Ver toda la información"><span class="glyphicon glyphicon-eye-open"></span></a></td>
								
						</tr>
					<?php }} ?>
				  </tbody>
				</table> 
		        </div>
				<br>
				<br>
				<br>
			</div>
			<div class="hidden-xs hidden-sm col-md-1 col-lg-1"></div>
		</div>


	
</div>

<script>
	$(document).ready(function() {
		$('#tablaPersonalizada').DataTable();
	});
</script>