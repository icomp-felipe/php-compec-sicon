<h2>Inscricao - Listar</h2>

<div class="actionBar">
[<?php echo CHtml::link('Criar',array('create')); ?>]
[<?php echo CHtml::link('Gerenciar',array('admin')); ?>]
</div>

<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>

<?php foreach($models as $n=>$model): ?>
<div class="item">
<?php echo CHtml::encode($model->getAttributeLabel('idinscricao')); ?>:
<?php echo CHtml::link($model->idinscricao,array('show','id'=>$model->idinscricao)); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('idinstituicaoopcao2')); ?>:
<?php echo CHtml::encode($model->idinstituicaoopcao2); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('idinstituicaoopcao1')); ?>:
<?php echo CHtml::encode($model->idinstituicaoopcao1); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('idconcurso')); ?>:
<?php echo CHtml::encode($model->idconcurso); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('idColaborador')); ?>:
<?php echo CHtml::encode($model->idColaborador); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('selecionado')); ?>:
<?php echo CHtml::encode($model->selecionado); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('codinscricao')); ?>:
<?php echo CHtml::encode($model->codinscricao); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('tipoinscricao')); ?>:
<?php echo CHtml::encode($model->tipoinscricao); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('candidatociente')); ?>:
<?php echo CHtml::encode($model->candidatociente); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('idFuncao')); ?>:
<?php echo CHtml::encode($model->idFuncao); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('dt_hr')); ?>:
<?php echo CHtml::encode($model->dt_hr); ?>
<br/>

</div>
<?php endforeach; ?>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>