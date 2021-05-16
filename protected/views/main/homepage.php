<?php // Homepage de usuário comum ?>

<?php if (Yii::app()->user->isGuest):?>

	<h1>Bem-vindo(a)!</h1>
	<h3>Neste site você poderá se inscrever nos concursos em aberto.</h3>
	
<?php // Homepage de usuário logado ?>

<?php else: ?>

	<?php if ($colaborador->sexo == 'F'): ?>
		<center><h1>Seja bem vinda ao site de Inscrição de Colaboradores!</h1></center>
		<h2>Gestora: <?php echo CHtml::encode($colaborador->nome); ?></h2>
	<?php else: ?>
		<center><h1>Seja bem vindo ao site de Inscrição de Colaboradores!</h1></center>
		<h2>Gestor: <?php echo CHtml::encode($colaborador->nome); ?></h2>
	<?php endif;?>

	<p></p>

	<h3>Neste site você pode identificar os concursos abertos e inscrever colaboradores nas funções disponibilizadas.
	    Basta usar os links na barra do menu superior.<br><br>
	
	<?php if (isset($instituicoesDirigidas)): ?>

		<?php if (count($instituicoesDirigidas) == 1): ?>
			Abaixo está a instituição sob sua responsabilidade:
		<?php else: ?>
			Você pode gerenciar informações das seguintes instituições:
		<?php endif;?>

		<ul style="color: green;">
			<?php foreach($instituicoesDirigidas as $n => $model): ?>
				<li><?php echo CHtml::encode($model->nomeComCodigo); ?></li>			
			<?php endforeach; ?>
		</ul>

	<?php endif; ?>

	</h3>
<?php endif;?>