<?php // Homepage de usuário comum ?>

<?php if (Yii::app()->user->isGuest):?>

	<h1>Bem-vindo(a)!</h1>
	<h3>Neste site você poderá se inscrever nos concursos em aberto.</h3>
	
<?php // Homepage de usuário logado ?>

<?php else: ?>

	<?php if ($colaborador->sexo == 'F'): ?>
		<h1>Bem vinda, gestora!</h1>
	<?php else: ?>
		<h1>Bem vindo, gestor!</h1>
	<?php endif;?>

	<h3>Neste site você pode identificar os concursos abertos e inscrever colaboradores nas funções disponibilizadas.
	    Basta usar os links na barra do menu superior.<br><br>
	
	<?php if (isset($instituicoesDirigidas)): ?>

		<?php if (count($instituicoesDirigidas) == 1): ?>
			Abaixo está a instituição sob sua responsabilidade:
		<?php else: ?>
			Você pode gerenciar informações das seguintes instituições:
		<?php endif;?>

		<ul>
			<?php foreach($instituicoesDirigidas as $n=>$model): ?>
				<li><?php echo CHtml::encode($model->nome); ?>
				&nbsp;[<?php echo CHtml::link('Entrega de Manual',array('concursosManual','id'=>$model->idinstituicao)); ?>]</li>			
			<?php endforeach; ?>
		</ul>

	<?php endif; ?>

	</h3>
<?php endif;?>