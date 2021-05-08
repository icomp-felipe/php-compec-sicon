<div class="yiiForm">

<p>
Arquivos com <span class="required">*</span> s&atilde;o de preenchimento obrigat&oacute;rio.
</p>

<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($model); ?>

<div class="simple">
<?php echo CHtml::activeLabelEx($model,'No da Ficha'); ?>
<?php echo CHtml::activeTextField($model,'idColaborador',array('size'=>8,'maxlength'=>10, 'disabled'=>'disabled')); ?>
</div>

<div class="simple">
<?php echo CHtml::activeLabelEx($model,'nome'); ?>
<?php echo CHtml::activeTextField($model,'nome',array('size'=>50,'maxlength'=>60)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'doc_identidade'); ?>
<?php echo CHtml::activeTextField($model,'doc_identidade',array('size'=>20,'maxlength'=>20)); ?>
 &Oacute;rg&atilde;o: 
<?php echo CHtml::activeTextField($model,'orgao_identidade',array('size'=>5,'maxlength'=>10)); ?>
 UF
<?php echo CHtml::activeDropDownList($model, 'iduf_identidade', 
									CHtml::listData(uf::model()->findAll(),'iduf','sigla'),
									array('empty'=>'Selecione')) ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'cpf'); ?>
<?php $this->widget('CMaskedTextField',array(
        'model'=>$model,
        'attribute'=>'cpf',
        'mask'=>'999.999.999-99',
        'placeholder'=>'_',
        'htmlOptions'=>array(
            'size'=>13,
            'maxlength'=>13,
        )
    )); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'tipo_vinculo'); ?>
<?php echo CHtml::activeDropDownList($model, 'tipo_vinculo', 
									CHtml::listData(tipovinculo::model()->findAll(),'idtipovinculo','nome'),
									array('empty'=>'Selecione')) ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'idescolaridade'); ?>
<?php echo CHtml::activeDropDownList($model, 'idescolaridade', 
									CHtml::listData(escolaridade::model()->findAll(),'idescolaridade','descricao'),
									array('empty'=>'Selecione')) ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'logradouro'); ?>
<?php echo CHtml::activeTextField($model,'logradouro',array('size'=>50,'maxlength'=>50)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'numero_endereco'); ?>
<?php echo CHtml::activeTextField($model,'numero_endereco',array('size'=>5,'maxlength'=>5)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'bairro'); ?>
<?php echo CHtml::activeTextField($model,'bairro',array('size'=>50,'maxlength'=>80)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'cep'); ?>
<?php echo CHtml::activeTextField($model,'cep',array('size'=>8,'maxlength'=>8)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'idmunicipio'); ?>
<?php echo CHtml::activeDropDownList($model, 'idmunicipio', 
									CHtml::listData(municipio::model()->findAll(),'idmunicipio','nome'),
									array('empty'=>'Selecione')) ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'DDD/Tel.Residencial'); ?>
<?php echo CHtml::activeTextField($model,'ddd',array('size'=>2,'maxlength'=>2)); ?> / 
<?php echo CHtml::activeTextField($model,'telefone',array('size'=>14,'maxlength'=>14)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'celular'); ?>
<?php echo CHtml::activeTextField($model,'celular',array('size'=>16,'maxlength'=>16)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'email'); ?>
<?php echo CHtml::activeTextField($model,'email',array('size'=>50,'maxlength'=>60)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'sexo'); ?>
<?php echo CHtml::activeDropDownList($model,'sexo',
												colaborador::model()->sexoOptions,
												array('empty'=>'Selecione')); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'Dt. nascimento'); ?>
    <?php $this->widget('CMaskedTextField',array(
        'model'=>$model,
        'attribute'=>'data_nascimento',
        'mask'=>'99/99/9999',
        'placeholder'=>'_',
        'htmlOptions'=>array(
            'size'=>10,
            'maxlength'=>10,
        )
    )); ?>&nbsp;Ex: 30/10/2010
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'pispasep'); ?>
<?php $this->widget('CMaskedTextField',array(
        'model'=>$model,
        'attribute'=>'pispasep',
        'mask'=>'999.99999.99-9',
        'placeholder'=>'_',
        'htmlOptions'=>array(
            'size'=>11,
            'maxlength'=>11,
        )
    )); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'banco'); ?>
<?php echo CHtml::activeTextField($model,'banco',array('size'=>50,'maxlength'=>100)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'agencia'); ?>
<?php echo CHtml::activeTextField($model,'agencia',array('size'=>10,'maxlength'=>10)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'contacorrente'); ?>
<?php echo CHtml::activeTextField($model,'contacorrente',array('size'=>20,'maxlength'=>20)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'observacoes'); ?>
<?php echo CHtml::activeTextArea($model,'observacoes',array('rows'=>6, 'cols'=>50)); ?>
</div>
<div class="action">
<?php echo CHtml::submitButton($update ? 'Salvar' : 'Criar'); ?>
</div>

<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->
