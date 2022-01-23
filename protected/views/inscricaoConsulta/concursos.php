<h2>Escolha um Concurso</h2>

<h3 class="actionBar">
    <ul>
        <li>
            <?php if($form->colaborador->colab_sexo == 'F'): ?>
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

                    <td>
                        <?php echo CHtml::link($concurso->conc_nome, array('selecionarConcurso','id' => $concurso->conc_id_pk)); ?>
                    </td>

                    <td align="center">
                        <?php echo CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy HH:mm',$concurso->conc_data_publico_inicio)); ?> - 
                        <?php echo CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy HH:mm',$concurso->conc_data_publico_fim)); ?>
                    </td>

                    <td align="center">
                        <?php echo CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy', $concurso->conc_data_realizacao)); ?>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<br/>