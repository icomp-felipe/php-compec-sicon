<?php $this->pageTitle=Yii::app()->name; ?>

	<?php if (!Yii::app()->user->isGuest):?>
		<h2>Entrega de Manual [<?=$instituicao->inst_nome?>]</h2>

		<?php if (isset($models)): ?>
			<br/>Selecione o concurso para o qual deseja emitir a lista de manual:

			<ul>
				<?php foreach($models as $n=>$model): ?>
					<li><?php echo CHtml::encode($model->etapa->concurso->descricao); ?>
      				&nbsp;[<?php echo CHtml::link('Gerar Lista',array('entregaManual','idetapa'=>$model->idetapa,'idinstituicao'=>$instituicao->idinstituicao),array('target'=>'_blank')); ?>]</li>			
				<?php endforeach; ?>
			</ul>
	<?php endif; ?>
	
<?php endif;?>