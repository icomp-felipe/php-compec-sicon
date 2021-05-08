<h2>Concurso - Listar</h2>

<div class="actionBar">
[<?php echo CHtml::link('Criar',array('create')); ?>]
[<?php echo CHtml::link('Gerenciar',array('admin')); ?>]
</div>

<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>

<?php foreach($models as $n=>$model): ?>
<div class="item">
<?php echo CHtml::encode($model->getAttributeLabel('idconcurso')); ?>:
<?php echo CHtml::link($model->idconcurso,array('show','id'=>$model->idconcurso)); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('idinstituicaorealizadora')); ?>:
<?php echo CHtml::encode($model->idinstituicaorealizadora); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('idinstituicaogestora')); ?>:
<?php echo CHtml::encode($model->idinstituicaogestora); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('descricao')); ?>:
<?php echo $model->descricao; ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('ano')); ?>:
<?php echo CHtml::encode($model->ano); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('quantidade_etapas')); ?>:
<?php echo CHtml::encode($model->quantidade_etapas); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('etapa_atual')); ?>:
<?php echo CHtml::encode($model->etapa_atual); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('situacao')); ?>:
<?php echo CHtml::encode($model->situacao); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('datainicioinscricao')); ?>:
<?php echo CHtml::encode($model->datainicioinscricao); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('datafiminscricao')); ?>:
<?php echo CHtml::encode($model->datafiminscricao); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('clonado')); ?>:
<?php echo CHtml::encode($model->clonado); ?>
<br/>

</div>
<?php endforeach; ?>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>