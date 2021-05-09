<h2>Por favor, confirme se todos os dados abaixo estão corretos</h2>

<div class="actionBar">
    <ul>
        <li><b>Concurso</b>: <?php echo $form->concurso->descricao .' - <b>Realização:</b> '. CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$form->etapa->data_realizacao)).' ['.CHtml::link('Trocar',array('selecionarConcursoEtapa')).']'; ?></li>
        <li><b>Instituição</b>: <?php echo $form->instituicao->nome.' ['.CHtml::link('Trocar',array('selecionarInstituicao')).']'; ?></li>
        <li><b>Função</b>: <?php echo $form->funcao->nome.' ['.CHtml::link('Trocar',array('selecionarFuncao')).']'; ?></li>
		<li><b>
			<?php if($form->colaborador->sexo == 'F'): ?>
				Colaboradora:
			<?php else: ?>
				Colaborador:
			<?php endif; ?></b>
			<?php echo $form->colaborador->nome.' ['.CHtml::link('Trocar',array('selecionarColaborador')).']'; ?>
		</li>
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
			<th class="label">CPF + Nome:</th>
			<td><?php echo $form->cpf; ?> - <?php echo $form->colaborador->nome; ?></td>
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
		<?php echo CHtml::submitButton('Inscrever',array('submit'=>array('inscricaoInstitucional/confirmar'))); ?>
	</div>

	<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->