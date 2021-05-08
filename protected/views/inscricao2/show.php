<h2>Inscricao <?php echo $model->idinscricao; ?> - Exibir</h2>

<div class="actionBar">
[<?php echo CHtml::link('Listar',array('list')); ?>]
[<?php echo CHtml::link('Inserir',array('create')); ?>]
[<?php echo CHtml::link('Atualizar',array('update','id'=>$model->idinscricao)); ?>]
[<?php echo CHtml::linkButton('Excluir',array('submit'=>array('delete','id'=>$model->idinscricao),'confirm'=>'Confirma exclus&atilde;o?')); ?>
]
[<?php echo CHtml::link('Gerenciar',array('admin')); ?>]
</div>

<table class="dataGrid">
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('idinstituicaoopcao2')); ?>
</th>
    <td><?php echo CHtml::encode($model->idinstituicaoopcao2); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('idinstituicaoopcao1')); ?>
</th>
    <td><?php echo CHtml::encode($model->idinstituicaoopcao1); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('idconcurso')); ?>
</th>
    <td><?php echo CHtml::encode($model->idconcurso); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('idColaborador')); ?>
</th>
    <td><?php echo CHtml::encode($model->idColaborador); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('selecionado')); ?>
</th>
    <td><?php echo CHtml::encode($model->selecionado); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('codinscricao')); ?>
</th>
    <td><?php echo CHtml::encode($model->codinscricao); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('tipoinscricao')); ?>
</th>
    <td><?php echo CHtml::encode($model->tipoinscricao); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('candidatociente')); ?>
</th>
    <td><?php echo CHtml::encode($model->candidatociente); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('idFuncao')); ?>
</th>
    <td><?php echo CHtml::encode($model->idFuncao); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('dt_hr')); ?>
</th>
    <td><?php echo CHtml::encode($model->dt_hr); ?>
</td>
</tr>
</table>
