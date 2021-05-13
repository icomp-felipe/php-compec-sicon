<h2>Identifique o Colaborador</h2>

<div class="actionBar">
    <ul>
		<li><b>Concurso</b>: <?php echo $form->concurso->descricao .' - <b>Realização:</b> '. CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$form->etapa->data_realizacao)); ?>

            <?php // Só mostra o botão de trocar caso haja mais de um concurso disponível ?>
            <?php if ($form->multiplosConcursos): ?>
                <?php echo ' ['.CHtml::link('Trocar',array('selecionarConcursoEtapa')).']'; ?>
            <?php endif; ?><br>

        </li>
		<li><b>Instituição</b>: <?php echo $form->instituicao->inst_nome; ?>

            <?php // Só mostra o botão de trocar caso haja mais de uma instituição disponível ?> 
            <?php if ($form->multiplasInstituicoes): ?>
                <?php echo ' ['.CHtml::link('Trocar',array('selecionarInstituicao')).']'; ?>
            <?php endif; ?>

        </li>
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