<?php // Homepage de usuário comum ?>

<?php if (Yii::app()->user->isGuest):?>

	<h1 style="color: green">Bem-vindo(a)!</h1>
	<h2>Neste site você poderá se inscrever nos concursos em aberto.</h2>
	
<?php // Homepage de usuário logado ?>

<?php else: ?>

	<?php if ($colaborador->colab_sexo == 'F'): ?>
		<center><h1>Seja bem vinda ao site de Inscrição de Colaboradores!</h1></center>
		<h2>Coordenadora: <?php echo CHtml::encode($colaborador->nomeProprio); ?></h2>
	<?php else: ?>
		<center><h1>Seja bem vindo ao site de Inscrição de Colaboradores!</h1></center>
		<h2>Coordenador: <?php echo CHtml::encode($colaborador->nomeProprio); ?></h2>
	<?php endif;?>

	<p></p>

	<h3>Neste site você pode identificar os concursos abertos e inscrever colaboradores nas funções disponibilizadas.
	    Basta usar os links na barra do menu superior.</h3>
	
	<?php if (isset($instituicoesDirigidas)): ?>

		<?php if (count($instituicoesDirigidas) == 1): ?>
			
			<h2>Consulte abaixo o edital de chamada:</h2>

			<?php if ($instituicoesDirigidas[0]->inst_municipio_id == 1): ?>
				<a href="/inscricao/arquivo/psc/2025/nota-gestores-capital-psc2025-e12.pdf" target="_blank" rel="noopener noreferrer">Nota aos Coordenadores (Manaus) - PSC 2025 [Etapas 1 e 2]</a>
			<?php else: ?>
				<a href="/inscricao/arquivo/psc/2025/nota-gestores-interior-psc2025-e12.pdf" target="_blank" rel="noopener noreferrer">Nota aos Coordenadores (Interior) - PSC 2025 [Etapas 1 e 2]</a>
			<?php endif; ?>

			<h2>Abaixo está a instituição sob sua responsabilidade:</h2>

		<?php else: ?>

			<h2>Você pode gerenciar informações das seguintes instituições:</h2>

		<?php endif;?>

		<h3>
			<ul style="color: green;">
				<?php foreach($instituicoesDirigidas as $n => $model): ?>
					<li><?php echo CHtml::encode($model->nomeComCodigo); ?></li>
				<?php endforeach; ?>
			</ul>
		</h3>

	<?php endif; ?>

<?php endif;?>