<h2>Ativação confirmada</h2>

<p>Compareça à COMPEC-UFAM no prazo de <strong>31/10/2016 a 07/11/2016</strong> para retirada do Manual de Instruções do Fiscal como confirmação de sua participação</p>

<div class="yiiForm">
<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($form); ?>

<table class="dataGrid">
<tr>
	<th class="label">Inscrição n&ordm;</th>
    <td><?php echo inscricao::load($form->colaborador->idColaborador, $form->etapa->idetapa)->idinscricao; ?></td>
</tr>
<tr>
	<th class="label">Identificação</th>
    <td><?php echo $form->cpf; ?> - 
		<?php echo $form->colaborador->nome; ?></td>
</tr>
<tr>
	<th class="label">Processo Seletivo</th>
    <td><?php echo $form->concurso->descricao .'. Prova do dia: '. CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$form->etapa->data_realizacao)); ?></td>
</tr>
<tr>
	<th class="label">Instituição</th>
    <td><?php echo $form->instituicao->nome; ?></td>
</tr>
<tr>
	<th class="label">Banco</th>
    <td><?php echo $form->colaborador->banco; ?></td>
</tr>
<tr>
	<th class="label">Agência</th>
    <td><?php echo $form->colaborador->agencia; ?></td>
</tr>
<tr>
	<th class="label">Conta Corrente</th>
    <td><?php echo $form->colaborador->contacorrente; ?></td>
</tr>
</table>

<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->
