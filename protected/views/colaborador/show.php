<h2>

    <?php if($_GET['update']): ?>

        <?php if($model->sexo == 'F'): ?>
            Dados da colaboradora atualizados com sucesso!
        <?php else: ?>
            Dados do colaborador atualizados com sucesso!
        <?php endif; ?></b>

    <?php else: ?>

        <?php if($model->sexo == 'F'): ?>
            Dados da colaboradora registrados com sucesso!
        <?php else: ?>
            Dados do colaborador registrados com sucesso!
        <?php endif; ?></b>

    <?php endif; ?></b>

</h2>

<table class="dataGrid">

    <tr>
	    <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('idColaborador')); ?></th>
        <td><?php echo CHtml::encode($model->idColaborador); ?></td>
    </tr>

    <tr>
	    <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('nome')); ?></th>
        <td><?php echo CHtml::encode($model->nome); ?>
    </td>

    </tr>
        <tr><th class="label"><?php echo CHtml::encode($model->getAttributeLabel('cpf')); ?></th>
        <td><?php echo CHtml::encode($model->cpfFormatado); ?>
    </td>

    </tr>
        <tr><th class="label"><?php echo CHtml::encode($model->getAttributeLabel('doc_identidade')); ?></th>
        <td><?php echo CHtml::encode($model->doc_identidade); ?>
    </td>

    </tr>
        <tr><th class="label"><?php echo CHtml::encode($model->getAttributeLabel('pispasep')); ?></th>
        <td><?php echo CHtml::encode($model->pisFormatado); ?>
    </td>

    </tr>
        <tr><th class="label"><?php echo CHtml::encode($model->getAttributeLabel('banco')); ?></th>
        <td><?php echo CHtml::encode($model->banco); ?>
    </td>

    </tr>
        <tr><th class="label"><?php echo CHtml::encode($model->getAttributeLabel('contacorrente')); ?>
        </th><td><?php echo CHtml::encode($model->contacorrente); ?></td>
    </tr>

    <tr>
    	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('agencia')); ?></th>
        <td><?php echo CHtml::encode($model->agencia); ?></td>
    </tr>

</table>

<br>

<div class="actionBar">

    <ul>
        <li>Se ainda desejar alterar dados, clique aqui → [<?php echo CHtml::link('Editar',array('update','id'=>$model->idColaborador)); ?>]</li>
        <li>Para cadastrar um novo colaborador, clique aqui → [<?php echo CHtml::link('Novo',array('create')); ?>]</li>
    </ul>
    
</div>