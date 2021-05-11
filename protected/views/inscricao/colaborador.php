<h2>Identifique o Colaborador</h2>

<div class="actionBar">
    <ul>
        <li><b>Concurso</b>: <?php echo $form->concurso->descricao .' - <b>Realização:</b> '. CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$form->etapa->data_realizacao)).' ['.CHtml::link('Trocar',array('selecionarConcursoEtapa')).']'; ?></li>
        <li><b>Instituição</b>: <?php echo $form->instituicao->nome.' ['.CHtml::link('Trocar',array('selecionarInstituicao')).']'; ?></li>
    </ul>
</div>

<div class="yiiForm">

    <?php echo CHtml::beginForm(CHtml::normalizeUrl(CController::createUrl('selecionarColaborador'))); ?>
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
        <?php echo CHtml::submitButton('Prosseguir'); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->