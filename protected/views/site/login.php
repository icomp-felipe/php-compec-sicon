<?php $this->pageTitle=Yii::app()->name . ' - Acessar �rea Institucional'; ?>

<h1>Acesso � �rea Institucional</h1>

<div class="yiiForm">
<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($form); ?>

<div class="simple">
<?php echo CHtml::activeLabel($form,'Usu&aacute;rio'); ?>
<?php echo CHtml::activeTextField($form,'username') ?>
</div>

<div class="simple">
<?php echo CHtml::activeLabel($form,'Senha'); ?>
<?php echo CHtml::activePasswordField($form,'password') ?>
</div>

<div class="action">
<?php echo CHtml::submitButton('Acessar'); ?>
</div>

<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->