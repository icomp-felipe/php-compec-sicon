<h2>Concurso <?php echo $model->idconcurso; ?> - Atualizar</h2>

<div class="actionBar">
[<?php echo CHtml::link('Listar',array('list')); ?>]
[<?php echo CHtml::link('Criar',array('create')); ?>]
[<?php echo CHtml::link('Gerenciar',array('admin')); ?>]
</div>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'update'=>true,
)); ?>