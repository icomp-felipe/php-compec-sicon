<h1>Novo Colaborador</h1>

<div class="actionBar">
	[<?php echo CHtml::link('Lista de Colaboradores previamente cadastrados',array('admin')); ?>]
</div>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'update'=>false,
)); ?>