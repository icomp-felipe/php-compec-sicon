<h2>Parabéns! Sua inscrição foi confirmada!</h2>

<p>ADICIONAR LINK DO MANUAL</p>

<div class="yiiForm">

	<?php echo CHtml::beginForm(); ?>
	<?php echo CHtml::errorSummary($form); ?>

	<table class="dataGrid">

		<tr>
			<th class="label">Nº de Inscrição:</th>
			<td><?php echo inscricao::load($form->colaborador->idColaborador, $form->etapa->idetapa)->idinscricao; ?></td>
		</tr>

		<tr>
			<th class="label">CPF + Nome:</th>
			<td><?php echo $form->cpf; ?> - 
				<?php echo $form->colaborador->nome; ?></td>
		</tr>

		<tr>
			<th class="label">Concurso:</th>
			<td><?php echo $form->concurso->descricao .' - <b>Realização:</b> '. CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$form->etapa->data_realizacao)); ?></td>
		</tr>

		<tr>
			<th class="label">Instituição:</th>
			<td><?php echo $form->instituicao->nome; ?></td>
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
			<th class="label">Nome do Banco:</th>
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