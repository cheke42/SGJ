<?php $query = $this->categoria_model->obtener_categorias(); ?>


<div class="container">
	<h2 class="text-center">Lista de Categorías</h2>
	<div class="row">
		<div class="hidden-xs hidden-sm col-md-1 col-lg-1"></div>
		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
		<br><br>	
			<div class="table-responsive">
			<table id="tablaPersonalizada" class="table">
			  <thead>
			    <tr class="info text-center">
			      <th class="text-center">ID</th>
			      <th class="text-center">Nombre</th>
			      <th class="text-center">Fecha Alta</th>
			      <th class="text-center">Descripción</th>
			    </tr>
			  </thead>
			  <tbody>
				<?php foreach ($query->result() as $row){ ?>
					<tr>
						<td class="text-center"><?php echo $row->id; ?></td>
						<td class="text-center"><?php echo $row->nombre; ?></td>
						<td class="text-center"><?php echo date('Y-m-d', strtotime($row->fecha_alta)); ?></td>
						<td class="text-center"><?php echo $row->descripcion; ?></td>
					</tr>
				<?php } ?>
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