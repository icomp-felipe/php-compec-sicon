<h2>Parabéns! Sua inscrição foi confirmada!</h2>

<p>ADICIONAR LINK DO MANUAL</p>

<div class="yiiForm">

	<?php echo CHtml::beginForm(); ?>
	<?php echo CHtml::errorSummary($form); ?>

	<table class="dataGrid">

		<tr>
			<th class="label" style="text-align: right;">Nº de Inscrição:</th>
			<td><?php echo inscricao::load($form->colaborador->idColaborador, $form->etapa->idetapa)->idinscricao; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;"><?php echo CHtml::activeLabel($form,'nome'); ?>:</th>
			<td><?php echo $form->colaborador->nome; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;"><?php echo CHtml::activeLabel($form,'cpf'); ?>:</th>
			<td><?php echo $form->cpf; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;"><?php echo CHtml::activeLabel($form,'concurso'); ?>:</th>
			<td><?php echo $form->concurso->descricao .' - <b>Realização:</b> '. CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$form->etapa->data_realizacao)); ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;"><?php echo CHtml::activeLabel($form,'instituicao'); ?>:</th>
			<td><?php echo $form->instituicao->nomeSemId; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;"><?php echo CHtml::activeLabel($form,'funcao'); ?>:</th>
    		<td>Aplicador (Sala ou Volante)</td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;"><?php echo CHtml::activeLabel($form,'celular'); ?>:</th>
    		<td><?php echo $form->celular; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;"><?php echo CHtml::activeLabel($form,'email'); ?>:</th>
    		<td><?php echo $form->email; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;"><?php echo CHtml::activeLabel($form,'pispasep'); ?>:</th>
    		<td><?php echo $form->colaborador->pisFormatado; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;"><?php echo CHtml::activeLabel($form,'doc_identidade'); ?>:</th>
    		<td><?php echo $form->colaborador->doc_identidade; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;"><?php echo CHtml::activeLabel($form,'banco'); ?>:</th>
			<td><?php echo $form->colaborador->banco; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;"><?php echo CHtml::activeLabel($form,'agencia'); ?>:</th>
			<td><?php echo $form->colaborador->agencia; ?></td>
		</tr>
		<tr>
			<th class="label" style="text-align: right;"><?php echo CHtml::activeLabel($form,'contacorrente'); ?>:</th>
			<td><?php echo $form->colaborador->contacorrente; ?></td>
		</tr>
	</table>

	<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->