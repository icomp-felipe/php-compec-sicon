<h1>Colaboradores Cadastrados</h1>

<div class="actionBar">
    [<?php echo CHtml::link('Clique aqui para cadastrar um novo colaborador',array('create')); ?>]
</div>

<table class="dataGrid">

    <thead>
        <tr>
            <th><?php echo $sort->link('cpf'); ?></th>	
            <th><?php echo $sort->link('nome'); ?></th>
            <th><?php echo $sort->link('idmunicipio'); ?></th>
            <th><?php echo $sort->link('celular'); ?></th>
            <th><?php echo $sort->link('colab_banco_id'); ?></th>
            <th><?php echo $sort->link('contacorrente'); ?></th>
            <th><?php echo $sort->link('agencia'); ?></th>
	        <th>Operações</th>
        </tr>
    </thead>

    <tbody>
    <?php foreach($models as $n=>$model): ?>
        <tr class="<?php echo $n%2 ? 'even' : 'odd'; ?>">
            <td><?php echo CHtml::link  ($model->cpfFormatado, array('show','id'=>$model->idColaborador)); ?></td>
            <td><?php echo CHtml::encode($model->nome             ); ?></td>	
            <td><?php echo CHtml::encode($model->municipio->nome  ); ?></td>	
            <td><?php echo CHtml::encode($model->celular          ); ?></td>
            <td><?php echo CHtml::encode($model->banco->banco_nome); ?></td>
            <td><?php echo CHtml::encode($model->contacorrente    ); ?></td>
            <td><?php echo CHtml::encode($model->agencia          ); ?></td>
            <td>
                <?php echo CHtml::link('Atualizar', array('update', 'id' => $model->idColaborador)); ?>
                <?php echo CHtml::linkButton('Excluir', array(
      	                    'submit'  => '',
      	                    'params'  => array('command'=>'delete', 'id' => $model->idColaborador),
      	                    'confirm' => "Confirma a exclusão do colaborador: '{$model->nome}'?")); ?>
	        </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<br>
<?php $this->widget('CLinkPager',array('pages' => $pages)); ?>