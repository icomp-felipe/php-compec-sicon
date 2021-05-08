<h2>Passo 1 - Identifica&ccedil;&atilde;o</h2>

<div class="yiiForm">

<p>
Digite abaixo o seu CPF
</p>

<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($model); ?>

<div class="simple">
<?php echo CHtml::activeLabelEx($model,'cpf'); ?>
<?php echo CHtml::activeTextField($model,'cpf',array('size'=>14,'maxlength'=>14)); ?>
</div>

<div class="action">
<?php echo CHtml::submitButton('Continuar'); ?>
</div>

<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->