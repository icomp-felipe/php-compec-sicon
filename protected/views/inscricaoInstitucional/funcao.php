<h2>Escolha a Fun��o</h2>

<div class="actionBar">
<br/><?php echo $form->concurso->descricao .'. Prova do dia: '. CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$form->etapa->data_realizacao)).'. '.CHtml::link('Desejo alterar o processo seletivo...',array('concursosEtapas')); ?><br/>
<?php echo $form->instituicao->nome.'. '.CHtml::link('Desejo alterar a institui��o...',array('selecionarInstituicao')); ?>
</div>
<center>
<table class="dataGrid" style="width:300px">
<thead>
	<tr>
		<th>Fun��o</th>
	</tr>
</thead>
<?php foreach($models as $n=>$model): ?>
	<tr class="<?php echo $n%2?'even':'odd';?>">
		<td><?php echo CHtml::link($model->nome,array('selecionarFuncao','idfuncao'=>$model->idFuncao)); ?></td>
	</tr> 
<?php endforeach; ?>
  </tbody>
</table>
</center>
<br/>