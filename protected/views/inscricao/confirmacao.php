<h2>Por favor, confirme se todos os dados abaixo estão corretos</h2>

<div class="actionBar">
    <ul>

        <li><b>Concurso</b>: <?php echo $form->concurso->conc_nome .' - <b>Realização:</b> '. CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$form->concurso->conc_data_realizacao)); ?>

            <?php // Só mostra o botão de trocar caso haja mais de um concurso disponível ?>
            <?php if ($form->multiplosConcursos): ?>
                <?php echo ' ['.CHtml::link('Trocar',array('selecionarConcursoEtapa')).']'; ?>
            <?php endif; ?><br>

        </li>

		<li><b>Instituição</b>: <?php echo $form->instituicao->nomeComCodigo; ?>

            <?php // Só mostra o botão de trocar caso haja mais de uma instituição disponível ?> 
            <?php if ($form->multiplasInstituicoes): ?>
                <?php echo ' ['.CHtml::link('Trocar',array('selecionarInstituicao')).']'; ?>
            <?php endif; ?>

        </li>

		<li><b>
				
			<?php // Apenas conveniência, ajusta o pronome de acordo com o sexo do colaborador ?>
			<?php if($form->colaborador->colab_sexo == 'F'): ?>
				Colaboradora:
			<?php else: ?>
				Colaborador:
			<?php endif; ?></b>
			<?php echo $form->colaborador->nomeProprio.' ['.CHtml::link('Trocar',array('selecionarColaborador')).']'; ?>

		</li>

		<li><b>Função</b>: <?php echo $form->funcao->func_nome.' ['.CHtml::link('Trocar',array('selecionarFuncao')).']'; ?></li>
		
    </ul>
</div>

<div class="yiiForm">
	
	<?php echo CHtml::beginForm(); ?>
	<?php echo CHtml::errorSummary($form); ?>

	<table class="dataGrid">

		<thead>
			<tr>
				<th colspan="2">
					<?php if($form->colaborador->colab_sexo == 'F'): ?>
						Dados da Colaboradora
					<?php else: ?>
						Dados do Colaborador
					<?php endif; ?>
				</th>
			</tr>
		</thead>

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
			<td>
				<?php $this->widget('CMaskedTextField',array(
					'model'=>$form,
					'attribute'=>'colab_nascimento',
					'mask'=>'99/99/9999',
					'placeholder'=>'_',
					'htmlOptions'=>array(
						'size'=>8,
						'maxlength'=>8
					)
				)); ?>
			</td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">PIS | PASEP | NIS | NIT:</th>
			<td>
				<?php $this->widget('CMaskedTextField',array(
					'model'=>$form,
					'attribute'=>'colab_pis',
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
			<th class="label" style="text-align: right;">Nº do RG:</th>
			<td><?php echo CHtml::activeTextField($form,'colab_rg',array('size'=>15,'maxlength'=>15)); ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">Banco:</th>
			<td><?php echo CHtml::activeDropDownList($form, 'colab_banco_id', 
									CHtml::listData(banco::model()->findAll(),'banco_id_pk','bancoComCodigo'),
									array('empty'=>'Selecione')) ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">Nº da Agência (s/ dígito):</th>
			<td>
				<?php $this->widget('CMaskedTextField',array(
						'model'=>$form,
						'attribute'=>'colab_agencia',
						'mask'=>'9999',
						'placeholder'=>'_',
						'htmlOptions'=>array(
							'size'=>4,
							'maxlength'=>4
						)
					)); ?>
			</td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">Nº da Conta (sem dígito):</th>
			<td><?php echo CHtml::activeTextField($form,'colab_conta',array('size'=>15,'maxlength'=>15)); ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">DV da Conta:</th>
			<td><?php echo CHtml::activeTextField($form,'colab_conta_dv',array('size'=>1,'maxlength'=>1)); ?></td>
		</tr>

	</table>

	<br>

	<div class="action">
		<?php echo CHtml::submitButton('Inscrever',array('submit'=>array('confirmar'))); ?>
	</div>

	<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->