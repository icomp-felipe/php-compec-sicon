<?php $this->pageTitle=Yii::app()->name; ?>

<?php if (!Yii::app()->user->isGuest):?>
<h1>
	Instituição Selecionada: <?=$instituicao->nome?>
</h1>

	<?php if (isset($models)): ?>
		<br/>Selecione a etapa para a qual deseja emitir o folder:
<ul>
		<?php foreach($models as $n=>$model): ?>
			<li><?php echo CHtml::encode($model->etapa->concurso->descricao); ?>
      		&nbsp;[<?php echo CHtml::link('Folder',array('entregafolder','idetapa'=>$model->idetapa,'idinstituicao'=>$instituicao->idinstituicao),array('target'=>'_blank')); ?>]</li>			
		<?php endforeach; ?>
</ul>
	<?php endif; ?>
	</p>
	<p style="text-align:center; font-weight:bolder; font-family:='Calibri'; font-size:16px; color:#990000" >
	
	<?php //echo CHtml::link('Gestor de escola, clique aqui e leia as instruções antes de prosseguir!',array('instrucaoInstitucional')); ?>
	</p>
<?php endif;?>