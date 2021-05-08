<h2>Ativação confirmada</h2>

<!--p>Consultar resultado do processo na página da COMPEC ap&oacute;s o dia <?php echo CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$form->concurso->datafiminscricao)); ?>.</p-->

<div class="yiiForm">
<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($form); ?>

<table class="dataGrid">
<tr>
	<th class="label">Inscrição n&ordm;</th>
    <td><?php echo inscricao::load($form->colaborador->idColaborador, $form->etapa->idetapa)->idinscricao; ?></td>
</tr>
<tr>
	<th class="label">Processo Seletivo</th>
    <td><?php echo $form->concurso->descricao .'. Prova do dia: '. CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$form->etapa->data_realizacao)); ?></td>
</tr>
<tr>
	<th class="label">Instituição</th>
    <td><?php echo $form->instituicao->nome; ?></td>
</tr>
<tr>
	<th class="label">Função</th>
    <td><?php echo $form->funcao->nome; ?></td>
</tr>
<tr>
	<th class="label">Colaborador</th>
    <td><?php echo $form->cpf; ?> - 
		<?php echo $form->colaborador->nome; ?></td>
</tr>

<tr>
	<th class="label">Banco</th>
    <td><?php echo $form->colaborador->banco; ?></td>
</tr>
<tr>
	<th class="label">Agência</th>
    <td><?php echo $form->colaborador->agencia; ?></td>
</tr>
<tr>
	<th class="label">Conta Corrente</th>
    <td><?php echo $form->colaborador->contacorrente; ?></td>
</tr>
<tr>
	<th class="label">PIS/PASEP</th>
    <td><?php echo $form->colaborador->pispasep; ?></td>
</tr>
<tr>
	<th class="label">RG</th>
    <td><?php echo $form->colaborador->doc_identidade; ?></td>
</tr>

</table>

<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->

<div class="actionBar">
<?php echo CHtml::link('Inscrever outro colaborador no mesmo processo, escola e função...',array('selecionarColaborador','cpf'=>'')); ?>
</div>
