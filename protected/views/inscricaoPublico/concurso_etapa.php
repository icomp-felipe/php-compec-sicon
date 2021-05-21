<h2>Escolha um Concurso</h2>

<h3 class="actionBar">
    <ul>
        <li>
            <?php if($form->colaborador->sexo == 'F'): ?>
                Colaboradora:
            <?php else: ?>
                Colaborador:
            <?php endif; ?>
            <?php echo $form->colaborador->nome .' ['. CHtml::link('Trocar',array('/inscricaoPublico')).']'; ?>
        </li>
    </ul>
</h3>

<?php echo CHtml::errorSummary($form,'Atenção!'); ?>

    <table class="dataGrid">

        <thead>
            <tr>
                <th>Nome do Concurso</th>
                <th>Período de Inscrições</th>
	            <th>Data de Realização</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($models as $n=>$model): ?>
                <tr class="<?php echo $n % 2 ? 'even' : 'odd';?>">

                    <td><?php echo CHtml::encode($model->descricao); ?>
                        <font color="#FF0066"><?php echo ($model->emteste == 1 ? ' (Restrito)' : ''); ?></font></td>
                    </td>

                    <td align="center">
                        <?php echo CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$model->datainicioinscricao)); ?> - 
                        <?php echo CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$model->datafiminscricao)); ?>
                    </td>

                    <td align="center">
                        <?php echo CHtml::link(CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy', $model->conc_data_realizacao)),
                                                array('selecionarConcurso','idconcurso' => $model->idconcurso)); ?>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<br/>