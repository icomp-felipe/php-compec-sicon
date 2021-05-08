<h2>Identifique o Colaborador</h2>

<div class="actionBar">
<p>
Para concluir a inscrição você precisa digitar, no formulário abaixo, o CPF do colaborador que deseja inscrever, ou pode optar por um dos links a seguir:
</p>

<ul>
<li><?php echo $form->concurso->descricao .'. Prova do dia: '. CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$form->etapa->data_realizacao)).'. '.CHtml::link('Desejo alterar o processo seletivo...',array('concursosEtapas')); ?></li>
<li>
<?php echo $form->instituicao->nome.'. '.CHtml::link('Desejo alterar a instituição...',array('selecionarInstituicao')); ?></li>
<li><?php echo $form->funcao->nome.'. '.CHtml::link('Desejo alterar a função...',array('selecionarFuncao')); ?></li>
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
<?php echo CHtml::submitButton('Continuar ...'); ?>
</div>

<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->
