<h2>Atualiza��o dos dados cadastrais do colaborador</h2>

<div class="actionBar">
<br/><?php echo $form->concurso->descricao .'. Prova do dia: '. CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$form->etapa->data_realizacao)).'. '.CHtml::link('Desejo alterar o processo seletivo...',array('concursosEtapas')); ?><br/>
<?php echo $form->instituicao->nome.'. '.CHtml::link('Desejo alterar a institui��o...',array('selecionarInstituicao')); ?><br/>
<?php echo $form->funcao->nome.'. '.CHtml::link('Desejo alterar a fun��o...',array('selecionarFuncao')); ?>
<br/>
<?php echo $form->colaborador->cpf.'. '.CHtml::link('Desejo alterar o colaborador...',array('selecionarColaborador')); ?>
</div>

<p>
Se realmente for este colaborador que voc� deseja inscrever como <?php echo $form->funcao->nome;?> neste <?php echo $form->concurso->descricao;?> para trabalhar na Institui��o <?php echo $form->instituicao->nome?>, voc� precisa confirmar os dados cadastrais abaixo, caso contr�rio, selecione uma das seguintes op��es:

<div class="actionBar">
<ul>
<li><?php echo $form->concurso->descricao .'. Prova do dia: '. CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$form->etapa->data_realizacao)).'. '.CHtml::link('Desejo alterar o processo seletivo...',array('concursosEtapas')); ?></li>
<li>
<?php echo $form->instituicao->nome.'. '.CHtml::link('Desejo alterar a institui��o...',array('selecionarInstituicao')); ?></li>
<li><?php echo $form->funcao->nome.'. '.CHtml::link('Desejo alterar a fun��o...',array('selecionarFuncao')); ?></li>
<li><?php echo $form->colaborador->cpf.'. '.CHtml::link('Desejo alterar o colaborador...',array('selecionarColaborador')); ?></li>
</ul>
</div>

<?php echo $this->renderPartial('_formColaborador', array(
	'model'=>$model,
	'update'=>true,
	'form'=>$form,	
)); ?>