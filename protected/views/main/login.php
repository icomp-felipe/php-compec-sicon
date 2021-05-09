<?php $this->pageTitle=Yii::app()->name . ' - Área Restrita'; ?>

<h2>Login na Área Restrita</h2>

<div class="yiiForm">
    <?php echo CHtml::beginForm(); ?>
    <?php echo CHtml::errorSummary($form); ?>

    <div class="simple">
        <?php echo CHtml::activeLabel($form,'Usuário'); ?>
        <?php echo CHtml::activeTextField($form,'username') ?>
    </div>

    <div class="simple">
        <?php echo CHtml::activeLabel($form,'Senha'); ?>
        <?php echo CHtml::activePasswordField($form,'password') ?>
    </div>

    <br>

    <div class="action">
        <?php echo CHtml::submitButton('Login'); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->