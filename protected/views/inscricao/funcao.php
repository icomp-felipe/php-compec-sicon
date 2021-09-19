<h2>Escolha uma Função</h2>

<div class="actionBar">

	<ul>

		<li><b>Concurso</b>: <?php echo $form->concurso->descricao .' - <b>Realização:</b> '. CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$form->concurso->conc_data_realizacao)); ?>

            <?php // Só mostra o botão de trocar caso haja mais de um concurso disponível ?>
            <?php if ($form->multiplosConcursos): ?>
                <?php echo ' ['.CHtml::link('Trocar',array('selecionarConcursoEtapa')).']'; ?>
            <?php endif; ?><br>

        </li>

		<li><b>Instituição</b>: <?php echo $form->instituicao->nomeComCodigo; ?>

            <?php // Só mostra o botão de trocar caso haja mais de uma instituição disponível ?> 
            <?php if ($form->multiplasInstituicoes): ?>
                <?php echo ' ['.CHtml::link('Trocar',array('selecionarInstituicao')).']'; ?>
            <?php endif; ?>

        </li>

		<li>

			<?php // Apenas conveniência, ajusta o pronome de acordo com o sexo do colaborador ?>
			<?php if($form->colaborador->colab_sexo == 'F'): ?>
				<b>Colaboradora:</b> 
			<?php else: ?>
				<b>Colaborador:</b> 
			<?php endif; ?>
			<?php echo $form->colaborador->nomeProprio.' ['.CHtml::link('Trocar',array('selecionarColaborador')).']'; ?>

		</li>

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