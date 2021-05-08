<h2>Colaborador - Listar</h2>

<div class="actionBar">
[<?php echo CHtml::link('Criar',array('create')); ?>]
[<?php echo CHtml::link('Gerenciar',array('admin')); ?>]
</div>

<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>

<?php foreach($models as $n=>$model): ?>
<div class="item">
<?php echo CHtml::encode($model->getAttributeLabel('idColaborador')); ?>:
<?php echo CHtml::link($model->idColaborador,array('show','id'=>$model->idColaborador)); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('idescolaridade')); ?>:
<?php echo CHtml::encode($model->idescolaridade); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('iduf_identidade')); ?>:
<?php echo CHtml::encode($model->iduf_identidade); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('idmunicipio')); ?>:
<?php echo CHtml::encode($model->idmunicipio); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('nome')); ?>:
<?php echo CHtml::encode($model->nome); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('sexo')); ?>:
<?php echo CHtml::encode($model->sexo); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('data_nascimento')); ?>:
<?php echo CHtml::encode($model->data_nascimento); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('doc_identidade')); ?>:
<?php echo CHtml::encode($model->doc_identidade); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('orgao_identidade')); ?>:
<?php echo CHtml::encode($model->orgao_identidade); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('logradouro')); ?>:
<?php echo CHtml::encode($model->logradouro); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('numero_endereco')); ?>:
<?php echo CHtml::encode($model->numero_endereco); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('bairro')); ?>:
<?php echo CHtml::encode($model->bairro); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('cep')); ?>:
<?php echo CHtml::encode($model->cep); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('ddd')); ?>:
<?php echo CHtml::encode($model->ddd); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('telefone')); ?>:
<?php echo CHtml::encode($model->telefone); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('celular')); ?>:
<?php echo CHtml::encode($model->celular); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('email')); ?>:
<?php echo CHtml::encode($model->email); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('cpf')); ?>:
<?php echo CHtml::encode($model->cpf); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('tipo_cadastro')); ?>:
<?php echo CHtml::encode($model->tipo_cadastro); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('status_cadastro')); ?>:
<?php echo CHtml::encode($model->status_cadastro); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('tipo_vinculo')); ?>:
<?php echo CHtml::encode($model->tipo_vinculo); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('anoatualgraduacao')); ?>:
<?php echo CHtml::encode($model->anoatualgraduacao); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('matriculaufam')); ?>:
<?php echo CHtml::encode($model->matriculaufam); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('cursoufam')); ?>:
<?php echo CHtml::encode($model->cursoufam); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('matriculaservidor')); ?>:
<?php echo CHtml::encode($model->matriculaservidor); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('orgaoservidor')); ?>:
<?php echo CHtml::encode($model->orgaoservidor); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('observacoes')); ?>:
<?php echo CHtml::encode($model->observacoes); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('banco')); ?>:
<?php echo CHtml::encode($model->banco); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('contacorrente')); ?>:
<?php echo CHtml::encode($model->contacorrente); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('agencia')); ?>:
<?php echo CHtml::encode($model->agencia); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('pispasep')); ?>:
<?php echo CHtml::encode($model->pispasep); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('tipo_vinculo_old')); ?>:
<?php echo CHtml::encode($model->tipo_vinculo_old); ?>
<br/>

</div>
<?php endforeach; ?>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>