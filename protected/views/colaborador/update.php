<h1>Atualização de Dados</h1>
<h2>Colaborador: <?php echo $model->colab_nome; ?></h2>

<div class="actionBar">
	[<?php echo CHtml::link('Clique aqui para cadastrar um novo colaborador',array('create')); ?>]
</div>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'update'=>true,
)); ?>