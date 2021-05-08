<?php $this->pageTitle=Yii::app()->name; ?>

<?php if (Yii::app()->user->isGuest):?>
<h1>
	Bem-vindo!
</h1>
	<p>
	Neste site, voc� poder� ativar-se nos concursos em aberto.
	</p>
	<p style="text-align:center; font-weight:bolder; font-family:='Calibri'; font-size:16px ;color:#990000" >
	<?php //echo CHtml::link('Amigo colaborador, clique aqui e leia as instru��es antes de prosseguir!',array('instrucaoInternet')); ?>
	</p>
<?php else: ?>
	<h1>
		Bem-vindo, <?php echo Yii::app()->user->name; ?>!
	</h1>
	<p>
	Neste site, voc� pode identificar os concursos abertos e ativar colaboradores nas fun��es existentes. 
	
	<?php if (isset($instituicoesDirigidas)): ?>
		<br/>Voc� pode gerenciar informa��es na(s) seguinte(s) institui��o(�es):
<ul>
		<?php foreach($instituicoesDirigidas as $n=>$model): ?>
			<li><?php echo CHtml::encode($model->nome); ?>
      		&nbsp;[<?php echo CHtml::link('Entrega de folder',array('etapas','id'=>$model->idinstituicao)); ?>]</li>			
		<?php endforeach; ?>
</ul>
	<?php endif; ?>
	</p>
	<p style="text-align:center; font-weight:bolder; font-family:='Calibri'; font-size:16px; color:#990000" >
	
	<?php //echo CHtml::link('Gestor de escola, clique aqui e leia as instru��es antes de prosseguir!',array('instrucaoInstitucional')); ?>
	</p>
<?php endif;?>