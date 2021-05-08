<h2>Concurso - Gerenciar</h2>

<div class="actionBar">
[<?php echo CHtml::link('Listar',array('list')); ?>]
[<?php echo CHtml::link('Criar',array('create')); ?>]
</div>

<table class="dataGrid">
  <thead>
  <tr>
    <th><?php echo $sort->link('idconcurso'); ?></th>
    <th><?php echo $sort->link('idinstituicaorealizadora'); ?></th>
    <th><?php echo $sort->link('idinstituicaogestora'); ?></th>
    <th><?php echo $sort->link('descricao'); ?></th>
    <th><?php echo $sort->link('ano'); ?></th>
    <th><?php echo $sort->link('quantidade_etapas'); ?></th>
    <th><?php echo $sort->link('etapa_atual'); ?></th>
    <th><?php echo $sort->link('situacao'); ?></th>
    <th><?php echo $sort->link('datainicioinscricao'); ?></th>
    <th><?php echo $sort->link('datafiminscricao'); ?></th>
    <th><?php echo $sort->link('clonado'); ?></th>
	<th>Opera&ccedil;&otilde;es</th>
  </tr>
  </thead>
  <tbody>
<?php foreach($models as $n=>$model): ?>
  <tr class="<?php echo $n%2?'even':'odd';?>">
    <td><?php echo CHtml::link($model->idconcurso,array('show','id'=>$model->idconcurso)); ?></td>
    <td><?php echo CHtml::encode($model->idinstituicaorealizadora); ?></td>
    <td><?php echo CHtml::encode($model->idinstituicaogestora); ?></td>
    <td><?php echo CHtml::encode($model->descricao); ?></td>
    <td><?php echo CHtml::encode($model->ano); ?></td>
    <td><?php echo CHtml::encode($model->quantidade_etapas); ?></td>
    <td><?php echo CHtml::encode($model->etapa_atual); ?></td>
    <td><?php echo CHtml::encode($model->situacao); ?></td>
    <td><?php echo CHtml::encode($model->datainicioinscricao); ?></td>
    <td><?php echo CHtml::encode($model->datafiminscricao); ?></td>
    <td><?php echo CHtml::encode($model->clonado); ?></td>
    <td>
      <?php echo CHtml::link('Atualizar',array('update','id'=>$model->idconcurso)); ?>
      <?php echo CHtml::linkButton('Excluir',array(
      	  'submit'=>'',
      	  'params'=>array('command'=>'delete','id'=>$model->idconcurso),
      	  'confirm'=>"Confirma excluir - Id #{$model->idconcurso}?")); ?>
	</td>
  </tr>
<?php endforeach; ?>
  </tbody>
</table>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>