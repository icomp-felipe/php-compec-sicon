<h2>Inscricao - Gerenciar</h2>

<div class="actionBar">
[<?php echo CHtml::link('Listar',array('list')); ?>]
[<?php echo CHtml::link('Criar',array('create')); ?>]
</div>

<table class="dataGrid">
  <thead>
  <tr>
    <th><?php echo $sort->link('idinscricao'); ?></th>
    <th><?php echo $sort->link('idinstituicaoopcao2'); ?></th>
    <th><?php echo $sort->link('idinstituicaoopcao1'); ?></th>
    <th><?php echo $sort->link('idconcurso'); ?></th>
    <th><?php echo $sort->link('idColaborador'); ?></th>
    <th><?php echo $sort->link('selecionado'); ?></th>
    <th><?php echo $sort->link('codinscricao'); ?></th>
    <th><?php echo $sort->link('tipoinscricao'); ?></th>
    <th><?php echo $sort->link('candidatociente'); ?></th>
    <th><?php echo $sort->link('idFuncao'); ?></th>
    <th><?php echo $sort->link('dt_hr'); ?></th>
	<th>Opera&ccedil;&otilde;es</th>
  </tr>
  </thead>
  <tbody>
<?php foreach($models as $n=>$model): ?>
  <tr class="<?php echo $n%2?'even':'odd';?>">
    <td><?php echo CHtml::link($model->idinscricao,array('show','id'=>$model->idinscricao)); ?></td>
    <td><?php echo CHtml::encode($model->idinstituicaoopcao2); ?></td>
    <td><?php echo CHtml::encode($model->idinstituicaoopcao1); ?></td>
    <td><?php echo CHtml::encode($model->idconcurso); ?></td>
    <td><?php echo CHtml::encode($model->idColaborador); ?></td>
    <td><?php echo CHtml::encode($model->selecionado); ?></td>
    <td><?php echo CHtml::encode($model->codinscricao); ?></td>
    <td><?php echo CHtml::encode($model->tipoinscricao); ?></td>
    <td><?php echo CHtml::encode($model->candidatociente); ?></td>
    <td><?php echo CHtml::encode($model->idFuncao); ?></td>
    <td><?php echo CHtml::encode($model->dt_hr); ?></td>
    <td>
      <?php echo CHtml::link('Atualizar',array('update','id'=>$model->idinscricao)); ?>
      <?php echo CHtml::linkButton('Excluir',array(
      	  'submit'=>'',
      	  'params'=>array('command'=>'delete','id'=>$model->idinscricao),
      	  'confirm'=>"Confirma excluir - Id #{$model->idinscricao}?")); ?>
	</td>
  </tr>
<?php endforeach; ?>
  </tbody>
</table>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>