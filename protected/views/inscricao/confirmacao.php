<h2>Por favor, confirme se todos os dados abaixo estão corretos</h2>

<div class="actionBar">
    <ul>

        <li><b>Concurso</b>: <?php echo $form->concurso->descricao .' - <b>Realização:</b> '. CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$form->etapa->data_realizacao)); ?>

            <?php // Só mostra o botão de trocar caso haja mais de um concurso disponível ?>
            <?php if ($form->multiplosConcursos): ?>
                <?php echo ' ['.CHtml::link('Trocar',array('selecionarConcursoEtapa')).']'; ?>
            <?php endif; ?><br>

        </li>

		<li><b>Instituição</b>: <?php echo $form->instituicao->inst_nome; ?>

            <?php // Só mostra o botão de trocar caso haja mais de uma instituição disponível ?> 
            <?php if ($form->multiplasInstituicoes): ?>
                <?php echo ' ['.CHtml::link('Trocar',array('selecionarInstituicao')).']'; ?>
            <?php endif; ?>

        </li>

		<li><b>
				
			<?php // Apenas conveniência, ajusta o pronome de acordo com o sexo do colaborador ?>
			<?php if($form->colaborador->sexo == 'F'): ?>
				Colaboradora:
			<?php else: ?>
				Colaborador:
			<?php endif; ?></b>
			<?php echo $form->colaborador->nome.' ['.CHtml::link('Trocar',array('selecionarColaborador')).']'; ?>

		</li>

		<li><b>Função</b>: <?php echo $form->funcao->nome.' ['.CHtml::link('Trocar',array('selecionarFuncao')).']'; ?></li>
		
    </ul>
</div>

<div class="yiiForm">
	
	<?php echo CHtml::beginForm(); ?>
	<?php echo CHtml::errorSummary($form); ?>

	<table class="dataGrid">

		<thead>
			<tr>
				<th colspan="2">
					<?php if($form->colaborador->sexo == 'F'): ?>
						Dados da Colaboradora
					<?php else: ?>
						Dados do Colaborador
					<?php endif; ?>
				</th>
			</tr>
		</thead>

		<tr>
			<th class="label">Nome:</th>
			<td><?php echo $form->colaborador->nome; ?></td>
		</tr>

		<tr>
			<th class="label">CPF:</th>
			<td><?php echo $form->colaborador->cpfFormatado; ?></td>
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