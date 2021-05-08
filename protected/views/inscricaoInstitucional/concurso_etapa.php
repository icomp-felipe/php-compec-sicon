<h2>Escolha o concurso</h2>

<table class="dataGrid">
  <thead>
  <tr>
    <th>Descrição</th>
    <th>Realização</th>
    <th>Período de Inscrições</th>
	<th>Etapa do concurso</th>
  </tr>
  </thead>
  <tbody>
<?php foreach($models as $n=>$model): ?>
  <tr class="<?php echo $n%2?'even':'odd';?>">
   <td><?php echo CHtml::encode($model->descricao); ?>
			<font color="#FF0066"><?php echo ($model->emteste==1?' (Em teste)':''); ?></font></td>
    <td><?php echo CHtml::encode($model->instituicaorealizadora->nome); ?></td>
    <td><?php echo CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$model->datainicioinscricao)); ?> - 
        <?php echo CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$model->datafiminscricao)); ?></td>
    <td>
		<?php foreach($model->etapas as $e=>$etapa): ?>	
			<?php if($etapa->status_etapa != 2): //a realizar (0) | em andamento (1) | finalizada (2)?>
			<div>
				<?php echo CHtml::link(CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$etapa->data_realizacao)),
									array('selecionarConcursoEtapa','idetapa'=>$etapa->idetapa)); ?>			
			</div>			
			<?php else: ?>
			<div>
				<?php echo CHtml::encode(Yii::app()->dateFormatter->format('dd/MM/yyyy',$etapa->data_realizacao)); ?>			
			</div>
			<?php endif;?>
		<?php endforeach; ?>		
	</td>
  </tr>
  
<?php endforeach; ?>
  </tbody>
</table>
<br/>
