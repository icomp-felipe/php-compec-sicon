<h2>Colaborador - Novo(a)</h2>

<div class="actionBar">
[<?php echo CHtml::link('Colaboradores',array('admin')); ?>]
</div>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'update'=>false,
)); ?>