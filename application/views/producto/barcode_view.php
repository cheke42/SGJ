<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<style>
	.margen-horizontal{
		width: 17px;
		display: inline-block;
		background-color: red;
	}
	.codigo{
		width: 85.35px;
		display: inline-block;
		background-color: blue;
	}

	.cola{
		width: 124.7px;
		display: inline-block;
		background-color: yellow;
	}
	body{
		margin: 0;
	}
</style>
</head>
<body>
	
<div style="background-color: green;">

<div style="margin-right: -4px;" class="margen-horizontal">&nbsp;</div>
<img style="height: 37.7px;" class="codigo" src="/assets/lib/barcode.php?text=<?php echo $codigo ?>&print=true&size=45" alt="<?php echo $codigo ?>">
<img style="margin-left: -4px; height: 37.7px;" class="codigo" src="/assets/lib/barcode.php?text=<?php echo $codigo ?>&print=true&size=45" alt="<?php echo $codigo ?>">
<div style="margin-left: -4px" class="cola">&nbsp;</div>
<div style="margin-left: -4px;" class="margen-horizontal">&nbsp;</div>

</div>
</body>
</html>