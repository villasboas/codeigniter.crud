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


	<?php if(isset($result->desc_foto)):?>
	<div class="col-md-12">	
		<div class="thumbnail col-md-3">
			<img 	src="<?php echo base_url() . "uploads/". $result->desc_foto . ".jpg"; ?>" 
					width="100%">
		</div>
	</div>
	<?PHP endif; ?>
	
		<div class="col-md-12">
		<label for="desc_foto">Foto do cliente</label>
		<input type="file" id="desc_foto" name="desc_foto">
		<br>
	</div>

	<div class="col-md-12">
		<label for="desc_nome">Nome do cliente</label>
		<input type="text" 
				id="desc_nome" 
				name="desc_nome" 
				class="form-control" 
				value="<?php if (isset($result->desc_nome)) echo $result->desc_nome; ?>" required maxlength="30">
	</div>

	<div class="col-md-12">
		<label for="desc_email">E-mail do cliente</label>
		<input 	type="email" 
				id="desc_email" 
				name="desc_email" 
				class="form-control" 
				value="<?php if (isset($result->desc_email)) echo $result->desc_email; ?>" required>
	</div>
	
	<div class="col-md-12">
		<label for="desc_telefone">Telefone do cliente</label>
		<input 	type="text" 
				id="desc_telefone" 
				name="desc_telefone" 
				class="form-control" 
				value="<?php if (isset($result->desc_telefone)) echo $result->desc_telefone; ?>" maxlength="14">
	</div>
	
	<div class="col-md-12">
		<label for="flg_ativo">Está ativo?</label>
		<input 	type="text" 
				id="flg_ativo" 
				name="flg_ativo" 
				class="form-control" 
				value="<?php if (isset($result->flg_ativo)) echo $result->flg_ativo; ?>" maxlength="1">
	</div>
	
	

	<div class="col-md-12">
		<br>
		<a href="<?php echo base_url(); ?>" class="btn btn-danger">Voltar</a>
		<button type="submit" class="btn btn-success pull-right">Salvar</button>
	</div>
	

</form>