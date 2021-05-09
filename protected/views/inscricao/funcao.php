<h2>Escolha uma Função</h2>

<div class="actionBar">

	<ul>
		<li><b>Concurso</b>: <?php echo $form->concurso->descricao .' - <b>Realização:</b> '. CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$form->etapa->data_realizacao)).' ['.CHtml::link('Trocar',array('selecionarConcursoEtapa')).']'; ?><br></li>
		<li><b>Instituição</b>: <?php echo $form->instituicao->nome.' ['.CHtml::link('Trocar',array('selecionarInstituicao')).']'; ?></li>
	</ul>

</div>

<center>
	<table class="dataGrid" style="width:300px">

		<thead>
			<tr>
				<th>Função</th>
			</tr>
		</thead>

		<tbody>
			<?php foreach($models as $n=>$model): ?>
				<tr class="<?php echo $n%2?'even':'odd';?>">
					<td><?php echo CHtml::link($model->nome,array('selecionarFuncao','idfuncao'=>$model->idFuncao)); ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
		
	</table>
</center>