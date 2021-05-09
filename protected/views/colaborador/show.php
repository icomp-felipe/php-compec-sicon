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

<div class="actionBar">
    [<?php echo CHtml::link('Editar',array('update','id'=>$model->idColaborador)); ?>]
</div>

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

<center>Se houver necessidade de alterar os dados do colaborador, clique no menu "Colaboradores" e no link "atualizar" localizado à esquerda de cada colaborador cadastrado por sua escola.</center>