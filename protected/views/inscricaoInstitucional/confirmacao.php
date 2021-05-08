<h2>Confirmar os dados desta ativação</h2>

<div class="yiiForm">
	
<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($form); ?>

<table class="dataGrid">
<tr>
	<th class="label">Processo Seletivo</th>
    <td><?php echo $form->concurso->descricao .'. Prova do dia: '. CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$form->etapa->data_realizacao)); ?></td>
</tr>
<tr>
	<th class="label">Instituição</th>
    <td><?php echo $form->instituicao->nome; ?></td>
</tr>
<tr>
	<th class="label">Função</th>
    <td><?php echo $form->funcao->nome; ?></td>
</tr>
<tr>
	<th class="label">Colaborador</th>
    <td><?php echo $form->cpf; ?> - 
		<?php echo $form->colaborador->nome; ?></td>
</tr>

<tr>
	<th class="label">Banco</th>
    <td><?php echo CHtml::activeTextField($form,'banco',array('size'=>10,'maxlength'=>10)); ?></td>
</tr>

<tr>
	<th class="label">Agência</th>
    <td><?php echo CHtml::activeTextField($form,'agencia',array('size'=>6,'maxlength'=>6)); ?></td>
</tr>

<tr>
	<th class="label">Conta</th>
    <td><?php echo CHtml::activeTextField($form,'contacorrente',array('size'=>10,'maxlength'=>10)); ?></td>
</tr>

<tr>
	<th class="label">PIS/PASEP</th>
    <td><?php echo CHtml::activeTextField($form,'pispasep',array('size'=>15,'maxlength'=>15)); ?></td>
</tr>

<tr>
	<th class="label">RG</th>
    <td><?php echo CHtml::activeTextField($form,'doc_identidade',array('size'=>20,'maxlength'=>20)); ?></td>
</tr>

</table>

<div class="action">
<?php echo CHtml::submitButton('Confirmar',array('submit'=>array('inscricaoInstitucional/confirmar'))); ?>
</div>

<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->
<div class="actionBar">
<p>
Se houver algum erro você pode executar uma das ações abaixo:
</p>

<ul>
<li><?php echo $form->concurso->descricao .'. Prova do dia: '. CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$form->etapa->data_realizacao)).'. '.CHtml::link('Desejo alterar o processo seletivo...',array('concursosEtapas')); ?></li>
<li>
<?php echo $form->instituicao->nome.'. '.CHtml::link('Desejo alterar a instituição...',array('selecionarInstituicao')); ?></li>
<li><?php echo $form->funcao->nome.'. '.CHtml::link('Desejo alterar a função...',array('selecionarFuncao')); ?></li>
<li><?php echo $form->colaborador->cpf.' - '. $form->colaborador->nome.' .'.CHtml::link('Desejo alterar o colaborador...',array('selecionarColaborador')); ?></li>
</ul>
</div>
