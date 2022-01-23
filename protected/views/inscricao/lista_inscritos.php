<h1>Colaboradores Inscritos</h1>

<div class="actionBar">

	<ul>
		<li><b>Concurso</b>: <?php echo $form->concurso->conc_nome .' - <b>Realização:</b> '. CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$form->concurso->conc_data_realizacao)); ?>

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
	</ul>

    <ul>
        <li>Criar um novo colaborador → [<?php echo CHtml::link('Novo', array('colaborador/create')); ?>]</li>
        <li>Inscrever um colaborador → [<?php echo CHtml::link('Inscrever', array('selecionarColaborador')); ?>]</li>
    </ul>

</div>

<table class="dataGrid">

    <thead>
        <tr>
            <th>#</th>
            <th>CPF</th>
            <th><?php echo $sort->link('nome'); ?></th>
            <th><?php echo $sort->link('funcao'); ?></th>
	        <th>Operações</th>
        </tr>
    </thead>

    <tbody>

        <?php $i = 1; ?>
        <?php foreach($inscricoes as $n => $inscricao): ?>

            <tr class="<?php echo $n % 2 ? 'even' : 'odd'; ?>">

                <td style="text-align: center;"><?php echo $i++; ?></td>
                <td style="text-align: center;"><?php echo CHtml::link  ($inscricao->cpfFormatado, array('colaborador/update','id' => $inscricao->idColaborador)); ?></td>
                <td><?php echo CHtml::encode($inscricao->nomeProprio); ?></td>
                <td style="text-align: center;"><?php echo CHtml::encode($inscricao->funcao); ?></td>
                <td style="text-align: center;">
                    <?php echo CHtml::link('Trocar Função', array('selecionarFuncao', 'idinscricao' => $inscricao->idinscricao)); ?><br>
                    <?php echo CHtml::linkButton('Cancelar Inscrição', array(
                                'submit'  => '',
                                'params'  => array('command' => 'delete', 'id' => $inscricao->idinscricao),
                                'confirm' => "Confirma o cancelamento da inscrição do colaborador: '{$inscricao->nomeProprio}'?")); ?>
                </td>
            </tr>
        <?php endforeach; ?>

    </tbody>
   
</table>