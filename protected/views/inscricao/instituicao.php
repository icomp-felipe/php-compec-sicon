<h2>Escolha uma Instituição</h2>

<div class="actionBar">
	<ul>
		<li><b>Concurso</b>: <?php echo $form->concurso->descricao .' - <b>Realização:</b> '. CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$form->etapa->data_realizacao)).' ['.CHtml::link('Trocar',array('selecionarConcursoEtapa')).']'; ?></li>
	</ul>
</div>

<table class="dataGrid">

	<?php $linha = 0; ?>

	<thead>
			<tr>
				<th colspan="2">Instituições Disponíveis</th>
			</tr>
		</thead>

	<?php foreach($models as $n=>$model): ?>

		<tr class="<?php echo $linha % 2 ? 'even' : 'odd';?>">
			<td><?php echo CHtml::link($model->inst_nome,array('selecionarInstituicao','idinstituicao'=>$model->inst_id_pk)); ?></td>
			<td><?php echo $model->getEndereco(); ?>
		</tr>

	<?php endforeach; ?>

  	</tbody>

</table>