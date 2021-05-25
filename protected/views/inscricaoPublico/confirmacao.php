<h2>Confirme os dados de sua solicitação de inscrição</h2>

<div class="yiiForm">

	<?php echo CHtml::beginForm(); ?>
	<?php echo CHtml::errorSummary($form); ?>

	<table class="dataGrid">

		<tr>
			<th class="label" style="text-align: right;">Nome:</th>
    		<td><?php echo $form->colaborador->nomeProprio; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">CPF:</th>
    		<td><?php echo $form->cpf; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">Concurso:</th>
    		<td><?php echo $form->concurso->descricao .' - <b>Realização:</b> '. CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$form->concurso->conc_data_realizacao)); ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">Instituição:</th>
    		<td><?php echo $form->instituicao->inst_nome; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">Função:</th>
    		<td>Aplicador (Sala ou Volante)</td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">Celular (WhatsApp):</th>
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
			<th class="label" style="text-align: right;">e-mail:</th>
    		<td><?php echo CHtml::activeTextField($form,'email',array('size'=>44,'maxlength'=>45)); ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">PIS | PASEP | NIS | NIT:</th>
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
			<th class="label" style="text-align: right;">Nº do RG:</th>
    		<td><?php echo CHtml::activeTextField($form,'doc_identidade',array('size'=>15,'maxlength'=>15)); ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">Nome do Banco:</th>
    		<td><?php echo CHtml::activeDropDownList($form, 'colab_banco_id', 
									CHtml::listData(banco::model()->findAll(),'banco_id_pk','bancoComCodigo'),
									array('empty'=>'Selecione')) ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">Nº da Agência (s/ dígito):</th>
			<td><?php echo CHtml::activeTextField($form,'agencia',array('size'=>15,'maxlength'=>15)); ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">Nº da Conta (com dígito):</th>
			<td><?php echo CHtml::activeTextField($form,'contacorrente',array('size'=>15,'maxlength'=>15)); ?></td>
		</tr>

	</table>

	<br>

	<p><?php echo CHtml::activeCheckBox($form, 'ciente'); ?> Declaro que meus dados estão corretos e, ainda, que:
		<ul>
			<li>Não pertenço ao grupo de risco;</li>
			<li>Se pertenço, estou vacinado com as duas doses contra a SARS-CoV-2 (COVID-19).</li>
		</ul>
	</p>

	<br>

	<div class="action">
		<?php echo CHtml::submitButton('Inscrever',array('submit' => array('confirmar', 'true'))); ?>
	</div>

	<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->