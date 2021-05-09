<h2>Cadastrar colaborador</h2>

<div class="actionBar">
<br/><?php echo $form->concurso->descricao .'. Prova do dia: '. CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$form->etapa->data_realizacao)).'. '.CHtml::link('Desejo alterar o processo seletivo...',array('concursosEtapas')); ?><br/>
<?php echo $form->instituicao->nome.'. '.CHtml::link('Desejo alterar a instituição...',array('selecionarInstituicao')); ?><br/>
<?php echo $form->funcao->nome.'. '.CHtml::link('Desejo alterar a função...',array('selecionarFuncao')); ?>
</div>

<div class="errorSummary">
<p>O CPF "<?php echo $form->cpf ?>" não está cadastrado em nosso banco de dados, preencha o formulário abaixo para inserí-lo ou <?php echo CHtml::link('clique aqui para informar outro CPF...',array('selecionarColaborador')); ?>
</p>
</div>

<?php echo $this->renderPartial('_formColaborador', array(
	'model'=>$model,
	'update'=>false,
	'form'=>$form,		
)); ?>
