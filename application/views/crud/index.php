<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?> 

<div class="col-md-12" style="text-align: right; padding: 20px 0px;">
	<a href="<?php echo site_url("app/update");?>" class="btn btn-success">Adicionar cliente</a>
</div>


<table id="tabela_clientes" class="table table-bordered">

<thead>
	<th>Foto</th>
	<th>Nome</th>
	<th>E-mail</th>
	<th>Telefone</th>
	<th>Status</th>
	<th>Ações</th>
</thead>

<tbody>
	<?php foreach ($table as $value): ?>
		<tr>
			<td>
				<img src="<?php echo base_url() . "uploads/". $value->desc_foto . ".jpg"; ?>	" width="50px">	
			</td>
			<td><?php echo $value->desc_nome; ?></td>
			<td><?php echo $value->desc_email; ?></td>
			<td><?php echo $value->desc_telefone; ?></td>
			<td><?php echo $value->flg_ativo; ?></td>
			<td>
				<a href="<?php echo site_url('app/read/'.$value->cliente_id)?>" alt="visualizar">
					<span class="glyphicon glyphicon-eye-open text-warning"></span>
				</a>
				<a href="<?php echo site_url('app/update/'.$value->cliente_id) ?>" alt="visualizar">
					<span class="glyphicon glyphicon-edit"></span>
				</a>
				<a href="<?php echo site_url('app/delete/'.$value->cliente_id) ?>" alt="visualizar">
					<span class="glyphicon glyphicon-remove text-danger"></span>
				</a>
			</td>
		</tr>
	<?php endforeach;?>
</tbody>

</table>