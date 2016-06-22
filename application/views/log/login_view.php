<style>
	html{
		background: url(<?php echo base_url('assets/images/bg.jpg'); ?>) no-repeat center center fixed;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}

	body{
		background: rgba(200, 20, 20, 0);
	}
	.panel{
		opacity: 0.85;
	}

	.panel-head{
		background-color: #333333;
		color: #FFFFFF;
	}

	
</style>

<div class="container transparent">
	<br>
	<br>
	<br>
	<div class="row text-center">
		<div class="hidden-xs col-sm-1 col-md-2 col-lg-3"></div>
		<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
			<div class="panel panel-primary">
			  <div class="panel-heading text-center"><strong><h4>.:: Acceso al Sistema ::.</h4></strong></div>
			  <div class="panel-body">
			    <form class="form-horizontal" method="post" action="<?php echo base_url('index.php/log/verificarDatos'); ?>">
			      <fieldset>
			        <div class="form-group">
			          <label for="username" class="col-lg-2 control-label" >Usuario</label>
			          <div class="col-lg-10">
			            <input type="text" class="form-control" id="username" name="username" placeholder="Nombre de usuario" value="<?php echo empty($usuario) ? '' : $usuario; ?>" autofocus required>
			          </div>
			        </div>
			        <div class="form-group">
			          <label for="password" class="col-lg-2 control-label">Contraseña</label>
			          <div class="col-lg-10">
			            <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña de acceso" required>
			            <?php echo empty($mensaje_error) ? '' : ('<span class="text-danger">'. $mensaje_error .'</span>') ?>
			            
			          </div>
			        </div>
			        
			        <br>
			        <div class="form-group">
			          <div class="col-lg-10 col-lg-offset-2 text-right">
			            <button type="reset" class="btn btn-default" data-toggle="modal" data-target="#myModal">Olvidé mi contraseña</button>
			            <button type="submit" class="btn btn-primary">Acceder <span class="glyphicon glyphicon-log-in"></span></button>
			          </div>
			        </div>
			      </fieldset>
			    </form>
			  </div>
			</div>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
		</div>
		<div class="hidden-xs col-sm-1 col-md-2 col-lg-3"></div>
	</div>
</div>

<div id="myModal" class="modal">
  <div  class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Información de Acceso</h4>
      </div>
      <div class="modal-body">
        <p>Para poder acceder al sistema debe logerse. </p><p>

Si no recuerda su usuario y/o contraseña puede contactarse con nosotros via correo electrónico a ezequielsuazo@outlook.com ó telefonicamente al (0297) 156-230977
</p><p>

Muchas gracias!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
      </div>
    </div>
  </div>
</div>

