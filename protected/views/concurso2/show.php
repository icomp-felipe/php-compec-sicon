<h2>Concurso <?php echo $model->idconcurso; ?> - Exibir</h2>

<div class="actionBar">
[<?php echo CHtml::link('Listar',array('list')); ?>]
[<?php echo CHtml::link('Inserir',array('create')); ?>]
[<?php echo CHtml::link('Atualizar',array('update','id'=>$model->idconcurso)); ?>]
[<?php echo CHtml::linkButton('Excluir',array('submit'=>array('delete','id'=>$model->idconcurso),'confirm'=>'Confirma exclus&atilde;o?')); ?>
]
[<?php echo CHtml::link('Gerenciar',array('admin')); ?>]
</div>

<table class="dataGrid">
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('idinstituicaorealizadora')); ?>
</th>
    <td><?php echo CHtml::encode($model->idinstituicaorealizadora); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('idinstituicaogestora')); ?>
</th>
    <td><?php echo CHtml::encode($model->idinstituicaogestora); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('descricao')); ?>
</th>
    <td><?php echo CHtml::encode($model->descricao); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('ano')); ?>
</th>
    <td><?php echo CHtml::encode($model->ano); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('quantidade_etapas')); ?>
</th>
    <td><?php echo CHtml::encode($model->quantidade_etapas); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('etapa_atual')); ?>
</th>
    <td><?php echo CHtml::encode($model->etapa_atual); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('situacao')); ?>
</th>
    <td><?php echo CHtml::encode($model->situacao); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('datainicioinscricao')); ?>
</th>
    <td><?php echo CHtml::encode($model->datainicioinscricao); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('datafiminscricao')); ?>
</th>
    <td><?php echo CHtml::encode($model->datafiminscricao); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('clonado')); ?>
</th>
    <td><?php echo CHtml::encode($model->clonado); ?>
</td>
</tr>
</table>
