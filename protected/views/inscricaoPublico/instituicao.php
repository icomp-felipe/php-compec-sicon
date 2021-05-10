<h2>Escolha uma Instituição</h2>

<h3 class="actionBar">
	<ul>

		<li>
			<?php if($form->colaborador->sexo == 'F'): ?>
				Colaboradora:
			<?php else: ?>
				Colaborador:
			<?php endif; ?>
			<?php echo $form->colaborador->nome .' ['. CHtml::link('Trocar',array('inscricaoPublico/autentica')).']'; ?>
		</li>

		<li><?php echo $form->concurso->descricao .' - Realização: '. CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$form->etapa->data_realizacao)).' ['.CHtml::link('Trocar]',array('selecionarConcurso')); ?></li>

	</ul>
</h3>

<table class="dataGrid">

	<thead>
		<tr>
			<th>Nome da Instituição</th>
			<th>Endereço Completo</th>
			<th>Localização (Google)</th>
		</tr>
	</thead>

	<tbody>

		<?php foreach($models as $n=>$model): ?>

			<tr class="<?php echo $n % 2 ? 'even' : 'odd';?>">

				<td><?php echo CHtml::link($model->nomeSemId,array('confirmacao','id'=>$model->idinstituicao)); ?></td>
				<td><?php echo $model->getEndereco(); ?></td>
				<td><a href="<?php echo $model->localizacao; ?>" target="_blank" rel="noopener noreferrer"><?php echo $model->localizacao; ?></a></td>

			</tr>

		<?php endforeach; ?>

  	</tbody>

</table>