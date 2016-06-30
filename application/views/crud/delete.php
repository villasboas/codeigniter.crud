<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?> 

<div class="col-md-4">
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
	<div class="col-md-12">
		<a href="<?php echo site_url(); ?>" class="btn btn-danger">Voltar</a>
	</div>
</div>