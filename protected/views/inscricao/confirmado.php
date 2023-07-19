<h2>Parabéns! A inscrição foi confirmada!</h2>

<div class="yiiForm">

	<?php echo CHtml::beginForm(); ?>
	<?php echo CHtml::errorSummary($form); ?>

	<table class="dataGrid">

		<tr>
			<th class="label" style="text-align: right;">Nº de Inscrição:</th>
			<td><?php echo inscricao::load($form->colaborador->colab_id_pk, $form->concurso->conc_id_pk)->insc_id_pk; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">Nome:</th>
			<td><?php echo $form->colaborador->nomeProprio; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">CPF:</th>
			<td><?php echo $form->colaborador->cpfFormatado; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">Data de Nascimento:</th>
			<td><?php echo date_format(date_create($form->colaborador->colab_nascimento), "d/m/Y"); ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">Concurso:</th>
			<td><?php echo $form->concurso->conc_nome .' - <b>Realização:</b> '. CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$form->concurso->conc_data_realizacao)); ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">Instituição:</th>
			<td><?php echo $form->instituicao->nomeComCodigo; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">Função:</th>
			<td><?php echo $form->funcao->func_apelido; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">PIS | PASEP | NIS | NIT:</th>
    		<td><?php echo $form->colaborador->pisFormatado; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">Nº do RG:</th>
    		<td><?php echo $form->colaborador->colab_rg; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">Banco</th>
			<td><?php echo $form->colaborador->banco->bancoComCodigo; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">Nº da Agência (s/ dígito):</th>
			<td><?php echo $form->colaborador->colab_agencia; ?></td>
		</tr>
		<tr>
			<th class="label" style="text-align: right;">Nº da Conta (sem dígito):</th>
			<td><?php echo $form->colaborador->colab_conta; ?></td>
		</tr>
		<tr>
			<th class="label" style="text-align: right;">DV da Conta:</th>
			<td><?php echo $form->colaborador->colab_conta_dv; ?></td>
		</tr>
	</table>

	<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->

<div class="actionBar">
	[<?php echo CHtml::link('Inscrever outro colaborador no mesmo concurso, instituição e função',array('selecionarColaborador','cpf'=>'')); ?>]<br>
	[<?php echo CHtml::link('Ir para a listagem de inscritos',array('/inscricao')); ?>]
</div>
