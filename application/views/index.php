<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">

		<title><?php echo $title ?></title>	

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">

		<style>
		#page-header
		{
			position: fixed;
			left: 0px;
			top: 0px;
			width: 100%;
			background: #fff;
			padding: 0px;
		}
		main
		{
			margin-top: 100px;
		}
		</style>

	</head>
	<body>

		<header id="page-header" class="container-fluid">
			<div class="page-header" style="margin: 0px; padding: 10px 100px;">
				<h1 >CRUD <small>Com CodeIgniter</small></h1>
				<a href="<?php echo base_url(); ?>" class="btn btn-default">
					<span class="glyphicon glyphicon-home"></span>
					Inicio
				</a>
			</div>
		</header>

		<main class="container">
		<?php $this->load->view('crud/'. $view);?>
		</main>

		<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<script>
			$(document).ready(function(){
			    $('#tabela_clientes').DataTable();
			});
		</script>
	</body>
</html>