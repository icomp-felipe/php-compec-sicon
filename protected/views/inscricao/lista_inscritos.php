<h1>Colaboradores Inscritos</h1>

<div class="actionBar">

	<ul>
		<li><b>Concurso</b>: <?php echo $form->concurso->descricao .' - <b>Realização:</b> '. CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$form->etapa->data_realizacao)).' ['.CHtml::link('Trocar',array('selecionarConcursoEtapa')).']'; ?><br></li>
		<li><b>Instituição</b>: <?php echo $form->instituicao->nome.' ['.CHtml::link('Trocar',array('selecionarInstituicao')).']'; ?></li>
	</ul>

    <ul>
        <li>Criar um novo colaborador → [<?php echo CHtml::link('Novo', array('colaborador/create')); ?>]</li>
        <li>Inscrever um colaborador → [<?php echo CHtml::link('Inscrever', array('selecionarFuncao')); ?>]</li>
    </ul>

</div>

<table class="dataGrid">

    <thead>
        <tr>
            <th>cpf</th>
            <th>nome</th>
            <th>funcao</th>
	        <th>Operações</th>
        </tr>
    </thead>

    <tbody>

        <?php foreach($inscricoes as $n => $inscricao): ?>

            <tr class="<?php echo $n % 2 ? 'even' : 'odd'; ?>">

                <td><?php echo CHtml::link  ($inscricao->colaborador->cpfFormatado, array('colaborador/update','id' => $inscricao->idColaborador)); ?></td>
                <td><?php echo CHtml::encode($inscricao->colaborador->nome); ?></td>
                <td><?php echo CHtml::encode($inscricao->funcao->nome); ?></td>
                <td>
                    <?php echo CHtml::link('Trocar Função', array('selecionarFuncao', 'id' => $inscricao->idColaborador)); ?><br>
                    <?php echo CHtml::linkButton('Cancelar Inscrição', array(
                                'submit'  => '',
                                'params'  => array('command' => 'delete', 'id' => $inscricao->idinscricao),
                                'confirm' => "Confirma o cancelamento da inscrição do colaborador: '{$inscricao->colaborador->nome}'?")); ?>
                </td>
            </tr>
        <?php endforeach; ?>

    </tbody>
   
</table>