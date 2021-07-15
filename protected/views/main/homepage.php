<?php // Homepage de usuário comum ?>

<?php if (Yii::app()->user->isGuest):?>

	<h1>Bem-vindo(a)!</h1>
	<h2>Neste site você poderá se inscrever nos concursos em aberto.</h2>
	<h2>Consulte abaixo o edital de chamada:</h2>

	<a href="/inscricao/arquivo/pstec/2021/chamada-publica-pstec2021.pdf">Chamada Pública - Concurso Público UFAM 2021</a>

	<h1>Inscriçômetro:
		<?php if ($inscricometro->inscricometro <= 0): ?>
			<span style="color: red">Todas as vagas para aplicador de prova completadas!</span>
		<?php else: ?>
			<span style="color: green"><?php echo $inscricometro->inscricometro; ?> vagas restantes</span>
		<?php endif; ?>
	</h1>
	
<?php // Homepage de usuário logado ?>

<?php else: ?>

	<?php if ($colaborador->sexo == 'F'): ?>
		<center><h1>Seja bem vinda ao site de Inscrição de Colaboradores!</h1></center>
		<h2>Gestora: <?php echo CHtml::encode($colaborador->nomeProprio); ?></h2>
	<?php else: ?>
		<center><h1>Seja bem vindo ao site de Inscrição de Colaboradores!</h1></center>
		<h2>Gestor: <?php echo CHtml::encode($colaborador->nomeProprio); ?></h2>
	<?php endif;?>

	<p></p>

	<h3>Neste site você pode identificar os concursos abertos e inscrever colaboradores nas funções disponibilizadas.
	    Basta usar os links na barra do menu superior.</h3>
	
	<?php if (isset($instituicoesDirigidas)): ?>

		<?php if (count($instituicoesDirigidas) == 1): ?>
			
			<h2>Consulte abaixo o edital de chamada:</h2>

			<?php if ($instituicoesDirigidas[0]->inst_municipio_id == 1): ?>
				<a href="/inscricao/arquivo/pstec/2021/nota-gestores-capital-pstec2021.pdf">Nota aos Coordenadores (Manaus) - PSTEC 2021</a>
			<?php else: ?>
				<a href="/inscricao/arquivo/pstec/2021/nota-gestores-interior-pstec2021.pdf">Nota aos Coordenadores (Interior) - PSTEC 2021</a>
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