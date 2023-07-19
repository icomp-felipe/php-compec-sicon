<h2>Parabéns! Sua inscrição foi confirmada!</h2>

<h3>
	Por favor, faça o download do manual do aplicador no link abaixo.<br>
	Obs.: não é necessário imprimir este manual, no dia do concurso o disponibilizaremos no formato impresso.
</h3>

<a href="/inscricao/arquivo/psc/2022-e12/manual-aplicador-psc2022-e12.pdf">Manual de Instruções do Aplicador (PSC 2022 - Etapas 1 e 2)</a>

<h2></h2>

<div class="yiiForm">

	<?php echo CHtml::beginForm(); ?>
	<?php echo CHtml::errorSummary($form); ?>

	<table class="dataGrid">

		<tr>
			<th class="label" style="text-align: right;">Nº de Inscrição:</th>
			<td><?php echo inscricao::load($form->colaborador->colab_id_pk, $form->concurso->conc_id_pk)->insc_id_pk; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;"><?php echo CHtml::activeLabel($form,'nome'); ?>:</th>
			<td><?php echo $form->colaborador->nomeProprio; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;"><?php echo CHtml::activeLabel($form,'colab_cpf'); ?>:</th>
			<td><?php echo $form->colab_cpf; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;"><?php echo CHtml::activeLabel($form,'concurso'); ?>:</th>
			<td><?php echo $form->concurso->conc_nome .' - <b>Realização:</b> '. CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$form->concurso->conc_data_realizacao)); ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;"><?php echo CHtml::activeLabel($form,'instituicao'); ?>:</th>
			<td><?php echo $form->instituicao->inst_nome; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;"><?php echo CHtml::activeLabel($form,'funcao'); ?>:</th>
    		<td>Aplicador (Sala ou Volante)</td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">Data de Nascimento:</th>
			<td><?php echo date_format(date_create($form->colaborador->colab_nascimento), "d/m/Y"); ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;"><?php echo CHtml::activeLabel($form,'colab_celular_1'); ?>:</th>
    		<td><?php echo $form->colaborador->celularFormatado; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;"><?php echo CHtml::activeLabel($form,'colab_email'); ?>:</th>
    		<td><?php echo $form->colab_email; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;"><?php echo CHtml::activeLabel($form,'colab_pis'); ?>:</th>
    		<td><?php echo $form->colaborador->pisFormatado; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;"><?php echo CHtml::activeLabel($form,'colab_rg'); ?>:</th>
    		<td><?php echo $form->colaborador->colab_rg; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;"><?php echo CHtml::activeLabel($form,'colab_banco_id'); ?>:</th>
			<td><?php echo $form->colaborador->banco->bancoComCodigo; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;"><?php echo CHtml::activeLabel($form,'colab_agencia'); ?>:</th>
			<td><?php echo $form->colaborador->colab_agencia; ?></td>
		</tr>
		<tr>
			<th class="label" style="text-align: right;"><?php echo CHtml::activeLabel($form,'colab_conta'); ?>:</th>
			<td><?php echo $form->colaborador->colab_conta; ?></td>
		</tr>
		<tr>
			<th class="label" style="text-align: right;"><?php echo CHtml::activeLabel($form,'colab_conta_dv'); ?>:</th>
			<td><?php echo $form->colaborador->colab_conta_dv; ?></td>
		</tr>
	</table>

	<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->