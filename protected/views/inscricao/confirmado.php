<h2>Parabéns! A inscrição foi confirmada!</h2>

<div class="yiiForm">

	<?php echo CHtml::beginForm(); ?>
	<?php echo CHtml::errorSummary($form); ?>

	<table class="dataGrid">

		<tr>
			<th class="label">Nº de Inscrição:</th>
			<td><?php echo inscricao::load($form->colaborador->idColaborador, $form->etapa->idetapa)->idinscricao; ?></td>
		</tr>

		<tr>
			<th class="label">Nome:</th>
			<td><?php echo $form->colaborador->nome; ?></td>
		</tr>

		<tr>
			<th class="label">CPF:</th>
			<td><?php echo $form->colaborador->cpfFormatado; ?></td>
		</tr>

		<tr>
			<th class="label">Concurso:</th>
			<td><?php echo $form->concurso->descricao .' - <b>Realização:</b> '. CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$form->etapa->data_realizacao)); ?></td>
		</tr>

		<tr>
			<th class="label">Instituição:</th>
			<td><?php echo $form->instituicao->inst_nome; ?></td>
		</tr>

		<tr>
			<th class="label">Função:</th>
			<td><?php echo $form->funcao->nome; ?></td>
		</tr>

		<tr>
			<th class="label">PIS | PASEP | NIS | NIT:</th>
    		<td><?php echo $form->colaborador->pisFormatado; ?></td>
		</tr>

		<tr>
			<th class="label">Nº do RG:</th>
    		<td><?php echo $form->colaborador->doc_identidade; ?></td>
		</tr>

		<tr>
			<th class="label">Nome do Banco</th>
			<td><?php echo $form->colaborador->banco; ?></td>
		</tr>

		<tr>
			<th class="label">Nº da Agência (s/ dígito):</th>
			<td><?php echo $form->colaborador->agencia; ?></td>
		</tr>
		<tr>
			<th class="label">Nº da Conta (com dígito):</th>
			<td><?php echo $form->colaborador->contacorrente; ?></td>
		</tr>
	</table>

	<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->

<div class="actionBar">
	[<?php echo CHtml::link('Inscrever outro colaborador no mesmo concurso, instituição e função',array('selecionarColaborador','cpf'=>'')); ?>]<br>
	[<?php echo CHtml::link('Ir para a listagem de inscritos',array('/inscricao')); ?>]
</div>
