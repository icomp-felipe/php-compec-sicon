<h2>Identificação do Colaborador</h2>

<div class="yiiForm">
<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($form,'Atenção!'); ?>

<div class="simple">
<?php echo CHtml::activeLabel($form,'cpf'); ?>
<?php $this->widget('CMaskedTextField',array(
        'model'=>$form,
        'attribute'=>'cpf',
        'mask'=>'999.999.999-99',
        'placeholder'=>'_',
        'htmlOptions'=>array(
            'size'=>13,
            'maxlength'=>13,
        )
    )); ?>
</div>

<div class="action">
<?php echo CHtml::submitButton('Continuar ...'); ?>
</div>

<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->
