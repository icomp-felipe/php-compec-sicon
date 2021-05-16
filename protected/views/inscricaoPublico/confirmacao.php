<h2>Confirme os dados de sua solicitação de inscrição</h2>

<div class="yiiForm">

	<?php echo CHtml::beginForm(); ?>
	<?php echo CHtml::errorSummary($form); ?>

	<table class="dataGrid">

		<tr>
			<th class="label">Nome:</th>
    		<td><?php echo $form->colaborador->nome; ?></td>
		</tr>

		<tr>
			<th class="label">CPF:</th>
    		<td><?php echo $form->cpf; ?></td>
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
    		<td>Aplicador (Sala ou Volante)</td>
		</tr>

		<tr>
			<th class="label">Celular (WhatsApp):</th>
    		<td>
				<?php $this->widget('CMaskedTextField',array(
						'model'=>$form,
						'attribute'=>'celular',
						'mask'=>'(99) 99999-9999',
						'placeholder'=>'_',
						'htmlOptions'=>array(
							'size'=>15,
							'maxlength'=>20,
						)
					)); ?>
			</td>
		</tr>

		<tr>
			<th class="label">e-mail:</th>
    		<td><?php echo CHtml::activeTextField($form,'email',array('size'=>44,'maxlength'=>45)); ?></td>
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
						'maxlength'=>20,
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
    		<td><?php echo CHtml::activeDropDownList($form, 'colab_banco_id', 
									CHtml::listData(banco::model()->findAll(),'banco_id_pk','bancoComCodigo'),
									array('empty'=>'Selecione')) ?></td>
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
		<?php echo CHtml::submitButton('Inscrever',array('submit'=>array('confirmar'))); ?>
	</div>

	<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->