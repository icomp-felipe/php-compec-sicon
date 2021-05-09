<?php $this->pageTitle=Yii::app()->name; ?>

	<?php if (Yii::app()->user->isGuest):?>
		<h1>Bem-vindo(a)!</h1>
		<h3>Neste site você poderá se inscrever nos concursos em aberto.</h3>
	<?php else: ?>

	<h1>Bem-vindo(a), <?php echo Yii::app()->user->name; ?>!</h1>
	<h3>Neste site, você pode identificar os concursos abertos e inscrever colaboradores nas funções disponibilizadas.
	
	<?php if (isset($instituicoesDirigidas)): ?>
		<br/>Você pode gerenciar informações na(s) seguinte(s) instituição(ões):
		<ul>
			<?php foreach($instituicoesDirigidas as $n=>$model): ?>
				<li><?php echo CHtml::encode($model->nome); ?>
				&nbsp;[<?php echo CHtml::link('Entrega de Manual',array('etapas','id'=>$model->idinstituicao)); ?>]</li>			
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>

	</h3>
<?php endif;?>