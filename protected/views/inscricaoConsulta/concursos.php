<h2>Escolha um Concurso</h2>

<h3 class="actionBar">
    <ul>
        <li>
            <?php if($form->colaborador->sexo == 'F'): ?>
                Colaboradora:
            <?php else: ?>
                Colaborador:
            <?php endif; ?>
            <?php echo $form->colaborador->nomeProprio .' ['. CHtml::link('Trocar',array('/inscricaoConsulta')).']'; ?>
        </li>
    </ul>
</h3>

<?php echo CHtml::errorSummary($form, 'Atenção!'); ?>

    <table class="dataGrid">

        <thead>
            <tr>
                <th>Nome do Concurso</th>
                <th>Período de Inscrições</th>
	            <th>Data de Realização</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($concursos as $n => $concurso): ?>
                <tr class="<?php echo $n % 2 ? 'even' : 'odd';?>">

                    <td><?php echo CHtml::link($concurso->descricao, array('selecionarConcurso','id' => $concurso->idconcurso)); ?>
                        <font color="#FF0066"><?php echo ($concurso->emteste == 1 ? ' (Restrito)' : ''); ?></font></td>
                    </td>

                    <td align="center">
                        <?php echo CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$concurso->datainicioinscricao)); ?> - 
                        <?php echo CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$concurso->datafiminscricao)); ?>
                    </td>

                    <td align="center">
                        <?php echo CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy', $concurso->conc_data_realizacao)); ?>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<br/>