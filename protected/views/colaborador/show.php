<h2>

    <?php if($_GET['update']): ?>

        <?php if($model->colab_sexo == 'F'): ?>
            Dados da colaboradora atualizados com sucesso!
        <?php else: ?>
            Dados do colaborador atualizados com sucesso!
        <?php endif; ?></b>

    <?php else: ?>

        <?php if($model->colab_sexo == 'F'): ?>
            Dados da colaboradora registrados com sucesso!
        <?php else: ?>
            Dados do colaborador registrados com sucesso!
        <?php endif; ?></b>

    <?php endif; ?></b>

</h2>

<table class="dataGrid">

    <tr>
	    <th class="label" style="text-align: right"><?php echo CHtml::encode($model->getAttributeLabel('colab_id_pk')); ?></th>
        <td><?php echo CHtml::encode($model->colab_id_pk); ?></td>
    </tr>

    <tr>
	    <th class="label" style="text-align: right"><?php echo CHtml::encode($model->getAttributeLabel('colab_nome')); ?></th>
        <td><?php echo CHtml::encode($model->colab_nome); ?></td>
    </tr>

    <tr>
        <th class="label" style="text-align: right"><?php echo CHtml::encode($model->getAttributeLabel('colab_cpf')); ?></th>
        <td><?php echo CHtml::encode($model->cpfFormatado); ?></td>
    </tr>

    <tr>
        <th class="label" style="text-align: right"><?php echo CHtml::encode($model->getAttributeLabel('colab_rg')); ?></th>
        <td><?php echo CHtml::encode($model->colab_rg); ?></td>
    </tr>

    <tr>
        <th class="label" style="text-align: right"><?php echo CHtml::encode($model->getAttributeLabel('colab_pis')); ?></th>
        <td><?php echo CHtml::encode($model->pisFormatado); ?></td>
    </tr>
    
        <tr><th class="label" style="text-align: right"><?php echo CHtml::encode($model->getAttributeLabel('colab_banco_id')); ?></th>
        <td><?php echo CHtml::encode($model->banco->bancoComCodigo); ?>
    </td>

    <tr>
    	<th class="label" style="text-align: right"><?php echo CHtml::encode($model->getAttributeLabel('colab_agencia')); ?></th>
        <td><?php echo CHtml::encode($model->colab_agencia); ?></td>
    </tr>

    </tr>
        <tr><th class="label" style="text-align: right"><?php echo CHtml::encode($model->getAttributeLabel('colab_conta')); ?>
        </th><td><?php echo CHtml::encode($model->colab_conta); ?></td>
    </tr>

    </tr>
        <tr><th class="label" style="text-align: right"><?php echo CHtml::encode($model->getAttributeLabel('colab_conta_dv')); ?>
        </th><td><?php echo CHtml::encode($model->colab_conta_dv); ?></td>
    </tr>

</table>

<br>

<div class="actionBar">

    <ul>
        <li>Se ainda desejar alterar dados, clique aqui → [<?php echo CHtml::link('Editar',array('update','id'=>$model->colab_id_pk)); ?>]</li>
        <li>Para cadastrar um novo colaborador, clique aqui → [<?php echo CHtml::link('Novo',array('create')); ?>]</li>
    </ul>
    
</div>