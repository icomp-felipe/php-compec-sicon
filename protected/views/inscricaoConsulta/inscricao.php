<h2>Confirmação de Inscrição</h2>

	<?php if ($funcaoConcurso->concurso->conc_id_pk == 58): ?>
        <a href="/inscricao/arquivo/pse/2020/manual-aplicador-pse2020.pdf">Manual de Instruções do Aplicador (PSE 2020)</a>
    <?php elseif ($funcaoConcurso->concurso->conc_id_pk == 59): ?>
		<a href="/inscricao/arquivo/pstec/2021/manual-aplicador-pstec2021.pdf">Manual de Instruções do Aplicador (Concurso Público 2021)</a>
	<?php elseif ($funcaoConcurso->concurso->conc_id_pk == 60): ?>
		<a href="/inscricao/arquivo/psc/2021-e3/manual-aplicador-psc2021-e3.pdf">Manual de Instruções do Aplicador (PSC 2021 - Etapa 3)</a>
	<?php elseif ($funcaoConcurso->concurso->conc_id_pk == 62): ?>
		<a href="/inscricao/arquivo/psc/2021-e12/manual-aplicador-psc2021-e12.pdf">Manual de Instruções do Aplicador (PSC 2021 - Etapas 1 e 2)</a>
	<?php elseif ($funcaoConcurso->concurso->conc_id_pk == 63): ?>
		<a href="/inscricao/arquivo/pstec/2022/manual-aplicador-pstec2022.pdf">Manual de Instruções do Aplicador (Concurso Público 2022)</a>
	<?php elseif ($funcaoConcurso->concurso->conc_id_pk == 65): ?>
		<a href="/inscricao/arquivo/psc/2022-e3/manual-aplicador-psc2022-e3.pdf">Manual de Instruções do Aplicador (PSC 2022 - Etapa 3)</a>
	<?php elseif ($funcaoConcurso->concurso->conc_id_pk == 69): ?>
		<a href="/inscricao/arquivo/psc/2022-e12/manual-aplicador-psc2022-e12.pdf">Manual de Instruções do Aplicador (PSC 2022 - Etapas 1 e 2)</a>
	<?php elseif ($funcaoConcurso->concurso->conc_id_pk == 77): ?>
		<a href="/inscricao/arquivo/psc/2023-e12/manual-aplicador-psc2023-e12.pdf">Manual de Instruções do Aplicador (PSC 2023 - Etapas 1 e 2)</a>
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