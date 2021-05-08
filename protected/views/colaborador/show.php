<h2>Colaborador <?php echo $model->idColaborador; ?> - Exibir</h2>

<div class="actionBar">
[<?php echo CHtml::link('Editar',array('update','id'=>$model->idColaborador)); ?>]
</div>

<table class="dataGrid">
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('idColaborador')); ?>
</th>
    <td><?php echo CHtml::encode($model->idColaborador); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('nome')); ?>
</th>
    <td><?php echo CHtml::encode($model->nome); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('cpf')); ?>
</th>
    <td><?php echo CHtml::encode($model->cpf); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('banco')); ?>
</th>
    <td><?php echo CHtml::encode($model->banco); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('contacorrente')); ?>
</th>
    <td><?php echo CHtml::encode($model->contacorrente); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('agencia')); ?>
</th>
    <td><?php echo CHtml::encode($model->agencia); ?>
</td>
</tr>
</table>
<p/>
<center>Se houver necessidade de alterar os dados do colaborador, clique no menu "Colaboradores" e no link "atualizar" localizado à esquerda de cada colaborador cadastrado por sua escola.</center>
