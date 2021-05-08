<div class="yiiForm">

<p>
Arquivos com <span class="required">*</span> s&atilde;o de preenchimento obrigat&oacute;rio.
</p>

<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($model); ?>

<div class="simple">
<?php echo CHtml::activeLabelEx($model,'idinstituicaorealizadora'); ?>
<?php echo CHtml::activeTextField($model,'idinstituicaorealizadora'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'idinstituicaogestora'); ?>
<?php echo CHtml::activeTextField($model,'idinstituicaogestora'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'descricao'); ?>
<?php echo CHtml::activeTextField($model,'descricao',array('size'=>50,'maxlength'=>50)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'ano'); ?>
<?php echo CHtml::activeTextField($model,'ano'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'quantidade_etapas'); ?>
<?php echo CHtml::activeTextField($model,'quantidade_etapas'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'etapa_atual'); ?>
<?php echo CHtml::activeTextField($model,'etapa_atual'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'situacao'); ?>
<?php echo CHtml::activeTextField($model,'situacao'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'datainicioinscricao'); ?>
<?php echo CHtml::activeTextField($model,'datainicioinscricao'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'datafiminscricao'); ?>
<?php echo CHtml::activeTextField($model,'datafiminscricao'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'clonado'); ?>
<?php echo CHtml::activeTextField($model,'clonado'); ?>
</div>

<div class="action">
<?php echo CHtml::submitButton($update ? 'Salvar' : 'Criar'); ?>
</div>

<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->