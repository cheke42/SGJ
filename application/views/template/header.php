<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Flor de Nacar</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/estilos.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/select2.min.css'); ?>">
	<style>
		.navbar{
			margin-bottom: 0;
		}
	</style>
</head>

<body>
<header class="navbar navbar-default navbar-static-top bs-docs-nav" id="top" role="banner">
	<?php 
		$valor = $this->session->userdata('usuario');
		if (!empty($valor)) { ?>

			<nav>
			  <div class="container">
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <a class="navbar-brand" href="#">Software FDN</a>
			    </div>

			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      <?php 
			      	$sucursal = $this->session->userdata('numero_sucursal');
			      	if (!empty($sucursal)) { ?>
			      <ul class="nav navbar-nav">
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Productos<span class="caret"></span></a>
			          <ul class="dropdown-menu" role="menu">
			            <li><a href="<?php echo base_url('index.php/producto/listar');?>">Listar Productos</a></li>
			            <li><a href="<?php echo base_url('index.php/producto/agregar');?>" title="Crear un nuevo producto no existente en el sistema">Crear Nuevo</a></li>
			            <li class="divider"></li>
			            <li><a href="<?php echo base_url('index.php/operacion/agregar'); ?>" title="">Agregar</a></li>
			            <li><a href="<?php echo base_url('index.php/operacion/vender'); ?>" title="">Vender</a></li>
			            <li><a href="<?php echo base_url('index.php/operacion/baja'); ?>" title="">Dar de Baja</a></li>
			          </ul>
			        </li>
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Categorías<span class="caret"></span></a>
			          <ul class="dropdown-menu" role="menu">
			            <li><a href="<?php echo base_url('index.php/categoria/listar');?>">Listar</a></li>
			            <li><a href="<?php echo base_url('index.php/categoria/agregar');?>">Agregar Nuevo</a></li>
			          </ul>
			        </li>
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Proveedores <span class="caret"></span></a>
			          <ul class="dropdown-menu" role="menu">
			            <li><a href="<?php echo base_url('index.php/proveedor/listar');?>">Listar</a></li>
			            <li><a href="<?php echo base_url('index.php/proveedor/agregar');?>">Agregar Nuevo</a></li>
			          </ul>
			        </li>
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Operaciones <span class="caret"></span></a>
			          <ul class="dropdown-menu" role="menu">
			            <li><a href="<?php echo base_url('index.php/operacion/listar');?>">Listar Todas</a></li>
			            
			            
			          </ul>
			        </li>
			      </ul>
			      	<?php
			      	}
			       ?>
			      <ul class="nav navbar-nav navbar-right">
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Bienvenido <?php echo ucwords($this->session->userdata('usuario')) ?> <span class="caret"></span></a>
			          <ul class="dropdown-menu" role="menu">
			            <li><a href="<?php echo base_url('index.php/usuario/ver');?>">Perfil</a></li>
			            <li><a data-toggle="modal" data-target="#acercade">Acerca de</a></li>
			            <li><a href="<?php echo base_url('index.php/log/out'); ?>">Salir</a></li>
			          </ul>
			        </li>
			      </ul>
			    </div>
			  </div>
			</nav>

		<?php
		}else{
			
		}
	 ?>
</header>

<script src="<?php echo base_url('assets/js/jquery-2.2.4.min.js'); ?>"></script>	
