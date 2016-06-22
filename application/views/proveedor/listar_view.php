<?php $query = $this->proveedor_model->obtener_proveedores(); ?>

<div class="container">
	<h2 class="text-center">Lista de proveedores</h2>
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
			      <th class="text-center">Mas información</th>
			    </tr>
			  </thead>
			  <tbody>
				<?php foreach ($query->result() as $row){ ?>
					<tr>
						<td class="text-center"><?php echo $row->id; ?></td>
						<td class="text-center"><?php echo $row->nombre; ?></td>
						<td class="text-center"><?php echo $row->fecha_alta; ?></td>
						<?php if($row->datos_fiscales){ ?>
						<td class="text-center"><a href="<?php echo base_url('index.php/proveedor/ver/?id=') . $row->id; ?>" title="Ver toda la información"><span class="glyphicon glyphicon-eye-open"></span></a></td>
						<?php }else{ ?>	
						<td class="text-center"><a href="<?php echo base_url('index.php/proveedor/agregar_fiscales_get/?nombre=') . $row->nombre; ?>" title="Agregar Información"><span class="glyphicon glyphicon-plus"></span></a></td>
						<?php }?>	
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