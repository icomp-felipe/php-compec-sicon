<h2>Colaborador <?php echo $model->idColaborador; ?> - Exibir</h2>

<div class="actionBar">
[<?php echo CHtml::link('Listar',array('list')); ?>]
[<?php echo CHtml::link('Inserir',array('create')); ?>]
[<?php echo CHtml::link('Atualizar',array('update','id'=>$model->idColaborador)); ?>]
[<?php echo CHtml::linkButton('Excluir',array('submit'=>array('delete','id'=>$model->idColaborador),'confirm'=>'Confirma exclus&atilde;o?')); ?>
]
[<?php echo CHtml::link('Gerenciar',array('admin')); ?>]
</div>

<table class="dataGrid">
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('idescolaridade')); ?>
</th>
    <td><?php echo CHtml::encode($model->idescolaridade); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('iduf_identidade')); ?>
</th>
    <td><?php echo CHtml::encode($model->iduf_identidade); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('idmunicipio')); ?>
</th>
    <td><?php echo CHtml::encode($model->idmunicipio); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('nome')); ?>
</th>
    <td><?php echo CHtml::encode($model->nome); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('sexo')); ?>
</th>
    <td><?php echo CHtml::encode($model->sexo); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('data_nascimento')); ?>
</th>
    <td><?php echo CHtml::encode($model->data_nascimento); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('doc_identidade')); ?>
</th>
    <td><?php echo CHtml::encode($model->doc_identidade); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('orgao_identidade')); ?>
</th>
    <td><?php echo CHtml::encode($model->orgao_identidade); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('logradouro')); ?>
</th>
    <td><?php echo CHtml::encode($model->logradouro); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('numero_endereco')); ?>
</th>
    <td><?php echo CHtml::encode($model->numero_endereco); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('bairro')); ?>
</th>
    <td><?php echo CHtml::encode($model->bairro); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('cep')); ?>
</th>
    <td><?php echo CHtml::encode($model->cep); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('ddd')); ?>
</th>
    <td><?php echo CHtml::encode($model->ddd); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('telefone')); ?>
</th>
    <td><?php echo CHtml::encode($model->telefone); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('celular')); ?>
</th>
    <td><?php echo CHtml::encode($model->celular); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('email')); ?>
</th>
    <td><?php echo CHtml::encode($model->email); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('cpf')); ?>
</th>
    <td><?php echo CHtml::encode($model->cpf); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('tipo_cadastro')); ?>
</th>
    <td><?php echo CHtml::encode($model->tipo_cadastro); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('status_cadastro')); ?>
</th>
    <td><?php echo CHtml::encode($model->status_cadastro); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('tipo_vinculo')); ?>
</th>
    <td><?php echo CHtml::encode($model->tipo_vinculo); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('anoatualgraduacao')); ?>
</th>
    <td><?php echo CHtml::encode($model->anoatualgraduacao); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('matriculaufam')); ?>
</th>
    <td><?php echo CHtml::encode($model->matriculaufam); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('cursoufam')); ?>
</th>
    <td><?php echo CHtml::encode($model->cursoufam); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('matriculaservidor')); ?>
</th>
    <td><?php echo CHtml::encode($model->matriculaservidor); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('orgaoservidor')); ?>
</th>
    <td><?php echo CHtml::encode($model->orgaoservidor); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('observacoes')); ?>
</th>
    <td><?php echo CHtml::encode($model->observacoes); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('banco')); ?>
</th>
    <td><?php echo CHtml::encode($model->banco); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('contacorrente')); ?>
</th>
    <td><?php echo CHtml::encode($model->contacorrente); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('agencia')); ?>
</th>
    <td><?php echo CHtml::encode($model->agencia); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('pispasep')); ?>
</th>
    <td><?php echo CHtml::encode($model->pispasep); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('tipo_vinculo_old')); ?>
</th>
    <td><?php echo CHtml::encode($model->tipo_vinculo_old); ?>
</td>
</tr>
</table>
