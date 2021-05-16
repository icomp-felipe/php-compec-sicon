<h1>Novo Colaborador</h1>

<?php if (UserIdentity::isUsuarioInterno()): ?>

	<div class="actionBar">
		[<?php echo CHtml::link('Lista de Colaboradores previamente cadastrados',array('admin')); ?>]
	</div>

<?php endif; ?>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'update'=>false,
)); ?>