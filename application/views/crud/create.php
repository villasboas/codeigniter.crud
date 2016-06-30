<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?> 
<h2>Adicionar novo cliente</h2>
<form class="form col-md-4" method="post" enctype="multipart/form-data">

	<?php if($error):?>
		<div class="alert alert-danger">
			<?php echo $error; ?>
		</div>
	<?php elseif($success):?>	
		<div class="alert alert-success">
			<?php echo $success; ?>
		</div>
	<?php endif;?>
	

	<label for="desc_foto">Foto do cliente</label>
	<input type="file" id="desc_foto" name="desc_foto" required>
	<br>

	<label for="desc_nome">Nome do cliente</label>
	<input type="text" id="desc_nome" name="desc_nome" class="form-control" placeholder="Gustavo vilas boas" required>

	<label for="desc_email">E-mail do cliente</label>
	<input type="email" id="desc_email" name="desc_email" class="form-control" placeholder="email@email.com" required>

	<label for="desc_telefone">Telefone do cliente</label>
	<input type="text" id="desc_telefone" name="desc_telefone" class="form-control" placeholder="(xx) xxxx-xxxx">

	<br>
	<a href="<?php echo base_url(); ?>" class="btn btn-danger">Voltar</a>
	<button type="submit" class="btn btn-success pull-right">Adicionar cliente</button>

</form>