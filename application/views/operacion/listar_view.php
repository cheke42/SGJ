<?php $operacion = $this->operacion_model->obtener_operaciones()->result(); ?>
<div class="container">
	<h2 class="text-center">Operaciones en Productos <?php echo empty($nombre_sucursal) ? '' : 'de ' . $nombre_sucursal;  ?></h2>
	<div class="row">
			<div class="hidden-xs hidden-sm col-md-1 col-lg-1"></div>
			<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
			<br><br>	
				<div class="table-responsive">
				<table id="tablaPersonalizada" class="table">
				  <thead>
				    <tr class="info text-center">
				      <th class="text-center">ID</th>
				      <th class="text-center">Producto</th>
				      <th class="text-center">Tipo de Operación</th>
				      <th class="text-center">Cantidad</th>
				      <th class="text-center">Operador</th>
				      <th class="text-center">Fecha Creación</th>
				      <th class="text-center">Detalle</th>
				    </tr>
				  </thead>
				  <tbody>
					<?php foreach ($operacion as $row){ 
							if($row->id_sucursal == $this->session->userdata('numero_sucursal')){
						?>
						<tr>
							<td class="text-center"><?php echo $row->id; ?></td>
							<td class="text-center"><?php echo $row->codigo_producto; ?></td>
							<td class="text-center"><?php echo $this->operacion_model->nombre_operacion($row->tipo_operacion); ?></td>
							<td class="text-center"><?php echo $row->cantidad; ?></td>
							<td class="text-center"><?php echo $this->usuario_model->obtener_nombre($row->id_operador); ?></td>
							<td class="text-center"><?php echo $row->fecha_operacion; ?></td>
							<td class="text-center"><?php echo $row->detalle; ?></td>	
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