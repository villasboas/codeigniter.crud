<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?> 

<form class="form col-md-4" method="post" enctype="multipart/form-data">
	<div class="col-md-12">
		<h2>Editar um cliente</h2>
	</div>

	<div class="col-md-12">
	<?php if($error):?>
		<div class="alert alert-danger">
			<?php echo $error; ?>
		</div>
	<?php elseif($success):?>	
		<div class="alert alert-success">
			<?php echo $success; ?>
		</div>
	<?php endif;?>
	</div>

	<?php foreach($result as $dados):?>
	<div class="col-md-12">	
		<div class="thumbnail col-md-3">
			<img src="<?php echo base_url() . "uploads/". $dados->desc_foto . ".jpg"; ?>" width="100%">
		</div>
	</div>

	<div class="col-md-12">
		<label for="desc_foto">Foto do cliente</label>
		<input type="file" id="desc_foto" name="desc_foto">
		<br>
	</div>

	<div class="col-md-12">
		<label for="desc_nome">Nome do cliente</label>
		<input type="text" id="desc_nome" name="desc_nome" class="form-control" value="<?php echo $dados->desc_nome; ?>">
	</div>

	<div class="col-md-12">
		<label for="desc_email">E-mail do cliente</label>
		<input type="email" id="desc_email" name="desc_email" class="form-control" value="<?php echo $dados->desc_email; ?>">
	</div>
	
	<div class="col-md-12">
		<label for="desc_telefone">Telefone do cliente</label>
		<input type="text" id="desc_telefone" name="desc_telefone" class="form-control" value="<?php echo $dados->desc_telefone; ?>">
	</div>
	
	<div class="col-md-12">
		<label for="flg_ativo">Está ativo?</label>
		<input type="text" id="flg_ativo" name="flg_ativo" class="form-control" value="<?php echo $dados->flg_ativo; ?>">
	</div>
	
	<?php endforeach; ?>

	<div class="col-md-12">
		<br>
		<a href="<?php echo base_url(); ?>" class="btn btn-danger">Voltar</a>
		<button type="submit" class="btn btn-success pull-right">Salvar</button>
	</div>
	

</form>