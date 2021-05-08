<div class="yiiForm">

<p>
Arquivos com <span class="required">*</span> s&atilde;o de preenchimento obrigat&oacute;rio.
</p>

<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($model); ?>

<div class="simple">
<?php echo CHtml::activeLabelEx($model,'idinstituicaoopcao2'); ?>
<?php echo CHtml::activeTextField($model,'idinstituicaoopcao2'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'idinstituicaoopcao1'); ?>
<?php echo CHtml::activeTextField($model,'idinstituicaoopcao1'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'idconcurso'); ?>
<?php echo CHtml::activeTextField($model,'idconcurso'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'idColaborador'); ?>
<?php echo CHtml::activeTextField($model,'idColaborador'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'selecionado'); ?>
<?php echo CHtml::activeTextField($model,'selecionado',array('size'=>1,'maxlength'=>1)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'codinscricao'); ?>
<?php echo CHtml::activeTextField($model,'codinscricao'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'tipoinscricao'); ?>
<?php echo CHtml::activeTextField($model,'tipoinscricao'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'candidatociente'); ?>
<?php echo CHtml::activeTextField($model,'candidatociente',array('size'=>1,'maxlength'=>1)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'idFuncao'); ?>
<?php echo CHtml::activeTextField($model,'idFuncao'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'dt_hr'); ?>
<?php echo CHtml::activeTextField($model,'dt_hr'); ?>
</div>

<div class="action">
<?php echo CHtml::submitButton($update ? 'Salvar' : 'Criar'); ?>
</div>

<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->