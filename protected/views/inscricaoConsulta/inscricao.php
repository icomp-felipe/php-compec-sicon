<h2>Confirmação de Inscrição</h2>

	<?php if ($arquivo != null): ?>
		<a href="<?php echo $arquivo->arq_caminho; ?>" target="_blank" rel="noopener noreferrer"><?php echo $arquivo->arq_nome; ?></a>
	<?php endif; ?>

<h2></h2>

<div class="yiiForm">

	<?php echo CHtml::beginForm(); ?>

	<table class="dataGrid">

		<tr>
			<th class="label" style="text-align: right;">Nº de Inscrição:</th>
			<td><?php echo $inscricao->insc_id_pk; ?></td>
		</tr>

        <tr>
			<th class="label" style="text-align: right;">Data e Hora de Inscrição:</th>
			<td><?php echo CHtml::encode(Yii::app()->dateFormatter->format("dd/MM/yyyy 'às' HH:mm:ss", $inscricao->insc_create_datetime)); ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">Nome:</th>
			<td><?php echo $inscricao->colaborador->nomeProprio; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">CPF:</th>
			<td><?php echo $inscricao->colaborador->cpfFormatado; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">Concurso:</th>
			<td><?php echo $funcaoConcurso->concurso->conc_nome; ?></td>
		</tr>

        <tr>
			<th class="label" style="text-align: right;">Função:</th>
    		<td>
				<?php echo $funcaoConcurso->funcao->func_nome; ?>
                <?php if ($funcaoConcurso->funcao->func_id_pk == 1): ?>
                    <?php echo ' (Sala ou Volante)'; ?>
                <?php endif; ?>
            </td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">Instituição:</th>
			<td><?php echo $inscricao->mapa->instituicao->inst_nome; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">Endereço da Instituição:</th>
    		<td><?php echo $inscricao->mapa->instituicao->endereco; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">Mapa da Instituição:</th>
    		<td><a href="<?php echo $inscricao->mapa->instituicao->inst_maps; ?>" target="_blank" rel="noopener noreferrer"><?php echo $inscricao->mapa->instituicao->inst_maps; ?></a></td>
		</tr>

	</table>

	<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->