<h2>Colaborador - Gerenciar</h2>

<div class="actionBar">
[<?php echo CHtml::link('Listar',array('list')); ?>]
[<?php echo CHtml::link('Criar',array('create')); ?>]
</div>

<table class="dataGrid">
  <thead>
  <tr>
    <th><?php echo $sort->link('idColaborador'); ?></th>
    <th><?php echo $sort->link('idescolaridade'); ?></th>
    <th><?php echo $sort->link('iduf_identidade'); ?></th>
    <th><?php echo $sort->link('idmunicipio'); ?></th>
    <th><?php echo $sort->link('nome'); ?></th>
    <th><?php echo $sort->link('sexo'); ?></th>
    <th><?php echo $sort->link('data_nascimento'); ?></th>
    <th><?php echo $sort->link('doc_identidade'); ?></th>
    <th><?php echo $sort->link('orgao_identidade'); ?></th>
    <th><?php echo $sort->link('logradouro'); ?></th>
    <th><?php echo $sort->link('numero_endereco'); ?></th>
    <th><?php echo $sort->link('bairro'); ?></th>
    <th><?php echo $sort->link('cep'); ?></th>
    <th><?php echo $sort->link('ddd'); ?></th>
    <th><?php echo $sort->link('telefone'); ?></th>
    <th><?php echo $sort->link('celular'); ?></th>
    <th><?php echo $sort->link('email'); ?></th>
    <th><?php echo $sort->link('cpf'); ?></th>
    <th><?php echo $sort->link('tipo_cadastro'); ?></th>
    <th><?php echo $sort->link('status_cadastro'); ?></th>
    <th><?php echo $sort->link('tipo_vinculo'); ?></th>
    <th><?php echo $sort->link('anoatualgraduacao'); ?></th>
    <th><?php echo $sort->link('matriculaufam'); ?></th>
    <th><?php echo $sort->link('cursoufam'); ?></th>
    <th><?php echo $sort->link('matriculaservidor'); ?></th>
    <th><?php echo $sort->link('orgaoservidor'); ?></th>
    <th><?php echo $sort->link('banco'); ?></th>
    <th><?php echo $sort->link('contacorrente'); ?></th>
    <th><?php echo $sort->link('agencia'); ?></th>
    <th><?php echo $sort->link('pispasep'); ?></th>
    <th><?php echo $sort->link('tipo_vinculo_old'); ?></th>
	<th>Opera&ccedil;&otilde;es</th>
  </tr>
  </thead>
  <tbody>
<?php foreach($models as $n=>$model): ?>
  <tr class="<?php echo $n%2?'even':'odd';?>">
    <td><?php echo CHtml::link($model->idColaborador,array('show','id'=>$model->idColaborador)); ?></td>
    <td><?php echo CHtml::encode($model->idescolaridade); ?></td>
    <td><?php echo CHtml::encode($model->iduf_identidade); ?></td>
    <td><?php echo CHtml::encode($model->idmunicipio); ?></td>
    <td><?php echo CHtml::encode($model->nome); ?></td>
    <td><?php echo CHtml::encode($model->sexo); ?></td>
    <td><?php echo CHtml::encode($model->data_nascimento); ?></td>
    <td><?php echo CHtml::encode($model->doc_identidade); ?></td>
    <td><?php echo CHtml::encode($model->orgao_identidade); ?></td>
    <td><?php echo CHtml::encode($model->logradouro); ?></td>
    <td><?php echo CHtml::encode($model->numero_endereco); ?></td>
    <td><?php echo CHtml::encode($model->bairro); ?></td>
    <td><?php echo CHtml::encode($model->cep); ?></td>
    <td><?php echo CHtml::encode($model->ddd); ?></td>
    <td><?php echo CHtml::encode($model->telefone); ?></td>
    <td><?php echo CHtml::encode($model->celular); ?></td>
    <td><?php echo CHtml::encode($model->email); ?></td>
    <td><?php echo CHtml::encode($model->cpf); ?></td>
    <td><?php echo CHtml::encode($model->tipo_cadastro); ?></td>
    <td><?php echo CHtml::encode($model->status_cadastro); ?></td>
    <td><?php echo CHtml::encode($model->tipo_vinculo); ?></td>
    <td><?php echo CHtml::encode($model->anoatualgraduacao); ?></td>
    <td><?php echo CHtml::encode($model->matriculaufam); ?></td>
    <td><?php echo CHtml::encode($model->cursoufam); ?></td>
    <td><?php echo CHtml::encode($model->matriculaservidor); ?></td>
    <td><?php echo CHtml::encode($model->orgaoservidor); ?></td>
    <td><?php echo CHtml::encode($model->banco); ?></td>
    <td><?php echo CHtml::encode($model->contacorrente); ?></td>
    <td><?php echo CHtml::encode($model->agencia); ?></td>
    <td><?php echo CHtml::encode($model->pispasep); ?></td>
    <td><?php echo CHtml::encode($model->tipo_vinculo_old); ?></td>
    <td>
      <?php echo CHtml::link('Atualizar',array('update','id'=>$model->idColaborador)); ?>
      <?php echo CHtml::linkButton('Excluir',array(
      	  'submit'=>'',
      	  'params'=>array('command'=>'delete','id'=>$model->idColaborador),
      	  'confirm'=>"Confirma excluir - Id #{$model->idColaborador}?")); ?>
	</td>
  </tr>
<?php endforeach; ?>
  </tbody>
</table>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>