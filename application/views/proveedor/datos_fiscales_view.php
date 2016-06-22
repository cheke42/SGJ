<div class="container">
	<div class="hidden-xs col-sm-1 col-md-1 col-lg-2"></div>
	<div class="col-xs-12 col-sm-10 col-md-10 col-lg-8">
		<h2>Obtener Datos Fiscales: <?php echo $nombre_proveedor; ?></h2>
		<fieldset>
		<form class="form-horizontal" action="<?php echo base_url('index.php/proveedor/recibir_datos_fiscales'); ?>" method="post">
		<legend></legend>
		<div class="form-group" id="form-cuit">
		  <label for="cuit" class="col-lg-2 control-label">CUIT</label>
		  <div class="col-lg-10">
		    <input type="number" class="form-control" id="cuit" name="cuit" placeholder="Ingrese el Cuit">
		  </div>
		</div>
		<div class="text-right">
			<a   id="luego" href="<?php echo base_url('index.php/proveedor/listar') ?>" class="btn btn-default" type="button"> << Realizar mas tarde</a>
			<a  id="buscar" class="btn btn-info" type="button">Buscar de nuevo</a>
			<a  id="obtener_datos" class="btn btn-success" type="button">Obtener datos</a>
		</div>
<input type="text" name="nombre_referencia" style="display: none" value="<?php echo $nombre_proveedor; ?>">

		</form>
		</fieldset>
		<br>
		<br>
		<br>
		<br>
	</div>
	<div class="hidden-xs col-sm-1 col-md-1 col-lg-2"></div>
	
</div>
<script>

//VER EL TEMA DE CUANTO APRIETAN ENTER!!
	$(document).ready(function() {
		$("#buscar").hide();
		obtenerDatos = '#obtener_datos';
		cuit = '#cuit'
		mensajeError = '#mensaje_error';
		$('form').on('keyup keypress', function(e) {
		  var keyCode = e.keyCode || e.which;
		  if (keyCode === 13) { 
		    e.preventDefault();
		    return false;
		  }
		});
		$(cuit).focusin(function(event) {
			$(mensajeError).remove();
		});
		$(obtenerDatos).unbind().click(function(event) {
			$('.anexo').remove();
			$("#buscar").hide();
			$('#send').remove();
			datosAfip();
		});


		$('#buscar').unbind().click(function(event) {
			$('#send').hide();
			$(this).hide();
			$('.anexo').remove();
			$(cuit).prop('readonly', false);
			$(obtenerDatos).show();
			
			$(cuit).val("");
		});


		function datosAfip(){
			numCuit = $(cuit).val();
			$.get("https://soa.afip.gob.ar/sr-padron/v2/persona/"+ numCuit,function(data){
				if(data.success){
					$(mensajeError).remove();
					var myMap = new Map();
					myMap.set('tipoPersona', data['data'].tipoPersona);
					myMap.set('estadoClave', data['data'].estadoClave);
					myMap.set('nombre', data['data'].nombre);
					myMap.set('tipoDocumento', data['data'].tipoDocumento);
					myMap.set('numeroDocumento', data['data'].numeroDocumento);
					myMap.set('direccion', data['data'].domicilioFiscal.direccion);
					myMap.set('localidad', data['data'].domicilioFiscal.localidad);
					myMap.set('codPostal', data['data'].domicilioFiscal.codPostal);
					myMap.set('fechaInscripcion', data['data'].fechaInscripcion);
					cargar_datos(myMap);
					$(cuit).prop('readonly', true);
					$(obtenerDatos).before('<button id="send" class="btn btn-success" type="submit">Guardar Datos</button>');
					$("#buscar").show();
					$(obtenerDatos).hide();
					$("#luego").hide();

				}else{
					$(mensajeError).remove();
					$(cuit).after('<span id="mensaje_error" class="text-danger">El CUIT no es válido</span>');
				}				
			});
			
		}


		function cargar_datos(datos){
			if(datos.get('tipoPersona') == "FISICA"){
				$('#form-cuit').after(nuevo_form('Código Postal', datos.get('codPostal') , 'codigo_postal'));
				$('#form-cuit').after(nuevo_form('Dirección', datos.get('direccion') , 'direccion'));
				$('#form-cuit').after(nuevo_form('Localidad', datos.get('localidad') , 'localidad'));
				$('#form-cuit').after(nuevo_form('Fecha de inscripción', datos.get('fechaInscripcion') , 'fecha_inscripcion'));
				$('#form-cuit').after(nuevo_form('N° DNI', datos.get('numeroDocumento') , 'numero_documento'));
				$('#form-cuit').after(nuevo_form('Tipo DNI', datos.get('tipoDocumento') , 'tipo_dni'));
				$('#form-cuit').after(nuevo_form('Estado', datos.get('estadoClave') , 'estado'));
				$('#form-cuit').after(nuevo_form('Nombre', datos.get('nombre') , 'nombre'));
				$('#form-cuit').after(nuevo_form('Tipo Persona', datos.get('tipoPersona') , 'tipo_persona'));

			}else{
				$('#form-cuit').after(nuevo_form('Código Postal', datos.get('codPostal') , 'codigo_postal'));
				$('#form-cuit').after(nuevo_form('Dirección', datos.get('direccion') , 'direccion'));
				$('#form-cuit').after(nuevo_form('Localidad', datos.get('localidad') , 'localidad'));
				$('#form-cuit').after(nuevo_form('Fecha de inscripción', datos.get('fechaInscripcion') , 'fecha_inscripcion'));
				$('#form-cuit').after(nuevo_form('Estado', datos.get('estadoClave') , 'estado'));
				$('#form-cuit').after(nuevo_form('Nombre', datos.get('nombre') , 'nombre'));
				$('#form-cuit').after(nuevo_form('Tipo Persona', datos.get('tipoPersona') , 'tipo_persona'));
			}
			
		}

		function nuevo_form(nombre, valor, id){
			return '<div style="margin-top: 5px" class="form-group anexo" id="form-'+ id +'"><label for="'+ id +'" class="col-lg-2 control-label">'+ nombre +'</label><div class="col-lg-10"><input type="text" class="form-control" id="'+ id +'"  name="'+ id +'" value="'+ valor +'" readonly></div>'
		}


	//fin documento listo
	});
</script>