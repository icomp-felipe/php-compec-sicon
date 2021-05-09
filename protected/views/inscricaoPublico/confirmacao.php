<h2>Confirme os dados de sua solicitação de inscrição</h2>

<div class="yiiForm">

	<?php echo CHtml::beginForm(); ?>
	<?php echo CHtml::errorSummary($form); ?>

	<table class="dataGrid">

		<tr>
			<th class="label">CPF + Nome:</th>
    		<td><?php echo $form->cpf; ?> - <?php echo $form->colaborador->nome; ?></td>
		</tr>

		<tr>
			<th class="label">Concurso:</th>
    		<td><?php echo $form->concurso->descricao .'. <b>Realização:</b> '. CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$form->etapa->data_realizacao)); ?></td>
		</tr>

		<tr>
			<th class="label">Instituição:</th>
    		<td><?php echo $form->instituicao->nome; ?></td>
		</tr>

		<tr>
			<th class="label">PIS | PASEP | NIS | NIT:</th>
    		<td>
				<?php $this->widget('CMaskedTextField',array(
					'model'=>$form,
					'attribute'=>'pispasep',
					'mask'=>'999.99999.99-9',
					'placeholder'=>'_',
					'htmlOptions'=>array(
						'size'=>15,
						'maxlength'=>15,
					)
        		)); ?>
			</td>
		</tr>

		<tr>
			<th class="label">Nº do RG:</th>
    		<td><?php echo CHtml::activeTextField($form,'doc_identidade',array('size'=>15,'maxlength'=>15)); ?></td>
		</tr>

		<tr>
			<th class="label">Nome do Banco:</th>
    		<td><?php echo CHtml::activeTextField($form,'banco',array('size'=>15,'maxlength'=>15)); ?></td>
		</tr>

		<tr>
			<th class="label">Nº da Agência (s/ dígito):</th>
			<td><?php echo CHtml::activeTextField($form,'agencia',array('size'=>15,'maxlength'=>15)); ?></td>
		</tr>

		<tr>
			<th class="label">Nº da Conta (com dígito):</th>
			<td><?php echo CHtml::activeTextField($form,'contacorrente',array('size'=>15,'maxlength'=>15)); ?></td>
		</tr>

	</table>

	<br>

	<div class="action">
		<?php echo CHtml::submitButton('Inscrever',array('submit'=>array('inscricaonet/confirmar'))); ?>
	</div>

	<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->