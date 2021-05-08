<h2>Escolha uma instituição</h2>

<h3 class="actionBar">
	<?php if($form->colaborador->sexo == 'F'): ?>
        Colaboradora:
    <?php else: ?>
        Colaborador:
    <?php endif; ?>
    <?php echo $form->colaborador->nome .' ['. CHtml::link('Trocar]',array('CpfForm')); ?><br>
	<?php echo $form->concurso->descricao .' - Realização: '. CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$form->etapa->data_realizacao)).' ['.CHtml::link('Trocar]',array('selecionarConcurso')); ?>
</h3>

<table class="dataGrid">

	<?php $grupo = null; ?>
	<?php $linha = 0; ?>

	<?php foreach($models as $n=>$model): ?>

		<?php $mudougrupo = false;?>

		<?php if ($grupo != $model->idgrupoinstituicao): ?>

			<thead>
				<tr>
					<th colspan="2"><?php echo CHtml::encode($model->grupoinstituicao->nome); ?></th>
				</tr>
			</thead>

			<?php $grupo = $model->idgrupoinstituicao;?>
			<?php $linha = 0;?>

		<?php endif; ?>

		<?php $linha = $linha + 1;?>

		<tr class="<?php echo $linha % 2 ? 'even' : 'odd';?>">
			<td><?php echo CHtml::link($model->nome,array('confirmacao','id'=>$model->idinstituicao)); ?></td>
			<td><?php echo $model->getEndereco(); ?>
		</tr>

	<?php endforeach; ?>

  	</tbody>

</table>