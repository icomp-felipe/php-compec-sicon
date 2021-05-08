<?php $this->pageTitle=Yii::app()->name; ?>

<?php if (Yii::app()->user->isGuest):?>
<h1>
	Bem-vindo!
</h1>
	<p>
	Neste site, você poderá ativar-se nos concursos em aberto.
	</p>
	<p style="text-align:center; font-weight:bolder; font-family:='Calibri'; font-size:16px ;color:#990000" >
	<?php //echo CHtml::link('Amigo colaborador, clique aqui e leia as instruções antes de prosseguir!',array('instrucaoInternet')); ?>
	</p>
<?php else: ?>
	<h1>
		Bem-vindo, <?php echo Yii::app()->user->name; ?>!
	</h1>
	<p>
	Neste site, você pode identificar os concursos abertos e ativar colaboradores nas funções existentes. 
	
	<?php if (isset($instituicoesDirigidas)): ?>
		<br/>Você pode gerenciar informações na(s) seguinte(s) instituição(ões):
<ul>
		<?php foreach($instituicoesDirigidas as $n=>$model): ?>
			<li><?php echo CHtml::encode($model->nome); ?>
      		&nbsp;[<?php echo CHtml::link('Entrega de folder',array('etapas','id'=>$model->idinstituicao)); ?>]</li>			
		<?php endforeach; ?>
</ul>
	<?php endif; ?>
	</p>
	<p style="text-align:center; font-weight:bolder; font-family:='Calibri'; font-size:16px; color:#990000" >
	
	<?php //echo CHtml::link('Gestor de escola, clique aqui e leia as instruções antes de prosseguir!',array('instrucaoInstitucional')); ?>
	</p>
<?php endif;?>
