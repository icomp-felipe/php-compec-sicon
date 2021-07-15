<h2>Confirmação de Inscrição</h2>

    <?php if ($inscricao->concurso->idconcurso == 58): ?>
        <a href="/inscricao/arquivo/pse/2020/manual-aplicador-pse2020.pdf">Manual de Instruções do Aplicador (PSE 2020)</a>
    <?php elseif ($inscricao->concurso->idconcurso == 59): ?>
		<a href="/inscricao/arquivo/pstec/2021/manual-aplicador-pstec2021.pdf">Manual de Instruções do Aplicador (Concurso Público 2021)</a>
	<?php endif; ?>

<h2></h2>

<div class="yiiForm">

	<?php echo CHtml::beginForm(); ?>

	<table class="dataGrid">

		<tr>
			<th class="label" style="text-align: right;">Nº de Inscrição:</th>
			<td><?php echo $inscricao->idinscricao; ?></td>
		</tr>

        <tr>
			<th class="label" style="text-align: right;">Data e Hora de Inscrição:</th>
			<td><?php echo CHtml::encode(Yii::app()->dateFormatter->format("dd/MM/yyyy 'às' HH:mm:ss", $inscricao->dt_hr)); ?></td>
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
			<td><?php echo $inscricao->concurso->descricao .' - <b>Realização:</b> '. CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$inscricao->concurso->conc_data_realizacao)); ?></td>
		</tr>

        <tr>
			<th class="label" style="text-align: right;">Função:</th>
    		<td><?php echo $inscricao->funcao->descricao; ?>
                <?php if ($inscricao->funcao->idFuncao == 1): ?>
                    <?php echo ' (Sala ou Volante)'; ?>
                <?php endif; ?>
            </td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">Instituição:</th>
			<td><?php echo $inscricao->instituicao->inst_nome; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">Endereço da Instituição:</th>
    		<td><?php echo $inscricao->instituicao->endereco; ?></td>
		</tr>

		<tr>
			<th class="label" style="text-align: right;">Mapa da Instituição:</th>
    		<td><a href="<?php echo $inscricao->instituicao->inst_maps; ?>" target="_blank" rel="noopener noreferrer"><?php echo $inscricao->instituicao->inst_maps; ?></a></td>
		</tr>

	</table>

	<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->