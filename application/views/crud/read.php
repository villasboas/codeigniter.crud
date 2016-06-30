<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?> 
<form class="form col-md-4" method="post" enctype="multipart/form-data">
	<div class="col-md-12">
		<h2>Adicionar novo cliente</h2>
	</div>
	<?php foreach($result as $dados):?>
	<div class="col-md-12">	
		<div class="thumbnail col-md-3">
			<img src="<?php echo base_url() . "uploads/". $dados->desc_foto . ".jpg"; ?>" width="100%">
		</div>
	</div>

	<div class="col-md-12">
		<label for="desc_nome">Nome do cliente</label>
		<input type="text" class="form-control" value="<?php echo $dados->desc_nome; ?>" disabled>
	</div>

	<div class="col-md-12">
		<label for="desc_email">E-mail do cliente</label>
		<input type="email" class="form-control" value="<?php echo $dados->desc_email; ?>" readonly>
	</div>
	
	<div class="col-md-12">
		<label for="desc_telefone">Telefone do cliente</label>
		<input type="text" class="form-control" value="<?php echo $dados->desc_telefone; ?>" readonly>
	</div>
	
	<div class="col-md-12">
		<label for="flg_ativo">Está ativo?</label>
		<input type="text" class="form-control" value="<?php echo $dados->flg_ativo; ?>" readonly>
	</div>
	
	<div class="col-md-12">
		<br>
		<a href="<?php echo base_url(); ?>" class="btn btn-danger">Voltar</a>
	</div>

	<?php endforeach; ?>
</form>