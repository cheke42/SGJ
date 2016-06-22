<div class="container">
	
	<?php 
		$datos_usuario = $this->usuario_model->obtener_datos($this->session->userdata('usuario'));
		
	 ?>
	 <br>
	 
	<div class="row">
		<div class="hidden-xs col-sm-1 col-md-2 col-lg-2"></div>
		<div class="col-xs-12 col-sm-10 col-md-8 col-lg-8">
			<form class="form-horizontal">
			  <fieldset>
			    <legend class="text-center">Datos de usuario</legend>
			    <div class="form-group">
			      <label for="username" class="col-lg-3 control-label">Usuario</label>
			      <div class="col-lg-9">
			        <input type="text" class="form-control" id="username" value="<?php echo $datos_usuario->nombre ?>" readonly>
			      </div>
			    </div>
			    <div class="form-group">
			      <label for="fecha_creacion" class="col-lg-3 control-label">Fecha Creación</label>
			      <div class="col-lg-9">
			        <input type="text" class="form-control" id="fecha_creacion" value="<?php echo date("d-m-Y", strtotime($datos_usuario->fecha_creacion)); ?>" readonly>
			      </div>
			    </div>
			    <div class="form-group">
			      <label for="password" class="col-lg-3 control-label">Password</label>
			      <div class="col-lg-9">
			        <input type="password" class="form-control" id="password" value="********" readonly>
			        <p class="text-right"><a class="text-danger btn" data-toggle="modal" data-target="#modalCambiarPassword">Modificar Password</a></p>
			      </div>
			    </div>
			    
			  </fieldset>
			</form>

			
		</div>
		<div class="hidden-xs col-sm-1 col-md-2 col-lg-2"></div>
	</div>

</div>

<div id="modalCambiarPassword" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title text-center">Modificar Contraseña</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="old_password" class="col-lg-3 control-label" focused>Contraseña Actual</label>
          <div class="col-lg-9">
            <input type="password" class="form-control" id="old_password" name="old_password">
          </div>
        </div>
        <div class="form-group">
          <label for="new_password" class="col-lg-3 control-label" focused>Contraseña Nueva</label>
          <div class="col-lg-9">
            <input type="password" class="form-control" id="new_password" name="new_password">
          </div>
        </div>
        <div class="form-group">
          <label for="repeat_new_password" class="col-lg-3 control-label" focused>Repita Contraseña Nueva</label>
          <div class="col-lg-9">
            <input type="password" class="form-control" id="repeat_new_password" name="repeat_new_password">
          </div>
        </div>
		<div class="form-group text-right">
		<br>
			<button id="btn-cambiar" type="button" class="btn btn-primary" style="margin-top: 10px;">Guardar </button>
		</div>
      </div>
  </div>
</div>

<script>
	$(document).ready(function() {
		$('#success-alert').hide();
		var passwordAnteriorCorrecta = false;
		var passwordNuevaCorrecta = false;
		$('#old_password').focusout(function(event) {
			oldPassword = $('#old_password').val();
			usuarioActual = "<?php echo $this->session->userdata('usuario') ?>";
			urlAjax = "<?php echo base_url('index.php/Usuario/ajaxChequear'); ?>";
			$.ajax({
				type: "post",
				url: urlAjax,
				cache: false,
				data: 'password=' + oldPassword,
				success: function(resp){
					if(resp == "correcto"){
						mensajeSpan('old_password_msj','Contraseña Correcta','text-success' , '#old_password');
						passwordAnteriorCorrecta = true;
						//password correcta, verificar si nueva password coincide y guardar
					}else{
						mensajeSpan('old_password_msj','Contraseña incorrecta','text-danger' , '#old_password');
						passwordAnteriorCorrecta = false;
						//password incorrecto, marcar que está mal
					}
				},
				error: function(){
					console.log("Se produjo un error de comunicación con el servidor");
				}
			});			
		});

		$('#old_password').focusin(function(event) {
			$("#old_password_msj").remove();
			passwordAnteriorCorrecta = false;
		});
		//Imprime un mensaje de algun tipo dentro de un span con un identificador despues de el selector que se especifique 
		function mensajeSpan(idSpan, mensaje, tipoMensaje, despuesDe) {
				$('#'+idSpan).remove();
				$(despuesDe).after('<span id="'+ idSpan +'" class="'+ tipoMensaje +'">'+ mensaje +'</span>');
		}

		//verifica si la clave nueva y la clave nueva repetida son iguales
		function passwordNuevasCorrectas(){
			longitudNuevaPassword = $('#new_password').val().length;
			longitudNuevaPasswordRepetida = $('#repeat_new_password').val().length;
			console.log();
			if ((longitudNuevaPassword < 1) || (longitudNuevaPasswordRepetida < 1)) {
				mensajeSpan('repeat_password_msj', 'Por favor ingrese una contraseña nueva', 'text-danger','#repeat_new_password');

				return false;
			}else{
				if($('#new_password').val() == $('#repeat_new_password').val()){
					return true;
				}else{
					mensajeSpan('repeat_password_msj', 'Las claves nuevas ingresadas no coinciden', 'text-danger','#repeat_new_password');
					return false;

				}
			}
		}



		$('#modalCambiarPassword').on('hidden.bs.modal',function(){
			clearinputs();
		});

		function clearinputs(){
			$('#new_password , #repeat_new_password , #old_password').val('');
			$('#old_password_msj , #repeat_password_msj').remove();
		}

		$('#new_password , #repeat_new_password').focusin(function(event) {
			$('#repeat_password_msj').remove();
		});

		$('#btn-cambiar').unbind().click(function(event) {
			if(passwordAnteriorCorrecta && passwordNuevasCorrectas()){
				$(function (){
					ajaxSave();
					$('#modalCambiarPassword').modal('toggle');
					$('header').after('<div class="alert alert-success text-center" id="success-alert"><button type="button" class="close" data-dismiss="alert">x</button><strong class="text-center">Contraseña Modificada Correctamente </strong></div>');
					$("#success-alert").fadeTo(3000, 500).slideUp(500, function(){
					    $("#success-alert").alert('close');
					});
				});
			}else{
				console.log("no estamos listos");
			}
		});

		function ajaxSave() {
			urlAjaxSave = "<?php echo base_url('index.php/usuario/ajaxGuardar'); ?>";
			$.ajax({
				type: "post",
				url: urlAjaxSave,
				cache: false,
				data: 'new_password=' + $('#new_password').val(),
				success: function(resp){
				},
				error: function(){
					console.log("Se produjo un error de comunicación con el servidor");
				}
			});	
		}
	});
</script>